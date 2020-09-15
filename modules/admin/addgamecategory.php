<?php 
$msg = "";
$msg_class = "";
if(isset($_POST['submitNewGameCategory']) && $_POST['submitNewGameCategory'] == "Submit Category")
{
	
	if(!isset($_POST['gametitle']) || !isset($_POST['gamedesc']))
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
		
		
		
	}else{
		if($_FILES['gameImage']['size'] > 200000) {
			$msg = "Image size should not be greated than 100Kb";
			$msg_class = "alert-danger";
			echo '<strong><div class="alert '.$msg_class.'" role="alert">'.$msg.'</div><strong>';
		}else {
			echo dashboardModel::newGameCategory($_POST);
		echo '<strong><div class="col-md-12 isa_error text-center">New game category has been uploaded successfully.</div><strong>';
		  }
		
		
		
	}
	
	//echo dashboardModel::newGameCategory($_POST);
			
}
?>
 <form class="form" role="form"  method="post" action="index.php?acc=addgamecategory" enctype="multipart/form-data" id="signup-nav2">
        
        <div class="col-md-12 form-group">
        
    	<div class="col-md-6">
            <label class="sr-only" for="exampleInputEmail2">Game Title</label>
            <input type="text" class="form-control" name="gametitle" placeholder="Game Title" required value="<?php echo isset($_POST['gametitle']) ? $_POST['gametitle'] : '' ; ?>">
   		</div>
        <div class="col-md-6">
        
        <div class="form-group">
            <label>Game Description</label>
            <textarea name="gamedesc" class="form-control"  required></textarea>
          </div>
         </div>
    </div>
     <div class="col-md-12 form-group">
    	<div class="col-md-6">
    <div class="btn btn-primary btn-sm float-left">
      <span>Choose file</span>
      <input type="file" name="gameImage" required value="<?php echo isset($_POST['gameImage']) ? $_POST['gameImage'] : '' ; ?>">
    </div>
    </div>
    </div>
   <div class="col-md-12 form-group">
    	<div class="col-md-12">
       		<input type="submit" name="submitNewGameCategory" class="btn btn-success" value="Submit Category" />
            
    	</div>
    	
        </div>
  </form>