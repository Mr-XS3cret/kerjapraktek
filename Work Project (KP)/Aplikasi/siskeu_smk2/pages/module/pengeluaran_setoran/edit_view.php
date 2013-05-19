<?
	require_once("business/pengeluaran_setoran.class.php");
	
	$tmpl->setBasedir("module/pengeluaran_setoran/templates");
	$tmpl->readTemplatesFromFile("edit_view.html");

	$tmpl->addVar("article", "HEADLINE", "Edit Transaksi");
	$tmpl->addVar("article", "URL_PROSES", "module/pengeluaran_setoran/process_request.php");
	
	//print_r($code);
	$idTr=$code['idTr'];
	
	$edit = new Setoran;
	$edit->connect();
	$edit->get_detil_transaksi_st($idTr);
	
	$row=0;
	while($result=$edit->get_array()){
		$disp[$row]=array(
						'ID_TR'=>$result['ID_TR'],
						'TANGGAL'=>$result['TANGGAL'],
						'ID_NAMA'=>$result['ID_NAMA'], 
						'NOMINAL'=>$result['NOMINAL'],
						'KETERANGAN'=>$result['KETERANGAN']); 
		$row++;
	}
	//print_r($disp);
	foreach($disp as $data){
		$tmpl->addVars("data", $data);
	}
	
	$edit->display_jenis_setoran();
	$sel=0;
	while($select=$edit->get_array()){
		if ($select['ID']==$disp[0]['ID_NAMA']) {
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