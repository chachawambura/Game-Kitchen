<?php

$tdetails = baseModel::tournamentDetails($tid);

$row = baseModel::gameDetails($tdetails->game_id);

$file = GAMES_ICONS_FOLDER . $row->img_icon ;

$img = is_file( $file ) ? $file : NO_IMAGE ;

$image = is_file($img) ? '<img src="'.$img.'" align="left" >' : '';

if($_REQUEST['msg'] == "success")
	echo '<div class="col-md-12 text-center isa_success">The operation was successful</div>';

?>
<h2 class="subhead"><?php echo $row->title; ?></h2>
<div class="col-md-3"><?php echo $image; ?></div>

<div class="col-md-9">
	<div class="col-md-6"><label>Category</label> <?php echo baseModel::categoryDetails($row->cat_id)->title; ?></div>
	<div class="col-md-6"><label>Prize</label> <?php echo $row->prize; ?></div>
	<div class="col-md-6"><label>Entry Fee</label> <?php echo $row->entry_fee; ?></div>
	<div class="col-md-6"><label>Seats</label> <?php echo $row->seats; ?></div>
    <div class="col-md-12"><label>Description</label> <?php echo $row->descrip; ?></div>
    
    <div class="col-md-12 text-center">
    
		<?php
        $accepted = playModel::checkIfInviteAccepted($tid);
        
        if($accepted > 0 )
            {
            if($tdetails->player_1 == MYID) //if i sent invites			
                echo '<p class="isa_warning">I invited for this tournament</p>';
            elseif($tdetails->player_2 == MYID)
                echo '<p class="isa_warning">I already accepted this tournament</p>';
            else
                echo '<p class="isa_warning">Someone already accepted the invite</p>';
            }
        else	
            {
			if($myActiveGames > 0)
				echo '<p class="isa_error">You have another active Game. You cant play this</p>';
			elseif($balance < MIN_ENTRY_FEE || $balance < $row->entry_fee )
				echo '<p class="text-center isa_error">Your current balance is low. Please top up to play</p>';
			else
				echo '<p><a href="'. $urls.'&page=accept&tid='.$tid.'" class="button">Accept Invite to Play Game</a></p>';
			
			}
        
        ?>	
        
        <p><a href="<?php echo $urls; ?>" class="button">Back to Tournaments</a></p>
        
    </div>	 
    
    <div class="col-md-12 text-center">
		<?php
        
        if(($tdetails->player_1 == MYID || $tdetails->player_2 == MYID) && playModel::isActiveTournament($tid)==1 )
           {
		   	if(($tdetails->player_1 == MYID && $tdetails->player_1_result > 0 ) || ($tdetails->player_2 == MYID && $tdetails->player_2_result > 0 ) ) 
		   		echo '<p class="text-center isa_warning">You have already posted results for this game</p>';
			else
		   		echo '<p class="text-center"><a href="'. $urls.'&page=results-post&tid='.$tid.'" class="button">Post Results</a></p>';
		   } 
		
        ?>
    </div> 
    
    
</div>



