Dāvida Lapiņa task for Magebit
-------------------------------------------------------------------------------------------
To Run this project locally you need all the things 
bellow installed on your computer :
1. apache web server 
2. Mysql database (others will not work because connection is made for mysql database)
-------------------------------------------------------------------------------------------
Things you have to make to run this project:
database with name -> magebit collation utf8_general_ci
inside magebit database create table -> emails.
emails table should have columns-> id, email, date
datatypes:
id : int(11) AI primary key
email: text
date: date
-------------------------------------------------------------------------------------------
Before running this project you will have to go in app/config/DBconfig.php file
and type in the username and password , localhost port nummber for database.
-------------------------------------------------------------------------------------------
After all this is set up you can run your apache server and in browser type in path to magebit folder