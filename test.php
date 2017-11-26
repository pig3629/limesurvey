<!----Zi,Han 2017/11/26 修改---->
<?php
	include('connect.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>問卷統計表</title>
</head>
<body>
	<table width="200" border="0" style="border:1px #000000 solid;text-align: center;" RULES=ALL>
  <tbody>	
		<tr>
	<?php 
				$sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS Where Table_Name ='lime_survey_12' and DATA_TYPE not like 'datetime'";
				$result = mysql_query($sql);
				while($w = mysql_fetch_assoc($result)){
				?>
					<td><?=$w['COLUMN_NAME']?></td>
				<?}?>
		</tr>
	<?php 
			$sql="SELECT * FROM `lime_survey_12` WHERE `submitdate` is not null ";
			$result = mysql_query($sql);
			while($rs = mysql_fetch_assoc($result)){
				echo '<tr>';
				foreach ($rs as $key=>$value){
					if($key!='submitdate' && $key!='startdate' && $key!='datestamp'){
				?>
				<td><?=$value?></td>
			<?	 }
				}
				echo '</tr>';
			}?>
  </tbody>
</table>
</body>
</html>
	  
      
