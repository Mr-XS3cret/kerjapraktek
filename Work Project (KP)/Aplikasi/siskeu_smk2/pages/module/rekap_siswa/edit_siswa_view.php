<?

require_once("business/rekap_siswa.class.php");

$tmpl->setBasedir("module/rekap_siswa/templates");
$tmpl->readTemplatesFromFile("edit_siswa_view.html");

$tmpl->addVar("article", "URL_PROSES", "module/rekap_siswa/process_request.php");
	
	//print_r($code);
$idTr=$code['idTr'];
	
$edit = new rekap_siswa;
$edit->connect();
$edit->get_detail_transaksi($idTr);
	
$row=0;
while($result=$edit->get_array()){
	$disp[$row]=array(
	         'ID_TR'=>$idTr,
				'NIS'=>$result['NIS'],
				'NAMA'=>$result['NAMA'],
				'TANGGAL'=>$result['TANGGAL'], 
				'ID_TRANS'=>$result['ID_TRANS'],
            'NOMINAL'=>$result['NOMINAL']); 
	$row++;
}
	//print_r($disp);
foreach($disp as $data){
	$tmpl->addVars("data", $data);
}
	
$edit->display_iuran();
$sel=0;
while($select=$edit->get_array()){
	if ($select['ID']==$disp[0]['ID_TRANS']) {
		$checked = 'CHECKED';
	} else {
			$checked = '';
	}
	$jenis[$sel]=array('ID'=>$select['ID'], 'NAMA'=>$select['NAMA'], 'CHECKED'=>$checked);
	$sel++;
}
	
foreach($jenis as $pilih){
	$tmpl->addVars("jenis", $pilih);
	$tmpl->parseTemplate("jenis", "a");
}

?>