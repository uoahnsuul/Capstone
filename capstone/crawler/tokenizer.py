import urllib3
import json
import math
import pymysql
import os

conn = pymysql.connect(host='localhost', user='root', password='autoset', db='capstone', charset='utf8')

curs = conn.cursor()
cur = conn.cursor()


def createFolder(directory):
    try:
        if not os.path.exists(directory):
            os.makedirs(directory)
    except OSError:
        print('Error: Creating directory. ' + directory)


def tokenizer(text):
    openApiURL = "http://aiopen.etri.re.kr:8000/WiseNLU"

    accessKey = "e32d4502-57bd-4886-8e22-241b715a701a"
    analysisCode = "morp"
    requestJson = {
        "access_key": accessKey,
        "argument": {
            "text": text,
            "analysis_code": analysisCode
        }
    }

    http = urllib3.PoolManager()
    response = http.request(
        "POST",
        openApiURL,
        headers={"Content-Type": "application/json; charset=UTF-8"},
        body=json.dumps(requestJson)
    )

    res = response.data.decode('utf-8')
    dic = json.loads(res)
    print(dic)
    return_object = dic['return_object']

    sentence = return_object['sentence']

    words = {}
    for i in range(len(sentence)):
        morp = sentence[i]['morp']
        for j in range(len(morp)):
            if morp[j]['type'][0] == 'N':
                g = words.get(morp[j]['lemma'])
                if len(morp[j]['lemma']) == 1:
                    continue
                if g is None:
                    words[morp[j]['lemma']] = 1
                else:
                    words[morp[j]['lemma']] = g + 1

    return words


def Find_df(word):
    filepath = os.path.join('inverseindex', word + ".txt")
    try:
        fid = open(filepath, "r", encoding="UTF8")
    except:
        return 0
    else:
        cnt = 0
        while True:
            line = fid.readline()
            if not line: break
            cnt += 1
    return cnt


def TF_IDF(article_id):
    dic = {}
    entries = os.listdir('index')
    cnt_files = len(entries)
    filepath = os.path.join('index', article_id + ".txt")
    fid = open(filepath, "r", encoding="UTF8")
    while True:
        line = fid.readline()
        if not line: break
        line = line.split("\t")
        word = line[0]
        tf = int(line[1])
        tf = math.log(tf + 1)
        idf = math.log(cnt_files / (Find_df(word) + 1))
        dic[word] = tf * idf
    fid.close()
    return dic


def TF_IDF_FILE_MAKER(article_id, text):
    words = tokenizer(text)

    article_id = str(article_id)

    entries = os.listdir('index')

    if article_id + '.txt' in entries:
        return

    try:
        if not os.path.exists("index"):
            os.makedirs("index")
    except OSError:
        print('Error: Creating directory. ' + "index")

    try:
        if not os.path.exists("inverseindex"):
            os.makedirs("inverseindex")
    except OSError:
        print('Error: Creating directory. ' + "inverseindex")

    filepath = os.path.join('index', article_id + ".txt")
    fid = open(filepath, "w", encoding="UTF8")
    for word in words:
        # print(word)
        fid.write("%s\t%d\n" % (word, words[word]))

        wordfilepath = os.path.join('inverseindex', word + ".txt")
        if os.path.exists(wordfilepath):
            wordfid = open(wordfilepath, "a", encoding="UTF8")
        else:
            wordfid = open(wordfilepath, "w", encoding="UTF8")
        wordfid.write("%s\n" % (article_id))
        wordfid.close()


def WORDS_TF_IDF(words):
    newWords = {}
    entries = os.listdir('index')
    cnt_files = len(entries)
    for word in words:
        tf = math.log(words[word] + 1)
        idf = math.log(cnt_files / (Find_df(word) + 1))
        newWords[word] = tf * idf
        if len(newWords) >= 5:
            break
    newWords = sorted(newWords.items(), key=lambda x: x[1], reverse=True)
    return newWords


def Find_TF_IDF(text):
    words = tokenizer(text)
    return WORDS_TF_IDF(words)


def keyword(media):
    createFolder('index')
    createFolder('inverseindex')

    sql = "SELECT ID, mainText, category, media FROM rawdata where media = %s"
    curs.execute(sql, media)

    result = curs.fetchall()

    for i in range(len(result)):
        id = result[i][0]
        text = result[i][1]
        TF_IDF_FILE_MAKER(id, text)

    i = 0

    for i in range(len(result)):
        sql = "SELECT * FROM keyvec where document_ID = %s and media = %s"
        curs.execute(sql, (result[i][0], media))
        arr = curs.fetchall()
        if len(arr) > 0:
            continue
        id = result[i][0]
        text = result[i][1]
        category = result[i][2]
        tmp = Find_TF_IDF(text)
        for j in range(len(tmp)):
            sql = "INSERT INTO keyvec (document_ID,keyword,category, tf_idf, media, date) VALUES (%s, %s, %s, %s, %s, now())"
            try:
                curs.execute(sql, (id, tmp[j][0], category, tmp[j][1], result[i][3]))
                conn.commit()
            except Exception as e:
                print(e)
