<?
	require_once("business/pengeluaran_bon.class.php");
	require_once("function/format_tanggal.php");
	
	$tmpl->setBasedir("module/pengeluaran_bon/templates");
	$tmpl->readTemplatesFromFile("edit_detil_view.html");

	$tmpl->addVar("article", "HEADLINE", "Edit Cicilan Pembayaran");
	$tmpl->addVar("article", "URL_PROSES", "module/pengeluaran_bon/process_request.php");
	
	//print_r($code);
	$idByr=$code['idByr'];
	
	$edit = new Peminjaman;
	$edit->connect();
	$edit->get_detil_pembayaran_by_tanggal($idByr);
	
	$row=0;
	while($result=$edit->get_array()){
		$disp[$row]=array(
						'ID'=>$result['ID'],
						'NAMA'=>$result['NAMA'],
                  'NOMINAL'=>$result['NOMINAL'], 
						'TANGGAL'=>$result['TANGGAL']);
		$row++;
	}
	//print_r($disp);
	foreach($disp as $data){
		$tmpl->addVars("data", $data);
		$tmpl->parseTemplate("data", "a");
	}
?>