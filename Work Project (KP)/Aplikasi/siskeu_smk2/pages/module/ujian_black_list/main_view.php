<?
   session_start();
	require_once("business/black_list.class.php");

	$tmpl->setBasedir("module/ujian_black_list/templates");
	
	$view = new blackList;
	$view->connect();
	
	//print_r($_SESSION);
	if(!empty($_SESSION['semester'])){      
      $ujian = $_SESSION['semester'];
   } else {
      $ujian='uts';
   }
   
	$row=0;
	if($ujian=='uts'){
		$tmpl->readTemplatesFromFile("main_view.html");
		$tmpl->addVar("article", "HEADLINE", "Lihat Black List Ujian Tengah Semester");
	
		$view->get_black_list_uts();
		while($result=$view->get_array()){
			$number=$row+1;
			if ($number % 2 ==0){
				$class_name='table-common-even';
			}else{
				$class_name='';
			}		
			$list[$row]=array('NO'=>$number,
							'NIS'=>$result['NIS'],
							'NAMA'=>$result['NAMA'],
							'KELAS'=>$result['KELAS'],
							'KOMITE'=>number_format($result['TOTAL_KOMITE'],2,',','.')
						); 
			$row++;
		}
		
		foreach ($list as $data){
			$tmpl->addVars("data", $data);
			$tmpl->parseTemplate("data","a");
		}
	}
	elseif($ujian=='uas'){
		$tmpl->readTemplatesFromFile("main_view_uas.html");
		$tmpl->addVar("article", "HEADLINE", "Lihat Black List Ujian Akhir Semester");
	
		$view->get_black_list_uas();
		while($result=$view->get_array()){
			$number=$row+1;
			if ($number % 2 ==0){
				$class_name='table-common-even';
			}else{
				$class_name='';
			}
			$list[$row] = array('NO'=>$number,
							'NIS'=>$result['NIS'],
							'NAMA'=>$result['NAMA'],
							'KELAS'=>$result['KELAS'],
							'KOMITE'=>number_format($result['TOTAL_KOMITE'],2,',','.'),
							'TA'=>number_format($result['TOTAL_TA'],2,',','.'),
							'PRAKERIN'=>number_format($result['TOTAL_PRAKERIN'],2,',','.'),
							'OSIS'=>number_format($result['TOTAL_OSIS'],2,',','.'),
							'DPS'=>number_format($result['TOTAL_DPS'],2,',','.')
						);
			$row++;
		}
		foreach ($list as $data){
			$tmpl->addVars("data", $data);
			$tmpl->parseTemplate("data","a");
		}
	}
	
	
?>
