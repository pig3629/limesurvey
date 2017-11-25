<!----Rhoda 2017/11/25 修改---->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<?php
	include('connect.php');
?>
</head>

<body>

	<table width="300" border="0" style="border:1px #000000 solid;text-align: center;" RULES=ALL>
  <tbody>
    <tr>
      <td width="100">id</td>
      <td width="200">date</td>
    </tr>
    <?php 
	$date="SELECT * FROM `lime_survey_12` WHERE `submitdate` is not null";
    $result = mysql_query($date) or die('query error0');
	$count_date=mysql_num_rows($result); 
	  
    for($i=0;$i<$count_date;$i++){ 
		$array[$i]=mysql_fetch_array($result);
		//echo $array[$i]['id'];
	 };?>

	  
	  <?php for($i=0;$i<$count_date;$i++){ ?>
    <tr>
      <td><?php echo $array[$i]['id'];?></td>
      <td><?php echo $array[$i]['submitdate'];?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>

</body>
</html>