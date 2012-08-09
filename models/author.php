<?php
class AuthorModel extends xModelMysql {

	public $table = 'Author';

	public $mapping = array(
			'id' => 'id',
			'firstname' => 'firstname',
			'lastname' => 'lastname',
			'email' => 'email'
	);
}