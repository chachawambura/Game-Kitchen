<div class="row" style="background-color:#1b3e5b;color:#fff">

    <div class="col-md-1 spaceb"></div>

    <div class="col-md-10">

       <div class="row">

          <div class="col-md-5 logo"><a href="<?php echo SITE_URL; ?>">

                  <img src="images/logo.jpg" class="responsive" alt="gamers kitchen"></a></div>
            
          <div class="col-md-7 mainmenu">

           <nav class="navbar navbar-default" role="navigation">

          <?php if (isset($_SESSION['myid'])){

          	$userdetails = userModel::userDetails(MYID);
          	$gameslList2 = dashboardModel::listNotifications(MYID);
          	
       
          	if($userdetails->access_lvl==0){

          		$balance = playModel::checkBalance(MYID);
          		
          		$shonotifications= count($gamesList2);
          		
          		$shonotifications = sizeof($gameslList2);

          	}else if($userdetails->access_lvl==1) {
          		$gameslList3 = dashboardModel::listNotificationx();
          		$balance = playModel::adminCheckBalance();
          		
          		
          		$shonotifications= count($gameslList3);
          		
          		$shonotifications = sizeof($gameslList3);

          	 }

          	

          //	

          }else {

          	

          }

          
        

          	?>

                

          <?php  if (isset($_SESSION['myid'])) : ?>

    	  <?php    	
    	  if($userdetails->active==1 && $userdetails->suspend_Status==0){
    	  echo '<div class="col-md-12 text-right top-profile">

                        <ul class="nav navbar-nav navbar-right  welcome">

 <li style="color:#fff;padding-right:10px;">'.userModel::userName(MYID).'<strong style="font-size:15px;color:#fff !important"> </li>
                          
<li><a href="index.php?pg=balance">Ksh '.$balance.'</a></strong></li>
                               <li><a href="index.php?pg=deposit" id="topupDiv">Top Up</a></li> 
<li><a href="index.php?pg=notifications">Notifications['.$shonotifications.']</a></li>

                               <li><a href="index.php?pg=withdraw" id="topupDiv">Withdraw</a> </li>

                               <li><a href="index.php?pg=myprofile">Profile</a></li>

                               <li><a href="index.php?pg=changepasswd">Password</a></li> 

                               <li><a href="index.php?url=logout">Logout</a></strong></li>

                        </ul>

                        </div>

                    

                        ';

    	                 }else if($userdetails->active==1 && $userdetails->suspend_Status==1) {
    	                	 echo '<div class="col-md-12 text-right top-profile">

    	                        <ul class="nav navbar-nav navbar-right  welcome">

    	 <li style="color:#fff;padding-right:10px;">'.userModel::userName(MYID).'<strong style="font-size:15px;color:#fff !important"> </li>
    	                          
    	<li><a href="#">Ksh '.$balance.'</a></strong></li>
    	                               <li><a href="index.php?pg=deposit" id="topupDiv">Top Up</a></li> 
    	<li><a href="#">Notifications['.$shonotifications.']</a></li>

    	                               <li><a href="#" id="topupDiv">Withdraw</a> </li>

    	                               <li><a href="#">Profile</a></li>

    	                               <li><a href="#">Password</a></li> 

    	                               <li><a href="index.php?url=logout">Logout</a></strong></li>

    	                        </ul>

    	                        </div>

    	                    

    	                        ';
    	                	 
    	                 }else if($userdetails->active==1 && $userdetails->suspend_Status==2) {
    	                	 echo 'permanent ';
    	                 }else {
    	                
    	                     echo '<div class="col-md-12 text-right top-profile">
          	    
                        <ul class="nav navbar-nav navbar-right  welcome">
          	    
 <li style="color:#fff;padding-right:10px;">'.userModel::userName(MYID).'<strong style="font-size:15px;color:#fff !important"> </li>
    	      
<li><a href="index.php?url=logout">Ksh '.$balance.'</a></strong></li>
                               <li><a href="index.php?url=logout" id="topupDiv">Top Up</a></li>
<li><a href="index.php?url=logout">Notifications['.$shonotifications.']</a></li>
     
                               <li><a href="index.php?url=logout" id="topupDiv">Withdraw</a> </li>
     
                               <li><a href="index.php?url=logout">Profile</a></li>
     
                               <li><a href="index.php?url=logout">Password</a></li>
     
                               <li><a href="index.php?url=logout">Logout</a></strong></li>
     
                        </ul>
     
                        </div>
     
     
     
                        ';
    	                 }

                     ?>

                      

    <?php endif ?>

			 

                

                    <div class="navbar-header">

                       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                       <span class="sr-only">Toggle navigation</span>

                       <span class="icon-bar"></span>

                       <span class="icon-bar"></span>

                       <span class="icon-bar"></span>

                       </button>

                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                       <ul class="nav navbar-nav">

                       	<?php 

                       	if (isset($_SESSION['myid']))
                       	    if($userdetails->active==1 && $userdetails->suspend_Status==0){
                            echo ' <li><a href="index.php">Home</a></li>';

			                  ?>

                          <li><a href="index.php?pg=about">About Us</a></li>

                          <li><a href="index.php?pg=how-works">How it Works</a></li>

                          <?php }else if($userdetails->active==1 && $userdetails->suspend_Status==1){ ?>
                           
                          <?php echo 'account temporary suspended !!!';
                          
                          
                          }else {?>
                           <li><a href="index.php?url=logout">Home</a></li>
                           <li><a href="index.php?url=logout">About Us</a></li>

                          <li><a href="index.php?url=logout">How it Works</a></li>
                           
                           <?php } ?>

                       </ul>

                       

                      <?php if(!isset($_SESSION['myid'])): ?>    

                          <ul class="nav navbar-nav navbar-right">

                              <li class="active"><a href="index.php?pg=login">Login/Register</a></li>

                           </ul>

                           

                       <?php endif; ?>



                    </div>

                    <!-- /.navbar-collapse -->

                 </nav>

          </div>

       </div>

    </div>

    <div class="col-md-1"></div>

   

</div>

