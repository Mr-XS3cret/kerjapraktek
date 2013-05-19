<?
	require_once($_SERVER['DOCUMENT_ROOT']."/siskeu_smk2/class/list_kelas.class.php");

	$tmpl->setBasedir("module/rekap_siswa/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$urlProc=$crypt->paramEncrypt('module=rekap_siswa&file=detil_kelas_view');
	
	$tmpl->addVar("article", "HEADLINE", "Rekapitulasi Iuran Siswa");
	$tmpl->addVar("article", "URL_PROSES", "index.php?".$urlProc);

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