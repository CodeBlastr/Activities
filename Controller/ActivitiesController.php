<?php
App::uses('ActivitiesAppController', 'Activities.Controller');

class ActivitiesController extends ActivitiesAppController {

/**
 * Name
 * 
 * @var string 
 */
	public $name = 'Activities';

/**
 * Uses
 * 
 * @var string
 */
	public $uses = 'Activities.Activity';

/**
 * Index method
 * 
 * @param type $parentForeignKey
 * @return type
 */
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
 * Add method
 * 
 * @throws NotFoundException
 */
    public function add() {        
    	if (!empty($this->request->data)) {
    	    try {
				$this->Activity->add($this->request->data);
    	        $this->Session->setFlash(__('The activity has been saved'));
    	   		$this->redirect(array('action' => 'view', $this->Activity->id));
    	    } catch (Exception $e) {
    	        $this->Session->setFlash($e->getMessage());
    	    }
    	}
	}
	
/**
 * Edit method
 * 
 * @param type $id
 * @throws NotFoundException
 */
    public function edit($id = null) {
		$this->Activity->id = $id;
		if (!$this->Activity->exists()) {
			throw new NotFoundException(__('Activity not found'));
		}
        
    	if (!empty($this->request->data)) {
    	    try {
				$this->Activity->add($this->request->data);
    	        $this->Session->setFlash(__('The activity has been saved'));
    	   		$this->redirect(array('action' => 'view', $this->Activity->id));
    	    } catch (Exception $e) {
    	        $this->Session->setFlash($e->getMessage());
    	    }
    	}
        $this->request->data = $this->Activity->read(null, $id);
	}
    
/**
 * View method
 * 
 * @param type $id
 * @throws NotFoundException
 */
	public function view($id = null) {
		$this->Activity->id = $id;
		if (!$this->Activity->exists()) {
			throw new NotFoundException(__('Activity not found'));
		}
		
		$activity = $this->Activity->find('first', array(
			'conditions' => array(
				'Activity.id' => $id,
				),
			));
        
		$this->set(compact('activity', 'contactDetailTypes'));
		
		$this->set('page_title_for_layout', $activity['Activity']['name']);
		$this->set('title_for_layout',  $activity['Activity']['name']);
	}

}