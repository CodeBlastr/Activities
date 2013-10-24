<?php
class SitemapsController extends ActivitiesAppController {

	public $name = 'Sitemaps';

	public $uses = array('Users.User');

	public $helpers = array('Time');

	public $components = array('RequestHandler');

	public function index() {
		//prevent xml validation errors caused by sql log
		Configure::write('debug', 0);
		$this->User->recursive = -1;
		$this->set('users', $this->User->find('all'));
	}

}
