<h1>Menu</h1>
<ul>
	<li><a href="<?php echo xUtil::url('home')?>"><?php echo _("Vignettes") ?></a></li>
	<?php
	//xController::load('role')->isAdmin(true)
	if(xContext::$auth->is_role('Instructor') || xContext::$auth->is_role('Administrator')){
	?>
	<li><a href="<?php echo xUtil::url('questionnary')?>"><?php echo _("Créer Vignettes") ?></a></li>
	<li><a href="<?php echo xUtil::url('home')?>"><?php echo _("Administration") ?></a></li>
	<?php }?>
	<li><a href="http://moodle2.unil.ch">Moodle</a></li>
</ul>