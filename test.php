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
			$sql="SELECT * FROM `lime_survey_12` WHERE `submitdate` is not null ";
			$result = mysql_query($sql);
			$ws = mysql_fetch_assoc($result);
			foreach($ws as $key=>$value){
				if($key!='submitdate' && $key!='startdate' && $key!='datestamp' && $key !='token'){		
			?>
				<td><?=$key?></td>
				<?}	
			}?>
			</tr>
	<?php 
			while($rs = mysql_fetch_assoc($result)){
				echo '<tr>';
				foreach ($rs as $key=>$value){
					if($key!='submitdate' && $key!='startdate' && $key!='datestamp' && $key !='token'){
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
	  
      
