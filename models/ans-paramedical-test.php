<?php
class AnsParamedicalTestModel extends xModelMysql {

	public $table = 'Ans_paramedical_test';

	public $mapping = array(
			'id' => 'id',
			'patient_values' => 'patient_values',
			'paramedical_test_id' => 'paramedical_test_id',
			'question_id' => 'question_id',
			'group_id' => 'group_id'
	);

	public $joins = array(
			'paramedical-test' => 'JOIN Paramedical_test ON (Ans_paramedical_test.paramedical_test_id = Paramedical_test.id)',
			'paramedical-test-traduct' => 'JOIN Paramedical_test_traduct ON (Paramedical_test_traduct.paramedical_test_id = Paramedical_test.id)',
			'group' => 'JOIN Group ON (Groupe.id = Ans_paramedical_test.group_id)',
			//'question' => 'JOIN Question ON (Ans_paramedical_test.question_id = Question.id)'
	);


	public $join = array('paramedical-test','paramedical-test-traduct', 'group'/*, 'question'*/);
}