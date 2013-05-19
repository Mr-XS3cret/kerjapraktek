<?
$tmpl->setBasedir("module/ref_jenis_iuran/templates");
$tmpl->readTemplatesFromFile("add_view.html");

$tmpl->addVar("article", "HEADLINE", "Tambah Jenis Iuran Siswa");
$tmpl->addVar("article", "URL_PROSES", "module/ref_jenis_iuran/process_request.php");
?>