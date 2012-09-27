<h1>Menu</h1>
<ul>
	<li><a href="<?php echo xUtil::url('home')?>">Vignettes</a></li>
	<?php
	//xController::load('role')->isAdmin(true)
	if(xContext::$auth->is_role('Instructor') || xContext::$auth->is_role('Administrator')){
	?>
	<li><a href="<?php echo xUtil::url('questionnary')?>">Création</a></li>
	<li><a href="<?php echo xUtil::url('home')?>">Administration</a></li>
	<?php }?>
	<li><a href="http://moodle2.unil.ch">Moodle</a></li>
</ul>