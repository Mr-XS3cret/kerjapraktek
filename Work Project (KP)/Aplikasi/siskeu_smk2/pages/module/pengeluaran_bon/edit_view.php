<?
	require_once("business/pengeluaran_bon.class.php");
	require_once("function/format_tanggal.php");
	
	$tmpl->setBasedir("module/pengeluaran_bon/templates");
	$tmpl->readTemplatesFromFile("edit_view.html");

	$tmpl->addVar("article", "HEADLINE", "Pembayaran Cicilan");
	$tmpl->addVar("article", "URL_PROSES", "module/pengeluaran_bon/process_request.php");
	
	//print_r($code);
	$idBn=$code['idBn'];
	
	$edit = new Peminjaman;
	$edit->connect();
	$edit->get_detil_data_peminjaman($idBn);
	
	$row=0;
	while($result=$edit->get_array()){
		$disp[$row]=array(
						'NO'=>$number,
						'ID'=>$result['ID'],
						'NAMA'=>$result['NAMA'], 
						'TANGGAL'=>$result['TANGGAL'],
						'JUMLAH_PINJAM'=>$result['JUMLAH_PINJAM'], 
						'JUMLAH_BAYAR'=>$result['JUMLAH_BAYAR']); 
		$row++;
	}
	//print_r($disp);
	foreach($disp as $data){
		$tmpl->addVars("data", $data);
		$tmpl->parseTemplate("data", "a");
	}
?>