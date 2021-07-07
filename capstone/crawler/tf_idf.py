import math
import os


def Find_df(word):
    filepath = os.path.join('inverseindex', word + ".txt")
    try:
        fid = open(filepath, "r", encoding = "UTF8")
    except:
        return 0
    else:
        cnt = 0
        while True:
            line = fid.readline()
            if not line: break
            cnt += 1
    return cnt


def WORDS_TF_IDF(words):
    newWords = {}
    entries = os.listdir('index')
    cnt_files = len(entries)
    for word in words:
        tf = math.log(words[word] + 1)
        idf = math.log(cnt_files / (Find_df(word) + 1) )
        newWords[word] = tf * idf
    newWords = sorted(newWords.items(), key=lambda x: x[1], reverse=True)
    return newWords
