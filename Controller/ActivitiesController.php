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

	public $allowedActions = array('ping');

	/**
	 * Index method
	 *
	 * @return array
	 */
	public function index($parentForeignKey = null) {
		$this->paginate['fields'] = array('id', 'name', 'creator_id', 'created', 'description');
		$this->paginate['contain'] = array('Creator' => array('fields' => array('id', 'full_name')));
		$associations = array('Creator' => array('displayField' => 'full_name'));

		if ($parentForeignKey) {
			$this->paginate['conditions'] = array('parent_foreign_key' => $parentForeignKey);
		}

		$activities = $this->paginate();
		$this->set(compact('activities', 'associations'));
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

		$activity = $this->Activity->find('first', array('conditions' => array('Activity.id' => $id, ), ));

		$this->set(compact('activity'));

		$this->set('page_title_for_layout', $activity['Activity']['name']);
		$this->set('title_for_layout', $activity['Activity']['name']);
	}

	public function delete($id = null) {
		$this->Activity->id = $id;
		if (!$this->Activity->exists()) {
			throw new NotFoundException(__('Invalid activity'));
		}

		if ($this->Activity->delete($id)) {
			$this->Session->setFlash(__('Activity deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Activity was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * used for a basic external "like" button
	 * @throws BadRequestException
	 */
	public function ping($activityType, $model, $foreignKey) {
		if (empty($activityType) || empty($model) || empty($foreignKey)) {
			throw new BadRequestException;
		}

		$okToSave = true;
		$ipLimited = false;

		if (defined('__ACTIVITIES_LIMIT_PINGS_BY_IP')) {
			$limited = unserialize(__ACTIVITIES_LIMIT_PINGS_BY_IP);
			foreach ($limited as $type => $limit) {
				if ($type === $activityType) {
					$ipLimited = true;
				}
			}
		}
		if ($ipLimited) {
			// check to see if this has been acted on by this ip
			$hasActed = $this->Activity->find('first', array(
				'conditions' => array('foreign_key' => $foreignKey, 'model' => $model, 'from_ip' => $_SERVER['REMOTE_ADDR'])
			));
			if (!empty($hasActed)) {
				$okToSave = false;
			}
		}

		if ($okToSave) {
			$activity = $this->Activity->create(array(
				'activity_type' => $activityType,
				'name' => $_SERVER['HTTP_REFERER'],
				'foreign_key' => $foreignKey,
				'model' => $model,
				'from_ip' => $_SERVER['REMOTE_ADDR']
			));
			$activity = $this->Activity->save();
			$this->view = false;
			$this->layout = false;
			$this->autoRender = false;
			$this->response->header(array('Access-Control-Allow-Origin' => '*'));
			return ($activity) ? 'true' : 'false';
		} else {
			return false;
		}
	}

}
