<?php
App::uses('ActivitiesAppController', 'Activities.Controller');

class ActivitiesController extends ActivitiesAppController {

	public $name = 'Activities';
	public $uses = 'Activities.Activity';
	public $allowedActions = array('index'); // allowed because it returns results and there is no view file, so there is no direct access as of now.

	public function index($parentForeignKey = null) {
		$this->Activity->recursive = 0;
		$this->paginate = array(
			'conditions' => array(
				'Activity.parent_foreign_key' => $parentForeignKey,
				),
			);
		$activities = $this->paginate();
		$this->set(compact('activities'));
		return $activities;
	}
	
	/**
	 * Method to add activities from other plugins
	 */
	public function record() {
    	if (!empty($this->request->data)) {
    	    $this->request->data['Activity']['user_id'] = $this->Auth->user('id');
    	    $this->request->data['Activity']['foreign_key'] = 0;
    	    if ($this->Activity->add($this->request->data)) {
    	        $this->Session->setFlash(__('The activity has been saved', true));
    	    } else {
    	        $this->Session->setFlash(__('The activity could not be saved. Please, try again.', true));
    	    }
    	    $this->redirect($this->referer());
    	}
	}

}