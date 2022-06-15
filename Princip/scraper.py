from urllib.request import urlopen, Request
from bs4 import BeautifulSoup as soup
import mysql.connector
import re
import datetime as dt

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="test1234",
  database="mydb"
) 
mycursor = mydb.cursor()
	
for y in range(1,10):
	url = 'https://www.izgubljen.si/izgubljen/{}'.format(y)
	req=Request(url, headers={'User-Agent': 'Mozila/5.0'})
	uClient=urlopen(req)
	webpage = uClient.read().decode('utf-8')
	uClient.close()

	page_soup=soup(webpage, "html.parser")

	containers=page_soup.findAll("div", {"class":"description"})
	for x in range(len(containers)):
		zival=str(containers[x].a["title"])
		opis=str(containers[x].p.find(text=True, recursive=False))
		datum1=re.search('\[\d+\.\d+\.\d+\]', opis).group(0)
		opis=re.search('\].*', opis).group(0)
		opis=opis[1:]
		datum1=datum1[1:-1]
		datum = dt.datetime.strptime(datum1, "%d.%m.%Y")
		datum = datum.date()
		
		sql = "DELETE FROM Zivali WHERE zival= %s AND opis = %s"
		val=(zival, opis)
		mycursor.execute(sql, val)
		mydb.commit()
		
		sql = "INSERT INTO Zivali (zival, opis, datum) VALUES (%s, %s, %s)"
		val = (zival, opis, datum)
		mycursor.execute(sql, val)
		mydb.commit()
	
mydb.close()