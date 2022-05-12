<?php

class Uporabnik{

  public $id;
  public $username;
  public $password;
  public $name;
  public $surname;
  public $email;
  public $phoneNo;
  public $address;
  public $gender;
  public $age;
  public $administrator;

  public function __construct($id, $username, $password,$name,$surname,$email,$phoneNo,$address,$gender,$age,$administrator) {
    $this->id  = $id;
    $this->username = $username;
    $this->password = sha1($password);
    $this->name = $name;
	$this->surname=$surname;
	$this->email=$email;
	$this->phoneNo=$phoneNo;
	$this->address=$address;
	$this->gender=$gender;
	$this->age=$age;
	$this->administrator=$administrator;
	
	/*    $this->id      = $id;
    $this->naslov  = $naslov;
    $this->vsebina = $vsebina;
    $this->datumObjave=$datumObjave;*/
	
  }


  public static function vsi() {
    $list = [];
      //dobimo objekt, ki predstavlja povezavo z bazo
    $db = Db::getInstance();
      //izvedemo query
    $result = mysqli_query($db,"SELECT * FROM users");

//v zanki ustvarjamo nove objekte in jih dajemo v seznam
    while($row = mysqli_fetch_assoc($result)){
      $list[] = new Uporabnik($row['id'], $row['username'], $row['password'],$row['name']
	  ,$row['surname'],$row['email'],$row['phoneNo']
	  ,$row['address'],$row['gender'],$row['age'],$row['administrator']);
    }
    
        //statična metoda vrača seznam objektov iz baze
    return $list;
  }
  
  public static function brisi(){
	  /*if(isset($_GET['id'])){
		  echo "AAAAAAAAAAAAAAAAAAAAAAAAAA";
	  }
	  else {
		  echo "BBBBBBBBBBBBBBBBBBBBBBB";
	  }*/
	   $userId=$_GET['id'];
	   $db = Db::getInstance();
	   
	$query = "DELETE FROM users WHERE id='$userId'";
	if($db->query($query)){
		
		echo "SUCCESS!";
	}
	else echo mysqli_error($db)
	;}
	
	
	
	
	
	  public static function spremeni(){
	  

	}
	
	
	
	

}

?>