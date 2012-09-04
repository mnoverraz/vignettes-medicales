<?php
class ParamedicalTestTraductModel extends xModelMysql {

	public $table = 'Paramedical_test_traduct';

	public $mapping = array(
			'id' => 'id',
			'name' => 'name',
			'language_id' => 'language_id',
			'paramedical_test_id' => 'paramedical_test_id'
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}