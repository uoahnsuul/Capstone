import feedparser
import requests
from bs4 import BeautifulSoup
from pagerank import TextRank
import pymysql

conn = pymysql.connect(host='localhost', user='root', password='autoset',db='capstone', charset='utf8')

curs = conn.cursor()
# 기사의 링크들이 담기는 리스트


def newsis_crawler():
    rsss = []

    def crawler(url, parser, css_selector):
        r = requests.get(url)
        soup = BeautifulSoup(r.content, parser)
        if css_selector == "h1":
            return soup.find('h1').string
        datas = soup.select(css_selector)
        if parser == "lxml":
            if css_selector == '#textBody':
                while True:
                    try:
                        datas[0].div.extract()

                    except Exception as e:
                        return datas[0].text
            else:
                return datas[1].text

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

    url = "https://newsis.com/RSS/politics.xml"
    # newsis

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = crawler(link, 'lxml', 'h1')
            link = article['link']
            date = crawler(link, 'lxml', '.date')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('Newsis', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == date[27:50]:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '#textBody')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (date[27:50], text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')
                    except Exception as e:
                        print(e)

                    print(result)
                    continue
            text = crawler(link, 'lxml', '#textBody')
            num_entries += 1
            print(title)
            print(link)
            print(date[0:24])
            print(date[27:50])
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s, %s, %s, %s,%s, %s)"
            try:
                curs.execute(sql, (title, 'Newsis', link, date[0:24], date[27:50], text, 0, summary))
                conn.commit()
                print('succsessful')

            except Exception as e:
                print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")
    # 기사의 링크들이 담기는 리스트
    rsss = []

    url = "https://newsis.com/RSS/economy.xml"

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = crawler(link, 'lxml', 'h1')
            link = article['link']
            date = crawler(link, 'lxml', '.date')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('Newsis', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == date[27:50]:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '#textBody')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (date[27:50], text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')
                    except Exception as e:
                        print(e)

                    print(result)
                    continue
            text = crawler(link, 'lxml', '#textBody')
            num_entries += 1
            print(title)
            print(link)
            print(date[0:24])
            print(date[27:50])
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s, %s, %s, %s,%s, %s)"
            try:
                curs.execute(sql, (title, 'Newsis', link, date[0:24], date[27:50], text, 1, summary))
                conn.commit()
                print('succsessful')

            except Exception as e:
                print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")

    # 기사의 링크들이 담기는 리스트
    rsss = []

    url = "http://www.newsis.com/RSS/society.xml"

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = crawler(link, 'lxml', 'h1')
            link = article['link']
            date = crawler(link, 'lxml', '.date')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('Newsis', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == date[27:50]:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '#textBody')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (date[27:50], text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')
                    except Exception as e:
                        print(e)

                    print(result)
                    continue
            text = crawler(link, 'lxml', '#textBody')
            num_entries += 1
            print(title)
            print(link)
            print(date[0:24])
            print(date[27:50])
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s, %s, %s, %s,%s, %s)"
            try:
                curs.execute(sql, (title, 'Newsis', link, date[0:24], date[27:50], text, 2, summary))
                conn.commit()
                print('succsessful')

            except Exception as e:
                print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")
