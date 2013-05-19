<?
	require_once("business/rekap_siswa.class.php");
	require_once("function/format_tanggal.php");

	$tmpl->setBasedir("module/rekap_siswa/templates");
	$tmpl->readTemplatesFromFile("detil_siswa_view.html");
	
	$tmpl->addVar("article", "HEADLINE", "Detail Rekap Siswa");
	
	//print_r($code);
	$nis=$code['nis']; //didecrypt di index.php
	
	$view = new rekap_siswa;
	$view->connect();
	
	$view->get_siswa($nis);
	$siswa = $view->get_array();
	
	$tmpl->addVar("article", "NIS", $siswa['NIS']);
	$tmpl->addVar("article", "NAMA", $siswa['NAMA']);
	$tmpl->addVar("article", "KELAS", $siswa['JENJANG']." - ".$siswa['KELAS']);
	
	$view->get_list_transaksi($nis);
	
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}		
		$disp[$row]=array('NO_TRANS'=>$number, 
						'TGL_TRANS'=>format_tanggal($result['TANGGAL']),
						'JNS_TRANS'=>$result['TRANSAKSI'],
						'TOTAL_TRANS'=>number_format($result['TOTAL'],2,',','.'),
						'ID_TRANS'=>$result['ID_TRANS'],
						'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=rekap_siswa&file=edit_siswa_view&idTr=".$data[ID_TRANS];
		$urlEd=$crypt->paramEncrypt($param);
		
		$tmpl->addVars("data_trans", $data);
		$tmpl->addVar("data_trans", "URL_EDIT", "index.php?".$urlEd);
		$tmpl->parseTemplate("data_trans","a");
	}
	
	
?>