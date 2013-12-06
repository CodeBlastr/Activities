<?php
App::uses('AppHelper', 'View/Helper');
class ActivityHelper extends AppHelper {

	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
	}
	
	public function find($type, $options = array()) {
		$this->Model = ClassRegistry::init('Activities.Activity');
		$defaults = array();
		$options = Set::merge($options, $defaults);
		$data = $this->Model->find($type, $options);
		return $data;
	}
	
}
