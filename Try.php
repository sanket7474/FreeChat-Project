<?php
	
	date_default_timezone_set("Asia/Kolkata");
	$s = date("d m Y,H:i");
	echo $s;
	$a = explode(',' , $s);
	
	$date = explode(' ' , $a[0]);
	
	$time = explode(':' , $a[1]);
	
	
	
?>