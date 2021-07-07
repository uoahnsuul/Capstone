import feedparser
import requests
from bs4 import BeautifulSoup
from pagerank import TextRank
import pymysql


conn = pymysql.connect(host='localhost', user='root', password='autoset',db='capstone', charset='utf8')

curs = conn.cursor()
# 기사의 링크들이 담기는 리스트

def daily_crawler():
    rsss = []

    def crawler(url, parser, css_selector):
        r = requests.get(url)
        soup = BeautifulSoup(r.content, parser)
        datas = soup.select(css_selector)
        if parser == "lxml":
            if css_selector == 'div.info-group li':
                if len(datas) > 3:
                    return datas[1].text, datas[2].text
                else:
                    return datas[1].text
            else:
                flagDiv = True
                flagAr = True

                while True:
                    if flagDiv:
                        try:
                            datas[0].div.extract()

                        except Exception as e:
                            flagDiv = False

                    if flagAr:

                        try:
                            datas[0].style.extract()

                        except Exception as e:
                            flagAr = False

                    if not (flagDiv and flagAr):
                        text = datas[0].text
                        text.strip()
                        text = text.replace("\n", " ")
                        " ".join(text.split())
                        return text
                        break
        else:
            for data in datas:
                rsss.append(data.text)

    def get_data(url):
        try:
            res = requests.get(url)
            html = res.text
            data = feedparser.parse(html)
            print(data.feed.title)
            return data
        except:
            return None

    url = "http://www.newsdaily.kr/rss/S1N51.xml"

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.
    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date = crawler(link, 'lxml', 'div.info-group li')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('Newsdaily', title))
            result = curs.fetchall()
            if result:
                if isinstance(date, tuple):
                    if result[0][5] == date[1]:
                        num_entries += 1
                        continue
                    else:
                        text = crawler(link, 'lxml', '#article-view-content-div')
                        num_entries += 1
                        textrank = TextRank(text)
                        summary = ''.join(textrank.summarize(sent_num=3))

                        sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                        try:
                            curs.execute(sql, (date[1], text, summary, result[0][0]))
                            conn.commit()
                            print('succsessful')
                        except Exception as e:
                            print(e)

                        continue
                else:
                    num_entries += 1
                    continue

            text = crawler(link, 'lxml', '#article-view-content-div')
            num_entries += 1
            print(title)
            print(link)
            if isinstance(date, tuple):
                print(date[0])
                print(date[1])
            else:
                print(date)
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            if isinstance(date, tuple):
                sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
                try:
                    curs.execute(sql, (title, 'Newsdaily', link, date[0], date[1], text, 0, summary))
                    conn.commit()
                    print('succsessful')

                except Exception as e:
                    print(e)
            else:
                sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
                try:
                    curs.execute(sql, (title, 'Newsdaily', link, date, '', text, 0, summary))
                    conn.commit()
                    print('succsessful')

                except Exception as e:
                    print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")

    rsss = []

    url = "http://www.newsdaily.kr/rss/S1N49.xml"

    crawler(url, 'xml', 'item link')

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date = crawler(link, 'lxml', 'div.info-group li')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('Newsdaily', title))
            result = curs.fetchall()
            if result:
                if isinstance(date, tuple):
                    if result[0][5] == date[1]:
                        num_entries += 1
                        continue
                    else:
                        text = crawler(link, 'lxml', '#article-view-content-div')
                        num_entries += 1
                        textrank = TextRank(text)
                        summary = ''.join(textrank.summarize(sent_num=3))

                        sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                        try:
                            curs.execute(sql, (date[1], text, summary, result[0][0]))
                            conn.commit()
                            print('succsessful')
                        except Exception as e:
                            print(e)

                        continue
                else:
                    num_entries += 1
                    continue
            text = crawler(link, 'lxml', '#article-view-content-div')
            num_entries += 1
            print(title)
            print(link)
            print(date)
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            if isinstance(date, tuple):
                sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
                try:
                    curs.execute(sql, (title, 'Newsdaily', link, date[0], date[1], text, 1, summary))
                    conn.commit()
                    print('succsessful')

                except Exception as e:
                    print(e)
            else:
                sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
                try:
                    curs.execute(sql, (title, 'Newsdaily', link, date, '', text, 1, summary))
                    conn.commit()
                    print('succsessful')

                except Exception as e:
                    print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")

    rsss = []

    url = "http://www.newsdaily.kr/rss/S1N38.xml"

    crawler(url, 'xml', 'item link')

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date = crawler(link, 'lxml', 'div.info-group li')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('Newsdaily', title))
            result = curs.fetchall()
            if result:
                if isinstance(date, tuple):
                    if result[0][5] == date[1]:
                        num_entries += 1
                        continue
                    else:
                        text = crawler(link, 'lxml', '#article-view-content-div')
                        num_entries += 1
                        textrank = TextRank(text)
                        summary = ''.join(textrank.summarize(sent_num=3))

                        sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                        try:
                            curs.execute(sql, (date[1], text, summary, result[0][0]))
                            conn.commit()
                            print('succsessful')
                        except Exception as e:
                            print(e)

                        continue
                else:
                    num_entries += 1
                    continue
            text = crawler(link, 'lxml', '#article-view-content-div')
            num_entries += 1
            print(title)
            print(link)
            print(date)
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            if isinstance(date, tuple):
                sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
                try:
                    curs.execute(sql, (title, 'Newsdaily', link, date[0], date[1], text, 2, summary))
                    conn.commit()
                    print('succsessful')

                except Exception as e:
                    print(e)
            else:
                sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
                try:
                    curs.execute(sql, (title, 'Newsdaily', link, date, '', text, 2, summary))
                    conn.commit()
                    print('succsessful')

                except Exception as e:
                    print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")

