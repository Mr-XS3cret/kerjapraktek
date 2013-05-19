<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/list_kelas.class.php");

	$tmpl->setBasedir("module/ref_data_siswa/templates");
	$tmpl->readTemplatesFromFile("insert_siswa_view.html");

	$tmpl->addVar("article", "HEADLINE", "Tambah Data Siswa");
	$tmpl->addVar("article", "URL_PROSES", "module/ref_data_siswa/process_request.php");
	
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