<?
   require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/list_kelas.class.php");
   require_once("business/data_siswa.class.php");

	$tmpl->setBasedir("module/ref_data_siswa/templates");
	$tmpl->readTemplatesFromFile("edit_siswa_view.html");

	$tmpl->addVar("article", "HEADLINE", "Edit Data Siswa");
	$tmpl->addVar("article", "URL_PROSES", "module/ref_data_siswa/process_request.php");
	
	$view = new list_kelas;
	$view->connect();
	$view->get_list_kelas();
	
	$klsJenjang = $code['klsJenjang'];
	
   for($i==1; $i<=3; $i++){
      if($klsJenjang==$i){
         $select = 'SELECTED';
      } else {
         $select = '';
      }
      
      $jenjang[$i]=array('JENJANG'=>$i, 'SELECT'=>$select);
   }
   
	foreach($jenjang as $jenjangKelas){
      $tmpl->addVars("jenjang", $jenjangKelas);
      $tmpl->parseTemplate("jenjang", "a");
   }
	
	$klsId = $code['klsId'];
	
	$row=0;
	while($result=$view->get_array()){
	   if($klsId==$result['ID']){
         $selected = 'SELECTED';
      } else {
         $selected = '';
      }
		
      $disp[$row]=array('ID'=>$result['ID'],'NAMA'=>$result['NAMA'], 'SELECTED'=>$selected); 
		$row++;               
	}
	
	foreach($disp as $kelas){
		$tmpl->addVars("kelas", $kelas);
		$tmpl->parseTemplate("kelas", "a");
	}
	
	$nis = $code['idEd'];
	//echo "Nomor Induk : ".$nis;
	$siswa = new data_siswa;
	$siswa->get_data_siswa_by_id($nis);
	
	$row=0;
	while($hasil=$siswa->get_array()){
	   $dataSiswa[$row]=array('NIS'=>$hasil['NIS'],
                           'NAMA'=>$hasil['NAMA'],
                           'JENJANG'=>$hasil['JENJANG'],
                           'KELAS'=>$hasil['KELAS'],
                           'DPS'=>$hasil['DPS']);
      $row++;
   }
   
   foreach($dataSiswa as $sis){
      $tmpl->addVars("siswa", $sis);
      $tmpl->parseTemplate("siswa","a");
   }
	
	
?>