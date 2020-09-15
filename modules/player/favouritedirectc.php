<?php 

echo $gid;

$currId = MYID;
$showList = userModel::userDetails($currId);
$getemail = $showList->emailadd;
$getfname = $showList->fname;
//get opponent details

$showList1 = userModel::userDetails($joingameId);
$getemail2 = $showList1->emailadd;
$getfname2 = $showList1->fname;
$mystake = $_POST['stake'];

echo $mystake;
$getstatus='0';
$gamesList = playModel::listActiveGames(MYID, $getstatus);
$gettotal = count($gamesList);

if(isset($_POST['submitDirectFChallengeGame']) && $_POST['submitDirectFChallengeGame'] == "Submit Game")
{
	
	if(!isset($_POST['gameCategoryId']) || !isset($_POST['gameConsoleId']) || !isset($_POST['stake']) )
	{
		echo '<div class="col-md-12 isa_error text-center">You have to fill all the details.</div>';
	}
	else
	{
		
		if($balance < $mystake){
			echo '<div class="col-md-12 isa_error text-center"><strong>You have Insufficient funds. Please top up your account.</strong></div>';
		}else {
			//echo dashboardModel::userSubmitMyGame($_POST);
			
			echo playModel::submitDirectChallenge($_POST);
			
			echo 'game will be submitted ';
		}
		
		
		
	}//termsandconditions
} 


?>

<form class="form" role="form" method="post" action="index.php?acc=favouritedirectc" id="signup-nav2">
    <div class="col-md-12 form-group">

    <input type="hidden" name="userId" value="<?php echo MYID;?>">
    
    <input type="hidden" name="player2Id" value="<?php echo $gid;?>">
    
    <input type="hidden" name="myemail" value="<?php echo $getemail;?>">
    
    <input type="hidden" name="fname" value="<?php echo $getfname;?>">
    
    </div>
   
   <div class="col-md-12 form-group">
     
          <div class="col-md-4">
            <label>Game Category</label><br/>
            <!-- <select class="browser-default custom-select"  name="gameCategoryId">-->
            <!-- <option selected>Select Game Category</option>-->
            <?php 
            //echo dashboardModel::getAllCategory();
            $categoryList2 = dashboardModel::listAllGameCategory();
            if(count($categoryList2) < 1 ):
            echo '<div class="col-md-12 isa_warning text-center">There are no game category</div>';
            else:
            ?>
        <?php 
        foreach($categoryList2 as $catcListx)
        {?>
        <div class="checkboxes">
            <label><input type="checkbox" value="<?php echo $catcListx->id; ?>" name="gameCategoryId" class="check1"><?php echo $catcListx->gametitle; ?></label>
            </div>
        <?php
        }
        
        ?>
        
        <?php 
        
        {?>
        
        <?php
        }
        endif;
        ?>
        
        <!--  </select>-->
            </div>
            <div class="col-md-6">
            <label>Your Stake</label>
            <div class="numbers-row">
            <input type="text" name="stake" style="float: left;width: 30px;padding: 3px 0 0 0;text-align: center;" id="french-hens" value="100">
            </div>
            <div class="col-md-4">
            <?php 
            $usr = userModel::userDetails($currId);
            //print_r($usr);
            ?>
            
            <label>My Console</label><br/>
            <input type="hidden" name="gameConsoleId" value="<?php echo $usr->consoleId;?>">
            <label>::<strong><?php echo $usr->consoleId;?></strong></label>
            
            </div>
            <div class="col-md-4">
            <label class="checkbox-inline"><input class="coupon_question" id="onlinecheck" type="checkbox" value="">Online Play</label>
            <label class="checkbox-inline"><input class="coupon_question" id="localcheck" type="checkbox" value="">Local Play</label> 
        </div> 
            </div>

            <div class="col-md-12 form-group">
           
             
            <div class="col-md-6">
            <label>League</label><br/>
            <select class="browser-default custom-select"  name="leagueId">
            <option>Select League</option>
            <option>Any League </option>
            
            <?php 
            //echo dashboardModel::getAllCategory();
            // = dashboardModel::listAllGameCategory();
            $categoryList2 = dashboardModel::showLeagueNow();
            if(count($categoryList2) < 1 ):
            echo '<div class="col-md-12 isa_warning text-center">There are no League</div>';
            else:
            ?>
        <?php 
        foreach($categoryList2 as $catcListx)
        {?>
            <option value="<?php echo $catcListx->league; ?>" name="leagueId"><?php echo $catcListx->league; ?></option>
        <?php
        }
        endif;
            ?>
            </select>
            </div>
            </div>


            <div class="col-md-12 form-group" id="onlineleagueDiv" style="display:none;">
            <div class="col-md-4">
            <label>Team star level</label>
            <select class="browser-default custom-select" name="starlevel">
            <option value="Any">Any Star Level</option>
            <option value="4½">4 ½ star and below</option>
            <option value="4">4 star and below</option>
            <option value="3½">3 ½ star and below</option>
            <option value="3">3 star and below</option>
            </select>
            </div> 

            <div class="col-md-4">
            <label>Half Length</label>
            <select class="browser-default custom-select" name="gamerules">
            <option value="4">4 minutes</option>
            <option value="5">5 minutes</option>
            <option value="6">6 minutes</option>
            <option value="7">7 minutes</option>
            <option value="8">8 minutes</option>
            </select>
    
            </div>

            <div class="col-md-4">
            <label>Team Type</label>
            <select class="browser-default custom-select" name="teamtype">
            <option value="Online">Online</option>
            <option value="Custom">Custom</option>
            <option value="85">85 Overall</option>
            </select>
            
            </div>

            </div>

            <div class="col-md-12 form-group" id="localLeagueDiv" style="display:none;">
          
            <div class="col-md-4">
            <label>Team star level</label>
            <select class="browser-default custom-select" name="starlevel">
            <option value="Any">Any Star Level</option>
            <option value="4½">4 ½ star and below</option>
            <option value="4">4 star and below</option>
            <option value="3½">3 ½ star and below</option>
            <option value="3">3 star and below</option>
            </select>
            </div> 

            <div class="col-md-4">
            <label>Half Length</label>
            <select class="browser-default custom-select" name="gamerules">
            <option value="4">4 minutes</option>
            <option value="5">5 minutes</option>
            <option value="6">6 minutes</option>
            <option value="7">7 minutes</option>
            <option value="8">8 minutes</option>
            </select>
    
            </div>

            <div class="col-md-4">
            <label>Match Type</label>
            <select class="browser-default custom-select" name="matchtype">
            <option value="classic">Classic Match</option>
            <option value="cl">Champions League</option>
            <option value="cup final">Cup Final</option>
            <option value="homeandaway">Home & Away</option>
            <option value="volta">Volta Football</option>
            </select>
            
            </div>

            <div class="col-md-4">
            <label>House Rules</label>
            <select class="browser-default custom-select" name="matchtype" >
            <option>Mystery Ball</option>
            <option>King of The Hill</option>
            <option>No Rules</option>
            <option>Headers & Volleys</option>
            <option>Survival</option> 
            <option>Long Range</option> 
            <option>First to...</option> 
            </select>
            </div> 

            </div>
        
            <div class="col-md-12 form-group">
    	<div class="col-md-12 text-center">
    	<?php 
    	if($balance < MIN_ENTRY_FEE || $balance < $row->entry_fee ){
    	echo '<p class="text-center isa_error">Your current balance is low. Please top up to play</p>';
    	}else {
    		if($gettotal==0){
    		echo '<input type="submit" name="submitDirectFChallengeGame" class="btn btn-success" value="Submit Game" />';
    		}else {
    			echo '<strong><input type="submit"  class="btn btn-success" value="Challenge Exists" /></strong>';
    			
    		}
    	}
    	?>
       		
            
    	</div>
        </div>
        
            
            <script type="text/javascript">

        $(document).ready(function(){
            $("select").change(function(){
                $( "select option:selected").each(function(){
                    if($(this).attr("value")=="ps4"){
                        $(".box").hide();
                        $("#ps4").show();
                    }
                    if($(this).attr("value")=="green"){
                        $(".box").hide();
                        $(".green").show();
                    }
                    if($(this).attr("value")=="blue"){
                        $(".box").hide();
                        $(".blue").show();
                    }
                    if($(this).attr("value")=="choose"){
                        $(".box").hide();
                        $(".choose").show();
                    }
                });
            }).change();
        });
        </script> 
    <script type="text/javascript">

    $(function() {

        $(".numbers-row").append('<div class="inc button2">+</div><div class="dec button2">-</div>');

        $(".button2").on("click", function() {

            var $button = $(this);
            var oldValue = $button.parent().find("input").val();

            if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 50;
            } else {
            // Don't allow decrementing below zero
            if (oldValue > 100) {
                var newVal = parseFloat(oldValue) - 50;
                } else {
                newVal = 100;
            }
            }

            $button.parent().find("input").val(newVal);

        });

        });


    </script>
    
    <script type="text/javascript">
    $("#onlineleagueDiv").hide();
    $("#localLeagueDiv").hide();
    $("#onlinecheck").hide();
    $("#localcheck").hide();



    $(".check1").click(function() {
        if($(this).is(":checked")) {
            $("#onlineleagueDiv").hide();
            $("#localLeagueDiv").hide();
           
            $("#onlinecheck").show();
            $("#localcheck").show();
        } else {
            $("#onlineleagueDiv").hide();
            $("#localLeagueDiv").hide();
            
            $("#onlinecheck").hide();
            $("#localcheck").hide();
        }
    });

    $("#onlinecheck").click(function() {
    if($(this).is(":checked")) {
            $("#onlineleagueDiv").show();
            $("#localLeagueDiv").hide();
            

        } else {
            $("#onlineleagueDiv").hide();
            $("#localLeagueDiv").hide();
            
     

        }
    });

    
    $("#localcheck").click(function() {
    if($(this).is(":checked")) {
            $("#onlineleagueDiv").hide();
            $("#localLeagueDiv").show();
            
            $("#league1").show();
           
        } else {
            $("#onlineleagueDiv").hide();
            $("#localLeagueDiv").hide();
           
            $("#league1").hide();
           

        }
    });


    $('.coupon_question').click(function() {
    $('.coupon_question').not(this).prop('checked', false);
    });

    </script>
        
    
       </form>
         
       