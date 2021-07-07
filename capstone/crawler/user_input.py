import pymysql
import numpy as np
from crawler_user import donga_user
from crawler_user import hani_user
from crawler_user import joins_user
from crawler_user import newsis_user
from crawler_user import newsdaily_user
from keyextractor import user_keyword
import pickle
import time

start = time.time()
def User_Url_Input(url):
    if 'donga' in url:
        text = donga_user(url)

    elif 'hani' in url:
        text = hani_user(url)

    elif 'joins' in url:
        text = joins_user(url)

    elif 'newsdaily' in url:
        text = newsdaily_user(url)

    elif 'newsis' in url:
        text = newsis_user(url)

    ret = User_Text_Input(text)

    return ret


def User_Text_Input(text):
    text = user_keyword(text)
    return text


def Find_Category(Text):

    with open('file.pkl', 'rb') as f:
        new_count_vec, new_tfidf_transformer, new_clf = pickle.load(f)

    data_counts = new_count_vec.transform(Text)
    data_tfidf = new_tfidf_transformer.transform(data_counts)

    return new_clf.predict(data_tfidf)


def CosSim(words1, words2):
    list1 = np.array(list(words1.values()))
    list2 = np.array(list(words2.values()))

    size1 = np.sqrt(np.square(list1).sum())
    size2 = np.sqrt(np.square(list2).sum())
    dotSize = 0

    for i in words1.keys():
        tmp1 = words1[i]
        tmp2 = words2.get(i)
        if tmp2 == None:
            tmp2 = 0
        dotSize += tmp1 * tmp2
    if size1 == 0 or size2 == 0:
        cos=0
    else:
        cos = (dotSize / (size1 * size2))

    return cos


conn = pymysql.connect(host='localhost', user='root', password='autoset',db='capstone', charset='utf8')

curs = conn.cursor()
curs.execute('select maintext, flag from userinput ORDER BY ID DESC limit 1')

ch = curs.fetchone()

text = ch[0]
flag = ch[1]

if flag == 1:
    text = User_Text_Input(text)

if flag == 2:
    text = User_Url_Input(text)

if flag == 3:
    text = User_Text_Input(text)
#print(text)
dat = ""
cnt = 0
dic_text = {}
for i in text:
    if cnt > 4:
        break
    dat += (i[0] + " ")
    cnt = cnt + 1

for i in range(5):
    if i >= len(text):
        break
    dic_text[text[i][0]] = text[i][1]

user_word_list = [dat]
category = Find_Category(user_word_list)[0]
sql = "SELECT document_ID, keyword, weight FROM keyvec where category = %s and media = %s"
curs.execute(sql, (category, '한겨레'))
result = curs.fetchall()
print(category)
max = 0.0
cnt = 1
max_id = cnt
dictionary = {}
for i in range(0, len(result)):
    if result[i][0] == cnt:
        dictionary[result[i][1]] = result[i][2]
    else:
        cos = CosSim(dictionary, dic_text)
        if max < cos:
            max_id = cnt
            max = cos
        dictionary = {}
        cnt = cnt+1
        if result[i][0] == cnt:
            dictionary[result[i][1]] = result[i][2]

output = {}
output[max_id] = round(max*100, 1)

category = Find_Category(user_word_list)[0]
sql = "SELECT document_ID, keyword, weight FROM keyvec where category = %s and media = %s"
curs.execute(sql, (category, '동아일보'))
result = curs.fetchall()

max = 0.0
cnt = result[0][0]
max_id = cnt
dictionary = {}
for i in range(0, len(result)):
    if result[i][0] == cnt:
        dictionary[result[i][1]] = result[i][2]
    else:
        cos = CosSim(dictionary, dic_text)
        if max < cos:
            max_id = cnt
            max = cos
        dictionary = {}
        cnt = cnt+1
        if result[i][0] == cnt:
            dictionary[result[i][1]] = result[i][2]

output[max_id] = round(max*100, 1)

sql = "SELECT document_ID, keyword, weight FROM keyvec where category = %s and media = %s"
curs.execute(sql, (category, '중앙일보'))
result = curs.fetchall()

max = 0.0
cnt = result[0][0]
max_id = cnt
dictionary = {}
for i in range(0, len(result)):
    if result[i][0] == cnt:
        dictionary[result[i][1]] = result[i][2]
    else:
        cos = CosSim(dictionary, dic_text)
        if max < cos:
            max_id = cnt
            max = cos
        dictionary = {}
        cnt = cnt+1
        if result[i][0] == cnt:
            dictionary[result[i][1]] = result[i][2]

output[max_id] = round(max*100, 1)

sql = "SELECT document_ID, keyword, weight FROM keyvec where category = %s and media = %s"
curs.execute(sql, (category, 'Newsis'))
result = curs.fetchall()

max = 0.0
cnt = result[0][0]
max_id = cnt
dictionary = {}
for i in range(0, len(result)):
    if result[i][0] == cnt:
        dictionary[result[i][1]] = result[i][2]
    else:
        cos = CosSim(dictionary, dic_text)
        if max < cos:
            max_id = cnt
            max = cos
        dictionary = {}
        cnt = cnt+1
        if result[i][0] == cnt:
            dictionary[result[i][1]] = result[i][2]

output[max_id] = round(max*100, 1)

sql = "SELECT document_ID, keyword, weight FROM keyvec where category = %s and media = %s"
curs.execute(sql, (category, 'Newsdaily'))
result = curs.fetchall()

max = 0.0
cnt = result[0][0]
max_id = cnt
dictionary = {}
for i in range(0, len(result)):
    if result[i][0] == cnt:
        dictionary[result[i][1]] = result[i][2]
    else:
        cos = CosSim(dictionary, dic_text)
        if max < cos:
            max_id = cnt
            max = cos
        dictionary = {}
        cnt = cnt+1
        if result[i][0] == cnt:
            dictionary[result[i][1]] = result[i][2]

output[max_id] = round(max*100, 1)


output = sorted(output.items(), key=lambda x: x[1], reverse=True)
#print(output)
sql = "INSERT INTO output (id1, max1, id2, max2, id3, max3, id4, max4, id5, max5) values (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
curs.execute(sql, (output[0][0], str(output[0][1]), output[1][0], str(output[1][1]), output[2][0], str(output[2][1]), output[3][0], str(output[3][1]), output[4][0], str(output[4][1])))
conn.commit()


curs.close()
conn.close()

end = time.time()
print("코드 실행 시간 :", end-start)
