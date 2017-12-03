<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>無標題文件</title>
</head>

<body>
	<table width="200" border="0" style="border:1px #000000 solid;text-align: center;" RULES=ALL>
		<tbody>
<?php
		include( 'connect.php' );
		//查詢不含DATE的標題
		$sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS Where Table_Name ='lime_survey_12' and DATA_TYPE not like 'datetime'";
		$result = mysql_query($sql);
		$count_bar=mysql_num_rows($result); 
		
    	for($i=0;$i<$count_bar;$i++){ 
			$array_bar[$i]=mysql_fetch_array($result);
	 	};
		//題組9的題目
		for($i=6;$i<103;$i++){ 
			$j=$i+1;
			$Arr1=str_split($array_bar[$i]['COLUMN_NAME']);
			$Arr2=str_split($array_bar[$j]['COLUMN_NAME']); 
			$aa=$Arr1[5].$Arr1[6].$Arr1[7];
			$bb=$Arr2[5].$Arr2[6].$Arr2[7];
			if($aa==$bb){
				$i+1;
			}else{
			//echo $aa.'<br>';
			$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='$aa' AND `language`='zh-Hant-TW'";
			$result_x = mysql_query($sql_x);
			while($w_x = mysql_fetch_assoc($result_x)){
				echo "<td>";
				echo $w_x['question']."<br>";
				echo "</td>";
				if($w_x['type']=='M'){
					$sql_title="SELECT * FROM `lime_questions` WHERE `parent_qid`='$aa' AND `language`='zh-Hant-TW'";
					$result_title = mysql_query($sql_title);
					while($w_title = mysql_fetch_assoc($result_title)){
						echo "<td>";
						echo $w_title['question']."<br>";
						echo "</td>";
					}
				}
			}	
		}
		}
		//剩下的題目
		for($i=103;$i<$count_bar;$i++){ 
			$j=$i+1;
			$Arr1=str_split($array_bar[$i]['COLUMN_NAME']);
			$Arr2=str_split($array_bar[$j]['COLUMN_NAME']); 
			$aa=$Arr1[6].$Arr1[7].$Arr1[8];
			$bb=$Arr2[6].$Arr2[7].$Arr2[8];
			if($aa==$bb){
				$i+1;
			}else{
			//echo $aa.'<br>';
			$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='$aa' AND `language`='zh-Hant-TW'";
			$result_x = mysql_query($sql_x);
			while($w_x = mysql_fetch_assoc($result_x)){
				echo "<td>";
				echo $w_x['question']."<br>";
				echo "</td>";
				if($w_x['type']=='M'){
					$sql_title="SELECT * FROM `lime_questions` WHERE `parent_qid`='$aa' AND `language`='zh-Hant-TW'";
					$result_title = mysql_query($sql_title);
					while($w_title = mysql_fetch_assoc($result_title)){
						echo "<td>";
						echo $w_title['question']."<br>";
						echo "</td>";
					}
				}
			}	
			}
		}
?>
</tbody>
	</table>
</body>

</html>