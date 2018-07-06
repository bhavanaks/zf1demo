# zf1demo


1.Download the  Application from https://github.com/bhavanaks/zf1demo.git

2.Downloaded file may be in tar format or zip format . So extract the file 

3.Put that application into /var/www or /htdocs(windows)

4.Now you go to https://www.zend.com/en/user/  and create user account

5.After getting login page goto this  url http://www.zend.com/en/community/downloads and download the Zend Framework 1.11 full (recommended) [Library file]

6.Extract the downloaded library file 

7.put the downloaded file into /var/www/zf1demo /library

8.Now copy the zend folder from the downloaded library file and paste it inside the library folder of our application

9. Update application/configs/application.ini with the mysql access

10. Edit php.ini and turn short_tags On

11. In apache.conf, search for '<Directory C:\wamp\www>', check if AllowOverride All is there.

12. Enable mod_rewrite in Apache.

(Steps 6,7,8 can be carried out by right-clicking on WAMP system tray icon)

13. Just for sanity, Restart WAMP services.

14. Browse 
