import pymongo
from lxml.html import fromstring, tostring
from lxml import etree
import re
from datetime import datetime

a=datetime.now() 
conn=pymongo.MongoClient("mongodb://172.16.1.203:27017/")
my_db=conn["baidubaike-new-2000W"]
my_set=my_db['article']
baidu_index=my_db['baidu_index']

items = []
for i in my_set.find().batch_size(10000):
    # selector = etree.HTML(i['content'])
    item = {}
    # item['content'] = selector.xpath('//h1//text()')[0]
    word = re.search(r'<h1>(.*?)<\/h1>', i['content'])
    if word:
        item['word'] = word.group(1)
    else:
        item['word'] = ''
    id = re.search(r'newLemmaId:\"([0-9]+?)\"', i['content'])
    if id:
        item['id'] = int(id.group(1))
    else:
        item['id'] = 0
    isfirst = re.search(r'<li class=\"item\">▪<span class=\"selected\">(.*?)</span></li>', i['content'])
    if isfirst: 
        item['is_first']= 1
    else:
        item['is_first']= 0
    count = re.findall(r'<li class=\"item\">▪(.*?)</li>', i['content'])
    if count:
        item['count'] = len(count)
    else:
        item['count'] = 0
    # is_duoyici = selector.xpath("//ul[@class='polysemantList-wrapper cmn-clearfix']/li[1]/span[@class='selected']")
    # if is_duoyici:
    #     item['is_first'] = 1
    # else:
    #     item['is_first'] = 0
    # count = selector.xpath("//ul[@class='polysemantList-wrapper cmn-clearfix']/li//text()")
    # if count:
    #     item['count'] = len(count)
    # else:
    #     item['count'] = 0
    item['fetchingTime'] = i['fetchingTime']
    # print(item)
    items.append(item)
c=datetime.now()
print((c-a).seconds) 
baidu_index.insert_many(items)
b=datetime.now()
print((b-a).seconds)