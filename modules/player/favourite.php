<?php 
$currId = MYID;
$showList = userModel::userDetails($currId);
$getemail = $showList->emailadd;
$getfname = $showList->fname;
echo playModel::submitFavouritePlayers($currId, $joingameId);

?>
