<!----Rhoda 2017/12/21 修改---->
<?php
include( 'connect.php' );
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
	 <?php 
		$ans="SELECT  `12X9X8591` , COUNT( * ) FROM  `lime_survey_12` WHERE  `12X12X775D101` IS NOT NULL GROUP BY  `12X9X8591`";
    	$result_ans = mysql_query($ans) or die('query error0');
		$count_ans=mysql_num_rows($result_ans); 
	?>
<table width="200" border="1" style="text-align: center;" RULES=ALL>
  <tbody>
    <tr>
	<?php //印題目
	/*	$sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS Where Table_Name ='lime_survey_12' and DATA_TYPE not like 'datetime'";
 		$result = mysql_query($sql);
 		$count_all=mysql_num_rows($result); 
     	for($i=0;$i<$count_all;$i++){ 
 			$array_all[$i]=mysql_fetch_array($result);
 	 	};
         //第一題
 		$sql_x="SELECT * FROM `lime_answers` WHERE `qid`='859' AND `language`='zh-Hant-TW'";
 		$result_x = mysql_query($sql_x);
 		while($w_x = mysql_fetch_assoc($result_x)){
 			echo "<td>";
 			echo $w_x['answer'];
 			echo "</td>";
 		}
 		正常的後面
 		for($i=6;$i<$count_all;$i++){
             $j=$i+1;
             $first=explode("X",$array_all[$i]['COLUMN_NAME']);
			 $second=explode("X",$array_all[$j]['COLUMN_NAME']);
             $firstQid= mb_substr($first[2],0,3,"utf-8"); //取qid碼 
             $secondQid= mb_substr($second[2],0,3,"utf-8"); //取下次qid碼 
 			if($firstQid!=$secondQid){  //比對這次的qid是否與下次相同
 				$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='$firstQid' AND `language`='zh-Hant-TW'";
 				$result_x = mysql_query($sql_x);
 				while($w_x = mysql_fetch_assoc($result_x)){	
 					if($w_x['type']=='M'){//||$w_x['type']=='F'
 						$sql_title="SELECT * FROM `lime_questions` WHERE `parent_qid`='$firstQid' AND `language`='zh-Hant-TW'";
 						$result_title = mysql_query($sql_title);
 						while($w_title = mysql_fetch_assoc($result_title)){
 							echo "<td>";
 							echo $w_title['question'];
 							echo "</td>";	
 						}
 					}else{
						$sql_ans="SELECT * FROM `lime_answers` WHERE `qid`='$firstQid' AND `language`='zh-Hant-TW'";
 						$result_ans = mysql_query($sql_ans);
 						while($w_ans = mysql_fetch_assoc($result_ans)){
 							echo "<td>";
 							echo $w_ans['answer'];
 							echo "</td>";	
 						}
 					}
 					if($w_x['other']=='Y'){
 						echo "<td>";
 						echo "其他";
 						echo "</td>";
 					}
 				}
 				
 			}	
 	 	}*/
		?>  
		</tr>
  	</tbody>
</table>
<!-------------------------------------------------------------------------------------------------------------------------------------->
<!--姐姐說把M跟F的qid分開-->
<table width="200" border="1" style="text-align: center;" RULES=ALL>
  <tbody>
    <tr>	
	<?php
		//answer
		$sql_answer="SELECT `qid`,`code` FROM `lime_answers` WHERE `language`='zh-Hant-TW'";
 		$result_answer = mysql_query($sql_answer);
		$count_answer=mysql_num_rows($result_answer); 
	
     	for($i=0;$i<$count_answer;$i++){ 
 			$array_answer[$i]=mysql_fetch_array($result_answer);
 	 	};//print_r($array_answer);
		
		//question
		$sql_question="SELECT `qid`,`type` FROM `lime_questions` WHERE `language`='zh-Hant-TW'";
 		$result_question = mysql_query($sql_question);
		$count_question=mysql_num_rows($result_question); 
		$ABC_M=array();
		$ABC_F=array();
     	for($i=0;$i<$count_question;$i++){ 
 			$array_question[$i]=mysql_fetch_array($result_question);
			if($array_question[$i]['type']=='M'){
				array_push($ABC_M,$array_question[$i]['qid']);
			}else{
				array_push($ABC_F,$array_question[$i]['qid']);
			}
 	 	};
		$count_M=count($ABC_M);
		$count_F=count($ABC_F);
		
		//lime_survey_12
		$all="SELECT * FROM `lime_survey_12`";
 		$result_all = mysql_query($all);
		$count_all=mysql_num_rows($result_all);
		while($rs = mysql_fetch_assoc($result_all)){
				//取key
				$array_key=array();
				$ABC=array();
				$D=array();
 				foreach ($rs as $key=>$value){
					if (preg_match("/other/i", $key)==false) {
						array_push($array_key,$key);
					}
				}//print_r($array_key);
				$count_key=count($array_key);
				//刪除前8個
				for($i=0;$i<8;$i++){
					unset($array_key[$i]);
				}
				
				
		}
		//key分類ABC
		$q_m=array();
		$q_f=array();
		for($i=8;$i<$count_key;$i++){
			$abc=explode("X",$array_key[$i]);
			if($abc[1]!='12'){
				$second=explode("X",$array_key[$i]);
				$firstQid= mb_substr($second[2],0,3,"utf-8"); 
				for($ii=0;$ii<$count_M;$ii++){
					if($firstQid==$ABC_M[$ii]){
						array_push($q_m,$array_key[$i]);
					}
				}
				for($ii=0;$ii<$count_F;$ii++){
					if($firstQid==$ABC_F[$ii]){
						array_push($q_f,$array_key[$i]);
					}
				}
			}
		}//print_r($q_f);
		
//sql----------------------------------------------------------------------------------------------------------------------------------//
		//sql_sex
		  $i=0;
			foreach($q_f as $abc){
				
				$second=explode("X",$abc);
				$firstQid= mb_substr($second[2],0,3,"utf-8"); //取qid碼 
				$Qid[$firstQid]=$firstQid;
				if($abc!='12X9X794' && $abc!='12X12X788' && $abc!='12X11X810' && $abc!='12X11X809'){
					$sex="SELECT  `$abc` , COUNT( * ) as total FROM  `lime_survey_12` WHERE  `12X12X775D101` GROUP BY  `$abc`,`12X12X775D101`";
					$result_sqlsex = mysql_query($sex) or die('query error0');
					$count_sqlsex=mysql_num_rows($result_sqlsex); 
					while($rs = mysql_fetch_assoc($result_sqlsex)){
						$i++;
						if($rs[$abc]=='') $rs[$abc]='null';
						if($i%2==0) $c2[$firstQid][$rs[$abc]]=$rs['total']; //女生的陣列
						else $c[$firstQid][$rs[$abc]]=$rs['total']; //男生的陣列
					}
				}
			}
			foreach($Qid as $qid){
				$sql_ans="SELECT answer,code FROM `lime_answers` WHERE `qid`='$qid' AND `language`='zh-Hant-TW'";
				$result_ans = mysql_query($sql_ans);
				while($rs = mysql_fetch_assoc($result_ans)){
					$b[$qid][$rs['code']]=$rs['answer']; //b=answer
				}
			}
			echo "選男生問題的單選";
			//$result=array_diff($b[$qis],$c[$qis]);
			foreach($b as $i=>$qis){
				//print_r($qis);
				$result2[$i]=array_diff_key($b[$i],$c[$i]);
				foreach($result2[$i] as $a=> $qans){
					$c[$i][$a] = '無人選';
					ksort($c[$i]); 
				}
				
				foreach($qis as $u=>$col){
					
					echo "<tr><td>".$i."</td>";
					echo "<td>".$u."</td>";
					echo "<td>".$c[$i][$u]."</td></tr>";
				}
			}
			//print_r($b);
			
		// $ccode=array_keys($c);
		// $bcode=array_keys($b);
		// for($i=0;$i<119;$i++){
		// 	$ckey=array_keys($c[$ccode[$i]]);
		// 	$bkey=array_keys($b[$bcode[$i]]);
		// 	$dd=array_diff($ckey,$bkey);
		// 	//print_r(array_keys($c[$ccode[$i]]));
		// 	//print_r(array_keys($b[$bcode[$i]]));
		// 	//print_r($dd);
		// 	//echo "<br>";
		// 	echo "<tr>";
		// 	foreach($b[$bcode[$i]] as $value_f){
		// 		//echo "<tr><td>".$q_f[$i]."</td>";
		// 		echo "<td>".$value_f."</td>";
		// 	}echo "</td><tr>";
		// 	foreach($c[$ccode[$i]] as $value_f){
		// 		echo "<td>".$value_f."</td>";
		// 	}
		// 	foreach($c2[$ccode[$i]] as $value_f){
		// 		echo "<td>".$value_f."</td>";
		// 	}
		// 	echo "</tr>";
		// 	/*if(array_diff($ckey,$bkey)){
		// 		print_r(array_keys($c[$ccode[$i]]));
		// 		print_r(array_keys($b[$bcode[$i]]));
		// 		echo '有<br>';
		// 	}else{
		// 		print_r(array_keys($c[$ccode[$i]]));
		// 		print_r(array_keys($b[$bcode[$i]]));
		// 		echo '空<br>';
		// 	}*/
		// }
		
		
			//print_r($b);
			//print_r($c);
	 ?>
		</tr>
  	</tbody>
</table>
</body>
</html>
