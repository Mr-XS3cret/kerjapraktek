<?
	$tmpl->setBasedir("module/ujian_cetak_kartu/templates");
	$tmpl->readTemplatesFromFile("main_view.html");
	
	$tmpl->addVar("article", "HEADLINE", "Cek Ijin Ujian");
	$tmpl->addVar("article", "URL_ACT", "module/ujian_cetak_kartu/process_request.php");
?>