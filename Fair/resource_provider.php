<?php
//check for required fields
$response = array();
if(isset($_POST['NELAT']) && isset($_POST['NELAG']) && isset($_POST['SWLAT']) && isset($_POST['SWLAG']))
{
   $north=$_POST['NELAT'];
   $east=$_POST['NELAG'];
   $south=$_POST['SWLAT'];
   $west=$_POST['SWLAG'];
   // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
    
  if($east<0 && $west>0) {
       $result = mysqli_query($db->con,"SELECT * from getids where (lat <=$north AND lat >=$south) AND (lang >= $west OR lang <=$east)");
   }
   else{
          $result = mysqli_query($db->con,"SELECT * from getids where (lat <=$north AND lat >=$south) AND (lang >= $west AND lang <=$east)");
   }
   if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //this table will be returned to user's mobile
      $resultarray[]=array("lat"=> $row["lat"],"lag"=>$row["lang"],"id"=>$row["Id"]);
    }
     $response["success"] = 2;
     $response["message"] = "ids being replied";
     $response["list"]=$resultarray;
    } else {
       $response["success"] = 1;
       $response["message"] = "coordinates received but no valid cook around you";
    }
	
}
else
	{
	   $response["success"] = 0;
        $response["message"] = "cordinates not received";
 	}
    echo json_encode($response);
?>