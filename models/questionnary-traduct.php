<?php
class QuestionnaryTraductModel extends xModelMysql {

	public $table = 'Questionnary_traduct';

	public $mapping = array(
			'id' => 'id',
			'theme' => 'theme',
			'title' => 'title',
			'description' => 'description',
			'conclusion' => 'conclusion',
			'language_id' => 'language_id',
			'questionnary_id' => 'questionnary_id'
	);
	
	public $allow_html = array(
			'theme' => '<p><b><br/>',
			'description' => '<p><b><strong><em><span><ul><ol><li><sup><sub><br/><h2><h3><h4>',
			'conclusion' => '<p><b><strong><em><span><ul><ol><li><sup><sub><br/><h2><h3><h4>'
	);
	
	public $joins = array(
		'language' => 'JOIN Language ON (Language.id = Questionnary_traduct.language_id)',
		'questionnary' => 'JOIN Questionnary ON (Questionnary.id = Questionnary_traduct.questionnary_id)',
		'module-questionnary' => 'JOIN Module_questionnary ON (Module_questionnary.questionnary_id = Questionnary.id)',
		'module' => 'JOIN Module ON (Module.id = Module_questionnary.module_id)',
		'user' => 'JOIN User ON (Questionnary.author_id = User.id)'
	);
	
	
	public $join = array('language','questionnary','module-questionnary','module','user');
}