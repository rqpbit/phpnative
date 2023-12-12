<?php 
// Initialize the session
	session_start();

	// Set host and database
	$host = "localhost";
	$user = "root";
	$pass = "";

	// Database name
	$db   = "phpnative";
	
	// Create a connection
	$link = mysqli_connect($host,$user,$pass, $db);

	// Check connection
	if($link === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}