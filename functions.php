<?php

// Connect to the database and return the database object
// Set environmental variables for server in httpd.conf 
// https://httpd.apache.org/docs/2.4/env.html
// Example: 
// SetEnv DB_HOST localhost
// SetEnv DB_NAME your_database_name
// SetEnv DB_USER your_username
// SetEnv DB_PWD your_password
// to access use: $_SERVER['EnvVar']
function connect()
{
    // Set the hostname for CodeCademy's platform
    $hostname = $_SERVER['DB_HOST'];

    // Set the database name
    $dbname = $_SERVER['DB_NAME'];

    // Set the username and password with permissions to the database
    $username = $_SERVER['DB_USER'];
    $password = $_SERVER['DB_PWD'];

    // Create the DSN (data source name) by combining the database type, hostname and dbname
    $dsn = "pgsql:host=$hostname;dbname=$dbname";

    // Create the try/catch blocks here
    try {
        return new PDO($dsn, $username, $password);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

// Get a list of all tiers in the database
function getTiers()
{
    try {
        // Get the database object
        $db = connect();

        // Create a query to get all fields for all tiers
        $tiersQuery = $db->query('SELECT * FROM tiers');

        // Return all records
        return $tiersQuery->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // If an error occurs echo the error
        echo $e->getMessage();
    }
}
