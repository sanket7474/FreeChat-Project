<?php

include("connection.php");
	 $error = 0;
	 $uerr = 0;
	 $eerr = 0;
	 $success = 0;
	 session_start();
	 
    if(isset($_POST['login'])) {
        
        $name = $_POST['username'];
        $pass = $_POST['pass'];
 	
			
        $q = "select * from user where userName = '$name' and pass = '$pass'";
        
        $r = mysqli_query($con , $q);
        
        $c = mysqli_num_rows($r);
        
        if($c == 1) {
            
			$_SESSION['uname'] = $name;
			$_SESSION['pass'] = $pass;
			
            header("location:chat.php");
        }
       
            else {
            
				$error = 1;
			}
	}
     if(isset($_POST['reg'])) {
        
			
			
			$rname = $_POST['rname'];
			$runame = $_POST['rUsername'];
			$remail = $_POST['remail'];
			$rpass = $_POST['rpass'];
			$q = "select * from user where userName = '$runame'";
			
			$r = mysqli_query($con,$q);
			$uc = mysqli_num_rows($r);
			
			$q = "select * from user where email = '$remail'";
			
			$r = mysqli_query($con,$q);
			$ec = mysqli_num_rows($r);
			
			if($uc == 1) 
				$uerr = 1;
			if($ec == 1) 
				$eerr = 1;
			if($eerr == 0 && $uerr == 0) {
			
			$q = "insert into active values('$runame' , 0 , '')";
			mysqli_query($con,$q);
			$q = "insert into user values('$runame' , '$rname' , '$rpass' , '$remail')";
			
				$r = mysqli_query($con , $q);
				
				if($r) {
					
					$success = 1;
				}
				else {
					$success = -1;
				}
			}
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/loginstyle.css">
</head>

<body style="background-color:rgba(128,128,128,0.2)">
    <div class="row">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">

            <div class="box" id= "box">

                <div class="imgs">
				<img src="back.jpg" style="width:100% ; height:100%"></img>
                </div>
                <div class="form1">

                    <div class="btn1 btn1-active" style="margin-left: 20%" id="loginbtn" onclick="changeToLogin()">Login</div>
                    <div class="btn1" onclick="changeToReg()" id="regbtn">Register</div>
        
                    <form action="" method="post">
                    <div class="login" id="login">
                       


                            <input type="text" placeholder="UserName" name = "username">
                            <input type="password" placeholder="Password" name = "pass">

                            <input type= "submit" value = "Let's Chat" class="btn2" name = "login">

                        
            <div class="error"><?php
                
                
                    if( $error == 1)
                    echo "Wrong UserName or Password";
                 
    
                
                ?> 
                  </div>
                   
                    </div>
                    <div class="reg" id="reg">
                        <input type="text" placeholder="Name" id = "name" name = "rname">
                        <input type="text" placeholder="UserName" id = "Username" name = "rUsername">
                        <input type="text" placeholder="Email" onblur="checkEmail()" id = "email" name = "remail">
                        <input type="password" placeholder="Password" id="pass" onblur="check()" name="rpass">
                        <input type="password" placeholder="Repeat Password"
                        onblur="check()"  id = "rpass" onkeyup="check()">
                        <input type="submit" class="btn2" id = "regg" value="Register" name = "reg">
                        <div class="error">
						<?php 
							
								if($uerr == 1)
									echo "User Already Exist";
								else if($eerr == 1)
									echo "Email Already Exist";
								else if($success == 1)
									echo "Regetration successful now you can login";
								else if( $success == -1)
									echo "Regetration unsuccessful";
						
						?></div>
                    </div>
                    
					</form>
               
                </div>

    
            </div>


        </div>
        <div class="col-lg-2 col-md-2"><div class="msg" id = "msg">dsfdfd</div></div>


</body>
<script src="assets/js/login.js"></script>

</html>
