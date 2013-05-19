<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/dbase.php");
	class mysql_db extends Database{
		private $db;
		private $query;
		private $result;
		private $row;
		
		function connect(){
			$this->db=mysql_connect($this->host,$this->user,$this->password);
			if(!$this->db)
				die('ERROR= '.mysql_error());
			
			mysql_select_db($this->database,$this->db);
		}
		
		function execute($query){
			$this->query=$query;
			$this->result=mysql_query($this->query);
			//$this->error_message($result);
		}
		
		function get_array(){
			if($this->row=mysql_fetch_array($this->result,MYSQL_ASSOC))
				return $this->row;
			else
				return false;
		}
	}
?>