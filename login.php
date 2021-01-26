<?php
session_start();

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$pass = $_POST['pass'];

	$db = new PDO ('mysql:host=localhost;dbname=login_systeme','root','');
	
	$sql ="SELECT * from membres where pseudo = '$username' ";
	$result = $db->prepare($sql);
	$result->execute();

	if($result->rowCount() > 0)
	{
		$data = $result->fetchAll();
		if (password_verify($pass, $data[0][$pass]))
		{
			echo"connexion effecuée";
			$_SESSION ['pseudo'] = $username;
		}
	

	}
	else 
	{
	$pass = password_hash($pass,PASSWORD_DEFAULT);
	$sql = "insert into  membres (pseudo, password) VALUES('$username','$pass')";
	$req = $db->prepare($sql);
	$req->execute();
	echo "enregistrement effectue";

	}

}


?>