<?
   session_start();
	require_once("business/rekap_detil_siswa.class.php");
	require_once("function/format_tanggal.php");

	$tmpl->setBasedir("module/portal_siswa/templates");
	$tmpl->readTemplatesFromFile("main_view.html");
	
	$tmpl->addVar("article", "HEADLINE", "Data Pembayaran");
	
	//print_r($_SESSION);
	$nis=$_SESSION['user'];
	
	$view = new rekap_siswa;
	$view->connect();
	
	$view->get_siswa($nis);
	$siswa = $view->get_array();
	
	$tmpl->addVar("article", "NIS", $siswa['NIS']);
	$tmpl->addVar("article", "NAMA", $siswa['NAMA']);
	$tmpl->addVar("article", "KELAS", $siswa['JENJANG']." - ".$siswa['KELAS']);
	
	$view->get_rekap_siswa_detil($nis);
	
   $row = 0;
   
	
	$view->get_rekap_siswa_detil($nis);
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}		
		$disp[$row]=array('NO'=>$number, 
						'NAMA_IURAN'=>$result['NAMA_IURAN'],
						'NOMINAL'=>number_format($result['NOMINAL'],2,',','.'),
						'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $dataIuran){		
		$tmpl->addVars("data_iuran", $dataIuran);
		$tmpl->parseTemplate("data_iuran","a");
	}
	
	$view->get_list_transaksi($nis);
	
	$row = 0;
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}		
		$trans[$row]=array('NO_TRANS'=>$number, 
						'TGL_TRANS'=>format_tanggal($result['TANGGAL']),
						'JNS_TRANS'=>$result['TRANSAKSI'],
						'TOTAL_TRANS'=>number_format($result['TOTAL'],2,',','.'),
						'ID_TRANS'=>$result['ID_TRANS'],
						'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($trans as $data){		
		$tmpl->addVars("data_trans", $data);
		$tmpl->parseTemplate("data_trans","a");
	}
	
	
?>