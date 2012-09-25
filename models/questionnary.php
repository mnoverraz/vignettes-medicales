<?php
class QuestionnaryModel extends xModelMysql {
	
	public $table = 'Questionnary';
	
	public $mapping = array(
			'id' => 'id',
			'author_id' => 'author_id',
			'creation_date' => 'creation_date',
			'limit_date' => 'limit_date',
			'publication' => 'publication',
	);
	
	public $joins = array(
			'user' => 'JOIN User ON (Questionnary.author_id = User.id)',
			'questionnary-traduct' => 'JOIN Questionnary_traduct ON (Questionnary.id = Questionnary_traduct.questionnary_id)'
	);
	

	public $join = array('user','questionnary-traduct');
}