<?php
	require_once("business/jenisIuran.class.php");

	$tmpl->setBasedir("module/ref_jenis_iuran/templates");
	$tmpl->readTemplatesFromFile("main_view.html");

	$urlAdd=$crypt->paramEncrypt('module=ref_jenis_iuran&file=add_view');
	$tmpl->addVar("article", "HEADLINE", "Jenis Iuran Siswa");
	$tmpl->addVar("article", "URL_TAMBAH", "index.php?".$urlAdd);
	
	$view=new jenisIuran;
	$view->connect();
	$view->view_all();
	
	$row=0;
	while($result=$view->get_array()){
		$number=$row+1;
		if ($number % 2 ==0){
			$class_name='table-common-even';
		}else{
			$class_name='';
		}		
		$disp[$row]=array(
							'NO'=>$number,'ID'=>$result['Id'],'NAMA'=>$result['Nama'],'JENJANG'=>$result['Jenjang'], 
							'JENIS'=>$result['Jenis'],'NOMINAL'=>number_format($result['Nominal'],2,',','.'), 
							'UTS'=>$result['Syarat_UTS'],'UAS'=>$result['Syarat_UAS'],'CLASS_NAME'=>$class_name); 
		$row++;
	}
	#print_r($disp);
	foreach ($disp as $data){
		$param="module=ref_jenis_iuran&file=edit_view&idEd=".$data[ID]."&jenjang=".$data[JENJANG];
		$urlEdt=$crypt->paramEncrypt($param);
	
	   $tmpl->addVars("data", $data);
		$tmpl->addVar("data", "URL_EDIT", "index.php?".$urlEdt);
	   $tmpl->parseTemplate("data","a");
	}
?>
