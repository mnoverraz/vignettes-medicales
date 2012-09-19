<html>
<head>
<title><?php echo _("app.name"); ?></title>
<meta charset="utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link rel="icon" href="https://wwwfbm.unil.ch/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="https://wwwfbm.unil.ch/favicon.ico" type="image/x-icon" />
<?php foreach ($m['css'] as $css): ?>
        <link href="<?php echo $css ?>" rel="stylesheet">
<?php endforeach ?>


<?php foreach ($m['js'] as $js): ?>
        <script type="text/javascript" src="<?php echo $js ?>"></script>
<?php endforeach ?>
</head>
<body>

<!-- BEGIN PAGE -->
	<div id="page">
		<!-- BEBIN HEADER -->
		<div id="header">
			<!--img id="login" src="https://wwwfbm.unil.ch/html/img/login.gif"
				alt="login" /-->
			<!--div id="language"><a href="?xlang=fr" class="language">Français</a> | <a href="?xlang=en" class="language">English</a> | <a href="config?lang=ja"  class="language">日本語</a></div-->
			
			
			<div id="bar"><?php echo _("app.name"); ?></div>
		</div>
		
		<!-- END HEADER -->
		<!-- BEGIN CONTENT -->
		<div id="content">
			<!-- BEGIN MAIN -->
			<div id="main">
				<!-- BEGIN CALENDAR -->
				<div id="toolbar"></div>
				<?php echo xView::load('layout/messages') ?>
            	<?php echo $d['html']['content'] ?>
				<!-- END CALENDAR -->
			</div>
			<!-- END MAIN -->
		</div>
		<!-- END CONTENT -->
		

		<?php echo xView::load('layout/footer') ?>
	</div>
</body>
</html>