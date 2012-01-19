<?php
/* Activities Test cases generated on: 2012-01-13 13:31:26 : 1326461486*/
App::uses('Activities', 'Activities.Controller');

/**
 * TestActivities *
 */
class TestActivities extends Activities {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * Activities Test Case
 *
 */
class ActivitiesTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		$this->Activities = new TestActivities();
		$this->Activity->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Activities);

		parent::tearDown();
	}

}
