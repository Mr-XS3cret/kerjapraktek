<?
$tmpl->setBasedir("module/ref_data_siswa/templates");
$tmpl->readTemplatesFromFile("insert_kelas_view.html");

$tmpl->addVar("article", "HEADLINE", "Tambah Kelas");
$tmpl->addVar("article", "URL_PROSES", "module/ref_data_siswa/process_request.php");
?>