<?php
class AnsPictureModel extends xModelMysql {

	public $table = 'Ans_picture';

	public $mapping = array(
			'id' => 'id',
			'checked' => 'checked',
			'image_url' => 'image_url',
			'question_id' => 'question_id',
			'group_id' => 'group_id'
	);

	public $joins = array(
			'ans-picture-traduct' => 'JOIN Ans_picture_traduct ON (Ans_picture_traduct.ans_picture_id = Ans_picture.id)',
			'group' => 'JOIN `Group` ON (`Group`.id = Ans_picture.group_id)',
			'group-traduct' => 'JOIN Group_traduct ON (Group_traduct.group_id = `Group`.id)'
	);


	public $join = array('ans-picture-traduct');
}