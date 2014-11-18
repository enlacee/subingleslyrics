# Order by relevance CRONS **application/modules/cron/controllers**

*01 : 06.subingles.py (SHELL)*
	
	-- pure scrap reading web (xml) data base
	python 06.subingles.py

*03 : cron05.php  (VIEW)*

    -- (load data api youtube :table:ac_videos)
    http://localhost/www.subingleslyrics.com/cron/cron05/index

*06 : cron06.php (SHELL)*
    
    -- update id_youtube_view (number of views)
    php /var/www/html/www.subingleslyrics.com/index.php cron cron06 index




## Execute Cron php


### Step 1

install cli php


## Step 2
execute command en terminal :
(all data seft sync)

    $ php /var/www/www.subingleslyrics.com/index.php cron subingles index

cron : module
subingles : controller
search : function


![image cron](http://i61.tinypic.com/2wf4b41.png)