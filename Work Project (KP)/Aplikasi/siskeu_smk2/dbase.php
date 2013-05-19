<?
	class Database{
		protected $host;
		protected $password;
		protected $dbase;
		
	
		function Database(){
			$this->host='localhost:3306';
			$this->user='root';
			$this->password='';
			$this->dbase='smk2_siskeu';
		}
	}
		
	mysql_connect('localhost:3306','root','');
	mysql_select_db('smk2_siskeu');
?>
