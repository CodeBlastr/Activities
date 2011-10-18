<?php
class Activity extends AppModel {

	var $name = 'Activity';
	var $displayField = 'name';
	var $actsAs = array('Affiliates.Referrable');
	var $order = array('Activity.created DESC');

	var $belongsTo = array(
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>