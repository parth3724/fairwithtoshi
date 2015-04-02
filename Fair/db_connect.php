<?php
 
/**
 * A class file to connect to database
Usage: When ever you want to connect to MySQL database and do some operations use the db_connect.php class like this

$db = new DB_CONNECT(); // creating class object(will open database connection)
 */
class DB_CONNECT {
 
	
    // constructor
    function __construct() {
        // connecting to database
        $this->connect();
    }
 
    // destructor
    function __destruct() {
        // closing db connection
        $this->close();
    }
 
    /**
     * Function to connect with database
     */
    function connect() {
        // import database connection variables
        require_once __DIR__ . '/db_config.php';
 
        // Connecting to mysql database
        $this->con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD) or die(mysqli_error($this->con));
 
        // Selecing database
        $db = mysqli_select_db($this->con,DB_DATABASE) or die(mysqli_error($this->con));
 
        // returing connection cursor
        return $this->con;
    }
 
    /**
     * Function to close db connection
     */
    function close() {
        // closing db connection
        mysqli_close($this->con);
    }
 
}
 
?>