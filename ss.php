
          
           <?php 

        
    include("connection.php");
            
			session_start();
			$convname = $_GET['convname'];    
            $uname = $_SESSION['uname'];
					$q3 = " select * from msg where CID = '$convname'";
				   /*
					To select the msgs from selected conversation
				   */
					$r3 = mysqli_query( $con , $q3);
					
						while($msg = mysqli_fetch_row($r3)) {
							
							
				   ?>
				   
				    <?php if( strtolower($msg[2]) != strtolower($uname)) { 
                   echo "<div class ='b'> <div class='msgfy'>
                        
                        <div class='img'>
                            <img src='user.jpg' alt=''>
                        </div>
                        <div class='data'>  $msg[4]  </div>
                    
                    </div>
					</div>";
				 }else { 
					
                echo "<div class='row'>
                        
                    <div class='col-lg-2'></div>
                    <div class='col-lg-2'></div>
                    <div class='col-lg-8'>
                    <div class='a'>
                        <div class='msgfm' onclick='seen(this)'>
                        
                        
                        <div class='data'> $msg[4] </div>
                        <div class='img'>
                            <img src='user.jpg' alt=''>
                        </div>
                   
                        <div class='tick' id ='tick'> <i class='material-icons";
                       if($msg[6] == 1) {
							echo " active' >";
						}
                       else {
                           
                           echo "'>";
                       }
																				
							
							//echo $msg[5];
                            if($msg[6] == 1) {
								echo "done_all";
							}
							else if($msg[5] == 1) {
								
								echo "done_all";
							}
							else {
								echo "done";
							}
                       echo "</i></div>
                    </div>
                        </div>
                    </div>
                
                </div>";
                
						}
                        
                        }
						
                    
						
				?>