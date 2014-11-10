# 01 : subingles
# http://www.subingles.com/exercises/mode/8532/
# http://www.subingles.com/songs/view/4359

from lxml import html
from xml.etree.ElementTree import tostring
import requests

# Function insert data to database mysql
def getDataWebSong(ID, url, tree):
    xartist = tree.xpath('/html/body/div[@id="pagewrap"]/div[@id="content"]/div[@id="titulo1"]/h1[@id="title_song"]/a[1]/text()')
    xtitle = tree.xpath('/html/body/div[@id="pagewrap"]/div[@id="content"]/div[@id="titulo1"]/h1[@id="title_song"]/text()')
    xlevel = tree.xpath('/html/body/div[@id="pagewrap"]/div[@id="content"]/div[@id="titulo1"]/h1[@id="title_song"]/a[2]/text()')
    #xlyrics = tree.get_element_by_id('textori').value
    artist = xartist[0].replace('Canciones de ', '')
    title = xtitle[1].strip(' \t\n\r')[8:]
    level = xlevel[0]
    lyrics = ''

    dictx = {}
    dictx['id'] = ID
    dictx['url'] = url
    dictx['title'] = title + "-" + artist
    dictx['level'] = formatLevel(level)
    dictx['lyrics'] = lyrics
    print('title', dictx['title'])
    return dictx

def formatLevel(string):
    level = 0
    if string == 'Easy':
        level = 1
    elif string == 'Medium':
        level = 2
    elif string == 'Hard':
        level = 3
    else:
        level = 4
    return str(level)

# Funtion insert to database MYSQL
def insertDb(data):
    import MySQLdb
    # Open database connection
    db = MySQLdb.connect("localhost","root","123456","subingleslyrics" )
    cursor = db.cursor()
    # execute SQL
    sql = "INSERT INTO ac_videos(id_youtube, title, level, ref) "
    sql = sql + "VALUES (\"%s\", \"%s\", \"%s\", \"%s\") " % (data['id'], data['title'], data['level'], data['url'])

    try:
       # Execute the SQL command
       cursor.execute(sql)
       # Commit your changes in the database
       db.commit()
    except:
       # Rollback in case there is any error
       writeLog('FAILSQL: ' + data['url'])  
       db.rollback()

    db.close()

# Function print logs
def writeLog(message = '*'):
    fo = open("06.subingles.log", "a")
    fo.tell();
    fo.write(message + "\n")
    fo.close()
    return message


####################################################
# Init App
####################################################
numInit = 4001
numFin = 4414
listNumber = range(numInit, (numFin+1))
for indice in listNumber:
    print indice
    #idweb = '8899'
    idweb = indice
    url = 'http://www.subingles.com/songs/view/' + str(idweb)
    page = requests.get(url)
    tree = html.fromstring(page.text)
    idImage = tree.xpath('/html/head/link[@rel="image_src"]/@href')
    ID = idImage[0][26:37]

    if (ID.find('/') == -1):     
        data = getDataWebSong(ID, url, tree)
        insertDb(data)
        print writeLog('OK : ' + url)
    else:
        print writeLog('FAIL : ' + url)    
