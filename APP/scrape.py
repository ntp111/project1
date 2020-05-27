#!C:\Users\The Maple\AppData\Local\Programs\Python\Python37-32\python.exe
print ("Content-Type: text/html")
print ("")
print("Hello World")
import os
import time
from browser import Browser
from stock import Stock
import pymongo
from tqdm import tqdm
import wget

client = pymongo.MongoClient("mongodb+srv://admin:admin@cluster0-xkizr.mongodb.net/test?retryWrites=true&w=majority")
db = client['aids']
stocks = db['stocks']
SLEEP_INTERVAL = 5
SLEEP_WHILE = 180

driver = Browser().get_driver()

def retireve_stock(link):
	try:
		print("retrieving...", link)
		## extract elements
		driver.get(link)
		title = driver.find_element_by_id("page-title").text
		time.sleep(SLEEP_INTERVAL)
		tags = []
		tagElements = driver.find_elements_by_css_selector('div.ds-tags a')
		for tag in tagElements: 
			tags.append(tag.text)

		try:
			desc = driver.find_element_by_css_selector('div.group-body').text.replace('Description\n','')
		except Exception as e:
			print("Cannot find description", e)
			desc = ""

		stock = Stock(link, title, desc, tags=tags)

		try:
			video_src = driver.find_elements_by_css_selector('source')[0].get_attribute('src')
			stock.add_source(video_src)
			print("downloading...", video_src)
			file = os.path.basename(video_src)
			file = file[:file.index('?')]
			file = './media/{}'.format(file)
			wget.download(video_src, file)
		except Exception as e:
			print("Cannot download video", e)

		return stock

	except Exception as e:
		return None

flg_cont = True
while flg_cont:
	links = stocks.find({'title': { '$exists': False }})
	print("Found ", links.count())
	for link in tqdm(links):
		if 'link' in link:
			try:
				stock = retireve_stock(link['link'])
				if stock:
					updated = stocks.replace_one({'_id': link['_id']}, stock.to_json(), upsert=True)
					print(updated)
				else:
					print("[FAIL]", link)
			except Exception as e:
				print("ERROR processing {}".format(link), e)
		else:
			print("Cannot find LINK key in the instance", link['_id'])
	time.sleep(SLEEP_WHILE)

driver.quit()

