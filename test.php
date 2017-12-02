<!----Rhoda 2017/12/01 修改---->
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
	<table width="200" border="0" style="border:1px #000000 solid;text-align: center;" RULES=ALL>
		<tbody>
	<?php
		//查詢不含DATE的標題
		$sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS Where Table_Name ='lime_survey_12' and DATA_TYPE not like 'datetime'";
		$result = mysql_query($sql);
		$count_bar=mysql_num_rows($result); 
		
    	for($i=0;$i<$count_bar;$i++){ 
			$array_bar[$i]=mysql_fetch_array($result);
	 	};
		//前五個
		for($i=0;$i<5;$i++){ 
			echo "<td>";
			echo $array_bar[$i]['COLUMN_NAME'];
			echo "</td>";	
	 	};
				
		$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='860' AND `language`='zh-Hant-TW'";
		$result_x = mysql_query($sql_x);
		while($w_x = mysql_fetch_assoc($result_x)){
			echo "<td>";
			echo $w_x['question']."<br>";
			echo "</td>";		
		}
		//題組9的題目
		for($i=6;$i<103;$i++){ 
			$Arr1=str_split($array_bar[$i]['COLUMN_NAME']); 
			$aa=$Arr1[5].$Arr1[6].$Arr1[7];
			//echo $aa.'<br>';
			$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='$aa' AND `language`='zh-Hant-TW'";
			$result_x = mysql_query($sql_x);
			while($w_x = mysql_fetch_assoc($result_x)){
			echo "<td>";
			echo $w_x['question']."<br>";
			echo "</td>";
			}
		}
		//剩下的題目
		for($i=103;$i<$count_bar;$i++){ 
			$Arr1=str_split($array_bar[$i]['COLUMN_NAME']); 
			$aa=$Arr1[6].$Arr1[7].$Arr1[8];
			$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='$aa' AND `language`='zh-Hant-TW'";
			$result_x = mysql_query($sql_x);
			while($w_x = mysql_fetch_assoc($result_x)){
				echo "<td>";
				echo $w_x['question']."<br>";
				echo "</td>";
			}
		}
		//表格內容
		$sql="SELECT * FROM `lime_survey_12` WHERE `submitdate` is not null ";
		$result = mysql_query($sql);
		while($rs = mysql_fetch_assoc($result)){
			echo '<tr>';
			foreach ($rs as $key=>$value){
				if($key!='submitdate' && $key!='startdate' && $key!='datestamp'){
					echo "<td>";
					echo $value;
					echo "</td>";
				 }
			}
			echo '</tr>';
		}?>
		</tbody>
	</table>
</body>

</html>