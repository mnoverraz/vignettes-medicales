<?php
class ModuleQuestionnaryModel extends xModelMysql {

	public $table = 'Module_questionnary';

	public $mapping = array(
			'module_id' => 'module_id',
			'questionnary_id' => 'questionnary_id'
	);
	
	public $joins = array(
			'module' => 'JOIN Module ON (Module_questionnary.module_id = Module.id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.id = Module_questionnary.questionnary_id)'
	);
	
	
	public $join = array('module','questionnary');
}