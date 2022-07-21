	<?php

	// if (!(is_page(24185)) && !(is_page(24476)) && !(is_page(23365)) && !(is_page(35048)))

	if (is_page(26103))
	{
	  header('Cache-Control: no cache');
	  session_cache_limiter('private_no_expire');
	}


	session_start();
	

	 
if (is_page(30072))	 
{
	$_SESSION['master'] = true;
	$_SESSION['mastervisited'] = true;
}
else if (is_page(24185))	
	$_SESSION['master'] = false;


if ($_POST['setmaster']) {
	$_SESSION['master'] = true;
	$_SESSION['myusername'] = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), base64_decode($_POST['myusernamemod']), MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))), "\0");
	$_SESSION['adminofficename'] = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), base64_decode($_POST['coditmod']), MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))), "\0");
	}	

if (!isset($_SESSION['myusername']) && (!is_page(array(214,34973,25195,20059,20062,28843)))) 
		{echo '<meta http-equiv="REFRESH" content="0;url=/membership/sandbox4/graceful-logout">'; exit();}

	remove_filter('the_content', 'wpautop');

	if (isset($_POST['mempost']))
	  $_SESSION['memfirst'] = $_POST['mempost'];

	$host="b66c0ee722b53502a9a3944b03cd04984798c5f5.rackspaceclouddb.com";
	$username="sandboxit"; // Mysql username
	$password="kK8ZG9mMhXbA2P4W"; // Mysql password
	$db_name="sandboxit"; // Database name

	mysql_connect("$host", "$username", "$password")or
	die("cannot connect");
	mysql_select_db("$db_name")or die("cannot select DB");

	$myusername = $_SESSION['myusername'];






	
	

	$sql="SELECT l.lead
	FROM
	login
	INNER JOIN login AS l ON l.office = login.office and login.username = '$myusername'
	AND l.MEM = 4";
	
	$result=mysql_query($sql);
	
	while($row = mysql_fetch_array($result))
	  {
	  	$_SESSION['lead'] = $lead = $row['lead'];
	  }
	
	
	$sql="SELECT l.lead
	FROM
	login
	INNER JOIN login AS l ON l.office = login.office and login.username = '$myusername'
	AND l.MEM = 4";
	
	$result=mysql_query($sql);
	
	
	$sql="SELECT MAS, password
	FROM
	login
	where login.username = '$myusername';";
	
	$result=mysql_query($sql);
	
	 while($row = mysql_fetch_array($result))
	  {
	  	$userpswd = $row['password'];
	  	$mas = $row['MAS'];
	  }
	
	if (!isset($_SESSION['firstuser'])) $_SESSION['firstuser'] = $myusername;
	
	$sql="SELECT DISTINCT
	login.num,
	login.password,
	login.MAS
	FROM
	login
	INNER JOIN clientservicestatus ON clientservicestatus.client_num = login.num
	AND login.username = '$myusername'
	AND clientservicestatus.service = 2
	AND clientservicestatus.`status` = 1
	AND isnull(login.deactivate)
	INNER JOIN login AS l ON l.office = login.office
	AND l.HIP = 4
	INNER JOIN clientservicestatus cs ON l.num = cs.client_num
	AND cs.service = 2
	AND cs.`status` = 1
	AND isnull(l.deactivate)";
	
	$result=mysql_query($sql);
		  
	if ($mas == 1) $_SESSION['masteruser'] = true; else $_SESSION['masteruser'] = false;
	$letin = mysql_num_rows($result);

	$tcidevice = $_SESSION['tcidevice'];
	$tab = $_SESSION['tab'];

	$sql = "SELECT
	login.num,
	login.MEM,
	login.office,
	office.message,
	office.tci_act,
	office.office_cust1,
	login.user_cust1,
	DATE_FORMAT(office.messagestart, \"%b %e, %Y\") as messagecapture
	FROM
	login
	JOIN office
	ON login.office = office.num and login.username = '$myusername';";

	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	  {
			$_SESSION['mylevel'] = $MEM = $row['MEM'];
			$_SESSION['numemp'] = $row['num'];
			$tci_act = $row['tci_act'];
			$office = $row['office'];
			$office_cust1= $row['office_cust1'];
			$user_cust1= $row['user_cust1'];
	  }


	  
	if (($MEM == 1) && (!is_page(array(24476,214,34973,25195,28928,28843,35703))))
		{echo '<meta http-equiv="REFRESH" content="0;url=/membership/sandbox4/empfolder">'; exit();}
		
			
	$sql = "SELECT
	office.message,
	DATE_FORMAT(office.messagestart, \"%b %e, %Y\") as messagecapture,
	office.messagecapture + INTERVAL 2 hour as messagecaptureexact
	FROM
	login
	JOIN office
	ON login.office = office.num and login.username = '$myusername'
	and
	IF(NOT isnull(office.messagestart) ,
	 now() + INTERVAL - 2 HOUR BETWEEN office.messagestart + interval -2 hour
	AND office.messageend + INTERVAL 1	day + interval -2 hour,true
	);";
	
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	  {
			$_SESSION['message'] = $message = nl2br($row['message']);
			$messagecapture = $row['messagecapture'];
			$messagecaptureexact = $row['messagecaptureexact'];
	  }  
	  


    $adminoffice = $_SESSION['adminoffice'];
    
    $monum = $_SESSION['monum'];
    
    $sql = "SELECT distinct
	office.message,
	DATE_FORMAT(office.messagestart, \"%b %e, %Y\") as messagecapture,
	office.messagecapture + INTERVAL 2 hour as messagecaptureexact
	FROM office
    JOIN office of on office.num = $monum
	and
	IF(NOT isnull(office.messagestart) ,
	 now() + INTERVAL - 2 HOUR BETWEEN office.messagestart + interval -2 hour
	AND office.messageend + INTERVAL 1 day + interval -2 hour,true
	);";

	/* $sql = "SELECT distinct
	office.message,
	DATE_FORMAT(office.messagestart, \"%b %e, %Y\") as messagecapture,
	office.messagecapture + INTERVAL 2 hour as messagecaptureexact
	FROM office
    JOIN office of on (of.parent = 4797 or of.num = 4843) and of.num = $adminoffice
    where 
	office.num = 4843
	and
	IF(NOT isnull(office.messagestart) ,
	 now() + INTERVAL - 2 HOUR BETWEEN office.messagestart + interval -2 hour
	AND office.messageend + INTERVAL 1 day + interval -2 hour,true
	);"; */
	
	// exit($sql);
	
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	  {
			$_SESSION['mastermessage'] = $mastermessage = nl2br($row['message']);
			$mastermessagecapture = $row['messagecapture'];
			$mastermessagecaptureexact = $row['messagecaptureexact'];
	  } 
	

	// exit($message);  
	  
	if ($_SESSION['master'])
	{
		$message = $mastermessage;
		$messagecapture = $mastermessagecapture;
	}	  
	
	/* echo $message;
	echo $mastermessage;  
	exit(); */


	if ($MEM < 3)
	{
	  $timeout = 600000;
	  $home = 'empfolder';
	}
	else
	{
	  if (is_page(24185))
      	$timeout = 3600000; else $timeout = 1200000;
	  $home = 'efolders';
	}
	
	
	if ((is_page(array(30072,30460,30674))) && (!$_SESSION['masteruser']))
{echo "<meta http-equiv='REFRESH' content='0;url=/membership/sandbox4/$home/'>"; exit();}

	if  (!(is_page(214)) && !(is_page(25195))) {
	  echo "<script>setTimeout(function(){window.location.href='/membership/sandbox4/graceful-logout'},$timeout);</script>";
	}

	if ($myusername == 'medpracticeinc0@gmail.com') {
		$timeout = 9999999999999;
	}

	
	$default = get_bloginfo('template_directory') . "/images/default.png";

	// For setting global username
	$GLOBALS['globalUserName'] = $GLOBALS['globalUserName'] = $myusername;

	$sql = "SELECT login.num AS uid FROM login WHERE login.username = '$myusername';";
	$result=mysql_query($sql);
	while($row = mysql_fetch_array($result))
	  {
		$uid = $row['uid'];
	  }  









	?>

		<head>
			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-PKZ7DJ');</script>
			<!-- End Google Tag Manager -->
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta name="format-detection" content="telephone=no">
			<title><? if (is_page(array(30072,25184,30460,30674,25554))) echo 'The Master'; else echo 'The Vault'; ?></title>
			<!-- <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> -->
			<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
			<link rel=stylesheet type=text/css href="<?php echo get_bloginfo('template_directory'); ?>/css/materialize.min.css">
			<link rel=stylesheet type=text/css href="<?php echo get_bloginfo('template_directory'); ?>/style.css?v=1.51">
			<link rel=stylesheet type=text/css href="<?php echo get_bloginfo('template_directory'); ?>/css/vlt.css?v=1.51">
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
			<link rel=stylesheet type=text/css href="<?php echo get_bloginfo('template_directory'); ?>/css/jquery-ui.css">
			<link rel=stylesheet type=text/css href="<?php echo get_bloginfo('template_directory'); ?>/css/jquery-ui.structure.css">
			<link rel=stylesheet type=text/css href="<?php echo get_bloginfo('template_directory'); ?>/css/jquery-ui.theme.css">
			<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/jquery-ui.js"></script>
			<input class="fs" type="" style="display: none;" name="<?php echo $myusername; ?>" />
		</head>
		<header <? if (is_page(31774) or is_page(31999) or is_page(32007) or is_page(32012) or is_page(32019) or is_page(32023) or is_page(32045) or is_page(32027) or is_page(32062) or is_page(36303) or is_page(32067) or is_page(32071) or is_page(32075)) echo 'style="display: none"'; ?>>
	<? if (($_SESSION['comingfrom'] == '88') or ($_SESSION['comingfrom'] == '66'))
	{
	$sql = "select num, first, last from login where username = '$myusername';";
	$result=mysql_query($sql); 
	while($row = mysql_fetch_array($result))
	  {
	  $first = $row['first']; 
	  $last = $row['last'];
	  }

	if ($_SESSION['comingfrom'] == '88') 
	echo "<div class=\"alert\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>You assumed META Powers for \"$first $last\"</div>";
	else if ($_SESSION['comingfrom'] == '66') 
	echo "<div class=\"native\"><span class=\"closebtn\" onclick=\"this.parentElement.style.display='none';\">&times;</span>You assumed NATIVE Powers for \"$first $last\"</div>";
	} 
	if(is_page(26052)) {
		echo "
			<div class='help-header cedr-orange'>
				<div class='help-container'>
					<span class='newness cedr-orange-font'>NEW</span>
					<span class='help-text'>Help overlays are right at your fingertips. Just click on the <span class='question-fa'><i class='fa fa-question-circle' aria-hidden='true'></i></span> whenever you see it in the header.
					</span>	
					<span class='help-fa closebtn' >×</span></div>
				</div>
			</div>
		";
	}

	// Testing if this is an employee or not for employee specific styles
	if(is_page(24476)) {
		$isEE = "isEE";
	}

	?>
	
			<nav class="gradient <?php echo $isEE; ?>">
				<div class="nav-wrapper" <? if (($_SESSION['master']) && is_page(array(30072,25184,30460,30674,25554))) echo "style='background-color: #252e6b'"; ?>>
					<div class="navTop container">	


<? if (($_SESSION['master']) && (is_page(array(30072,25184,30460,30674,25554))))	 { ?> 



					
<form style="display: inline;" name="hiplogin" method="post" action="/membership/sandbox4/signin.php">
	<div style="display:none">
	 <input type="hidden" id="myusername" name="myusername" value="<? echo $myusername; ?>">
	 <input type="hidden" id="mypassword" name="mypassword" value="<? echo md5($userpswd); ?>">
	 <input type="hidden" id="comingfrom" name="comingfrom" value="gvlt" >
	</div>
	<div class="vaultLink">
	 <input type="submit" style="
	 outline: none;
	 	line-height: inherit;
		border:none;
		background-image:none;
		background-color:transparent;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;"
	    value="HR Vault">
	  </div> 
</form>	

<? } ?>




						
<? if (($letin > 0) && (!$_SESSION['master']) &&  (($_SESSION['masteruser']) or (!$_SESSION['mastervisited'])) && (($_SESSION['firstuser'] == $myusername) or ($_SESSION['comingfrom'] == '88'))) { ?> 
					
<form style="display: inline;" name="hiplogin" method="post" action="https://www.yourhipaatraining.com/hipaa/signin.php" target="_blank">
	<div style="display:none">
	 <input type="hidden" id="myusername" name="myusername" value="<? echo $myusername; ?>">
	 <input type="hidden" id="mypassword" name="mypassword" value="<? echo md5($userpswd); ?>">
	 <input type="hidden" id="comingfrom" name="comingfrom" value="gvlt" >
	</div>
	<div class="hipaaLink">
	 <input type="submit" style="
	 outline: none;
	 	line-height: inherit;
		border:none;
		background-image:none;
		background-color:transparent;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;"
	    value="HIPAA">
	  </div> 
</form>	

<? } if ((((($office_cust1 == "-1")) or ($user_cust1 != "-1")) && !(($MEM == 1) && ($user_cust1 == "-1"))) && (!$_SESSION['master']) &&  (($_SESSION['masteruser']) or (!$_SESSION['mastervisited'])) && (($_SESSION['firstuser'] == $myusername) or ($_SESSION['comingfrom'] == '88')))   { ?>
						
	<div class="tciLink">
	 <input <? if ($user_cust1 != "-1")  echo 'id="btnSso"'; ?> onclick="<? if (($user_cust1 == "-1") && ($MEM > 1)) { ?>$('#modaltcipend').modal('open'); <? } ?>" type="submit" style="
	    outline: none;
	 	line-height: inherit;
		border:none;
		background-image:none;
		background-color:transparent;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		- box-shadow: none;" value="Time & PTO" >
	  </div> 	
<?
	
	/* box-shadow: none;" value="<? if ($user_cust1 != "-1")  echo "Timekeeping"; else if ($tci_act == 1) echo "Timekeeping Pending"; else echo "Activate Timekeeping"; ?>" >
		if ((((($lead > 0) && ($office_cust1 == "-1")) or ($user_cust1 != "-1")) && !(($MEM == 1) && ($user_cust1 == "-1"))) && (!$_SESSION['master']) &&  (($_SESSION['masteruser']) or (!$_SESSION['mastervisited'])) && (($_SESSION['firstuser'] == $myusername) or ($_SESSION['comingfrom
		
		
		 */
	
	
	} ?>

<? if (($_SESSION['masteruser']) && isset($_SESSION['monum']) && isset($_SESSION['ponum']) && (!$_SESSION['master']) && (($_SESSION['firstuser'] == $myusername) or ($_SESSION['comingfrom'] == '88')))  { ?> 
					

<form style="display: inline;" name="masterlogin" method="post" action="/membership/sandbox4/offices">
	<div style="display:none">
	 <input type="hidden" id="myusername" name="myusername" value="<? echo $myusername; ?>">
	 <input type="hidden" id="mypassword" name="mypassword" value="<? echo md5($userpswd); ?>">
	 <input type="hidden" id="comingfrom" name="comingfrom" value="gvlt" >
	</div>
	<div class="masterLink">
	 <input type="submit" style="
	 outline: none;
	 	line-height: inherit;
		border:none;
		background-image:none;
		background-color:transparent;
		-webkit-box-shadow: none;
		-moz-box-shadow: none;
		box-shadow: none;"
	    value="Master Access">
	  </div> 
</form>	

<? } ?>


<script src="http://kjur.github.io/jsrsasign/jsrsasign-latest-all-min.js"></script>
 
 <?
date_default_timezone_set('America/Chicago');
$info = getdate();
$min = $info['minutes'];
$sec = $info['seconds'];

$servertime = "$min m $sec s";

?>
 
 
 <script>
	var d = new Date();
    var m = d.getMinutes();
    var s = d.getSeconds();
    var ms = <? echo $min; ?>;
    var ss = <? echo $sec; ?>;
    var drift = ms*60 + ss - m*60 - s;
    var absdrift = Math.abs(drift);
</script>

 
 <script type="text/javascript">
 $(function () {
 $('#btnSso').click(function () {
	
getJWTsso("9999", "<? echo $office_cust1; ?>", "<? echo $user_cust1; ?>",
"xxxxxxxxxxxxxxxxxx", function (err, jwt) {			
	
 if (err) {
 console.log('Fail: ' + err);
 $('#result').html('Fail: ' + err);
 } else {
 // JWT authenticated received.
 // Access ESS via a new browser tab
 let webClockUrl = 'https://payrollservers.us/pg/Login.aspx/?jwt=' + jwt;
 window.open(webClockUrl); }
 });
 });
 });
 function getJWTsso(partnerID, siteID, login, apiSecret, callback) {
 let header = { alg: "HS256", typ: "JWT" };
 let token = {
 iss: partnerID,
 product: "twplogin",
 sub: "partner",
 exp: Math.floor(Date.now() / 1000) + 60 * 5,
 siteInfo: {
 type: "id",
 id: siteID
 },
 user: {
 type: "login",
 id: login
 }
 }
 let jwt = KJUR.jws.JWS.sign("HS256", JSON.stringify(header), JSON.stringify(token), apiSecret);
 console.log('Calling Authentication Service with ' + jwt);
 $.ajax({
 url: "https://clock.payrollservers.us/AuthenticationService/oauth2/userToken",
 method: "POST",
 headers: {
 "Authorization": 'Bearer ' + jwt,
 "Content-Type": "application/json"
 },
 success: (result, status) => {
 if (result && result.token) {
14
 // we received an access token!
 callback(null, result.token);
 } else {
 // An access token was not issued
 callback('Status: ' + status + ', Result: ' + JSON.stringify(result), null);
 }
 },
 error: (o, err) => {
 // An error occurred calling the token endpoint
 console.log(o);
 if (absdrift > 30)
	 if (drift < 0)			
	 	alert("Your Single Sign On (SSO) has Failed.\n\nComputer clock is "+ absdrift + " sec fast. Pls adjust your computer clock (Windows or Mac) so it is within 30 seconds.\n\nFor help visit www.computerhope.com/issues/ch000554.htm");
			else		
	 	alert("Your Single Sign On (SSO) has Failed.\n\nComputer clock is "+ absdrift + " sec slow. Pls adjust your computer clock (Windows or Mac) so it is within 30 seconds.\n\nFor help visit www.computerhope.com/issues/ch000554.htm");
	 else
	 	alert("Your Single Sign On (SSO) has Failed.\nPlease contact your administrator.");
 }
 })
 }
 </script>
						
						<!-- mobile & tablet hamburger menu -->
						<img class="for_mobile fa-bars" src="/membership/sandbox4/wp-content/themes/Meraki/images/hamburger.png" />
						<!-- mobile & tablet hamburger menu -->	
						<!-- post counter -->	
						<span class="post_counter for_mobile">1</span>		
<?
						if (is_page(214) or is_page(25195) or is_page(20062) or is_page(20059) or is_page(25522)) { ?>
						<a href="/membership/sandbox4" class="brand-logo"><img src="/membership/sandbox4/wp-content/themes/Meraki/images/vltlogo.png" /></a

						<? } else {       
						         
	                        if (($_SESSION['master']) && is_page(array(30072,25184,30460,30674,25554)))
	                        
	                        {
		                        
		                     ?> 
		                     		                     
		                     <a  style="cursor: pointer;" onclick="document.getElementById('masterlogin').submit();" class="brand-logo"><img src="/membership/sandbox4/wp-content/themes/Meraki/images/betamaster_office.png" /></a>
		                     
		                     <?   
	                        
	                        }
	                        else
	                        {
		                     ?> <a href="/membership/sandbox4/<? echo $home; ?>" class="brand-logo"><img src="/membership/sandbox4/wp-content/themes/Meraki/images/betaLogo.png" /></a> <?
	                        }
                        
                        ?>
                        
						<div class="avatarWrap">

							<span>
							<span  class="navIcon">
								<i class="fa fa-question-circle" id="overlayTrigger" aria-hidden="true"></i>
							</span>

								<? if (($message != '') or ($mastermessage != '')) { ?>
									<div  style='display:inline; position: relative;'>
										<span class="navIcon" id="alerts">
											<i class="fa fa-bell" aria-hidden="true"></i>
											

											
											<? $m = $mm = $n = 0; if (($message != '') && ($_SESSION['lastime'] < $messagecaptureexact) && (!$_SESSION['master'])) $m++; if (($mastermessage != '') && ($_SESSION['lastime'] < $mastermessagecaptureexact)) $mm++; $n = $m + $mm; ?>
											<span  style="<? if (($n == 0) or ($_SESSION['been'] == 1)) echo 'display:none;'; ?>" class="alertNumber"><? echo $n; ?></span>
										</span>
								 
								    <? 	if (($_SESSION['been'] == 0) && ($n > 0)) $toggle = 'active'; else $toggle = ''; ?>

									<!--============ Bulletin Menu - header ============-->
									<span class="alertsDropdown for_desktop z-depth-1 <? echo $toggle; ?>">
									
										<ul>
											<li>
											   <? if (($mastermessage != '')  && !($_SESSION['master'])){ ?>
											 	<div><span class="alertBadge" <? if (($mm == 0) or ($_SESSION['been'] == 1)) {echo 'style="display:none;"';} ?>>NEW</span><span class="timestamp"> from Master</span></div>
												<strong><? echo $mastermessage; ?></strong>
												<div class="timestamp"><? echo $mastermessagecapture; ?></div>
												<? } ?>
												<? if ($MEM > 1) { ?>
													<div class="alertEdit">


															<!-- <form method="post" action="/membership/sandbox4/alert">
																		
																	<? 
																	  $monummod //= base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), $monum, MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))));
																	//  $myusernamemod = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), $myusername, MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))));
																	//  $coditmod = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), $_SESSION['adminofficename'], MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))));
																	?>	
																		
																	<div style="display:none">
																	 <input type="hidden" id="monum" name="monum" value="<? //echo $monummod; ?>">
																	 <input type="hidden" id="coditmod" name="coditmod" value="<? //echo $coditmod; ?>">
																	 <input type="hidden" id="myusernamemod" name="myusernamemod" value="<? //echo $myusernamemod ?>">
																	 <input type="hidden" id="setmaster" name="setmaster" value=<? //echo $_SESSION['master']; ?>>
																	</div> 
																
																<button type="submit" name="alert" style="background: transparent; border: none !important;">
																	<i class="fa fa-edit" aria-hidden="true"></i>
																</button>
															</form> -->

															<button name="alert" class="add_post_btn" style="background: transparent; border: none !important;">
																<i class="fa fa-edit" aria-hidden="true"></i>
															</button>
													</div>
												<? } ?>
												 <? if ($message != '') { ?>
												<div><span class="alertBadge" <? if (($m == 0) or ($_SESSION['been'] == 1)) {echo 'style="display:none;"'; } ?>>NEW</span><span class="timestamp"> from <? if ($_SESSION['master']) echo "Master"; else echo $_SESSION['adminofficename']; ?></span></div>
												<strong><? echo $message; ?></strong>
												<div class="timestamp"><? echo $messagecapture; ?></div>
												<? } ?>
											</li>
										</ul>
									</span>
										<!--============ /Bulletin Menu - header ============-->
									</div>
									
									<? 	if (($_SESSION['been'] == 0) && ($n > 0)) $_SESSION['been'] = 1;  ?>
								<? }  else  { ?>

									<span class="navIcon addalert" id="alerts">
										<? if ($MEM > 1) { ?>
											 	<button  name="alert" class="addAlertButton add_post_btn">
														<svg class="addAlertSVG" version="1.1" id="Isolation_Mode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 185 153.7" style="enable-background:new 0 0 185 153.7;" xml:space="preserve">
															<style type="text/css">
																.st0{fill:none;}
															</style>
															<g>
																<path class="st0" d="M81.5,135.4c-5.8,0-10.5-4.8-10.5-10.5c0-0.7-0.5-1.2-1.2-1.2s-1.2,0.5-1.2,1.2c0,7.1,5.8,12.9,12.9,12.9
																	c0.7,0,1.2-0.5,1.2-1.2C82.7,135.9,82.2,135.4,81.5,135.4z"/>
																<g>
																	<path class="st0" d="M140.3,122.7c-0.1,0.5-0.3,0.9-0.7,1.2C139.9,123.6,140.2,123.1,140.3,122.7z"/>
																	<path class="st0" d="M121,122.2c0,0.3,0.1,0.6,0.2,0.9c0.1,0.1,0.2,0.3,0.2,0.4c-0.1-0.1-0.2-0.3-0.2-0.4
																		C121.1,122.8,121,122.5,121,122.2z"/>
																	<path class="st0" d="M133,124.6h-9.6c-0.3,0-0.6-0.1-0.9-0.2c0.3,0.1,0.6,0.2,0.9,0.2L133,124.6l4.9,0c0.5,0,0.9-0.2,1.3-0.4
																		c-0.4,0.3-0.8,0.4-1.3,0.4H133z"/>
																	<path class="st0" d="M168.7,77.2c0.2,0.3,0.4,0.5,0.5,0.8C169.1,77.7,168.9,77.5,168.7,77.2z"/>
																	<path class="st0" d="M93.6,95.5c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0.1,0.5,0.1c-0.2,0-0.3-0.1-0.5-0.1
																		C93.9,95.6,93.7,95.6,93.6,95.5z"/>
																	<path class="st0" d="M168.9,94.9c0.1-0.1,0.1-0.2,0.2-0.2c0-0.1,0.1-0.2,0.1-0.3c-0.1,0.1-0.1,0.2-0.2,0.3
																		C169,94.8,169,94.9,168.9,94.9z"/>
																	<path class="dingPart" d="M81.5,135.3c-5.7,0-10.5-4.7-10.5-10.5c0-0.7-0.5-1.2-1.2-1.2s-1.2,0.5-1.2,1.2c0,7.1,5.8,12.9,12.9,12.9
																		c0.7,0,1.2-0.5,1.2-1.2S82.2,135.3,81.5,135.3z"/>
																	<path class="st0" d="M113,108.7v-5H94.5c-0.7,0-1.3-0.1-1.8-0.2c-1.7-0.2-3-0.9-3.9-1.6c-0.4-0.2-1-0.7-1.6-1.3c-0.4-0.4-1.3-1.3-2-2.7
																		c-0.8-1.5-1.1-3.1-1.1-4.8V78.7c0-1.7,0.4-3.3,1.1-4.8c0.7-1.4,1.6-2.3,2-2.7c1.1-1.1,2.3-1.8,3.8-2.3l1.2-0.4h0.2
																		c0.8-0.2,1.5-0.2,2-0.2h18.8V49.8c0-1.3,0.3-2.3,0.5-3c0.4-1.5,1.2-2.8,2.3-3.9c0,0,0.1-0.1,0.1-0.1c-4.5-9.8-14.4-18.3-28.3-20.3
																		c0.4-0.9,0.6-1.8,0.6-2.9c0-3.9-3.1-7-7-7s-7,3.1-7,7c0,1,0.2,2,0.6,2.9c-19.4,2.9-31,18.2-31,32.3c0,35.3-12.6,51.7-23.4,60.8
																		c0,5.1,4.2,9.4,9.4,9.4h32.8c0,10.3,8.4,18.7,18.7,18.7c10.3,0,18.7-8.4,18.7-18.7h13.1c-0.2-0.7-0.4-1.6-0.4-2.7V108.7z
																		 M81.5,137.7c-7.1,0-12.9-5.8-12.9-12.9c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2c0,5.8,4.8,10.5,10.5,10.5c0.7,0,1.2,0.5,1.2,1.2
																		S82.2,137.7,81.5,137.7z"/>
																	<path class="st0" d="M168.7,77.2c-0.2-0.2-0.5-0.4-0.8-0.5c-0.3-0.1-0.6-0.2-0.9-0.2h-26.5V49.9c0-1.3-1.1-2.4-2.4-2.4h-13.4h-1
																		c-0.3,0-0.6,0.1-0.9,0.2c-0.1,0.1-0.3,0.2-0.4,0.2c-0.3,0.2-0.5,0.4-0.7,0.6c-0.1,0.1-0.2,0.3-0.2,0.4c-0.1,0.3-0.2,0.6-0.2,0.9
																		v0.1c0-0.3,0.1-0.6,0.2-0.9c-0.1,0.3-0.2,0.6-0.2,0.9v26.4h-0.4H94.5c-0.2,0-0.3,0-0.5,0.1c-0.1,0-0.3,0.1-0.4,0.1
																		c-0.3,0.1-0.5,0.2-0.7,0.4c-0.2,0.2-0.4,0.4-0.5,0.6c-0.2,0.4-0.3,0.8-0.3,1.2v14.5c0,0.4,0.1,0.8,0.3,1.2
																		c0.1,0.2,0.3,0.4,0.5,0.6c0.2,0.2,0.5,0.3,0.7,0.5c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0.1,0.5,0.1H121v13v13.5
																		c0,0.3,0.1,0.6,0.2,0.9c0.1,0.2,0.2,0.3,0.2,0.4c0.3,0.4,0.6,0.7,1.1,0.9c0.3,0.1,0.6,0.2,0.9,0.2h9.6h4.9c0.5,0,0.9-0.2,1.3-0.4
																		c0.1-0.1,0.2-0.2,0.4-0.3c0.3-0.3,0.6-0.7,0.7-1.2c0-0.2,0-0.3,0-0.5V121v-7.6v-5.8v0V97v-1.1H167c0.3,0,0.6-0.1,0.9-0.2
																		c0.3-0.1,0.5-0.3,0.8-0.5c0.1-0.1,0.2-0.2,0.2-0.2c0.1-0.1,0.1-0.2,0.2-0.2c0.1-0.1,0.1-0.2,0.2-0.3c0-0.1,0.1-0.2,0.2-0.4
																		c0-0.2,0-0.3,0-0.5V78.9c-0.1-0.3-0.1-0.6-0.2-0.9C169.1,77.7,168.9,77.5,168.7,77.2z M167,76.6c0.3,0,0.6,0,0.9,0.2
																		C167.6,76.7,167.3,76.6,167,76.6z M168.6,95.2c0.2-0.1,0.3-0.3,0.4-0.5C168.9,94.9,168.8,95.1,168.6,95.2z M168.6,77.3
																		c0.3,0.2,0.4,0.4,0.5,0.8C169,77.8,168.8,77.5,168.6,77.3z"/>
																	<path d="M167.9,76.8c-0.3-0.2-0.6-0.2-0.9-0.2C167.3,76.6,167.6,76.7,167.9,76.8z"/>
																	<path d="M168.6,77.3c0.2,0.2,0.4,0.5,0.5,0.8C169,77.7,168.9,77.5,168.6,77.3z"/>
																</g>
															</g>
														</svg>
												</button> 	
												<!-- <form method="post" action="/membership/sandbox4/alert">
													 <button type="submit" name="alert" class="addAlertButton">
														<svg class="addAlertSVG" version="1.1" id="Isolation_Mode" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 185 153.7" style="enable-background:new 0 0 185 153.7;" xml:space="preserve">
															<style type="text/css">
																.st0{fill:none;}
															</style>
															<g>
																<path class="st0" d="M81.5,135.4c-5.8,0-10.5-4.8-10.5-10.5c0-0.7-0.5-1.2-1.2-1.2s-1.2,0.5-1.2,1.2c0,7.1,5.8,12.9,12.9,12.9
																	c0.7,0,1.2-0.5,1.2-1.2C82.7,135.9,82.2,135.4,81.5,135.4z"/>
																<g>
																	<path class="st0" d="M140.3,122.7c-0.1,0.5-0.3,0.9-0.7,1.2C139.9,123.6,140.2,123.1,140.3,122.7z"/>
																	<path class="st0" d="M121,122.2c0,0.3,0.1,0.6,0.2,0.9c0.1,0.1,0.2,0.3,0.2,0.4c-0.1-0.1-0.2-0.3-0.2-0.4
																		C121.1,122.8,121,122.5,121,122.2z"/>
																	<path class="st0" d="M133,124.6h-9.6c-0.3,0-0.6-0.1-0.9-0.2c0.3,0.1,0.6,0.2,0.9,0.2L133,124.6l4.9,0c0.5,0,0.9-0.2,1.3-0.4
																		c-0.4,0.3-0.8,0.4-1.3,0.4H133z"/>
																	<path class="st0" d="M168.7,77.2c0.2,0.3,0.4,0.5,0.5,0.8C169.1,77.7,168.9,77.5,168.7,77.2z"/>
																	<path class="st0" d="M93.6,95.5c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0.1,0.5,0.1c-0.2,0-0.3-0.1-0.5-0.1
																		C93.9,95.6,93.7,95.6,93.6,95.5z"/>
																	<path class="st0" d="M168.9,94.9c0.1-0.1,0.1-0.2,0.2-0.2c0-0.1,0.1-0.2,0.1-0.3c-0.1,0.1-0.1,0.2-0.2,0.3
																		C169,94.8,169,94.9,168.9,94.9z"/>
																	<path class="dingPart" d="M81.5,135.3c-5.7,0-10.5-4.7-10.5-10.5c0-0.7-0.5-1.2-1.2-1.2s-1.2,0.5-1.2,1.2c0,7.1,5.8,12.9,12.9,12.9
																		c0.7,0,1.2-0.5,1.2-1.2S82.2,135.3,81.5,135.3z"/>
																	<path class="st0" d="M113,108.7v-5H94.5c-0.7,0-1.3-0.1-1.8-0.2c-1.7-0.2-3-0.9-3.9-1.6c-0.4-0.2-1-0.7-1.6-1.3c-0.4-0.4-1.3-1.3-2-2.7
																		c-0.8-1.5-1.1-3.1-1.1-4.8V78.7c0-1.7,0.4-3.3,1.1-4.8c0.7-1.4,1.6-2.3,2-2.7c1.1-1.1,2.3-1.8,3.8-2.3l1.2-0.4h0.2
																		c0.8-0.2,1.5-0.2,2-0.2h18.8V49.8c0-1.3,0.3-2.3,0.5-3c0.4-1.5,1.2-2.8,2.3-3.9c0,0,0.1-0.1,0.1-0.1c-4.5-9.8-14.4-18.3-28.3-20.3
																		c0.4-0.9,0.6-1.8,0.6-2.9c0-3.9-3.1-7-7-7s-7,3.1-7,7c0,1,0.2,2,0.6,2.9c-19.4,2.9-31,18.2-31,32.3c0,35.3-12.6,51.7-23.4,60.8
																		c0,5.1,4.2,9.4,9.4,9.4h32.8c0,10.3,8.4,18.7,18.7,18.7c10.3,0,18.7-8.4,18.7-18.7h13.1c-0.2-0.7-0.4-1.6-0.4-2.7V108.7z
																		 M81.5,137.7c-7.1,0-12.9-5.8-12.9-12.9c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2c0,5.8,4.8,10.5,10.5,10.5c0.7,0,1.2,0.5,1.2,1.2
																		S82.2,137.7,81.5,137.7z"/>
																	<path class="st0" d="M168.7,77.2c-0.2-0.2-0.5-0.4-0.8-0.5c-0.3-0.1-0.6-0.2-0.9-0.2h-26.5V49.9c0-1.3-1.1-2.4-2.4-2.4h-13.4h-1
																		c-0.3,0-0.6,0.1-0.9,0.2c-0.1,0.1-0.3,0.2-0.4,0.2c-0.3,0.2-0.5,0.4-0.7,0.6c-0.1,0.1-0.2,0.3-0.2,0.4c-0.1,0.3-0.2,0.6-0.2,0.9
																		v0.1c0-0.3,0.1-0.6,0.2-0.9c-0.1,0.3-0.2,0.6-0.2,0.9v26.4h-0.4H94.5c-0.2,0-0.3,0-0.5,0.1c-0.1,0-0.3,0.1-0.4,0.1
																		c-0.3,0.1-0.5,0.2-0.7,0.4c-0.2,0.2-0.4,0.4-0.5,0.6c-0.2,0.4-0.3,0.8-0.3,1.2v14.5c0,0.4,0.1,0.8,0.3,1.2
																		c0.1,0.2,0.3,0.4,0.5,0.6c0.2,0.2,0.5,0.3,0.7,0.5c0.1,0.1,0.3,0.1,0.4,0.1c0.2,0,0.3,0.1,0.5,0.1H121v13v13.5
																		c0,0.3,0.1,0.6,0.2,0.9c0.1,0.2,0.2,0.3,0.2,0.4c0.3,0.4,0.6,0.7,1.1,0.9c0.3,0.1,0.6,0.2,0.9,0.2h9.6h4.9c0.5,0,0.9-0.2,1.3-0.4
																		c0.1-0.1,0.2-0.2,0.4-0.3c0.3-0.3,0.6-0.7,0.7-1.2c0-0.2,0-0.3,0-0.5V121v-7.6v-5.8v0V97v-1.1H167c0.3,0,0.6-0.1,0.9-0.2
																		c0.3-0.1,0.5-0.3,0.8-0.5c0.1-0.1,0.2-0.2,0.2-0.2c0.1-0.1,0.1-0.2,0.2-0.2c0.1-0.1,0.1-0.2,0.2-0.3c0-0.1,0.1-0.2,0.2-0.4
																		c0-0.2,0-0.3,0-0.5V78.9c-0.1-0.3-0.1-0.6-0.2-0.9C169.1,77.7,168.9,77.5,168.7,77.2z M167,76.6c0.3,0,0.6,0,0.9,0.2
																		C167.6,76.7,167.3,76.6,167,76.6z M168.6,95.2c0.2-0.1,0.3-0.3,0.4-0.5C168.9,94.9,168.8,95.1,168.6,95.2z M168.6,77.3
																		c0.3,0.2,0.4,0.4,0.5,0.8C169,77.8,168.8,77.5,168.6,77.3z"/>
																	<path d="M167.9,76.8c-0.3-0.2-0.6-0.2-0.9-0.2C167.3,76.6,167.6,76.7,167.9,76.8z"/>
																	<path d="M168.6,77.3c0.2,0.2,0.4,0.5,0.5,0.8C169,77.7,168.9,77.5,168.6,77.3z"/>
																</g>
															</g>
														</svg>
													</button> 
												</form> -->
										<? } else { ?>	
											<i class="fa fa-bell" aria-hidden="true"></i>
										<? } ?>
									</span>			
								<? } ?>		
								
								 <? // echo $_SESSION['lastime'].'****'.$mastermessagecaptureexact; ?>	

										<? if ($MEM > 1)  { ?>
											<span class="navIcon" <? if ((is_page(24476)) or (($_SESSION['master']) && is_page(array(30072,25184,30460,30674,25554)))) echo 'style="display:none"'; ?>><a href="/membership/sandbox4/add-employee" class=""><i class="fa fa-user-plus" aria-hidden="true"></i></a></span>
											<? } ?>
					

											<div class="paddingvl"></div>
											<div class="vertical-line"></div>		
											<div class="paddingvl"></div>
											<?
											echo "<div  style='display:inline; position: relative;'><img  class='circle avatar' id='headerAvatarImage' height='40px' width='40px' src='/membership/sandbox4/showfile.php?num={$_SESSION['numemp']}' onerror='this.src=\"{$default}\"'/>";
											?>
												<div class="avatarDropdown for_desktop z-depth-1">
													<ul>
													   <? if ($_SESSION['master']) { ?> 
														
														<? } else { ?> 
															
															<li><a href="/membership/sandbox4/edit-info-4">My Profile</a></li>
														    <? if (($_SESSION['numemp'] > 821538) && ($_SESSION['lead'] == 2) && ($MEM == 4) && (!(strstr($myusername, '@cedrsolutions.com')))) echo '<li><a href="/membership/sandbox4/141874682136482364836486238472374234933.php" target="_blank">My Billing</a></li>'; ?>										
														<li  <? if (is_page(24476)) echo 'style="display:none"'; ?>><a href="#">My Billing</a></li>														
														<li  <? if (is_page(24476)) echo 'style="display:none"'; ?>><a href="#" class="feedback_btn">Give Feedback</a></li>
														<? } ?>

														<li><a href="/membership/sandbox4/logout.php">Sign Out</a></li>
													</ul>
												</div>
												</div>
												
												<span class="caption" style="cursor: default; margin-left: 15px; font-size: 14px; font-family: 'Roboto', Regular;"	><? echo $_SESSION['adminofficename']; ?></span>
												
												
												
							</div> 
							<? } ?>
						</div>	
					</div>
			</nav>
			<!-- side_menu -->
			<div class="subNav container">
				<h3 class="for_mobile"><img class="circle avatar" height="40px" width="40px" src="https://www.cedrsolutions.com/membership/sandbox4/wp-content/themes/Meraki/images/default.png"> Man with Golden Tooth DDS</h3>	
				<ul class="mobile_menu_subnav">
					<li <? if (($MEM > 1) or is_page(20059) or is_page(20062)) echo 'style="display:none"'; ?>
            <? if(!is_page(34973)) echo 'class="active"' ?> ><a href="/membership/sandbox4/empfolder">Home</a></li>

						<li <? if (($MEM > 1) or is_page(20059) or is_page(20062)) echo 'style="display:none !important"'; ?>
						 class="mobile_menu view_post_modal">
							<a title="View Post" href="javascript:;">View Post</a>
							<span class="post_counter">1</span>
						</li>

						
						 <li <? if (($MEM > 1) or is_page(20059) or is_page(20062)) echo 'style="display:none !important"'; ?> 
            class="mobile_menu <? if(is_page(34973)) echo 'active' ?>"><a href="/membership/sandbox4/edit-info-4">My Profile</a></li>


						<li <? if (($MEM > 1) or is_page(20059) or is_page(20062)) echo 'style="display:none !important"'; ?> 
						class="mobile_menu"><a href="/membership/sandbox4/logout.php">Sign Out</a></li>
						
						

					<? if ($MEM > 1) { ?>
				
						<li <? if (is_page(24476)) echo 'style="display:none"'; ?>
							<? if (is_page(24185) or is_page(26103) or is_page(30072) or is_page(35048)) echo 'class="active";' ?>>
							
							<? if ((($_SESSION['master']) && is_page(array(30072,25184,30460,30674,25554)))) { ?>
							
<form style="display: inline;" id="masterlogin" name="masterlogin" method="post" action="/membership/sandbox4/signin.php">
	<div style="display:none">
	 <input type="hidden" id="myusername" name="myusername" value="<? echo $myusername; ?>">
	 <input type="hidden" id="mypassword" name="mypassword" value="<? echo md5($userpswd); ?>">
	 <input type="hidden" id="comingfrom" name="comingfrom" value="offices" >
	</div> 
</form>	


							
							<a style="cursor: pointer;" onclick="document.getElementById('masterlogin').submit();" title="Where you find all your offices">Offices</a> <? } else { ?> <a href="/membership/sandbox4/efolders" title="Where all your employees are stored">Employee Folders</a> <? } ?>
							
							
							</li>
							
							<? if ((($_SESSION['master']) && is_page(array(30072,25184,30460,30674,25554)))) { ?>
							
							<li <? if (is_page(24476)) echo 'style="display:none"'; ?>
							<?   if (is_page(30460)) echo 'class="active";' ?>>
							
<form style="display: inline;" id="masteruserslogin" name="masterlogin" method="post" action="/membership/sandbox4/signin.php">
	<div style="display:none">
	 <input type="hidden" id="myusername" name="myusername" value="<? echo $myusername; ?>">
	 <input type="hidden" id="mypassword" name="mypassword" value="<? echo md5($userpswd); ?>">
	 <input type="hidden" id="setmaster" name="setmaster" value=true>
	 <input type="hidden" id="comingfrom" name="comingfrom" value="master-users" > 
	</div> 
</form>	


<a style="cursor: pointer;" onclick="document.getElementById('masteruserslogin').submit();" title="Where you grant & revoke Master rights">Master Users</a> </li><? } ?>

<? if ((($_SESSION['master']) && is_page(array(30072,25184,30460,30674,25554)))) { ?>
							
							<li <? if (is_page(24476) or $_SESSION['master']) echo 'style="display:none"'; ?>
							<?   if (is_page(30674)) echo 'class="active";' ?>>


<form style="display: inline;" id="mastermasterfolder" name="mastermasterfolder" method="post" action="/membership/sandbox4/signin.php">
	<div style="display:none">
	 <input type="hidden" id="myusername" name="myusername" value="<? echo $myusername; ?>">
	 <input type="hidden" id="mypassword" name="mypassword" value="<? echo md5($userpswd); ?>">
	 <input type="hidden" id="comingfrom" name="comingfrom" value="master-master-folder" >
	</div> 
</form>	


<a style="cursor: pointer;" onclick="document.getElementById('mastermasterfolder').submit();" title="Where all your Master Master Files are stored">Master Master Folder</a> </li><? } else
	{ ?> 
							<li <? if (is_page(24476)) echo 'style="display:none"'; ?>
							<? if (is_page(23885) or is_page(23365)) echo 'class="active";' ?>>

							<a title="Where all your files are stored" href="/membership/sandbox4/mfc">Master Folder</a>
	<? } ?></li>
							<!--- Bulletin Board  menu-->
					<!-- <li class="mobile_menu">
							<a title="Bulletin Board" href="javascript:;">Bulletin Board</a>
							<span class="post_counter post_ct">1</span>
						</li> -->
<!--- Bulletin Board  menu-->	
							
						<li class="mobile_menu view_post_modal ">
							<a title="View Post" href="javascript:;">View Post</a>
							<span class="post_counter">1</span>
						</li>



						<li class="mobile_menu <? if (is_page(25554)) echo 'active' ?>"><a title="Add Bulletin" class="add_post_btn" href="#">Add Post </a></li>

						<li class="mobile_menu <? if (is_page(35048)) echo 'active' ?>" ><a title="Add Employee" href="/membership/sandbox4/add-employee">Add Employee</a></li>	
						
						<!-- <li <? //if (is_page(25184) or is_page(31428)) echo 'class="active";' ?>><a title="Contact us" href="/membership/sandbox4/contact-us">Contact Us</a></li> -->
						<li <? if (is_page(25184) or is_page(31428)) echo 'class="active";' ?>><a class="contact_btn" title="Contact us" href="#">Contact Us</a></li>

						<li class="mobile_menu <? if ($num == $_SESSION['numemp']) echo 'active' ?>"> <a  href="/membership/sandbox4/edit-info-4">My Profile</a></li>
						<li class="mobile_menu"><a href="#">My Billing</a></li>
						<li class="mobile_menu <? if (is_page(25436)) echo 'active' ?>"><a class="feedback_btn" href="#">Give Feedback</a></li>
						
						<!-- /membership/sandbox4/feedback/ -->
						<li class="mobile_menu"><a href="/membership/sandbox4/logout.php">Sign Out</a></li>
							
						<? } ?>
				</ul>
			</div>  
			<!-- /side_menu -->

			<!-- mobile bulletin container -->
			<span class="alertsDropdown for_mobile z-depth-1 <? echo $toggle; ?>">
			<a href="#!" class="close modal-close"><i class="fa fa-close"></i></a>
									
										<ul>
											<li>
											   <? if (($mastermessage != '')  && !($_SESSION['master'])){ ?>
											 	<div><span class="alertBadge" <? if (($mm == 0) or ($_SESSION['been'] == 1)) {echo 'style=""';} ?>>NEW</span><span class="timestamp"> from Master</span></div>
												<strong><? echo $mastermessage; ?></strong>
												<div class="timestamp"><? echo $mastermessagecapture; ?></div>
												<? } ?>
												<? if ($MEM > 1) { ?>
													<div class="alertEdit">
												<!-- 	<form method="post" action="#">
														
													<? 
													  $monummod //= base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), $monum, MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))));
													//  $myusernamemod = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), $myusername, MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))));
													//  $coditmod = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($_SESSION['tedoen']), $_SESSION['adminofficename'], MCRYPT_MODE_CBC, md5(md5($_SESSION['tedoen']))));
													?>	
														
													<div style="display:none">
													 <input type="hidden" id="monum" name="monum" value="<? //echo $monummod; ?>">
													 <input type="hidden" id="coditmod" name="coditmod" value="<? //echo $coditmod; ?>">
													 <input type="hidden" id="myusernamemod" name="myusernamemod" value="<? //echo $myusernamemod ?>">
													 <input type="hidden" id="setmaster" name="setmaster" value=<? //echo $_SESSION['master']; ?>>
													</div> 
														
														<button type="submit" name="alert" class="add_post_btn" style="background: transparent; border: none !important;">
															<i class="fa fa-edit" aria-hidden="true"></i>
														</button>
													</form> -->

													<button type="submit" name="alert" class="add_post_btn" style="background: transparent; border: none !important;">
															<i class="fa fa-edit" aria-hidden="true"></i>
														</button>
													</div>
												<? } ?>
												 <? if ($message != '') { ?>
												<div><span class="alertBadge" <? if (($m == 0) or ($_SESSION['been'] == 1)) {echo 'style=""'; } ?>>NEW</span><span class="timestamp"> from <? if ($_SESSION['master']) echo "Master"; else echo $_SESSION['adminofficename']; ?></span></div>
												<strong><? echo $message; ?></strong>
												<div class="timestamp"><? echo $messagecapture; ?></div>
												<? } ?>
											</li>
										</ul>
									</span>

			<div class="tintbg"></div>
		</header>
		<!-- top_buttons -->
		<div class="top_buttons" <? if (is_page(31774) or is_page(31999) or is_page(32007) or is_page(32012) or is_page(32023) or is_page(32027) or is_page(32045) or is_page(32062) or is_page(32067) or is_page(32071) or is_page(32075)) echo 'style="display: none !important"'; ?>>
		   <a class="waves-effect waves-light" href="#" id="btn1">PTO & Time</a>
		   <a class="waves-effect waves-light" href="#" id="btn2">HIPAA</a>
		   <a class="waves-effect waves-light" href="#" id="btn3">CEDR Mem</a>
		   <a class="waves-effect waves-light" href="#" id="btn4">Master Access</a>
		</div>
		<!-- /top_buttons -->

		<!-- base-camp header -->
		<? if (is_page(31774) or is_page(31999) or is_page(32007) or is_page(32012) or is_page(32019) or is_page(32023) or is_page(32027) or is_page(32045) or is_page(32062) or is_page(32067) or is_page(32071) or is_page(32075) or is_page(36303)) { ?>			
			<header class="base_camp_header">
				<div class="container">
					<div class="row">
						<div class="col m4">
							<a href="https://www.cedrsolutions.com/membership/sandbox4/base-camp-dashboard/">
								<img src='https://www.cedrsolutions.com/membership/sandbox4/base_camp/images/Backstage_white.png' style='height: 100%;'/>
							</a>
						</div>	
						<div class="col m8 right-align right-icons">
							<span href="#" class='active bell-icon'>
								<span class='badge-num'>1</span>
								<i class="fa fa-bell" aria-hidden="true"></i>
								<span class="alertsDropdown-backstage alertDrop for_desktop for_mobile z-depth-1 bulltin-block">
                                    <div class="add-post ">
                                        <a class="modal-trigger" id="add_postModal_btn" href="#add_postModal">Add Post</a>
                                    </div>
                                    <ul class="notify-list ">
                                        <li class="list">
                                            <div class="alertEdit notify-alert">
                                                <form method="post"
                                                    action="https://www.cedrsolutions.com/membership/alert">
                                                    <div class="actionsButton">
														<i class="dot1 fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        <ul class="noteList z-depth-2 active notification_list"
                                                            style="display: none;">
                                                            <li class="n-list pin_top">

                                                                <span>
                                                                    <img class="" src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.svg"
                                                                        style="width: 18px; top: 4px; position: relative;"><span class="pin_left">Pin to Top</span> 

                                                                </span>
                                                                <input type="checkbox" />

                                                            </li>
                                                            <li class="n-list editPost_notification add_post_btn"><i
                                                                    class="fa fa-edit center modal-trigger"></i><span class="pin_left">Edit</span>
                                                            </li>
                                         <li class="n-list addPost_delete"><i class="fa fa-trash"></i>
                                            <span class="pin_left">Delete</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>

                                            <div>
                                                <span class="pin_span"> <img class="pin" src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.png"
                                                        style="width: 23px;"></span>
                                                <span class="timeheading new_heading"><span class="alertBadge">NEW</span> Company Zoom First List..</span>
                                            </div>
                                            <div class="timestamp"><span> Phillip Pitteroff</span></div>
                                            <div class="list_content"><strong> <span class="bold_text">This is where a post goes on the bulletin board. New posts are bold and 3 lines displayed. </span></strong></div>
											<div class="read-more"> READ MORE &gt;</div>
                                            <div class="timestamp1">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span
                                                    class="dys"><input class="dysVal" Ispin="0" value="1" type="hidden"/>&nbsp;1 day ago</span>
                                            </div>
                                        </li> 
                                        <li class="list">
                                            <div class="alertEdit notify-alert">
                                                <form method="post"
                                                    action="https://www.cedrsolutions.com/membership/alert">
                                                    <div class="actionsButton">
														<i class="dot1 fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        <ul class="noteList z-depth-2 active notification_list"
                                                            style="display: none;">
                                                            <li class="n-list pin_top">

                                                                <span>
                                                                    <img class="" src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.svg"
                                                                        style="width: 18px; top: 5px; position: relative;"><span class="pin_left">Pin to Top</span> 

                                                                </span>
                                                                <input type="checkbox" />

                                                            </li>
                                                            <li class="n-list editPost_notification add_post_btn"><i
                                                                    class="fa fa-edit center modal-trigger"></i><span class="pin_left">Edit</span>
                                                            </li>
                                         <li class="n-list addPost_delete"><i class="fa fa-trash"></i>
                                            <span class="pin_left">Delete</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                            <div>
                                                <span class="pin_span"> <img class="pin" src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.png"
                                                        style="width: 23px;"></span>
                                                <span class="timeheading">This team is awesome!</span>
                                            </div>
                                            <div class="timestamp"><span> Ronald Gallo</span></div>


                                            <div class="list_content">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua....</div>
                                            <div class="read-more"> READ MORE &gt;</div>
                                            <div class="timestamp1">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span
                                                    class="dys"><input class="dysVal"  Ispin="0" value="3" type="hidden"/>&nbsp;3 days ago</span>
                                            </div>
                                        </li>
                                        <li class="list">
                                            <div class="alertEdit notify-alert">
                                                <form method="post"
                                                    action="https://www.cedrsolutions.com/membership/alert">
                                                    <div class="actionsButton">
													<i class="dot1 fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        <ul class="noteList z-depth-2 active notification_list"
                                                            style="display: none;">
                                                            <li class="n-list pin_top">

                                                                <span>
                                                                    <img class="" src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.svg"
                                                                        style="width: 18px; top: 5px; position: relative;"><span class="pin_left">Pin to Top</span> 

                                                                </span>
                                                                <input type="checkbox" />

                                                            </li>
                                                            <li class="n-list editPost_notification add_post_btn"><i
                                                                    class="fa fa-edit center modal-trigger"></i><span class="pin_left">Edit</span>
                                                            </li>
                                         <li class="n-list addPost_delete"><i class="fa fa-trash"></i>
                                            <span class="pin_left">Delete</span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </form>
                                            </div>
                                            <div>
                                                <span class="pin_span"> <img class="pin" src="https://www.cedrsolutions.com/membership/sandbox4/static_bulletin/pin.png"
                                                        style="width: 23px;"></span>
                                                <span class="timeheading">REMINDER: All-hands meeeting show ...</span>
                                            </div>
                                            <div class="timestamp"><span> Maria Carraleno</span></div>
                                            <div class="list_content">This is how older posts will be displayed, not bold. It will display three lines and then...</div>
											
                                            <div class="read-more"> READ MORE &gt;</div>
                                            <div class="timestamp1">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i><span
                                                    class="dys"><input class="dysVal"  Ispin="0" value="10" type="hidden"/>&nbsp;10 day ago</span>
                                            </div>
                                        </li>
                                        <li class="order20">
                                            <div class="noti-archive"><span>View Archive -</span><span
                                                    style="color: #0064AD;font-weight: 700;"> COMING SOON!</span></div>
                                        </li>
                                    </ul>
                                </span>
							</span>
							<span href="#">
								<i class="fa fa-user-plus"></i>
							</span>
							<span href="#" class='icon-header'>
								<img src='https://www.cedrsolutions.com/membership/sandbox4/base_camp/images/Referafriend-white.svg' />
							</span>
							
							<i class="fas fa-bars for_mobile" id="base_camp_fa_bars"></i>
							<span class="user">
								<img src="https://www.cedrsolutions.com/membership/sandbox4/base_camp/images/user.png"> Grinn & Barrett Dental
								<!-- user-menu -->
								<div class="user-menu">
									<ul>
										<li><a href="#">My Profile</a></li>
										<li><a href="#">My Account</a></li>
										<!-- <li><a href="#">Settings</a></li> -->
										<li><a href="#">Parent/Child</a></li>
										<!-- <li><a href="#">Give Feedback</a></li> -->
										<li><a href="#">Contact Us</a></li>
										<li><a href="#">Sign Out</a></li>
									</ul>
								</div>
								<!-- /user-menu -->
							</span>
						</div>	
						<!-- mobile-menu -->
						<div class="mobile-menu-cover">							
							<div class="mobile-menu">
								<span class="user">
									<img src="https://www.cedrsolutions.com/membership/sandbox4/base_camp/images/mobile-user.png"> 
									<b>Grinn & Barrett Dental</b>
								</span>
								<ul>
									<!-- <li <? //if (is_page(30094)) echo 'class="active"'?>><a href="#">Bulletin Board</a></li> -->
									<li><a href="#">Bulletin Board</a></li>
									<li><a href="#">Add Employee</a></li>
									<li><a href="#">My Profile</a></li>
									<li><a href="#">My Account</a></li>
									<!-- <li><a href="#">Settings</a></li> -->
									<li><a href="#">Parent/Child</a></li>
									<!-- <li><a href="#">Give Feedback</a></li> -->
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Sign Out</a></li>
								</ul>
							</div>
						</div>
						<!-- mobile-menu -->
					</div>
				</div>
				<!-- feedback-modals -->
				<div class="feedback-modals">
					<div class="row">
					    <form name="feedback" method="#" action="#" class="feedback-form" id="feedback-form">
		                    <div class="infoSection col s12">
		                    	<h2><i class="fas fa-comment"></i>Feedback</h2>
		                        <span>We appreciate your feedback on how we can make<br>Base Camp better.</span>
		                    </div>
		                    <div class="input-field col s6">
		                        <label for="fullname" class="active">Name</label>
		                        <input disabled="" required="" type="text" id="fullname" name="fullname" value="Owner Of Office">
		                    </div>
		                    <div class="input-field col s6">
		                        <label for="email" class="active">Email</label>
		                        <input disabled="" required="" type="email" id="email" name="email" value="medpracticeinc0@gmail.com">
		                    </div>
		                    <div class="input-field col s12">
		                        <label for="subject">Subject</label>
		                        <input required="" type="text" id="subject" name="subject" value required>
		                    </div>
		                    <div class="input-field col s12">
		                        <label for="message">Message</label>
		                        <textarea required="" name="message" id="message" cols="20" rows="20" class="materialize-textarea" required></textarea>
		                    </div> 
		                    <div class="controlWrapper clearfix">
		                        <button class="orangeButton" onclick= "event.stopPropagation()">Submit</button>
		                        <span class="or">or</span>
		                        <a href="#" type="submit" name="buttonchoice" class="cancelButton cedr-darkgray-font">Cancel</a>
		                    </div>
		                 </form>  
	                </div>			    
				</div>
				<!-- /feedback-modals -->
				<!-- contact-modals -->
				<div class="contact-modals">
					<div class="row">
					    <form name="feedback" method="" action="" class="feedback-form">
		                    <div class="infoSection col s12">
		                    	<h2>What would you like to contact us about?</h2>
		                    	<h3>We want to provide you with the best assistance possible.</h3>
		                    </div>
		                    <a href="https://www.cedrsolutions.com/membership/sandbox4/base-camp-my-hr-requests" class="hr-link">HR Issue</a>
		                    <a href="#" class="software-link">Our Software</a>
		                    <p>
		                        <span class="or">or</span>
		                        <span class="cancel">Cancel</span>
	                        </p>
		                 </form>  
	                </div>			    
				</div>
				<!-- /contact-modals -->
				<!-- contact-modals-main -->
				<div class="contact-modals-main">
					<div class="row">
					    <form name="feedback" method="#" action="#" class="feedback-form" id="contact-main-form">
		                    <div class="infoSection col s12">
		                    	<h2><i class="fas fa-envelope"></i>Contact Us</h2>
		                        <span>If you have a question for us, please use the form below.</span>
		                    </div>
		                    <div class="input-field col s6">
		                        <label for="fullname" class="active">Name</label>
		                        <input disabled="" required="" type="text" id="fullname" name="fullname" value="Owner Of Office">
		                    </div>
		                    <div class="input-field col s6">
		                        <label for="email" class="active">Email</label>
		                        <input disabled="" required="" type="email" id="email" name="email" value="medpracticeinc0@gmail.com">
		                    </div>
		                    <div class="input-field col s12">
		                        <label for="subject">Subject</label>
		                        <input required="" type="text" id="subject" name="subject" value="" autocomplete="off" required>
		                    </div>
		                    <div class="input-field col s12">
		                        <label for="message">Message</label>
		                        <textarea required="" name="message" id="message" cols="20" rows="20" class="materialize-textarea" required></textarea>
		                    </div>
		                    <div class="controlWrapper clearfix">
		                        <button class="orangeButton" onclick= "event.stopPropagation()">Submit</button>
		                        <span class="or">or</span>
		                        <a href="#" type="submit" name="buttonchoice" class="cancelButton cedr-darkgray-font">Cancel</a>
		                    </div>
		                    <div class="contact-info">
		                    	<div class="col s5">
		                    		<h4>Prefer the Phone?</h4>
		                    		<h5>(866) 414-6056</h5>
		                    	</div>
		                    	<div class="col s7">
		                    		<b>Hours of Operation:</b>
		                    		<p>M-Th: 8:30am–4:30pm • F: 8:30am–3:30pm</p>
		                    		<i>We are on Arizona time, which does not change for daylight-saving time.</i>
		                    	</div>
		                    </div>
		                 </form>  
	                </div>			    
				</div>
				<!-- /contact-modals-main -->
				<!-- thanku-modals -->
				<div class="thanku-modals">
					<h2>Thank You!</h2>
					<p></p>
					 <a href="#" type="submit" name="buttonchoice" class="cancelButton cedr-darkgray-font">Done</a>
				</div>
				<!-- /thanku-modals -->
				<!-- tintbg -->
				<div class="tintbg"></div>
				<div class="action-transparent-bg" style='display: none'></div>
				<!-- /tintbg -->
				<!-- user-menu-bg -->
				<div class="user-menu-bg"></div>
				<!-- /user-menu-bg -->
			</header>
		<? } ?>		
		<!-- /base-camp header -->
		
		
<? if (!is_page(array(24476,214,34973,25195,28928))) { ?>		
<div id="modaltcipend" class="modal">
    <div class="modal-content" >
        <h4>Activate Time & PTO Tracking!</h4>
            <p class="p1 cedr-darkgray-font center">Schedule a demo with our Member Services team to activate your Time & PTO Tracking application.</p>
            <button onclick="window.open('https://calendly.com/member-services-team/pto-tracking?back=1&month=2019-12','_blank');" style="min-width: 100px;" class="waves-effect orangeButton waves-light modal-close">Schedule</button>            
            <div class="moveCancel">
                <span class="or">or</span>
                <a  href="#!" class="modal-close">Cancel</a>
            </div>
    </div>
</div> 	
<? } ?>

<script>
 function topbuttons(btnList) {
    const btnName = ['PTO & Time', 'HIPAA', 'CEDR Mem', 'Master Access'];
    const btnColor = ['green', 'bright-blue', 'dark-blue', 'light-blue'];
    var buttons_row = $('.top_buttons');
    buttons_row.empty();
    for(let i=0; i < btnList.length; i++) {
        let j = btnList[i];
        $(buttons_row).append(`<a class="waves-effect waves-light ${btnColor[j - 1]}" href="#" id="btn${i + 1}">${btnName[j - 1]}</a>`) 
    }
}
topbuttons([1,2,3,4]);

$('.alertsDropdown.for_mobile a.close').click(function(){
    $('.tintbg').fadeOut();
    $('header .alertsDropdown.for_mobile').css('visibility','hidden');

})
$(document).ready(function(){
	$('.modal').modal();  
})
</script>
<script>
   $(document).ready(function(){

   	$(document).on('click','.actionsButton .dot1', function() {
   		const _ = this;
   		console.log(_);
		$('.actionsButton .dot1').parent('.actionsButton').find('.notification_list').hide();
   	$(_).parent('.actionsButton').find('.notification_list').toggle();
	return false
   	});


	
	
   	$('#alerts').on('click', function() {
   		$('.alertDrop ').toggleClass('show-dd');
   	});
   }); 
</script>
<!-- <script>
$('.mem.vlt header .subNav.container ul li.view_post_modal').click(function(){
    var post_length = $('header .alertsDropdown.for_mobile ul li .alertBadge, header .alertsDropdown.for_mobile ul li .timestamp, header .alertsDropdown.for_mobile ul li strong').length;

    if(post_length==0){

$('header .alertsDropdown.for_mobile ul').empty()            
$('header .alertsDropdown.for_mobile ul').append('<b>NO Data found</b>')
            $('button[name="alert"]').hide()
     }

})
</script> -->

<!--=========================================== additional modals - 9/feb/2021  ========================================-->
<!-- add-post modal -->
<div class="add_Post_Modal">
    <div id="addPost" class="modal">
     	<div class="modal-content">			  
			<?php include 'add_edit_alert.php' ?> 
		</div> 
    </div> 
    <div id="delete_cancel_btn" class="custom_modal addDelete_modal modal">
		<div class="modal-content">
			<h4>Are you sure you want to delete this post?</h4>
			<p class="p1 cedr-darkgray-font center">This action cannot be undone.</p>
			<form id="alertform" name="alertform" method="post" action="/membership/sandbox4/alert.php">
				<button name="buttonchoice" class="waves-effect orangeButton waves-light" value="Delete">Delete</button>
			</form>
			<div class="cancel_cover">
				<span class="or">or</span>
				<a  href="#" class="modal-close">Cancel</a>
			</div>
		</div>
	</div>
	<!--add cancel modal -->
	<div class="cutup_modal_cover">
		<!--delete cancel modaL-->
		<div id="add_cancel_btn" class="custom_modal modal add_cancel_btn">
			<div class="modal-content" style="padding-top: 30px;">
				<h4>Are you sure you want to cancel?</h4>
				<p class="p1 cedr-darkgray-font center"></p>
				<div class="cancelBtn center">
					<button class="waves-effect orangeButton waves-light modal-close">No</button>
					<button class="waves-effect addCancle_btn orangeButton waves-light modal-close">Yes</button>
				</div>
			</div>
		</div>
		<!--delete cancel modaL-->
	</div>  
</div> 
<!-- /add-post modal -->


<!--=================== contact us modal ===================-->
<!-- contact us modal -->
<? 
	$myusername = $_SESSION['myusername'];

	$sql = "select num, first, last from login where username = '$myusername';";
	$result=mysql_query($sql); 
	while($row = mysql_fetch_array($result))
    {
	  $first = $row['first']; 
	  $last = $row['last'];
    }

?>

<div class="contact_us_Modal">
	<!-- contact modal -->
    <div id="contactUs" class="modal contactModal">
        <div class="modal-content">
            <div class="modalHeader">
                <div class="title cedr-bluegray-font center">
                    <h4 class="ctn_heading"><i class="fa fa-envelope" aria-hidden="true"></i><span>Contact Us</span></h4>
                </div>
                <p class="p1 cedr-darkgray-font center cnt_p_text">If you have a question for us,<br/> use the form below.</p>
            </div>
            <hr>
            <form name="contactus" method="post" action="#" class="contactus-form">
                <div class="row">
                    <div class="colWrapper">
                        <div class="col m6 s12">
                            <label for="fullname" id="grayed" class="cedr-darkgray-font">Name</label>
                            <input disabled required type="text" id="fullname" name="fullname" value="<? echo $first.$last; ?>">
                        </div>
                        <div class="col m6 s12">
                            <label for="email" id="grayed" class="cedr-darkgray-font">Email</label>
                            <input disabled required type="email" id="email" name="email" value="<? echo $myusername; ?>">
                        </div>
                        <div class="clearfix"></div>                    
	                    <div class="col s12">
	                        <label>Subject*</label>
	                        <input type="text" name="hiredate" id="contact_subject" autocomplete="off" value="">
	                    </div>
	                    <div class="clearfix"></div>
	                    <div class="col s12">
	                        <label>Message*</label>
	                        <textarea required="" name="" id="contact_message" cols="20" rows="20" class="materialize-textarea"></textarea>
	                    </div>
                  	    <div class="clearfix"></div>
                    </div>
                    <div class="controlWrapper">
                        <a href="#contact_thankyou" class="orangeButton modal-close disabled-button">Submit </a><br />
                        <span class="orSpan">or</span>
                        <a href="#contactus_cancel" type="submit" name="buttonchoice" class="cancelButton addcancelPost cedr-darkgray-font">Cancel</a>
                    </div>
                </div>
            </form>
            <div class="colWrapper contactUs">
                <div class="row text-btm-center">
	                <div class="col m5 s12">
	                  <div class="bottom-text-left">
	                    <h5>Prefer the Phone? </h5>
	                    <p>(866) 414-6056</p>
	                  </div>
	                </div>
	                <div class="col m7 s12">
	                  <div class="bottom-text-right">
	                    <p><strong>Hours of Operation: </strong></p>
	                    <p class="address">M-Th: 8:30am–4:30pm <span class="c_dot">•</span><br/> F: 8:30am–3:30pm<p>
	                    	<p class="address italic">We are on Arizona time, which does not change for daylight-saving time.</p>
	                  </div>                
	                </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>  
    </div>    
    <!-- /contact modal -->
    <div class="cutup_modal_cover">
    	<!-- contact cancel modal -->
        <div id="contactus_cancel" class="custom_modal modal contactCancel">
            <div class="modal-content">
                <h4>Are you sure you want to cancel?</h4>
                <p class="p1 cedr-darkgray-font center">Your inquiry has not been submitted.</p>
                <div class="center">
                    <a class="waves-effect orangeButton waves-light modal-close">No</a>
                    <a href="#" class="waves-effect orangeButton waves-light modal-close">Yes</a>
                </div>
            </div>
        </div> 
        <!-- /contact cancel modal -->
        <!-- contact thankyou modal -->
        <div id="contact_thankyou" class="custom_modal modal thank_modal">
            <div class="modal-content">
                <h4 class="thanks-text">Thank You!</h4>
                <p class="p1 cedr-darkgray-font center">Your inquiry has been submitted.</p>
                <div class="center">
                    <a class="waves-effect orangeButton waves-light modal-close" style="width: 100px;">Done</a>                    
                </div>
            </div>
        </div>
        <!-- /contact thankyou modal -->
    </div>
</div>
<!-- /contact us modal -->
<!--=================== /contact us modal ===================-->

<!--=================== feedback modal ===================-->
<div class="feedback_Modal">
	<!-- feedback modal --> 
    <div id="feedback" class="modal feedModal">
        <div class="modal-content" style="padding-bottom: 0;">
            <div class="modalHeader">
                <div class="title cedr-bluegray-font center">
                    <h4 class="ctn_heading"><i class="fa fa-comment" aria-hidden="true"></i><span>Feedback</span></h4>
                </div>
                <p class="p1 cedr-darkgray-font center">We appreciate your feedback on how<br/> we can make HR Vault better.</p>
            </div>
            <hr>
            <form name="contactus" method="post" action="/membership/sandbox4/contact_us.php" class="contactus-form">
                <div class="row">
                    <div class="colWrapper">
                        <div class="col m6 s12">
                            <label for="fullname" id="grayed" class="cedr-darkgray-font">Name</label>
                            <input disabled required type="text" id="fullname" name="fullname" value="<? echo $first.$last; ?>">
                        </div>
                        <div class="col m6 s12">
                            <label for="email" id="grayed" class="cedr-darkgray-font">Email</label>
                            <input disabled required type="text" id="email" name="email" value="<? echo $myusername; ?>">
                        </div>
                        <div class="clearfix"></div>
                  

	                    <div class="noteCategory col s12">
	                        <label>Subject*</label>
	                        <input type="text" name="hiredate" id="feedback_subject" autocomplete="off" value="">
	                    </div>
	                    <div class="clearfix"></div>
	                    <div class="noteCategory col s12">
	                        <label>Message*</label>
	                        <textarea required="" name="message" id="feedback_message" cols="20" rows="20" class="materialize-textarea"></textarea>
	                    </div>
	                    <div class="clearfix"></div>                    
             	   </div>
              	  <div class="controlWrapper">
                        <a href="#feedback_thankyou" class="orangeButton disabled-button modal-close">Submit </a><br />
                        <span class="orSpan">or</span><a href="#feed_cancel" type="submit" name="buttonchoice" class="cancelButton addcancelPost cedr-darkgray-font ">Cancel</a>
                    </div>
				</div>
            </form>           
        </div> 
		</div> 
   
    <!-- /feedback modal -->    
    <div class="cutup_modal_cover">
    	<!-- feedback cancel modal -->
	    <div id="feed_cancel" class="custom_modal feed_cancel modal">
	        <div class="modal-content" style="padding-top: 30px;">
	            <h4>Are you sure you want to cancel?</h4>
	            <p class="p1 cedr-darkgray-font center">Your feedback has not been submitted.</p>
	            <div class="center">
	                <a class="waves-effect orangeButton waves-light modal-close">No</a>
	                <a href="#" class="waves-effect orangeButton waves-light modal-close">Yes</a>
	            </div>
	        </div>
	    </div>
	    <!-- /feedback cancel modal -->
	    <!-- feedback thankyou modal -->
	    <div id="feedback_thankyou" class="custom_modal modal feedThanks">
	        <div class="modal-content">
	            <h4 class="thanks-text">Thank You!</h4>
	            <p class="p1 cedr-darkgray-font center" style="padding-bottom: 9px;">Your feedback has been submitted.</p>
	            <div class="center thanksbtn">
	                <a class="waves-effect orangeButton waves-light modal-close" style="width: 100px;">Done</a>	                
	            </div>
	        </div>
	    </div>
	    <!-- feedback thankyou modal -->
	</div>
</div> 

























