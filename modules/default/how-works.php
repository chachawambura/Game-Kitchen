<div class="col-md-12">
 <?php if(!isset($_SESSION['myid'])): ?>  
	<h2 class="subheading">HOW IT WORKS</h2>
   
    <ul>
      <li>Create account (sign up)</li>
      <li>Deposit funds(Mpesa)</li>
      <li>Online or Offline</li>
      <li>Create match/ join match</li>
      <li>Find opponent</li>
      <li>Play match</li>
      <li>Claim result</li>
    </ul>
    <?php endif; ?>
     <?php if(isset($_SESSION['myid'])): ?>  
    <h3>CREATE ACCOUNT</h3>
    <p>Customers input credentials that fit the requirements needed by the gaming kitchen.</p>
    <h3>DEPOSIT FUNDS</h3>
    <p>Clients are able to add funds directly from their Mpesa accounts through our Paybill number or using our Mpesa prompt.</p>
    <h3>CREATE MATCH</h3>
    <p>Players are able to select their preferred games and choose from a custom set of rules they want to implement.</p>
    <p>Players will also be able to decide on the amount of money they would prefer to play with depending on their current wallet balance; this amount will be matched by the opponent.</p>
    <p>As soon as an opponent is found a direct message will be sent to notify you of your opponent’s gamer tag which you will use to find your opponent on your console.</p>
    <p>Please note, once a match is created it will only stay open for ten minutes to allow an opponent to join. If no opponent is found in the pre-specified time the created match will expire.</p> 
    <p>Please note, only one match can be created at a time.</p>
    <h3>JOIN MATCH</h3>
    <p>Players will also have the option to join matches that have already been created by other users. They will have to accept the pre-set rules and cash requirement in order to join a match. </p>
    <p>Once they accept, a direct message will be sent to them to notify them of their opponent’s (creator of the match) gamer tag, which they will use to find their opponent on their console.</p>
    <h3>PLAY MATCH </h3>
    <p>Players have a maximum of 2 hours to play the game and submit the results.</p>
    <h3>CLAIM RESULT</h3>
    <p>Once both players have completed the game, they click on the claim button. This will allow the players to choose if they won, lost or create a dispute.</p>
    <?php endif; ?>
    
</div>
