<?php
App::uses('ActivitiesAppController', 'Activities.Controller');

class ActivitiesController extends ActivitiesAppController {

	public $name = 'Activities';
	public $uses = 'Activities.Activity';
	public $allowedActions = array('index'); // allowed because it returns results and there is no view file, so there is no direct access as of now.

	function index($parentForeignKey = null) {
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

}