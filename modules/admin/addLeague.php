<?php echo 'Add League';
if(isset($_POST['submitLeagueNow']) && $_POST['submitLeagueNow'] == "Submit League")
{
  
    echo dashboardModel::addNewLeague($_POST);
    
}

?>
<form class="form" role="form" method="post" action="index.php?acc=addLeague" id="signup-nav2">


<div class="col-md-12 form-group">
     
          <div class="col-md-6">
          <label>Game Category</label>
          <select class="browser-default custom-select"  name="gameCategoryId">
          <option selected>Select Game Category</option>
         <?php 
         //echo dashboardModel::getAllCategory();
         $categoryList2 = dashboardModel::listAllGameCategory();
         if(count($categoryList2) < 1 ):
         echo '<div class="col-md-12 isa_warning text-center">There are no game category</div>';
         else:
         ?>
       <?php 
       foreach($categoryList2 as $catcListx)
       {?>
        <option value="<?php echo $catcListx->id; ?>" name="gameCategoryId"><?php echo $catcListx->gametitle; ?></option>
       <?php
       }
       endif;
       ?>
         </select>
         </div>
         <div class="col-md-12 form-group">
         <div class="col-md-6">
         <label>League</label>
        <div class="numbers-row">
        <input type="text" name="league" class="form-control"  value="league" placeholder="League">
          </div>
          
        </div>
        </div>
        
          <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
    	<?php 
    
    		echo '<input type="submit" name="submitLeagueNow" class="btn btn-success" value="Submit League" />';
    	?>
       		
            
    	</div>
        </div>
        </div>
</form>