<?php include "header.php"; ?>

<section class="content" style="background-color: #fff !important;">
    <div class="container-fluid">
        <div class="row content1">
            <div class="col-md-1"></div>
            <div class="col-md-10">
			<?php
            
            $pg = $_REQUEST['pg'];
            
            switch($pg)
                {
				
                default:
					$file = _DEFAULT . DS. $pg.EXT;
					
                    $include = is_file($file) ? $pg : "home";
                    break;
                
                }
                
                include $include . EXT;
           
			?>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
</section>

<section class="works" style="display:none; !important">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <h3>How it Works</h3>
					<div class="col-md-12">
                        <div class="col-md-4">
                            <p style="text-align: left;"><strong>Step 1: Fund Your Account</strong></p>
                            <p style="text-align: left;">Receive up to a 200% deposit,bonus on your initial deposit.</p>
                            <p></p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Step 2: Play</strong></p>
                            <p>Join a 1v1 match or multiplayer tournament..</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Step 3: Count Your Cash</strong></p>
                            <p>Fast and easy payouts.</p>
                        </div>
                	</div>
                	
                    <div class="col-md-12 register text-center"><a href="index.php?pg=reg" id="regbutton">Register now for free</a></div>
                
            </div>
            <div class="col-md-1 sider"></div>
        </div>
        
       
        
       
        
    </div>	
</section>

<?php include _DEFAULT . DS . "footer" . EXT; ?>