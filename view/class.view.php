<?php
class View
{
	
	
	private function DisplayHeaderStart(){
		
		?>
		<!DOCTYPE HTML>
		<html>
			<head>
				<link rel="icon" href="http://<?=SITEURL?>" type="image/x-icon">
			<title><?=$title?></title>
		<?
	
	}
	
	
	private function DisplayHeaderEnd(){
			
		?>
			
		<script type="text/javascript">
	
			$(document).ready(function(){
					// you can put some jQuery DOM manipulation view logic inside here
			});
		</script>
		<!-- Google Analytics start -->
		<script>
			  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			  ga('create', 'UA-xxxxxxxxxxx', 'auto');
			  ga('send', 'pageview');

		</script>
		<!-- Google Analytics end -->
		</head>
		<body>
			
		<?
	
	}
	
	
	public function DisplayBodyEnd(){
		
		?>
		</body>
		</html>
		<?
		
	}
	
	
	private function DisplayMetaInfo(){
			
			?>
			
			<meta http-equiv="content-type" content="text/html; charset=utf-8" />
			<base href="<?=($_SERVER['https'] == 'on' ? 'https://'.SITEURL : 'http://'.SITEURL)?>/">
			<meta name="description" content="" />
			<meta name="keywords" content="" />
						
			
			<?
	
	}
	
	
	public function displayRegisterForm(){

	?>
		<!-- Header -->
			<div id="header">
				<div class="container">
					<!-- Logo -->
						<div id="logo">
							<h1 style="padding-top:15px;">
								<a href="http://www.somedomainname.com">
									<img src="resources/logo.png" border="0" />
								</a>
							</h1>
						</div>
					
					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="">Home</a></li>
								<?  if(!isset($_SESSION['companyid'])){  ?>
								<li class="active"><a href="http://www.somedomainname.com/register">Register</a></li>
								<?  }  ?>
								<li><a href="https://www.somedomainname.com/services">Services</a></li>
								<li>
									<span>Support</span>
									<ul>
										<li><a href="https://www.somedomainname.com/contact">Customer support</a></li>
										<li><a href="https://www.somedomainname.com/privacypolicy">Privacy</a></li>
										<li><a href="https://www.somedomainname.com/refundpolicy">Refunds</a></li>
										<li><a href="http://www.somedomainname.com/faq">FAQ</a></li>
										<li><a href="http://www.somedomainname.com/adsettings">Settings</a></li>
										<? if(isset($_SESSION['companyid']) && $_SESSION['companyid'] === '1'){ ?>
										<li><a href="http://www.somedomainname.com/managecompanies">Manage my assets</a></li>
										<? } ?>
									</ul>
								</li>
								<li><a href="https://www.somedomainname.com/saleterms">Terms of service</a></li>
								<li><a href="https://www.somedomainname.com/contact">Contact</a></li>
								<? if(!isset($_SESSION["companyid"])){ ?>
								<li><a href="https://www.somedomainname.com/companylogin">Company login</a></li>
								<? } else { ?>
								<li>
									<a id="fblogout" href="javascript:;">Logout</a>
								</li>
								<? } ?>
								<? if(isset($_SESSION["companyid"])){ ?>
								<li>
									<a href="https://www.somedomainname.com/company/<?=$_SESSION['companyid']?>">My company</a>
								</li>
								<? } ?>
							</ul>
						</nav>
				</div>
			</div>

		<!-- Main -->
			<div id="main">
				<div class="container">

					<!-- Main Content -->
						<div class="row 200%">

						<!-- Content -->
							<div id="content" class="8u">
								<section>
									<header>
										<h2>Register</h2>
									</header>
									<form method="post" action="" name="contactform" id="contactform" onSubmit="CheckSubmit();"> 
										<div class="row 50%">
											<div class="6u" style="clear:left;">
												<input type="text" name="businessemail" id="businessemail" placeholder="E-mail" value="<?=isset($_POST["businessemail"]) ?  $_POST["businessemail"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="firstname" id="firstname" placeholder="First name" value="<?=isset($_POST["firstname"]) ? $_POST["firstname"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="lastname" id="lastname" placeholder="Last name" value="<?=isset($_POST["lastname"]) ? $_POST["lastname"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="username" id="username" placeholder="Username" value="<?=isset($_POST["username"]) ? $_POST["username"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="password" name="password" id="password" placeholder="Password" value="<?=isset($_POST["password"]) ? $_POST["password"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businessname" id="businessname" placeholder="Company name" value="<?=isset($_POST["businessname"]) ? $_POST["businessname"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businessaddress" id="businessaddress" placeholder="Address" value="<?=isset($_POST["businessaddress"]) ? $_POST["businessaddress"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businesscity" id="businesscity" placeholder="City" value="<?=isset($_POST["businesscity"]) ? $_POST["businesscity"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businesszip" id="businesszip" placeholder="Zip code" value="<?=isset($_POST["businesszip"]) ? $_POST["businesszip"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businessphone" id="businessphone" placeholder="Phone" value="<?=isset($_POST["businessphone"]) ? $_POST["businessphone"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businessmobilephone" id="businessmobilephone" placeholder="Mobile phone" value="<?=isset($_POST["businessmobilephone"]) ? $_POST["businessmobilephone"] : ''?>" />
											</div>
											<div class="6u" style="clear:left;">
												<input type="text" name="businessfax" id="businessfax" placeholder="Fax" value="<?=isset($_POST["businessfax"]) ? $_POST["businessfax"] : ''?>" />
											</div>
											
											<div class="6u" style="clear:left;">
												<input type="text" name="code" id="code" placeholder="Enter Captcha code" value="<?=isset($_POST["code"]) ? $_POST["code"] : ''?>" />
											</div>
											<input type="hidden" name="newcompany" value="1" />
			
			
										   <div style="width:60%;text-align:left;height:100px;margin-left:0px;">
											  <div style="margin-left:0px;margin-top:5px;width:200px;text-align:right;">
												<img id="siimage" style="border: 1px solid #D7F0FC; margin-right: 15px" src="/components/securimage/securimage/securimage_show.php?sid=<?php echo md5(uniqid()) ?>" alt="CAPTCHA Image" align="left">
											  </div>
											  <div style="margin-left:10px;margin-top:5px;">
												<a tabindex="-1" style="border-style: none;" href="#" title="Refresh Image" onclick="document.getElementById('siimage').src = '/components/securimage/securimage/securimage_show.php?sid=' + Math.random(); this.blur(); return false"><img src="/resources/refresh.gif" alt="Reload Image" onclick="this.blur()" align="bottom" border="0"></a>
											  </div>	
										   </div>	
										</div>
										<div class="row 50%">
											<div class="12u">
												<textarea name="additionalinfo" id="message" placeholder="Optional message"><?=isset($_POST["additionalinfo"]) ? $_POST["additionalinfo"] : ''?></textarea>
											</div>
										</div>
										<div class="row 50%">
											<div class="12u">
												<a href="/contact" onClick="document.getElementById('contactform').submit();return false;" class="button big">Register</a>
												<a href="javascript:;" onClick="document.getElementById('contactform').reset();" class="button big alt">Clear form</a>
											</div>
										</div>
									</form>
								</section>
							</div>

						<!-- Sidebar -->
							<div id="sidebar" class="4u">
								<section>
									<ul class="info">
										<li>
											<h3>Address</h3>
											<p>
												Some company name<br />
												Address<br />
												Street<br />
												Country
											</p>
										</li>
										<li>
											<h3>Support Mail </h3>
											<p><a href="javascript:void();"><?=GENERALMAIL?></a></p>
										</li>
									</ul>
								</section>
							</div>
						</div>
					<!-- Footer -->
				</div>
			</div>

		 <!-- Copyright -->
			<div id="copyright">
				<a href="#top" class="bubble-top scrolly">Top</a>
				<div class="container">
					<div class="row">
						<div class="6u">
							<span>Copyright &copy; Some company name. All rights reserved.</span>
						</div>
						<div class="6u">
							<ul class="social">
								<li style="margin-left:-200px;">
									<a href="https://www.facebook.com/somecompanyname class="icon fa-facebook"></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
	<?
	}
	
	
	private function DisplayJScripts(){
		
			?>
			<script src="js/jquery.min.js"></script>
			<?	
			
	}
	
	
	private function DisplayCSS(){
		
		?>
		<link rel="stylesheet" href="css/style.css" />
		<?
		
	}
	
	
	
	
	public function DisplayHeader(){
		
		$this->DisplayHeaderStart();
		$this->DisplayMetaInfo();
		$this->DisplayJScripts();
		$this->DisplayCSS();
		$this->DisplayHeaderEnd();
		
	}
	
	public function DisplayErrors($arrerrors){
		
					$icounter = 1;
					
					?>
					<script type="text/javascript">
					$(document).ready(function($){
					
					<?
					
					foreach($arrerrors as $key=>$val){
							
							if($key == 'passwordexists' || $key == 'usernameexists'){ 
							
								?>
								
								$("#<?=substr($key, 0, 8)?>").after("<span id='error<?=$icounter?>'><?=$val?></span");
								$("#error<?=$icounter?>").css(
									{
										"display":"none",
										"height":"40px",
										"width":"auto",
										"border":"1px solid red",
										"padding":"10px",
										"position":"absolute",
										"z-index":"999",
										"border-radius": "5px",
										"margin-left": "15px",
										"margin-top" : "15px"
									}
								);
								
								$("#<?=substr($key, 0, 8)?>").css({"border":"2px solid red"});
								$("#error<?=$icounter?>").fadeIn(500);
								
								<?	
							
							
							} else {
							
											
					?>		
							$("#<?=$key?>").after("<span id='error<?=$icounter?>'><?=$val?></span");
							
								$("#error<?=$icounter?>").css(
									{
										"display":"none",
										"height":"40px",
										"width":"auto",
										"border":"1px solid red",
										"padding":"10px",
										"position":"absolute",
										"z-index":"999",
										"border-radius": "5px",
										"margin-left": "15px",
										"margin-top" : "15px"
									}
								)
							
							$("#<?=$key?>").css({"border":"2px solid red"})
							
							$("#error<?=$icounter?>").fadeIn(500);
							
					<?	
					
							}
					
					$icounter++;
						
					}
					
					
					?>
					
					});
					
					</script>
									
					<?
		
		
	}
	
}
?>
