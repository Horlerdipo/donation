<?php
//reuiring the classes
	require_once("includes/ini.php");
	//checking nd confirming if  truly any request is sent
		//echo "hello";
	if(isset($_POST["email"]) && isset($_POST["pass"]) && !empty($_POST['pass']) && !empty($_POST['email'])  && isset($_POST['surname']) && !empty($_POST['surname'])){
		//using the validation method of the user class to prevent attack
	$email=$users->validate_data($_POST['email']);
	$pass=$users->validate_data($_POST['pass']);
	$surname=$users->validate_data($_POST['surname']);

	$query="SELECT * FROM users WHERE email='{$email}' AND password='{$pass}' AND surname='{$surname}'";
	//connect to  database 
	$database->connectdb();
	//uerying the database to check if user is in the database
	$return=$database->querydb($query);

	//check if user is in the database else return error message

	if (mysqli_num_rows($return)==1) { 
		 header('Content-type: application/json');
		 session_start();
		 $_SESSION['email']=$email;
		 $_SESSION['pass']=$pass;
		 $_SESSION['surname']=$surname;
		$return_data="logged in";
		$return_url="profile.php";
		$return_array= array('response' =>$return_data ,'url'=> $return_url );
		$return=json_encode($return_array);
		header("Location:http://localhost/donation/profile.html");
	}else{
		 header('Content-type: application/json');
		$return_data="<script type='text/javascript'>alert('incorrect usernme or password')";
		$return_url="./index.html";
		$return_array= array('response' =>$return_data ,'url'=> $return_url );
		$return=json_encode($return_array);
		
		echo("alert('incorrect usernme or password')");
		//header("Location:http://localhost/donation/index.html");
		//echo($return);
	}


}else{
		 header('Content-type: application/json');
		$return_data="you did not supply any valid info";
		$return_url="./index.html";
		$return_array= array('response' =>$return_data ,'url'=> $return_url );
		$return=json_encode($return_array);
		echo("you did not supply valid info");
}


?>