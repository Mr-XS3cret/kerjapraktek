<?
   require_once("business/password.class.php");
	
	$tmpl->setBasedir("module/ganti_password/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$tmpl->addVar("article", "HEADLINE", "Ganti Password");
	$tmpl->addVar("article", "URL_PROSES", "module/ganti_password/process_request.php");
?>