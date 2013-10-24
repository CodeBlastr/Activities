<?php
class RssController extends ActivitiesAppController {

	public $name = 'Rss';

	public $uses = array('Users.User');

	public $helpers = array('Text');

	public $components = array('RequestHandler');

	public function index() {
		if ($this->RequestHandler->isRss()) {
			$users = $this->User->find('all', array('limit' => 20, 'order' => 'User.created DESC'));
			return $this->set(compact('users'));
		}
	}

}
