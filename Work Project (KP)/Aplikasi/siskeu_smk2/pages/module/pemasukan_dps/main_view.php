<?php
	require_once("business/input_iuran_dps.class.php");
	
	$tmpl->setBasedir("module/pemasukan_dps/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$tmpl->addVar("article", "HEADLINE", "Pemasukan Dana Pengembangan Sekolah");
	$tmpl->addVar("article", "URL_PROSES", "module/pemasukan_dps/process_request.php");
	
	$iuran=new inputIuranDps;
	$iuran->connect();
	$iuran->display_dps();
	
	$row=0;
	while($result=$iuran->get_array()){
		$number=$row+1;
		$disp[$row]=array('ID'=>$result['ID'],'NAMA'=>$result['NAMA'], 'PAGE'=>$id, 'TITLE'=>$result['NAMA']); 
		$row++;
	}
	foreach($disp as $data){
	   $tmpl->addVars("data", $data);
	   $tmpl->parseTemplate("data","a");
	}
?>
