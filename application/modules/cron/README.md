# Order by relevance CRONS **application/modules/cron/controllers**

*01 : 06.subingles.py (SHELL)*
	
	-- pure scrap reading web (xml) data base
	pyhon 06.subingles.py

*02 : subingles.php   (SHELL)*
	
	-- Get videos alternatives : scrap form
    php /var/www/html/www.subingleslyrics.com/index.php cron subingles index

*03 : apiyoutube.php  (VIEW)*

    -- (load data api youtube :table:ac_videos)
    http://localhost/www.subingleslyrics.com/cron/apiyoutube/index

*04 : apiyoutube2.php (SHELL)*
    
    -- (load data table to other table, of video status = 0) 
    php /var/www/html/www.subingleslyrics.com/index.php cron apiyoutube2 search

*05 : apiyoutube1.php (VIEW)*

    -- (load data api youtube :table:ac_videos_helper) 
    http://localhost/www.subingleslyrics.com/cron/apiyoutube1/index

    



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