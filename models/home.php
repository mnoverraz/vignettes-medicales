<?php
class HomeModel extends xModelMysql{
	
	public $table = 'Questionnary';
	
	public $mapping = array(
			'id' => 'id',
			'author_id' => 'creation_date',
			'creation_date' => 'limit_date',
			'limit_date' => 'marque_id',
			'publication' => 'marque_id',
			'questionnary_traduct_id' => 'marque_id'
	);
	
	public $joins = array(
			'Author' => 'JOIN Author ON (Author.id = Questionnary.author_id)',
	);
	
	/**
	 * Default joins
	 * @var array
	*/
	public $join = array('Author');
}