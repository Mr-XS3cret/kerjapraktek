<?
	session_start();
	require_once("../class/enkripsi.class.php");
	
	if(!$_SESSION['user'] && !$_SESSON['group']){
		header("location:../index.php?message='Silahkan Login Terlebih Dahulu'");
	} else {
		$crypt = new Enkripsi;
		
		$queryMenu=mysql_query("SELECT idMenu, namaMenu, groupMenu FROM pub_menu WHERE groupMenu >='$_SESSION[group]' ORDER BY idMenu asc");
		while($menu=mysql_fetch_array($queryMenu)){
			echo "<div class='submenu'>:: ".$menu['namaMenu']."</div>";
			$querySubMenu=mysql_query("SELECT idSubMenu, namaSubMenu, idMenuParent, idSubMenuModul, subMenuGroup FROM pub_submenu WHERE subMenuGroup >= $_SESSION[group] AND idMenuParent = $menu[idMenu] ORDER BY idSubMenu asc");
			while($subMenu=mysql_fetch_array($querySubMenu)){
				$x='id='.$subMenu[idSubMenuModul];
				$url=$crypt->paramEncrypt($x);
				echo "<a href='index.php?".$url."'class=sheet>".$subMenu['namaSubMenu']."</a>";
			}
			
		}
	}
?>
