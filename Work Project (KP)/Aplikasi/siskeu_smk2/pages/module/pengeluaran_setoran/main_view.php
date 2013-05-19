<?
	require_once("business/pengeluaran_setoran.class.php");

	$tmpl->setBasedir("module/pengeluaran_setoran/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$url=$crypt->paramEncrypt('module=pengeluaran_setoran&file=insert_view');

	$tmpl->addVar("article", "HEADLINE", "Manajemen Penyetoran Dana");
	$tmpl->addVar("article", "URL_ADD", "index.php?".$url);

	$view = new Setoran;
	$view->connect();
	$view->get_rekap_setoran();

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
								'NAMA'=>$result['NAMA_SETORAN'], 
								'MASUK'=>number_format($result['JUMLAH_MASUK'],2,',','.'), 
								'KELUAR'=>number_format($result['JUMLAH_DISETORKAN'],2,',','.'), 
								'SISA'=>number_format($result['JUMLAH_SISA'],2,',','.'),
								'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=pengeluaran_setoran&file=detil_view&idSt=".$data[ID];
		$urlDet=$crypt->paramEncrypt($param);
		
		if($data['KELUAR']!=0){
			$tmpl->addVar("data", "URL_DETAIL", "index.php?".$urlDet);
			$tmpl->addVar("data", "IMAGE", "../images/button-detil.gif");
		} else {
			$tmpl->addVar("data", "URL_DETAIL", "");
			$tmpl->addVar("data", "IMAGE", "");
		}
		
		$tmpl->addVars("data", $data);
		$tmpl->parseTemplate("data","a");
	}
?>