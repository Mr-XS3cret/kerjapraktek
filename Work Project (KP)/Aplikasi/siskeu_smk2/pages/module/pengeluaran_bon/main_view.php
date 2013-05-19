<?
	require_once("business/pengeluaran_bon.class.php");
	require_once("function/format_tanggal.php");

	$tmpl->setBasedir("module/pengeluaran_bon/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$url=$crypt->paramEncrypt('module=pengeluaran_bon&file=insert_view');

	$tmpl->addVar("article", "HEADLINE", "Manajemen Peminjaman Dana");
	$tmpl->addVar("article", "URL_ADD", "index.php?".$url);
	
	$view = new Peminjaman;
	$view->connect();
	$view->get_all_data_peminjaman();

	$row=0;
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}
            		
		$disp[$row]=array('NO'=>$number,
								'ID'=>$result['ID'],
								'NAMA'=>$result['NAMA'], 
								'TANGGAL'=>format_tanggal($result['TANGGAL']),
								'JUMLAH_PINJAM'=>number_format($result['JUMLAH_PINJAM'],2,',','.'), 
								'JUMLAH_BAYAR'=>number_format($result['JUMLAH_BAYAR'],2,',','.'), 
								'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=pengeluaran_bon&file=edit_view&idBn=".$data[ID];
		$urlClr=$crypt->paramEncrypt($param);
		
		$param="module=pengeluaran_bon&file=edit_history_view&idBn=".$data[ID];
		$urlEdt=$crypt->paramEncrypt($param);
		
		$param="module=pengeluaran_bon&file=detil_bayar_view&idBn=".$data[ID]."&nama=".$data[NAMA];
		$urlDet=$crypt->paramEncrypt($param);
		
		$tmpl->addVar("data", "URL_CLEAR", "index.php?".$urlClr);
		$tmpl->addVar("data", "URL_EDIT", "index.php?".$urlEdt);
		$tmpl->addVar("data", "URL_DETIL", "index.php?".$urlDet);
		$tmpl->addVars("data", $data);
		$tmpl->parseTemplate("data","a");
	}
?>