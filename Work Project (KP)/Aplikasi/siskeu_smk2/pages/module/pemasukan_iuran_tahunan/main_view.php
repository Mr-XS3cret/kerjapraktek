<?php
	require_once("business/input_iuran_tahunan.class.php");
	
	$tmpl->setBasedir("module/pemasukan_iuran_tahunan/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$tmpl->addVar("article", "HEADLINE", "Pemasukan Iuran Tahunan Siswa");
	$tmpl->addVar("article", "URL_PROSES", "module/pemasukan_iuran_tahunan/process_request.php");
	
	$iuran=new inputIuranTahunan;
	$iuran->connect();
	$iuran->display_jenis_iuran_tahunan();
	
	$row=0;
	while($result=$iuran->get_array()){
		$number=$row+1;
		$disp[$row]=array('ID'=>$result['ID'],'NAMA'=>$result['NAMA'], 'PAGE'=>$id, 'TITLE'=>$result['NAMA']); 
		$row++;
	}
	foreach ($disp as $data){
	   $tmpl->addVars("data", $data);
	   $tmpl->parseTemplate("data","a");
	}
?>
