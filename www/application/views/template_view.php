<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 3.0 License

Name       : Accumen
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120712

Modified by VitalySwipe
-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>ОЛОЛОША TEAM</title>
		<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
		<link href="http://fonts.googleapis.com/css?family=Kreon" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="/css/style.css" />
		<script src="/js/jquery-1.6.2.js" type="text/javascript"></script>
		<script type="text/javascript">
		// return a random integer between 0 and number
		function random(number) {
			
			return Math.floor( Math.random()*(number+1) );
		};
		
		// show random quote
		$(document).ready(function() { 

			var quotes = $('.quote');
			quotes.hide();
			
			var qlen = quotes.length; //document.write( random(qlen-1) );
			$( '.quote:eq(' + random(qlen-1) + ')' ).show(); //tag:eq(1)
		});
		</script>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
                            <div>
                                <?php include 'application/views/menu_view.php'; ?>
				<div id="logo">
					<a href="/">ОЛОЛОША</span> <span class="cms">TEAM</span></a>
				</div>
                                <?php include 'application/views/enter_view.php'; ?>
                            </div>
			</div>
			<div id="page">
				<div id="sidebar">
					<?php  include 'application/views/sidebox_view.php';  ?>
                                        <?php if($enter === 'active'){ include 'application/views/usermenu_view.php'; } ?>
				</div>
				<div id="content">
                                        <div class="map">
                                            <?php include 'application/views/maps_view.php';?>
                                        </div>
                                        <br class="clearfix" />
					<div class="box">
						<?php include 'application/views/'.$content_view; ?>
					</div>
					<br class="clearfix" />
				</div>
				<br class="clearfix" />
			</div>
			<div id="page-bottom">
                            <a name="contact"></a>
				<div id="page-bottom-sidebar">
					<h3>Наши контакты</h3>
					<ul class="list">
						<li class="first">icq: 199199538</li>
						<li>skypeid: vitalyswipe</li>
						<li class="last">email: vitalyswipe@gmail.com</li>
					</ul>
				</div>
				<div id="page-bottom-content">
					<?php include 'application/views/aboutbottom_view.php'; ?>
				</div>
				<br class="clearfix" />
			</div>
		</div>
		<div id="footer">
			<a href="/">ОЛОЛОША TEAM</a> &copy; <?=date('Y',time());?></a>
		</div>
	</body>
</html>