<?php
App::uses('ActivitiesAppModel', 'Activities.Model'); 

class Activity extends ActivitiesAppModel {

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
	
	function add($data) {
	    if (!empty($data)) {
	        if ($this->save($data)) {
	            return true;
	        }
        }
	}
	
}
?>