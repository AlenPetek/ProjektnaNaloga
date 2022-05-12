<?php
include_once('glava.php');


if(isset($_GET["author"]) && isset($_GET["id"])){

$author = $_GET["author"];
$id= $_GET["id"];
if($_SESSION["USER_NAME"]==$author){
		global $conn;
	
	$query = "DELETE FROM ads WHERE author='$author' AND id='$id'";
	
		if($conn->query($query)){
		header("Location: index.php");
		die();
	}
	else{
		echo mysqli_error($conn);
		die();
	}
}
else {echo "You are not allowed to delete this post!";
       header("Location: index.php");
		die();
}
}
else {
	
	echo "Error in paramaters!";
}


?>