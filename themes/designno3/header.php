<?php if (!defined('FLUX_ROOT')) exit; ?>
<?php include 'gthemes/functions.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Gerome" />
<?php if (isset($metaRefresh)): ?>
<meta http-equiv="refresh" content="<?php echo $metaRefresh['seconds'] ?>; URL=<?php echo $metaRefresh['location'] ?>" />
<?php endif ?>
<title><?php echo Flux::config('SiteTitle'); if (isset($title)) echo ": $title" ?></title>  
<link rel="stylesheet" href="<?php echo $this->themePath('css/flux.css') ?>" type="text/css" media="screen" title="" charset="utf-8" />
<link href="<?php echo $this->themePath('css/flux/unitip.css') ?>" rel="stylesheet" type="text/css" media="screen" title="" charset="utf-8" />
<?php if (Flux::config('EnableReCaptcha')): ?>
<link href="<?php echo $this->themePath('css/flux/recaptcha.css') ?>" rel="stylesheet" type="text/css" media="screen" title="" charset="utf-8" />
<?php endif ?>	

<?php echo script_tag('js/jquery.tools.min.js'); ?>
<?php echo script_tag('js/jquery-1.7.1.js'); ?>
<?php echo script_tag('js/flux.datefields.js'); ?>
<?php echo script_tag('js/flux.unitip.js'); ?>
<?php echo script_tag('js/jquery.jclock.js'); ?>
        
<?php echo script_tag('js/jui/jquery.ui.core.js'); ?>
<?php echo script_tag('js/jui/jquery.ui.widget.js'); ?>
<?php echo script_tag('js/jui/jquery.ui.tabs.js'); ?>

<?php echo script_tag('js/hoverIntent.js'); ?>
<?php echo script_tag('js/superfish.js'); ?>

<?php echo script_tag('js/jquery.colorbox.js'); ?>

<?php echo link_tag('css/colorbox.css'); ?>
<?php echo link_tag('css/superfish.css','stylesheet','','','screen'); ?>
<?php echo link_tag('css/jquery.ui.tabs.css'); ?>
<?php echo link_tag('css/reset.css'); ?>
<?php echo link_tag('css/text.css'); ?>
<?php echo link_tag('css/960.css'); ?>
<?php echo link_tag('engine1/style.css'); ?>
<?php echo link_tag('css/main.css'); ?>
<?php echo link_tag('css/agile_carousel.css'); ?>
<?php echo link_tag('favicon.ico','shortcut icon','image/ico'); ?>


    <!-- End Gthemes -->
        <script type="text/javascript">
		jQuery(function(){jQuery('ul.sf-menu').superfish();});
		</script>
 		<script type="text/javascript">
		$(function() {
		  $( "#tabs" ).tabs();
        });
		</script>       

		<script type="text/javascript">
		$(document).ready(function(){
		//Examples of how to assign the ColorBox event to elements
		$(".group1").colorbox({rel:'#slideshow'});
		$(".group2").colorbox({rel:'group2', transition:"fade"});
		$(".group3").colorbox({rel:'group3', transition:"none", width:"75%", height:"75%"});
		$(".group4").colorbox({rel:'group4', slideshow:true, slideshowAuto:true});
		$(".ajax").colorbox();
		$(".youtube").colorbox({iframe:true, innerWidth:425, innerHeight:344});
		$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
		$(".inline").colorbox({inline:true, width:"50%"});
		});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				var inputs = 'input[type=text],input[type=password],input[type=file]';
				$(inputs).focus(function(){
					$(this).css({
						'background-color': '#f9f5e7',
						'border-color': '#dcd7c7',
						'color': '#726c58'
					});
				});
				$(inputs).blur(function(){
					$(this).css({
						'backgroundColor': '#ffffff',
						'borderColor': '#dddddd',
						'color': '#444444'
					}, 500);
				});
				$('.menuitem a').hover(
					function(){
						$(this).fadeTo(200, 0.85);
						$(this).css('cursor', 'pointer');
					},
					function(){
						$(this).fadeTo(150, 1.00);
						$(this).css('cursor', 'normal');
					}
				);
				$('.money-input').keyup(function() {
					var creditValue = parseInt($(this).val() / <?php echo Flux::config('CreditExchangeRate') ?>, 10);
					if (isNaN(creditValue))
						$('.credit-input').val('?');
					else
						$('.credit-input').val(creditValue);
				}).keyup();
				$('.credit-input').keyup(function() {
					var moneyValue = parseFloat($(this).val() * <?php echo Flux::config('CreditExchangeRate') ?>);
					if (isNaN(moneyValue))
						$('.money-input').val('?');
					else
						$('.money-input').val(moneyValue.toFixed(2));
				}).keyup();
				
				// In: js/flux.datefields.js
				processDateFields();
			});
			
			function reload(){
				window.location.href = '<?php echo $this->url ?>';
			}
		</script>
		
		<script type="text/javascript">
			function updatePreferredServer(sel){
				var preferred = sel.options[sel.selectedIndex].value;
				document.preferred_server_form.preferred_server.value = preferred;
				document.preferred_server_form.submit();
			}
			
			// Preload spinner image.
			var spinner = new Image();
			spinner.src = '<?php echo $this->themePath('img/spinner.gif') ?>';
			
			function refreshSecurityCode(imgSelector){
				$(imgSelector).attr('src', spinner.src);
				
				// Load image, spinner will be active until loading is complete.
				var clean = <?php echo Flux::config('UseCleanUrls') ? 'true' : 'false' ?>;
				var image = new Image();
				image.src = "<?php echo $this->url('captcha') ?>"+(clean ? '?nocache=' : '&nocache=')+Math.random();
				
				$(imgSelector).attr('src', image.src);
			}
			function toggleSearchForm()
			{
				//$('.search-form').toggle();
				$('.search-form').slideToggle('fast');
			}
		</script>
		
		<?php if (Flux::config('EnableReCaptcha') && Flux::config('ReCaptchaTheme')): ?>
		<script type="text/javascript">
			 var RecaptchaOptions = {
			    theme : '<?php echo Flux::config('ReCaptchaTheme') ?>'
			 };
		</script>
		<?php endif ?>
        
		<script type="text/javascript">
	    $(document).ready(function(){$('#qckLogin').hover(function(){$(this).css('width', '370');});  $('#qckLogin').mouseout(function(){$(this).width('270');});  $('#qckVote4Points').hover(function(){$(this).css('width', '370');});$('#qckVote4Points').mouseout(function(){$(this).width('270');});$('#qckWriteReview').hover(function(){$(this).css('width', '370');});$('#qckWriteReview').mouseout(function(){$(this).width('270');});  $('#qckDonationInfo').hover(function(){$(this).css('width', '370');});$('#qckDonationInfo').mouseout(function(){$(this).width('270');});});
        </script>
		
		<script type="text/javascript">
            $(function($) {
              var options = {
                format: '%I:%M:%S %p', // 12-hour with am/pm 
                fontFamily: 'Verdana, Times New Roman',
                fontSize: '14px',
                foreground: '#d2c58b',
                background: 'transparent'
              }
              $('.jclock').jclock(options);
            });
          </script>
        <script type="text/javascript">
           	$(document).ready(function(){
        	   //Download
        	  $('.img_qckVote4Points').hover(function() {
                    $(this).attr('src','<?php echo $this->themePath('css/img/btnDownloadClient.png') ?>');
        	   });
              $('.img_qckVote4Points').mouseout(function() {
                    $(this).attr('src','<?php echo $this->themePath('css/img/btnDownloadClient_hover.png') ?>');
        	   });
              //HelpDesk
        	  $('.img_HelpDesk').hover(function() {
                    $(this).attr('src','<?php echo $this->themePath('css/img/btnHelpDesk.png') ?>');
        	   });
              $('.img_HelpDesk').mouseout(function() {
                    $(this).attr('src','<?php echo $this->themePath('css/img/btnHelpDesk_hover.png') ?>');
        	   });
             }); 
        </script>
		  
		<style type="text/css">
		#slideshow {position:relative;}
		#slideshow IMG {position:absolute;top:0;left:0;z-index:8;opacity:0.0;}
		#slideshow IMG.active {z-index:10;opacity:1.0;}
		#slideshow IMG.last-active {z-index:9;}
		#inline_content { visible: false;}
		</style>
</head>

<body>
<div id="headContainer">
    <!-- (Server Status/Online Players/Server Time) -->
    <div id="topContainer">
        <div class="wrapper container_12">
            <?php include('gthemes/server_status.php');?>
            <div id="onlinePlayerContainer" class="cleanMP"><b><?php include 'gthemes/online_player.php' ?></b></div>
            <div id="server_time" class="cleanMP">
                <b>Server Time</b>
                <div class="jclock"></div>
            </div>
        </div>
    </div>
    <!-- (Ragnarok Online Banner) -->
    <div id="bannerContainer">
        <div class="wrapper container_12">
            <img src="<?php echo $this->themePath('img/banner.png') ?>" />
        </div>
    </div>
    <!-- (Top Menu) -->
    <div id="menuContainer" class="container_12">
        <div class="grid_12">
        <?php  include 'main/sidebar.php' ?>
        </div>
    </div>
</div>

<div id="mainContentWrapper" class="container_12">
    <div id="leftbarContainer" class="grid_3">
    <!-- (Left Sidebar Links) -->
        <a class='inline' href="#inline_content" title="Login Here" ><span id="qckLogin"></span></a>
        <a href="<?php echo $this->url('voteforpoints') ?>" title="Vote for Points"><span id="qckVote4Points"></span></a>
        <a href="#" title="Write a Review"><span id="qckWriteReview"></span></a>
        <a href="#" title="Donation Info"><span id="qckDonationInfo"></span></a>
        <div id="MoreLinks">
            <a href="#" title="Download Client Here!"><img class="img_qckVote4Points leftlink" src="<?php echo $this->themePath('css/img/btnDownloadClient.png') ?>" /><!-- <div id="downloadClient"></div> --></a>
            <a href="#" title="Click Here if you need Help"><img class="img_HelpDesk leftlink" src="<?php echo $this->themePath('css/img/btnHelpDesk.png') ?>" /><!--<div id="HelpDesk"></div>--></a>
        </div>
    <!-- (End Sidebar Links) -->
    </div>
    
    <div id="mainContentContainer" class="grid_7">
    <div id="showcaseContainer">
        <div id="slideShowContainer">
	<!-- (Slideshow) -->
	<div id="slideshow">
    <?php include 'gthemes/slideshow.php' ?>
    </div>
            
        </div>
	<!-- (Woe Schedule) -->	
        <div id="woeSchedContainer"></div>
    </div>
    <?php if($_GET['module'] == 'main' OR empty($_GET['module'])): ?>
    <h2>Welcome To <?php echo Flux::config('SiteTitle'); ?></h2>
    <div style="width: 500px; padding: 10px;" class="cleanMP">
    <div id="nuConteiner">
	<img src="<?php echo $this->themePath('css/img/newsAndUpdates.png') ?>" style="margin: 0px 0px 10px 0px;"/>
    <?php include 'gthemes/newsandupdates.php'; ?>
    </div>
    <div id="PvpRankContainer">
    <?php include('gthemes/pvpranking.php'); ?>
    </div>
    </div>
    <?php endif; ?> 
    <?php include 'main/loginbox.php' ?>
    <div id="contentWrapper">
    <script type="text/javascript" src="<?php echo $this->themePath('engine1/wowslider.js')?>"></script>
	<script type="text/javascript" src="<?php echo $this->themePath('engine1/script.js') ?>" ></script>
                                <?php if (Flux::config('DebugMode') && @gethostbyname(Flux::config('ServerAddress')) == '127.0.0.1'): ?>
									<p class="notice">Please change your <strong>ServerAddress</strong> directive in your application config to your server's real address (e.g., myserver.com).</p>
								<?php endif ?>
								<?php if ($message=$session->getMessage()): ?>
									<p class="message"><?php echo htmlspecialchars($message) ?></p>
								<?php endif ?>
								<?php include 'main/submenu.php' ?>
								<?php include 'main/pagemenu.php' ?>
								
								<?php if (in_array($params->get('module'), array('donate', 'purchase'))) include 'main/balance.php' ?>
    
