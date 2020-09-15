<?php

$games = dashboardModel::listAllGameCategory();

if(count($games) < 1 ):
echo '<div class="col-md-12 isa_warning text-center">There are no games</div>';
else:

foreach($games as $game)
{
	$file = GAMES_FOLDER . $game->gameImage ;
	$categId = $game->gamecategory_id;
	$tes = dashboardModel::getGameByCategoryId($categId);

	$img = is_file( $file ) ? $file : NO_IMAGE ;
	
	$image = is_file($img) ? '<img src="upload/'.$game->gameImage.'" align="left" >' : '';
	
	$details = '<h4>'.$game->gametitle.'</h4>
					<p><label>Description</label>'.$game->gamedesc.'</p>';
	
	//echo $file;
	
	echo '<div class="col-md-4 game-details">
	<div class="col-md-6">' .$image . '</div>
    <div class="col-md-6">' . $details .'</div>
	</div>';
	
}

endif;



?>

