<?php

require_once('includes/ini.php');

if(isset($_POST["email"]) && isset($_POST["pass"]) && !empty($_POST['pass']) && !empty($_POST['email'])  && isset($_POST['surname']) && !empty($_POST['surname']) && isset($_POST['firstname']) && !empty($_POST['firstname'])){
		$email=$users->validate_data($_POST['email']);
		$pass=$users->validate_data($_POST['pass']);
		$surname=$users->validate_data($_POST['surname']);  
		$firstname=$users->validate_data($_POST['firstname']);

		$query="SELECT * FROM users WHERE email='{$email}' AND password='{$pass}' AND surname='{$surname}'";

		$database->connectdb();
		$result=$database->querydb($query);

		if(mysqli_num_rows($result)==1){
			//header("Content-type:application/json");
			$response="user already exists";
			$url="./login.html";
			$array = array('response' => $response ,'url'=>$url );
			//echo(json_encode($array));
			echo "user already exists";
		}else{

			$query="INSERT INTO users (email,surname,password,firstname) VALUES ('$email','$surname','$pass','$firstname')";
			$result=$database->querydb($query);
			if ($result) {
				//header("Content-type:application/json");
				$response="registration complete";
				$url="./login.html";
				$array = array('response' => $response ,'url'=>$url );
				//echo(json_encode($array));
				echo "registration complete";
				sleep(3);
				header("Location:http://localhost/donation/index.html");
			}else{

				//header("Content-type:application/json");
			$response="coonection time lost";
			$url="./login.html";
			$array = array('response' => $response ,'url'=>$url );
			echo("connection time out");
			}
		}

}else{
//	header("Content-type:application/json");
	$response="please input correct info";
	$url="./register.html";
	$array = array('response' => $response,'url'=>$url );
	echo("plese input correct info");
}

?>