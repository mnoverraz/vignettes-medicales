<?php
class AnsPictureTraductModel extends xModelMysql {

	public $table = 'Ans_picture_traduct';

	public $mapping = array(
			'id' => 'id',
			'testname' => 'testname',
			'comment' => 'comment',
			'ans_picture_id' => 'ans_picture_id',
			'language_id' => 'language_id',
			
	);

	/*public $joins = array(
			'user' => 'JOIN User ON (User.id = Author.user_id)',
			'questionnary' => 'JOIN Questionnary ON (Questionnary.author_id = Author.id)'
	);


	public $join = array('user','questionnary');
	*/
}