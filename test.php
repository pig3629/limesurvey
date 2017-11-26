<!----Rhoda 2017/11/26 修改---->
<?php
	include('connect.php');
?>
<?php 
	$name="DESCRIBE  `lime_survey_12`"; 
    $result = mysql_query($name) or die('query error0');
	$count_bar=mysql_num_rows($result); 

    for($i=0;$i<$count_bar;$i++){ 
		$array_bar[$i]=mysql_fetch_array($result);
		
	 };
	
	for($j=0;$j<$count_bar;$j++){ 
		if(preg_match("/date/i", $array_bar[$j]['Field'])){
			unset($array_bar[$j]['Field']);
			//echo 'match'.'<br>';
		}
	};
	
	/*for($j=8;$j<$count_bar;$j++){ 
		echo $array_bar[$j]['Field'].'<br>';
	};*/
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
   
    <tr>
     <?php for($j=0;$j<$count_bar;$j++){ ?>
      	<td><?php echo $array_bar[$j]['Field']?></td>
      <?php }?>
    </tr>
    
    <?php 
	  $date="SELECT * FROM `lime_survey_12` WHERE `submitdate` is not null";
      $result = mysql_query($date);
      $row= mysqli_num_rows($result);
	  while($r = mysql_fetch_assoc($result)){
		  
      ?>
      <tr><?php for($k=0;$k<$count_bar;$k++){ ?>
        <td><?php echo $r[$array_bar[$k]['Field']] ?></td>  
        <?php } ?>
      </tr>
      
      <?php  }?>
  </tbody>
</table>

</body>
</html>
	  
      
