<?php
App::uses('ActivitiesAppModel', 'Activities.Model');

class Activity extends ActivitiesAppModel {

	public $name = 'Activity';

	public $displayField = 'name';

	public $order = array('Activity.created DESC');

	public $belongsTo = array('User' => array('className' => 'Users.User', 'foreignKey' => 'user_id', 'conditions' => '', 'fields' => '', 'order' => ''), 'Creator' => array('className' => 'Users.User', 'foreignKey' => 'creator_id', 'conditions' => '', 'fields' => '', 'order' => ''));

/**
 * Add method
 * 
 * @throws Exception
 */
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
