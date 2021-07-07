import feedparser
import requests
from bs4 import BeautifulSoup
from pagerank import TextRank
import pymysql

conn = pymysql.connect(host='localhost', user='root', password='autoset', db='capstone', charset='utf8')

curs = conn.cursor()


def hani_crawler():
    rsss = []

    def crawler(url, parser, css_selector):
        r = requests.get(url)
        soup = BeautifulSoup(r.content, parser)
        datas = soup.select(css_selector)
        if parser == "lxml":
            if css_selector == '.article-text div.text':

                flagDiv = True
                flagP = True

                while True:
                    if flagDiv:

                        try:
                            datas[0].div.extract()

                        except Exception as e:
                            flagDiv = False

                    if flagP:

                        try:
                            datas[0].p.extract()

                        except Exception as e:
                            flagP = False

                    if not (flagDiv and flagP):
                        text = datas[0].text
                        text.strip()
                        text = text.replace("\n", " ")
                        " ".join(text.split())
                        return text
                        break

            else:
                return datas[0].text

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

    url = "http://www.hani.co.kr/rss/politics/"
    # 한겨레

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date = crawler(link, 'lxml', '.date-time')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('한겨레', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == date[20:40]:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '.article-text div.text')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (date[20:40], text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')
                    except Exception as e:
                        print(e)

                    print(result)
                    continue

            text = crawler(link, 'lxml', '.article-text div.text')
            num_entries += 1
            print(title)
            print(link)
            print(date[0:20])
            print(date[20:40])
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
            try:
                curs.execute(sql, (title, '한겨레', link, date[0:20], date[20:40], text, 0, summary))
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

    url = "http://www.hani.co.kr/rss/economy/"
    # 한겨레

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date = crawler(link, 'lxml', '.date-time')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('한겨레', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == date[20:40]:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '.article-text div.text')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (date[20:40], text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')

                    except Exception as e:
                        print(e)

                    print(result)
                    continue

            text = crawler(link, 'lxml', '.article-text div.text')
            num_entries += 1
            print(title)
            print(link)
            print(date[0:20])
            print(date[20:40])
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES (%s, %s, %s,%s, %s,%s, %s, %s)"
            try:
                curs.execute(sql, (title, '한겨레', link, date[0:20], date[20:40], text, 1, summary))
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

    url = "http://www.hani.co.kr/rss/society/"
    # 한겨레

    crawler(url, 'xml', 'item link')
    # rss에 기사 링크들이 담기게 됩니다.

    parsed_data = get_data(url)

    num_entries = 0

    for link in rsss:
        try:
            article = parsed_data['entries'][num_entries]
            title = article['title']
            link = article['link']
            date = crawler(link, 'lxml', '.date-time')
            sql = "SELECT * FROM rawdata where media = %s and title = %s"
            curs.execute(sql, ('한겨레', title))
            result = curs.fetchall()
            if result:
                if result[0][5] == date[20:40]:
                    num_entries += 1
                    continue
                else:
                    text = crawler(link, 'lxml', '.article-text div.text')
                    num_entries += 1
                    textrank = TextRank(text)
                    summary = ''.join(textrank.summarize(sent_num=3))

                    sql = "UPDATE rawdata set revise_date=%s ,mainText=%s, summary=%s where id = %s"
                    try:
                        curs.execute(sql, (date[20:40], text, summary, result[0][0]))
                        conn.commit()
                        print('succsessful')

                    except Exception as e:
                        print(e)

                    print(result)
                    continue

            text = crawler(link, 'lxml', '.article-text div.text')
            num_entries += 1
            print(title)
            print(link)
            print(date[0:20])
            print(date[20:40])
            print(text)
            textrank = TextRank(text)
            summary = ''.join(textrank.summarize(sent_num=3))
            print(summary)
            print("=" * 20)

            sql = "INSERT INTO rawdata (title,media,link,update_date,revise_date,mainText,category, summary) VALUES ( %s, %s, %s,%s, %s,%s, %s, %s)"
            try:
                curs.execute(sql, (title, '한겨레', link, date[0:20], date[20:40], text, 2, summary))
                conn.commit()
                print('succsessful')

            except Exception as e:
                print(e)

        except Exception as e:
            print(e)
            print('Continuing ...')
            continue

    print("크롤링 끝")
