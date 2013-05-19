<?
	require_once("business/rekap_siswa.class.php");

	$tmpl->setBasedir("module/rekap_siswa/templates");
	$tmpl->readTemplatesFromFile("detil_kelas_view.html");
		
	//print_r($_POST);
	$klsJenjang = $_POST['jenjang'];
	$klsId = $_POST['kelas'];
	
	$view = new rekap_siswa;
	$view->connect();
	
	$view->get_kelas_detil($klsId);
	$namaKelas = $view->get_array();
	
	$tmpl->addVar("article", "HEADLINE", "Rekap Iuran Siswa Kelas ".$klsJenjang." - ".$namaKelas['NAMA']);
	$tmpl->addVar("article", "URL_XLS", "module/rekap_siswa/cetak_excel_siswa.php?j=".$klsJenjang."&i=".$klsId."");
	
	$view->get_list_siswa($klsJenjang, $klsId);
	$row=0;
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}		
		$disp[$row]=array('NO'=>$number,
						'NIS'=>$result['NIS'], 
						'NAMA'=>$result['NAMA'],
						'KOMITE'=>number_format($result['TOTAL_KOMITE'],2,',','.'),
						'TA'=>number_format($result['TOTAL_TA'],2,',','.'),
						'PRAKERIN'=>number_format($result['TOTAL_PRAKERIN'],2,',','.'),
						'KESISWAAN'=>number_format($result['TOTAL_OSIS'],2,',','.'),
						'DPS'=>number_format($result['TOTAL_DPS'],2,',','.'),
						'NOMINAL_DPS'=>number_format($result['NoMINAL_DPS'],2,',','.'),
						'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=rekap_siswa&file=detil_siswa_view&nis=".$data[NIS];
		$urlDtl=$crypt->paramEncrypt($param);
		
		$tmpl->addVars("data", $data);
		$tmpl->addVar("data", "URL_DETIL", "index.php?".$urlDtl);
		$tmpl->parseTemplate("data","a");
	}
?>