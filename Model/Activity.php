<?php
App::uses('ActivitiesAppModel', 'Activities.Model'); 

class Activity extends ActivitiesAppModel {

	public $name = 'Activity';
	public $displayField = 'name';
	public $order = array('Activity.created DESC');

	public $belongsTo = array(
		'User' => array(
			'className' => 'Users.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public function __construct($id = false, $table = null, $ds = null) {
		if (in_array('Affiliates', CakePlugin::loaded())) {
			$this->actsAs[] = 'Affiliates.Referrable';
		}		
    	parent::__construct($id, $table, $ds);		
    }
	
	public function add($data) {
	    if (!empty($data)) {
	        if ($this->save($data)) {
	            return true;
	        } else {
				throw new Exception(__('The activity could not be saved. Please, try again.'));
			}
        } else {
			throw new Exception(__('Submitted data was invalid.'));
		}
	}
	
}