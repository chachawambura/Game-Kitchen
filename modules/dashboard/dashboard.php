<section class="content">
	<div class="container">
		<div class="row">

                <div class="col-md-12">
                <?php 
                    
                    switch(USRLVL)
                        {
                        case 0: 
                            $mod = "player";
                            break;
                        case 1: //super
                            $mod = "admin";
                            break;
                         case 2: //super 1
                        	$mod = "superadmin";
                        	break;
                        }		
            
                    require_once APPLIC . DS . $mod . DS . "model" . EXT;
                    include APPLIC . DS . $mod . DS . $mod . EXT;
                
                ?>                
                
            </div>

</div></div>
</section>
