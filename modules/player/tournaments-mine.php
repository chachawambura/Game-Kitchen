<?php

$tournaments = playModel::listMyTournaments();

if(count($tournaments) < 1 ):
	echo '<div class="col-md-12 isa_warning text-center">There are no open tournaments</div>';
else:
	
	foreach($tournaments as $tourn)
		{
		
		$game = baseModel::gameDetails($tourn->game_id);
		
		$file = GAMES_ICONS_FOLDER . $game->img_icon ;
		
		$img = is_file( $file ) ? $file : NO_IMAGE ;
		
		$image = is_file($img) ? '<img src="'.$img.'" align="left" >' : '';
		
		$details = '<h4>'.$game->title.'</h4>
					<p><label>CAT</label> '.baseModel::categoryDetails($game->cat_id)->title.'</p>
					<p><label>Prize</label> '.$game->prize.'</p>
					<p><label>Entry Fee</label> '.$game->entry_fee.'</p>
					<p><label>Seats</label> '.$game->seats.'</p>
					<p class="readmore"><a href="'.$urls.'&page=details&tid='.$tourn->id.'">View Tournament</a></p>';
		
		echo '<div class="col-md-4 game-details">
					<div class="col-md-6">' .$image . '</div><div class="col-md-6">' . $details .'</div>
			  </div>';
		
		}
		
endif;



?>

