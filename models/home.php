<?php
class HomeModel extends xModelMysql {
	
	public $table = 'Questionnary';
	
	public $mapping = array(
			'id' => 'id',
			'author_id' => 'author_id',
			'creation_date' => 'creation_date',
			'limit_date' => 'limit_date',
			'publication' => 'publication',
			'questionnary_traduct_id' => 'questionnary_traduct_id'
	);
	
	public $joins = array(
			'author' => 'JOIN Author ON (Questionnary.author_id = Author.id)',
			'questionnary-traduct' => 'JOIN Questionnary_traduct ON (Questionnary.questionnary_traduct_id = Questionnary_traduct.id)'
	);
	

	public $join = array('author','questionnary-traduct');
}