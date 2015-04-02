<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 global $temglobal;
// check for required fields
if (isset($_POST['FirstName']) && !empty($_POST['FirstName']) && isset($_POST['Password']) && !empty($_POST['Password'])) 
{
 
    $FirstName = $_POST['FirstName'];
    $Password = $_POST['Password'];
    $temglobal=$_POST['FirstName'];
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
 //select Password from persons where FirstName="kishan";
    // get password for that username/emailid
    $result = mysqli_query($db->con,"SELECT Password from persons where FirstName LIKE '$FirstName'");
 

if (mysqli_num_rows($result))
{
$row = mysqli_fetch_row($result);
    if ($row[0]==$Password) 
	{
        // correct password
        $response["success"] = 1;
        $response["message"] = "you are logged in";
	}
	else
	{
	   $response["success"] = 0;
        $response["message"] = "correct = '$row[0]' and input pass='$Password' for user='$FirstName'";
 	}
	// echoing JSON response
        echo json_encode($response);
}
elseif (!$result) 
{    // failed to insert row
     echo json_encode(mysql_error());
}
   // compare server password with user provided
} 
else 
{
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>