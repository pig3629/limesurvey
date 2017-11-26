<!----Rhoda 2017/11/26 修改---->
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
	<table width="300" border="0" style="border:1px #000000 solid;text-align: center;" RULES=ALL>
  <tbody>
    <tr>
      <td width="100">id</td>
      <td width="200">date</td>
    </tr>
    <?php 
	$date="SELECT * FROM `lime_survey_12` WHERE `submitdate` is not null";
      $result = mysql_query($date);
      $row= mysqli_num_rows($result);
      //if(mysqli_num_rows($result) ==0)   exit;
      while($r = mysql_fetch_assoc($result)){
	  
      ?>
      <tr>
        <td><?php echo $r['id']; ?></td>
        <td><?php echo $r['submitdate']?></td>
      </tr>
      <?php }?>
  </tbody>
</table>

</body>
</html>