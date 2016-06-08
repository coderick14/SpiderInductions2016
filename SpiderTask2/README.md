###Spider Task 2

**Framework used : PHP on Apache**
**Database 	 : MySQL**
**Server	 : Apache2**

Below are the links for downloading all the necessary software required to run the scripts :

####For Windows
+ Install Apache. [Click here](https://www.sitepoint.com/how-to-install-apache-on-windows/) to install. It contains all the links and a step by step guide about the installation.
+ Install php5. [This link](https://www.sitepoint.com/how-to-install-php-on-windows/) provides a step by step method on how to install and configure php5 on your system.
+ Install MySQL. [This link](https://www.sitepoint.com/how-to-install-mysql/) provides a step by step method for doing this

####For Linux
+ Install Apache. Open your terminal. Type **sudo apt-get install apache2**. Start your server with **sudo /etc/init.d/apache2 start**.
+ Install php5. Type **sudo apt-get install php5 libapache2-mod-php5** and **sudo apt-get install php5-mysql**. Restart your server with the command **sudo /etc/init.d/apache2 restart**.
+ Install MySQL. Type **sudo apt-get install mysql-server**. 
In case of any trouble, [click here] for a detailed instruction on how to set up a LAMP Server. 

The details about the database and the tables used are as follows :
+ The user is 'coderick14'@'localhost' with all grant privileges.
+ Password is 9047142795.
+ The database name is 'Spider'.
+ The table name is 'students'. The CREATE TABLE command is given below.
   CREATE TABLE `students` (
  `NAME` varchar(20) DEFAULT NULL,
  `ROLL_NO` int(9) NOT NULL DEFAULT '0',
  `DEPT` varchar(50) DEFAULT NULL,
  `MAIL` varchar(25) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `ABOUT` text,
  `PSCODE` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ROLL_NO`)
) 

**Either you can create a user and database as mentioned above or you can use your own user and database. For the latter, make necessary changes to connect.php script**.

The **mysqli** library has been used for connecting to the database.

####How to run the scripts
+ Clone this repository into the folder you want. 
+ Start your apache server.
+ Copy all the files from SpiderTask2 to your localhost directory.(Usually C:/inetpub/wwwroot for Windows and /var/www/html for Linux).
+ Open up your browser. Type http://localhost/ as the URL.
+ Click on student.html.
