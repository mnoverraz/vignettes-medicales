<h1>Menu</h1>
<ul>
	<li><a href="<?php echo xUtil::url('home')?>"><?php echo _("Vignettes") ?></a></li>
	<?php
	if(xContext::$auth->is_role('Instructor') || xContext::$auth->is_role('Administrator')){
		printf('<li><a href="%s">%s</a></li>',
			xUtil::url('questionnary'),
			_("Créer Vignettes")
		);
	}
	
	if(xContext::$auth->is_role('Administrator')){
		printf('<li><a href="%s">%s</a></li>',
			xUtil::url('admin/admin'),
			_("Administration")
		);
	}
	?>
	<li><a href="http://moodle2.unil.ch">Moodle</a></li>
</ul>