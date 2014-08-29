blive
=====

Install
----
1. __Configuration__
Extract .zip file to your web folder (htdocs, www, ...)
Open ./lib/config.php, find and edit these values matching yours:
	* `DB_SERVER`		->		Database server
	* `DB_USER`		->		Root username
	* `DB_PASS`		->		Root password
	* `DB_NAME`		->		Database name
	* `/var/lib/tomcat6/webapps/ROOT/blive`		->		Path to your ./blive folder
	* `http://localhost:8080/blive`		->		Your page url
2. __Create database__
Go to phpMyAdmin, import __blive.sql__ (located in ./lib/ folder)
3. __Preview and report__
Check out your installation by going to your site. It should display as this http://blive.webege.com if not, please report us the problem.
