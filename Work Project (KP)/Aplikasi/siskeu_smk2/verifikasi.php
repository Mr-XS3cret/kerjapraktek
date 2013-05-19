<?
	session_start();
	if(isset($_POST['login'])){
		include("dbase.php");
		
		$user=$_POST['user'];
		$pass=$_POST['pass'];
				
		$query=mysql_query("SELECT namaUser, passwordUser, groupUser FROM pub_user WHERE namaUser='$user'");
		$cek=mysql_num_rows($query);
		$data=mysql_fetch_array($query);
		
		if(!$data['namaUser']){
         $query=mysql_query("SELECT nisSiswa, passwordSiswa, groupID FROM sis_siswa WHERE nisSiswa='$user'");
			$cek=mysql_num_rows($query);
			$data=mysql_fetch_array($query);
		}
		if(!$data['passwordUser'])
			$password=$data['passwordSiswa'];
		else
			$password=$data['passwordUser'];
			
		if($cek!=NULL && $pass==$password){
         if(!$data['nisSiswa']){ 
				$_SESSION['user']=$data['namaUser'];
				$_SESSION['password']=$data['passwordUser'];
				$_SESSION['group']=$data['groupUser'];
			}else{ 
				$_SESSION['user']=$data['nisSiswa'];
				$_SESSION['password']=$data['passwordSiswa'];
				$_SESSION['group']=$data['groupID'];
			}
			header('location:pages/');
		} else {
			header('location:index.php?message=Login Gagal, silahkan Cek Ulang Username dan Password anda');			
		}
			 
	}
?>
