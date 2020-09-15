<?php
$tourna = baseModel::tournamentDetails($tid);

if($tourna->player_1 == MYID)
	$field = "player_1_result";
elseif($tourna->player_2 == MYID)
	$field = "player_2_result";

?>

<h3>Posting Results for <b><?php echo baseModel::gameDetails($tourna->game_id)->title; ?></b></h3>

<?php

if($_POST['submitThis'] == "Submit")
	{
	echo playModel::postResults($_POST);
	}
else
	{

	?>

    <div class="col-md-12">
    
        <form action="" method="post">
        
            <div class="col-md-6 text-right"><label>Enter Results</label></div>
            <div class="col-md-6"><input type="text" name="score" required ></div>
        
            <div class="col-md-12 text-center"><input type="submit" name="submitThis" value="Submit"></div>
        
        	<input type="hidden" name="tid" value="<?php echo $tid; ?>">            
            <input type="hidden" name="url" value="<?php echo $urls; ?>">
        
        </form>
    
    
    </div>
    
	<?php
	}
	?>