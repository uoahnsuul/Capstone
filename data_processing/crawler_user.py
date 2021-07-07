import requests
from bs4 import BeautifulSoup

url = "https://www.donga.com/news/Politics/article/all/20201116/103985821/1"


def donga_user(url):
    r = requests.get(url)
    soup = BeautifulSoup(r.content, "lxml")
    datas = soup.select('.article_txt')

    while(True):
        try:
            datas[0].strong.extract()
        except Exception as e:
            while True:
                try:
                    datas[0].div.extract()

                except Exception as e:
                    datas[0].script.extract()
                    return datas[0].text


def hani_user(url):
    r = requests.get(url)
    soup = BeautifulSoup(r.content, "lxml")
    datas = soup.select('.article-text div.text')

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


def joins_user(url):
    r = requests.get(url)
    soup = BeautifulSoup(r.content, "lxml")
    datas = soup.select('#article_body')

    flagDiv = True
    flagBr = True

    while True:
        if flagDiv:

            try:
                datas[0].div.extract()

            except Exception as e:
                flagDiv = False

        if flagBr:

            try:
                datas[0].br.extract()

            except Exception as e:
                flagBr = False

        if not (flagDiv and flagBr):
            text = datas[0].text
            text.strip()
            text = text.replace("\n", " ")
            " ".join(text.split())
            return text


def newsdaily_user(url):
    r = requests.get(url)
    soup = BeautifulSoup(r.content, "lxml")
    datas = soup.select('#article-view-content-div > p')

    for data in datas:
        text = data.text
        text.strip()
        text = text.replace("\n", " ")
        " ".join(text.split())
        return text


def newsis_user(url):
    r = requests.get(url)
    soup = BeautifulSoup(r.content, "lxml")
    datas = soup.select('#textBody')

    while (True):
        try:
            datas[0].div.extract()

        except Exception as e:
            return datas[0].text





