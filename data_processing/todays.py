import pymysql
import pandas as pd

conn = pymysql.connect(host='localhost', user='root', password='autoset', db='capstone', charset='utf8')
curs = conn.cursor()

curs.execute("select keyword from keyvec where date between '2020-11-27 00:00:00' AND '2020-11-27 12:00:00'")
ch1 = curs.fetchall()

flag = 0

for x in ch1:
    flag = 0

    sql = 'select keyword from today_keyword where keyword = %s'
    curs.execute(sql, x)
    ch2 = curs.fetchall()
    if len(ch2) >= 1:
        sql2 = 'update today_keyword set appear_num=appear_num+1 where keyword=%s'
        curs.execute(sql2, x)
    else:
        sql = 'select category from keyvec where keyword=%s'

        curs.execute(sql, x)
        cnt = curs.fetchone()

        sql = "INSERT INTO today_keyword (keyword, appear_num,category) VALUES (%s, %s,%s)"
        try:
            curs.execute(sql, (x, 1, cnt))

        except Exception as e:
            print(e)

conn.commit()
conn.close()

'''

sql = "SELECT keyword, appear_num, category from today_keyword where appear_num>2 ORDER BY appear_num DESC";
curs.execute(sql)
words = curs.fetchall()
words = words[:20]

'''
