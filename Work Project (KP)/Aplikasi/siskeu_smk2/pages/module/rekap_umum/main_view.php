<?

require_once("business/rekap_umum.class.php");
require_once("function/format_tanggal.php");

$tmpl->setBasedir("module/rekap_umum/templates");
$tmpl->readTemplatesFromFile("main_view.html");

$urlProc=$crypt->paramEncrypt('module=rekap_umum&file=detil_view');

$tmpl->addVar("article", "HEADLINE", "Rekapitulasi Umum");
$tmpl->addVar("article", "URL_PROSES", "index.php?".$urlProc);

$thisyear = get_year();
$startyear = $thisyear - 10;

$row=0;
for($startyear; $startyear<=$thisyear; $startyear++){
   if ($startyear==$thisyear){
      $selected = 'SELECTED';
   }else{ 
      $selected = '';
   }
   $years[$row]=array('TAHUN'=>$startyear, 'SELECTED'=>$selected);
   $row++;
}

foreach($years as $tahun){
   $tmpl->addVars("tahun", $tahun);
	$tmpl->parseTemplate("tahun", "a");
}           

?>