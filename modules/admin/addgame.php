			<?php 
			if(isset($_POST['submitNewGame']) && $_POST['submitNewGame'] == "New Game")
			{
				
				if(!isset($_POST['gametitle']) || !isset($_POST['gamedesc']) || !isset($_POST['categoryId']) || !isset($_POST['gameImage']) )
				{
					echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
					
				}else{
				
					echo dashboardModel::newGameAdded($_POST);
					echo '<div class="col-md-12 isa_error text-center">New game has been uploaded successfully.</div>';
				
				}
				
			}
			
			?>
      <form class="form" role="form" method="post" action="index.php?acc=addgame" enctype="multipart/form-data" id="signup-nav2">
                   <div class="col-md-12 form-group">
    	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Game Title</label>
            <input type="text" class="form-control" name="gametitle" placeholder="Game Title" required value="<?php echo isset($_POST['gametitle']) ? $_POST['gametitle'] : '' ; ?>">
   		</div>
        <div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Game Description</label>
            <textarea class="form-control" name="gamedesc" placeholder="Game Desc" required value="<?php echo isset($_POST['gamedesc']) ? $_POST['gamedesc'] : '' ; ?>">
             </textarea>
        </div>   
    </div>
    
        <div class="col-md-12 form-group">
    	<div class="col-md-6">
    	<div class="file-field">
    <div class="btn btn-primary btn-sm float-left">
      <span>Choose file</span>
      <input type="file" name="gameImage" required value="<?php echo isset($_POST['gameImage']) ? $_POST['gameImage'] : '' ; ?>">
    </div>
    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" placeholder="Upload your file">
    </div>
  </div>
    	</div>
    	<div class="col-md-6">
    	<select class="mdb-select md-form" name="categoryId">
       <option value="" disabled selected>Choose your option</option>
      <?php 
       //echo dashboardModel::getAllCategory();
       $categoryList = dashboardModel::getAllCategory();
       if(count($categoryList) < 1 ):
       echo '<div class="col-md-12 isa_warning text-center">There are no category</div>';
       else:
       ?>
       <?php 
       foreach($categoryList as $catcList)
       {?>
        <option value="<?php echo $catcList->id; ?>"><?php echo $catcList->title; ?></option>
       <?php
       }
       endif;
       ?>
       </select>
    	</div>
    	
    	</div>
    	
    	
    	  <div class="col-md-12 form-group">
    	<div class="col-md-4">
            <label class="sr-only" for="exampleInputEmail2">Price</label>
            <input type="text" class="form-control" name="price" placeholder="Price" required value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ; ?>">
   		</div>
   		
   		<div class="col-md-4">
            <label class="sr-only" for="exampleInputEmail2">Entry Fee</label>
            <input type="text" class="form-control" name="entryFee" placeholder="Entry Fee" required value="<?php echo isset($_POST['entryFee']) ? $_POST['entryFee'] : '' ; ?>">
   		</div>
   		
   		<div class="col-md-4">
            <label class="sr-only" for="exampleInputEmail2">Seats</label>
            <input type="text" class="form-control" name="seats" placeholder="Seats" required value="<?php echo isset($_POST['seats']) ? $_POST['seats'] : '' ; ?>">
   		</div>
         
    </div>
    
          <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
       		<input type="submit" name="submitNewGame" class="btn btn-success" value="New Game" />
            
    	</div>
    	
        </div>
                   </form>      