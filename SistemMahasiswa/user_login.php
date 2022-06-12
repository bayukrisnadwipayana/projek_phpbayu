<?php
	require_once("koneksi.php");
	if(isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"]))
	{
		$username=$_POST["username"];
		$password=$_POST["password"];
		$sql="select*from tabellogin where user_name='$username' and pass_word=$password";
		$hasil=mysqli_query($koneksi,$sql);
		if (mysqli_num_rows($hasil)>0)
		{
			session_start();
			$_SESSION["namauser"]=$username;
			header("Location:mahasiswa.php");
		}
		else
		{
			header("Location:login.php");
		}
	}
?>