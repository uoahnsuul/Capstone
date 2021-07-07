import requests as r
import json
import pymysql
import urllib3
import os

conn = pymysql.connect(host='localhost', user='root', password='autoset', db='capstone', charset='utf8')

curs = conn.cursor()
cur = conn.cursor()

#class result()
def token(text):
    # URL 지정
    url = "http://svc.saltlux.ai:31781"

    # Header 정보 지정
    headers = {'Content-Type': 'application/json; charset=utf-8'}

    # Request Parameter 정보 지정
    params = {
        'key': '00c9bb19-e898-437c-a80a-a8d98fdf97ec',
        #'key': '372aad40-e515-40e8-846e-38b1487bf2d2',
        'serviceId': '00116013830',
        'argument': {
            "question": text
        }
    }

    response = r.post(url, headers=headers, data=json.dumps(params))
    dic = json.loads(response.content)
    return_object = dic['return_object']
    keylist = return_object['keylists']
    return keylist


def keyword():

    sql = "SELECT ID, mainText, category, media FROM rawdata"
    curs.execute(sql)

    result = curs.fetchall()

    for i in range(len(result)):
        sql = "SELECT * FROM keyvec where document_ID = %s"
        curs.execute(sql, result[i][0])
        arr = curs.fetchall()
        if len(arr) > 0:
            continue
        id = result[i][0]
        text = result[i][1]
        category = result[i][2]
        tmp = token(text)
        cnt = 0
        for j in tmp:
            if cnt > 4:
                break
            key, value = j.items()
            key = key[1].replace('_', '')
            if key == "뉴스데일리":
                continue
            elif key == "뉴시스":
                continue
            sql = "INSERT INTO keyvec (document_ID,keyword,category, weight, media, date) VALUES (%s, %s, %s, %s, %s, now())"
            try:
                curs.execute(sql, (id, key, category, value[1], result[i][3]))
                cnt = cnt + 1
                conn.commit()
            except Exception as e:
                print(e)


def user_keyword(text):
    text = token(text)
    cnt = 0
    result = []
    for i in text:
        if cnt > 4:
            break
        key, value = i.items()
        key = key[1].replace('_', '')

        if key == "뉴스데일리":
            continue
        elif key == "뉴시스":
            continue
        elif key == "공감언론":
            continue
        line = []
        line.append(key)
        line.append(value[1])
        result.append(line)
        cnt= cnt + 1

    return result
