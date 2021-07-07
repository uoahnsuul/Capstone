import pandas as pd
import pymysql

from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import CountVectorizer
from sklearn.feature_extraction.text import TfidfTransformer
from sklearn.naive_bayes import MultinomialNB

import pickle
import numpy as np
from keyextractor import user_keyword

conn = pymysql.connect(host='localhost', user='root', password='autoset', db='capstone', charset='utf8')

curs = conn.cursor()

sql = "SELECT keyword, category FROM keyvec"
curs.execute(sql)
result = curs.fetchall()

sql = "SELECT ID, maintext, category FROM rawdata"
curs.execute(sql)
db = curs.fetchall()

data = {"news" : [], "code" : []}

for i in range(len(result)):
    data["news"].append(result[i][0])
    data["code"].append(result[i][1])


df = pd.DataFrame(data)
#df

X_train, X_test, y_train, y_test = train_test_split(df["news"], df["code"], random_state=0)

#단어의 수를 카운트하는 사이킷런의 카운트벡터라이저
count_vec = CountVectorizer()
X_train_counts = count_vec.fit_transform(X_train)

# 카운트벡터라이저의 결과로부터 TF-IDF 결과를 얻습니다.
tfidf_transformer = TfidfTransformer()

X_train_tfidf = tfidf_transformer.fit_transform(X_train_counts)

# 나이브베이즈 분류기를 수행ㅎ압니다.
# X_train은 TF-IDF 벡터, y_train은 레이블입니다.
clf = MultinomialNB().fit(X_train_tfidf, y_train)

c = 0
cc = 0
for i in range(1500):
    flag0 = 0
    flag1 = 0
    flag2 = 0
    text = user_keyword(db[i][1])
    X_test_counts = count_vec.transform(dict(text[:1]))
    X_test_tfidf = tfidf_transformer.transform(X_test_counts)
    c1 = clf.predict(X_test_tfidf)
    X_test_counts = count_vec.transform(dict(text[1:2]))
    X_test_tfidf = tfidf_transformer.transform(X_test_counts)
    c2 = clf.predict(X_test_tfidf)
    X_test_counts = count_vec.transform(dict(text[2:3]))
    X_test_tfidf = tfidf_transformer.transform(X_test_counts)
    c3 = clf.predict(X_test_tfidf)
    X_test_counts = count_vec.transform(dict(text[3:4]))
    X_test_tfidf = tfidf_transformer.transform(X_test_counts)
    c4 = clf.predict(X_test_tfidf)
    X_test_counts = count_vec.transform(dict(text[4:5]))
    X_test_tfidf = tfidf_transformer.transform(X_test_counts)
    c5 = clf.predict(X_test_tfidf)
    print(i)
    if c1 == '0':
        flag0 = flag0 + 1
    elif c1 == '1':
        flag1 = flag1 + 1
    elif c1 == '2':
        flag2 = flag2 + 1
    if c2 == '0':
        flag0 = flag0 + 1
    elif c2 == '1':
        flag1 = flag1 + 1
    elif c2 == '2':
        flag2 = flag2 + 1
    if c3 == '0':
        flag0 = flag0 + 1
    elif c3 == '1':
        flag1 = flag1 + 1
    elif c3 == '2':
        flag2 = flag2 + 1
    if c4 == '0':
        flag0 = flag0 + 1
    elif c4 == '1':
        flag1 = flag1 + 1
    elif c4 == '2':
        flag2 = flag2 + 1
    if c5 == '0':
        flag0 = flag0 + 1
    elif c5 == '1':
        flag1 = flag1 + 1
    elif c5 == '2':
        flag2 = flag2 + 1
    flag = [flag0, flag1, flag2]
    if max(flag) == flag0:
        ca = 0
    if max(flag) == flag1:
        ca = 1
    if max(flag) == flag2:
        ca = 2
    if db[i][2] == str(ca):
        cc = cc+1

print(cc/1500)


with open("file.pkl", 'wb') as fout:
    pickle.dump((count_vec, tfidf_transformer, clf), fout)


