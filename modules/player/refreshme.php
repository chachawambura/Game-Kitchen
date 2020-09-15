<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">

var timeout = setInterval(reloadChat, 5000);    
function reloadChat () {

 $('#links').load('games.php');
}
</script>