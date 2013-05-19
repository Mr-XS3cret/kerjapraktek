<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/list_kelas.class.php");

	$tmpl->setBasedir("module/ref_data_siswa/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$urlAddKls=$crypt->paramEncrypt('module=ref_data_siswa&file=insert_kelas_view');
	$urlDtl=$crypt->paramEncrypt('module=ref_data_siswa&file=detil_view');
	
	$tmpl->addVar("article", "HEADLINE", "Referensi Data Siswa");
	$tmpl->addVar("article", "URL_ADD_KLS", "index.php?".$urlAddKls);
	$tmpl->addVar("article", "URL_DETIL", "index.php?".$urlDtl);

	$view = new list_kelas;
	$view->connect();
	$view->get_list_kelas();
	
	$row=0;
	while($result=$view->get_array()){
		$disp[$row]=array('ID'=>$result['ID'],'NAMA'=>$result['NAMA']); 
		$row++;
	}
	
	foreach($disp as $kelas){
		$tmpl->addVars("kelas", $kelas);
		$tmpl->parseTemplate("kelas", "a");
	}
?>
