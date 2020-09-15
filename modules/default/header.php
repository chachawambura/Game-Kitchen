<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo SITE_NAME; ?></title>
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <meta name="description" content="">
   <meta name="author" content="">
	<link rel="stylesheet" href="css/bootstrap.min.css" >
    <script src="js/bootstrap.min.js"></script>
  
	<link rel="stylesheet" href="css/style.css" >
	<link href="css/style_1.css" rel="stylesheet"> 
	<link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet"> 
    <script src="js/jquery.min_3.2.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/total.js"></script>
    <script src="js/datetimepicker.js"></script>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
 

</head>
<body>
	<header class="top">
		<div class="container-fluid">
			<?php include 'navigation' . EXT ;?>
			
			<?php //echo playModel::autoUpdateGamingAlerts();?>
		</div>	
	</header>
   
    <section class="banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 slider">
                <?php if(isset($_SESSION['myid'])): ?>  
                    <div class=" col-md-1 sideba"></div>
           <div class="col-md-12 banner11">    
             
   <img src="images/<?php echo empty($_SERVER['QUERY_STRING']) && !isset($_SESSION['myid']) ? 'banner-home.jpg' : ''; ?>" alt="-">
           
           <div class="col-md-1"></div>
           <div class="col-md-11">
     <?php if(isset($_SESSION['myid'])): ?> 
     
     <?php 
     $userdetails = userModel::userDetails(MYID);
     if($userdetails->access_lvl==0){
     	include 'search_details.php';
     }
     ?>
      <?php endif; ?>  
        </div>   
           </div>   
                    
                    <?php endif; ?>
                    <?php if(!isset($_SESSION['myid'])): ?>
                    <div class="col-md-12 banner11">
                    <img src="images/<?php echo empty($_SERVER['QUERY_STRING']) ?'banner-home.jpg' : ''; ?>" alt="-"> 
                     </div>
                     
                     <?php endif; ?>
                </div>
             
                 <?php if(!isset($_SESSION['myid'])): ?>  
                 <div class="ftop" style="display:none;">
                 <h1>Play For Something. Make money playing video games on Gaming Kitchen. </h1>
                 <a href="index.php?pg=games"><button id="btnt">Start Playing</button></a>
                  <a href="index.php?pg=reg"><button id="btnt">Register Now </button></a>
                 </div>
                 <?php endif; ?>
            </div>
        </div>
    </section>
   
