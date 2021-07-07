import feedparser
import requests
from bs4 import BeautifulSoup
from pagerank import TextRank
import pymysql

conn = pymysql.connect(host='localhost', user='root', password='autoset',db='capstone', charset='utf8')

curs = conn.cursor()


def donga_crawler():

    rsss = []

    def crawler(url, parser, css_selector):
        r = requests.get(url)
        soup = BeautifulSoup(r.content, parser)
        datas = soup.select(css_selector)
        if parser == "lxml":
            if css_selector == '.article_txt':
                while True:
                    try:
                        datas[0].strong.extract()
                    except Exception as e:
                        while True:
                            try:
                                datas[0].div.extract()

                            except Exception as e:
                                datas[0].script.extract()
                                return datas[0].text
            else:
                return datas[0].text, datas[1].text

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

    url = "https://rss.donga.com/politics.xml"
    # 동아

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            result = []
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date, revise_date = crawler(link, 'lxml', '.date01')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('동아일보', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == revise_date:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '.article_txt')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (revise_date, text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')

                    except Exception as e:
                        print(e)

                    continue
            text = crawler(link, 'lxml', '.article_txt')
            num_entries += 1
            print(title)
            print(link)
            print(date)
            print(revise_date)
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
            try:
                curs.execute(sql, (title, '동아일보', link, date, revise_date, text, 0, summary))
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

    url = "	https://rss.donga.com/economy.xml"
    # 동아

    crawler(url, 'xml', 'item link')

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date, revise_date = crawler(link, 'lxml', '.date01')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('동아일보', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == revise_date:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '.article_txt')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (revise_date, text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')

                    except Exception as e:
                        print(e)

                    continue
            text = crawler(link, 'lxml', '.article_txt')
            num_entries += 1
            print(title)
            print(link)
            print(date)
            print(revise_date)
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
            try:
                curs.execute(sql, (title, '동아일보', link, date, revise_date, text, 1, summary))
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

    url = "	https://rss.donga.com/national.xml"
    # 동아

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date, revise_date = crawler(link, 'lxml', '.date01')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('동아일보', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == revise_date:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '.article_txt')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (revise_date, text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')

                    except Exception as e:
                        print(e)

                    continue
            text = crawler(link, 'lxml', '.article_txt')
            num_entries += 1
            print(title)
            print(link)
            print(date)
            print(revise_date)
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
            try:
                curs.execute(sql, (title, '동아일보', link, date, revise_date, text, 2, summary))
                conn.commit()
                print('succsessful')

            except Exception as e:
                print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")