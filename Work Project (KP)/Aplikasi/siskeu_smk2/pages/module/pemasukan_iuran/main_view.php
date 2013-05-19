<?php
	require_once("business/input_iuran.class.php");
	
	$tmpl->setBasedir("module/pemasukan_iuran/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$tmpl->addVar("article", "HEADLINE", "Pemasukan Iuran Bulanan Siswa");
	$tmpl->addVar("article", "URL_PROSES", "module/pemasukan_iuran/process_request.php");
	
	$iuran=new inputIuran;
	$iuran->connect();
	$iuran->display_jenis_iuran();
	
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
