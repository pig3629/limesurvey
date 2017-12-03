
﻿<!----Rhoda 2017/12/03 修改---->

<?php
include( 'connect.php' );
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">

	<title>問卷統整</title>

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

        //第一題
		$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='860' AND `language`='zh-Hant-TW'";
		$result_x = mysql_query($sql_x);
		while($w_x = mysql_fetch_assoc($result_x)){
			echo "<td>";
			echo $w_x['question'];
			echo "</td>";
		}

		//前五個	
		for($i=0;$i<$count_bar;$i++){ 
			if($i<5){
				echo "<td>";
				echo $array_bar[$i]['COLUMN_NAME'];
				echo "</td>";	
				}

		}
		//正常的後面
		for($i=6;$i<$count_bar;$i++){
            $j=$i+1;
            /*zihan 17/12/03 修改*/ 
            $firstQid= mb_substr(explode("X",$array_bar[$i]['COLUMN_NAME'])[2],0,3,"utf-8"); //取qid碼 
            $secondQid= mb_substr(explode("X",$array_bar[$j]['COLUMN_NAME'])[2],0,3,"utf-8"); //取下次qid碼 
            /*zihan 17/12/03 修改*/ 
			if($firstQid!=$secondQid){  //比對這次的qid是否與下次相同
				$sql_x="SELECT * FROM `lime_questions` WHERE `qid`='$firstQid' AND `language`='zh-Hant-TW'";
				$result_x = mysql_query($sql_x);
				while($w_x = mysql_fetch_assoc($result_x)){	
       		if($w_x['type']=='M'||$w_x['type']=='F'){
						$sql_title="SELECT * FROM `lime_questions` WHERE `parent_qid`='$firstQid' AND `language`='zh-Hant-TW'";
						$result_title = mysql_query($sql_title);
						while($w_title = mysql_fetch_assoc($result_title)){
							echo "<td>";
							echo $w_x['question'].$w_title['question'];
							echo "</td>";	
						}
					}else{
						echo "<td>";
						echo $w_x['question'];
						echo "</td>";
					}
					if($w_x['other']=='Y'){
						echo "<td>";
						echo $w_x['question']."其他";
						echo "</td>";
					}
    


				}
				
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