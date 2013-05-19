<?
session_start();

if($_SESSION['semester']=='uts'){
   $aktif = 'Semester Ganjil';
}elseif($_SESSION['semester']=='uas'){
   $aktif = 'Semester Genap';
}else{
   $aktif = 'Semester Ganjil';
}
$tmpl->setBasedir("module/setting_semester/templates");
$tmpl->readTemplatesFromFile("main_view.html");
$tmpl->addVar("article", "HEADLINE", "Pengaturan Semester");
$tmpl->addVar("article", "AKTIF", $aktif);
$tmpl->addVar("article", "URL_PROSES", "module/setting_semester/process_request.php");
?>