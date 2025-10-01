<?php

if ($_SERVER["SERVER_NAME"] == "localhost") {
    // Database config
    define("DBNAME", "3826959_mark73");
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    
    define("ROOT", "http://localhost/ncaatournament/public");
} else {
    // Database config
    define("DBNAME", "3826959_mark73");
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "");
    
    // production root
    define("ROOT", "https://www.mywebsite.com");
}

define("APP_NAME", "NCAA Football Pickem");
define("APP_DESC", "Online college football picks game");

// true means show errors
define("DEBUG", true);
