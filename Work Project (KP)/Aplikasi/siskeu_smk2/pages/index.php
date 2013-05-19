<?
	session_start();
	if(empty($_SESSION['user']) && empty($_SESSON['group'])){
		header("location:../index.php?message='Silahkan Login Terlebih Dahulu'");
	} else {
	//print_r($_SESSION);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>SMKN 2 Temanggung</title>
	<link rel="stylesheet" href="../css/main_page.css" type="text/css">
	<link rel="stylesheet" href="../css/table.css" type="text/css">
	<link rel="stylesheet" href="../css/forms.css" type="text/css">
   <script type="text/javascript" src="../lib/jQuery/jquery-1.3.1.min.js"></script>
	<script type="text/javascript" language="javascript" src="../js/ajax_post.js"></script>
	<link href="../images/books.ico" rel="SHORTCUT ICON" />
</head>
<body>
	<body>
	<div id="main">
		<div id="header-atas"></div>
		<div id="panel">		
			<div id="menu">
				<a href="index.php">Depan</a>
				<a href="logout.php">Logout</a>
			</div>
		</div>
		<div id="header"></div>
		<div id="frameContent">
		 	<div id="contentMenu">
				<?
					require_once("../dbase.php");
					include_once("menu.php");
				?>
			</div>
		 	<div id="contentQuery">
				<?	
					require_once("../dbase.php");
					require_once("../class/enkripsi.class.php");
					require_once("../lib/pat_template/pat_template.php");
					require_once("../class/mysql_db.class.php");
						
					$tmpl = new patTemplate();
					$crypt = new Enkripsi;
					$code=$crypt->decode($_SERVER['REQUEST_URI']);
					$id=$code['id'];
					
					//print_r($_GET);
					//print_r($code);				
					$query=mysql_query("SELECT namaModule FROM pub_module WHERE idModule='$id'");
					$modul=mysql_fetch_row($query);
						
               if($modul[0]){
   					$file="module/".$modul[0]."/main_view.php";
   					if(file_exists($file)){
   						require_once("{$file}");
   						$tmpl->displayParsedTemplate("article");
   					}
   				}elseif($code['module']){
   					$file="module/".$code['module']."/".$code['file'].".php";
   					if(file_exists($file)){
   						require_once("{$file}");	
   						$tmpl->displayParsedTemplate("article");
   					}
   				} elseif($_GET['portal']==1){
   				   $file="module/portal_siswa/main_view.php";
   					if(file_exists($file)){
   						require_once("{$file}");	
   						$tmpl->displayParsedTemplate("article");
   					}             
               }else {
   					echo "<h3>Sistem Informasi Keuangan SMK N 2 Temanggung</h3>";
   					include("home.php");
   				}
				?>
			</div>
		</div>
		<div id="footer"></div>
	</div>
</body>
</body>

</html>
<?}?>
