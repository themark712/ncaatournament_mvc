<?php
require 'constants.php';

function dbconnect()
{
	/*
	$servername = "fdb1020.awardspace.net";
	$dbname = "3826959_mark73";
	$username = "3826959_mark73";
	$password = "Hilltopper#95";
    */
    
    $servername="127.0.0.1";
	$dbname = "3826959_mark73";
	$username = "root";
	$password = "";
    
	// Create connection
	$cn = new mysqli($servername, $username, $password, $dbname);

	return $cn;
}
?>