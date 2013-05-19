<?php
	require_once("business/pengeluaran_setoran.class.php");
	
	$tmpl->setBasedir("module/pengeluaran_setoran/templates");
	$tmpl->readTemplatesFromFile("insert_view.html");

	$tmpl->addVar("article", "HEADLINE", "Manajemen Penyetoran Dana");
	$tmpl->addVar("article", "URL_PROSES", "module/pengeluaran_setoran/process_request.php");
	
	$setoran=new Setoran();
	$setoran->connect();
	$setoran->display_jenis_setoran();
	
	$row=0;
	while($result=$setoran->get_array()){
		$number=$row+1;
		$disp[$row]=array('ID'=>$result['ID'],'NAMA'=>$result['NAMA'], 'TITLE'=>$result['NAMA']); 
		$row++;
	}
	foreach ($disp as $data){
	   $tmpl->addVars("data", $data);
	   $tmpl->parseTemplate("data","a");
	}
?>
