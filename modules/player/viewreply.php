<?php 
$gamesList = playModel::showReplyByMessageId($gid);
?>
<table id="dtBasicExample" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
  <thead>
  </thead>
  <tbody>
  <?php 
  foreach($gamesList as $game)
  {
  echo '<tr>';
  $details = '<h4></h4>
		
					<td><p><label>Message</label>'.$game->description.'</p></td>';
  
  echo '<div class="col-md-12 game-details">
					<div class="col-md-12">' . $details .'</div>
			  </div>';
  echo '</tr>';
  
  }
  ?>
  </tbody>
  </table>