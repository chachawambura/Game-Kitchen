<?php
$urls = 'index.php?acc=games';

$page = $_REQUEST['page'];

$gid = $_REQUEST['gid'];

$playerId = $_REQUEST['playerId'];

$stake = $_REQUEST['stake'];

$currentgameId = $_REQUEST['currentgameId'];

$searchplayerId = $_REQUEST['searchplayerId'];

switch($page)
	{
	
	case "invite":
		include "invite".EXT;
		break;	
	
	case "details":
		include "game-details".EXT;
		break;
		
	case "direct":
		include "direct_challenge".EXT;
		break;
		
	case "claims":
		include "claim-prize".EXT;
		break;
		
	case "favourite_games":
		include "favourite_games".EXT;
		break;
			
	case "player1_prize":
		include "prize1".EXT;
		break;
		
	case "player2_dispute2":
		include "player2_dispute2".EXT;
		break;
		
	case "player1_dispute":
		include "player1_dispute".EXT;
		break;
		
	case "favouritedirectm":
		include "favouritedirectm".EXT;
		break;
		
	 case "favouritedirectc":
		include "favouritedirectc".EXT;
		break;
		
		
	case "read":
		include "read".EXT;
		break;
		
	case "reply":
		include "reply".EXT;
		break;
		
		
	case "gamesummary":
		include "gamesummary".EXT;
		break;
		
	case "viewreply":
		include "viewreply".EXT;
		break;
		
	case "acceptNow":
		include "acceptNow".EXT;
		break;
	case "declineChallenge":
	    include "declineChallenge".EXT;
	    break;
	
	case "cancelNow":
	    include "cancelNow".EXT;
	    break;
		
	case "acceptChallenge":
		include "acceptChallenge".EXT;
		break;
		
	case "player1_dispute2":
		include "player1_dispute2".EXT;
		break;
		
	case "player2_dispute":
		include "player2_dispute".EXT;
		break;
		
	case "player2_prize":
		include "prize2".EXT;
		break;
		
		
	case "matchmaking":
		include "matchmaking".EXT;
		break;
		
	case "direct_message":
		include "direct_message".EXT;
		break;
	
	case "games-mine":
		include "games-mine".EXT;
		break;
		
	case "cancel_mygame":
		include "cancel_mygame".EXT;
		break;
		
	case "custom":
		include "custom".EXT;
		break;
		
	case "creatematch":
		include "creatematch".EXT;
		break;
		
	case "tournament":
		include "tournament".EXT;
		break;
	
	case "games-all":
		include "games-all" . EXT;
		break;
		
	default:
		include "games-all".EXT;
		break;
		
	default:
		include "favourite_games".EXT;
		break;
	
	default:
		include "addmessage".EXT;
		break;
		
	default:
		include "showmessage".EXT;
		break;
		
	default:
		include "messages".EXT;
		break;
		
	default:
		include "gamesactive".EXT;
		break;
		
	default:
		include "directgames".EXT;
		break;
		
	default:
		include "directmessage".EXT;
		break;
	
	}


?>

