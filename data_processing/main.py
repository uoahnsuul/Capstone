import time
import threading
from hani import hani_crawler
from donga import donga_crawler
from joins import joins_crawler
from newsdaily import daily_crawler
from newsis import newsis_crawler
from keyextractor import keyword

def thread_run():
    while True:
        hani_crawler()
        donga_crawler()
        joins_crawler()
        newsis_crawler()
        daily_crawler()
        keyword()
    #threading.Timer(600, thread_run).start()


thread_run()