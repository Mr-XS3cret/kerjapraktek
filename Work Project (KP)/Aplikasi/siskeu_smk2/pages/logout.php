<?
	session_start();
	if(isset($_SESSION['user'])){
		unset($_SESSION);
		session_destroy();
		
		header("location:../index.php");
		//echo "<a href='../index.php'>Main Page</a>";
	}
?>