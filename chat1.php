<?php

	include("connection.php");
	
    session_start();
	$uname = "";
	if(isset($_SESSION['uname']))
	$uname = $_SESSION['uname']; // To set UserName of logged in User
	$name; // Name of the User
	$convname = ""; // To get Selected Conversation Name
	$toUser = ""; // The user you wanna send the msg 
	$converr = 0; // Conversation Error
	$time = "";//Last Seen
	$q = "update active set isActive = 1 where userName='$uname'";
	/*
    To set user is active or not(1 = active , 0 = inactive)
    */
	mysqli_query($con , $q);
	
	$q = "update msg set Deliver = 1 where toUser = '$uname'";
	mysqli_query($con , $q);
	
	if(isset($_GET['logout'])) {
	/*
    User clicked on logout
    */
		$logout = $_GET['logout'];
		
		if($logout == "done") {
		date_default_timezone_set("Asia/Kolkata");
		$s = date("d m Y,H:i");
		
		$q = "update active set isActive= 0 where userName = '$uname'";
		/*
        To set user is inactive now
        */
		mysqli_query($con , $q);
		
		$q = "update active set lastSeen = '$s' where userName = '$uname'";
		/*
        Update users logout time
        */
		mysqli_query($con , $q);
			session_destroy();
			header("location:index.php");
        /*
        After logout go to the index page
        */
		} 
	}
	if(isset($_GET['conversation'])) {
		/*
        
        User Clicked on Conversation 
        */
		$convname = $_GET['conversation'];
		
		$q = " update msg set Deliver = 1 where CID = '$convname' and toUser = '$uname'";
		mysqli_query($con , $q);
		
		$q = " update msg set Seen = 1 where CID = '$convname' and toUser = '$uname'";
		mysqli_query($con , $q);
	}
	
    
	if(isset($_POST['convbtn'])) {
		/*
        User Clicked On Add New Conversation 
        */
		$convname= $_POST['convname'];
		
		$q = "select * from conv where touser = '$convname' AND fromUser='$uname' OR toUser= '$uname' AND fromuser='$convname' and userName='$uname';";
		
		$r = mysqli_query($con , $q);
		
		$c = mysqli_num_rows($r);
		/*
        To check User already has conversation with that user or not
        */
		$q = "select * from user where username='$convname'";
		
		$r = mysqli_query($con , $q);
		
		$cc = mysqli_num_rows($r);
		/*
        To check the User Exists or not
        */
        if($c == 1 || $cc != 1) {
			
			$converr = 1;
		}
		 
		else {
			$mix = $uname.$convname;
			echo $mix;
			$q = "insert into conv values('$mix' , '$uname' , '$convname' , '$uname')";
			mysqli_query($con , $q);
            /*
            Add new conversation to users conversations
            */
		}
	}
	
?>
<?php if($uname != null) { 

/*
    If user not going to access any webpage directly without login 
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/chatstyle.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    
    <div class="nav">
        <div class="menu" onclick="hide()">
            <div class="line" id= "1"></div>
            <div class="line" id= "2"></div>
            <div class="line" id = "3"></div>
        </div>
        
    </div>
     <div class="chatdiv">
    <div class="row">
       
        <div class="col-md-3 col-lg-3 col-xs-3 col-sm-3 offset-0" id="fst">
            
            <div class="prof"  id ="fstp">
                <div class="pic">
                    <div class="img">
                        <img src="user.jpg" alt="">
                    </div>
                    <p>
					<?php
					
						$q = "select name from user where userName = '$uname'";
						
						$r = mysqli_query($con , $q);
						
						while($data = mysqli_fetch_row($r)) {
							$name = $data[0];
							echo $data[0];
						}
					
					?>
					</p>
                </div>
                <div class="list">
                
                <div class="items active"><span class="align">Messages</span></div>
                    <div class="items"><span class="align">Profile</span></div>
                    <div class="items"><span class="align">Settings</span></div>
                
                
                
            </div>
           <a href="chat.php?logout=done"> <div class="logout">Logout</div> </a>
            </div>
            
        </div>
        <div class="col-md-3 col-xs-3 col-lg-3 col-sm-3 offset-0" id ="scnd">
            <div class="conversation">
               <div class="addChat" id="addcnv">
                   
				   <form action="" method="post">
                   <input placeholder="Enter Username" type="text" name="convname"/>
                   
                   <input type="submit" class="convbtn" value="Create Chat" name= "convbtn"/>
				   
                   </form>
                   <div class="err"><?php 
						
						if($converr == 1)
							echo "<script> 
                            swal('Error!', ' Conversation Already Exists or User not Exist', 'error');
                            </script>"; 
				   
				   ?></div>
                   <div class="clos" onclick="clos()">X</div>
               </div>
               
                <div class="search">
                    <input type="text">
                </div>
                <div class="items">
                    
					<?php
						
						$q1 = "select * from conv where fromUser='$uname' OR toUser='$uname'";
						/*
						To select coversations of user
						*/
						$to_user = "";
						$r1 = mysqli_query( $con , $q1);
					
						while($data = mysqli_fetch_row($r1)) {
							
							if(strtolower($data[2]) == strtolower($uname)) {
									$to_user = $data[1];
									$q2 = "select name from user where userName='$data[1]'";
								}
								else {
									$to_user = $data[2];
									$q2 = "select name from user where userName='$data[2]'";
								}
								$r2 = mysqli_query( $con , $q2);
					
									while($d = mysqli_fetch_row($r2)) {
							
					?>
					 <a href="chat.php?conversation=<?php echo $data[0]?>">
                   <div class="list <?php 
						
						if($convname == $data[0])
							echo "active";
					   ?>" id= "<?php echo $data[0] ?>"> 
                        
                        <div class="img">
                            
                            <img src="user.jpg" alt="">                    
                        </div>
                        <div class="name">
						
                           <?php

								echo $d[0];
									
                                    }
						
						
				            ?>
							
                            <div><div class="status "></div>
							<?php 
								
								$q = "select isActive from active where userName= '$to_user'";
								
								$r = mysqli_query($con , $q);
								if($r) {
									
								while($d = mysqli_fetch_row($r)){
									
									if($d[0] == 1) {
										
										echo "Online";
										
									}
									else {
										
										$q = "select lastSeen from active where username='$to_user'";
											date_default_timezone_set("Asia/Kolkata");
										$s = date("d m Y,H:i");
	
										$aa = explode(',' , $s);
	
										$cdate = explode(' ' , $aa[0]);
	
										$ctime = explode(':' , $aa[1]);
										
										$r = mysqli_query($con , $q);
										
										
										while($d = mysqli_fetch_row($r)){
											if(isset($d[0])) {
											$a = explode(',' , $d[0]);
	
											$date = explode(' ' , $a[0]);
	
											$time = explode(':' , $a[1]);
											
											if($cdate[2] - $date[2] > 0) {
												
												$t = $cdate[2] - $date[2];
												
												echo "active $t years ago";
											}
											else if($cdate[1] - $date[1] > 0) {
												
												$t = $cdate[1] - $date[1];
												
												echo "active $t months ago";
									
											}
											else if($cdate[0] - $date[0] > 0) {
												$t = $cdate[0] - $date[0];
												echo "active $t days ago";
											}
											else if($ctime[0] - $time[0] > 0) {
												
												$t = $ctime[0] - $time[0];
												
												echo "active $t hrs ago";
											}
											else if($ctime[1] - $time[1] > 0) {
												$t = $ctime[1] - $time[1];
												echo "active $t mins ago";
											}
											 
										}
											 
											
											
										}
										
									}
								}
						}
							?>
							
							
							</div>
                        </div>
                    </div>
                    </a>
                   <?php
						}
                    
				   ?>
                  
                    <div class="addbtn" onclick="addconv()"><span>+</span></div>
					
                </div>
                
            </div>
            
        </div>
        <div class="col-md-6 col-xs-6 col-lg-6 col-sm-6 offset-0" id = "thrd">
            <?php
				
				$q1 = "select * from conv where CID ='$convname' ";
						
						
						$r1 = mysqli_query( $con , $q1);
					
						while($data = mysqli_fetch_row($r1)) {
							/*
							To select the users name who is going to recieve msgs 
							*/
							if(strtolower($data[2]) == strtolower($uname)) {
									
									
									$q2 = "select name from user where userName='$data[1]'";
								}
								else {
									
								$q2 = "select name from user where userName='$data[2]'";
								}
								
								$r = mysqli_query($con,$q2);
								
								while($data = mysqli_fetch_row($r)) {
							
									$toUser = $data[0];	
								}
						}

			?>
            <div class="msg">
                <div class="info" onclick="infoChange()" id = "info">
                   
                   <div class="pic" id = "pic">
                       <img src="user.jpg" alt="">
                       
                   </div>
                    
                    <div class="name" id = "name">
                   
                        <?php echo $toUser; ?>
                        <p>
						<?php 
						
							$q1 = "select * from conv where CID ='$convname' ";
						
						
						$r1 = mysqli_query( $con , $q1);
					
						while($data = mysqli_fetch_row($r1)) {
							/*
							To select the users username who is going to recieve msgs 
							*/
							if(strtolower($data[2]) == strtolower($uname)) {
									
									$toUser = $data[1];
									
								}
								else {
									$toUser = $data[2];
								
								}
						}
							$q = "select isActive from active where userName= '$toUser'";
								
								$rr = mysqli_query($con , $q);
								
									
								while($d = mysqli_fetch_row($rr)){
									
									if($d[0] == 1) {
										
										echo "Online";
										
									}
									else {
										
										$q = "select lastSeen from active where username='$toUser'";
											date_default_timezone_set("Asia/Kolkata");
										$s = date("d m Y,H:i");
	
										$aa = explode(',' , $s);
	
										$cdate = explode(' ' , $aa[0]);
	
										$ctime = explode(':' , $aa[1]);
										
										$r = mysqli_query($con , $q);
										
										
										while($d = mysqli_fetch_row($r)){
											if(isset($d[0])) {
											$a = explode(',' , $d[0]);
	
											$date = explode(' ' , $a[0]);
	
											$time = explode(':' , $a[1]);
											
											if($cdate[2] - $date[2] > 0) {
												
												$t = $cdate[2] - $date[2];
												
												echo "active $t years ago";
											}
											else if($cdate[1] - $date[1] > 0) {
												
												$t = $cdate[1] - $date[1];
												
												echo "active $t months ago";
									
											}
											else if($cdate[0] - $date[0] > 0) {
												$t = $cdate[0] - $date[0];
												echo "active $t days ago";
											}
											else if($ctime[0] - $time[0] > 0) {
												
												$t = $ctime[0] - $time[0];
												
												echo "active $t hrs ago";
											}
											else if($ctime[1] - $time[1] > 0) {
												$t = $ctime[1] - $time[1];
												echo "active $t mins ago";
											}
											 
										}
											 
											
											
										}
										
									}
								}
						
						
						
						?>
						
						</p>
                    </div>
                </div>
                <div class="msgs" id = "msgs">
                   <?php 
				    
					
					$q3 = " select * from msg where CID = '$convname'";
				   /*
					To select the msgs from selected conversation
				   */
					$r3 = mysqli_query( $con , $q3);
					
						while($msg = mysqli_fetch_row($r3)) {
							
							
				   ?>
				   
				    <?php if( strtolower($msg[2]) != strtolower($uname)) { ?>
                   <div class ="b"> <div class="msgfy">
                        
                        <div class="img">
                            <img src="Sagar.jpg" alt="">
                        </div>
                        <div class="data"> <?php echo $msg[4] ?> </div>
                    
                    </div>
					</div>
					<?php }else { ?>
					
                    <div class="row">
                        
                    <div class="col-lg-2"></div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                    <div class="a">
                        <div class="msgfm" onclick="seen(this)">
                        
                        
                        <div class="data"> <?php echo $msg[4]?> </div>
                        <div class="img">
                            <img src="user.jpg" alt="">
                        </div>
                   
                        <div class="tick" id ="tick"> <i class="material-icons <?php if($msg[6] == 1) {
																					echo " active";
						}
																					?>" >
							<?php
							echo $msg[5];
                            if($msg[6] == 1) {
								echo "done_all";
							}
							else if($msg[5] == 1) {
								
								echo "done_all";
							}
							else {
								echo "done";
							}?></i></div>
                    </div>
                        </div>
                    </div>
                
                </div>
                <?php
						}
                        
                        }
						
                    
						
				?>
                
                
                
            </div>
            
            <div class="input">
               <form action="" method="post">
                <input class="s" type="text" name="msg">
                <input class="send" type="submit" value="send" name="send">
                </form>
            </div>
            
        </div>
        
        </div>
    </div>
    </div>
	
	<?php
	
    $q = "select isActive from Active where userName = '$toUser'";
    
    $r = mysqli_query($con , $q);
    if($r)
    while($data = mysqli_fetch_row($r)) {
            
        $active = $data[0];
        
    }
    
	if(isset($_POST['send'])) {
			$msg = $_POST['msg'];
			$s = 0;
			$q = "insert into msg values('$uname' , '$convname' , '$uname' , '$toUser' , '$msg' , '$active' , '$s')";
			if($msg != "") {
			$r = mysqli_query($con,$q);
            
    }
    }
	?>
	
</body>
<script src="assets/js/chat.js"></script>
</html>
<?php }
	
	else {
		
		header("location:index.php");
	}

 ?>