<html><center>
	<head>
		<title>SMK N 2 Temanggung</title>
		<link rel="stylesheet" type="text/css" href="css/log.css"></link>
		<link href="images/books.ico" rel="SHORTCUT ICON" />
	</head>
	<body bgcolor="#e6f4fa">
	<div id='bg'>
		<div id='log'>
			<form method="POST" action="verifikasi.php">
			<table>
				<tr><td><b>Username </b></td><td><input type="text" name="user"></input></td></tr>
				<tr><td><b>Password </b></td><td><input type="password" name="pass"></input></td></tr>
				<tr><td colspan=2 align="center" valign="bottom"><input type="submit" name="login" value="LOGIN"></td></tr>
			</table>
			</form>
			<?
				echo "<br /><h3>".$_GET['message']."</h3>";
			?>
		</div>
	</body>
</center></html>
