<?
	require_once("business/data_siswa.class.php");

	$tmpl->setBasedir("module/ref_data_siswa/templates");
	$tmpl->readTemplatesFromFile("detil_view.html");
		
	//print_r($_POST);
	$klsJenjang = $_POST['jenjang'];
	$klsId = $_POST['kelas'];
	
	$view = new data_siswa;
	$view->connect();
	
	$urlAddSis=$crypt->paramEncrypt('module=ref_data_siswa&file=insert_siswa_view');
	
	$view->get_kelas_detil($klsId);
	$namaKelas = $view->get_array();
	$tmpl->addVar("article", "HEADLINE", "Data Siswa Kelas ".$klsJenjang." - ".$namaKelas['NAMA']);
	$tmpl->addVar("article", "URL_ADD_SIS", "`index.php?".$urlAddSis);
	
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
                        'DPS'=>number_format($result['DPS'],2,',','.'), 
								'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=ref_data_siswa&file=edit_siswa_view&idEd=".$data[NIS]."&klsId=".$klsId."&klsJenjang=".$klsJenjang;
		$urlEdt=$crypt->paramEncrypt($param);
		
		$tmpl->addVars("data", $data);
		$tmpl->addVar("data", "URL_EDIT", "index.php?".$urlEdt);
		$tmpl->addVar("data", "URL_HAPUS", "#");
		$tmpl->parseTemplate("data","a");
	}
	
?>