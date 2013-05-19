<?
	function format_tanggal($tanggal){
		date_default_timezone_set('Europe/London');
		
		$datetime = new DateTime($tanggal);
		return $datetime->format('jS, F Y');	
	}
	
	function get_year(){
       $today=getdate();
       $thisyear=$today['year'];
       
       return $thisyear; 
   }
?>
