<?php
	require_once("business/pengeluaran_bon.class.php");
	
	$tmpl->setBasedir("module/pengeluaran_bon/templates");
	$tmpl->readTemplatesFromFile("insert_view.html");

	$tmpl->addVar("article", "HEADLINE", "Tambah Data Peminjaman");
	$tmpl->addVar("article", "URL_PROSES", "module/pengeluaran_bon/process_request.php");
?>