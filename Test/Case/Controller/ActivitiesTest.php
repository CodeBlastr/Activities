<?php
/* Activities Test cases generated on: 2012-01-13 13:31:26 : 1326461486*/
App::uses('ActivitiesController', 'Activities.Controller');

if (!class_exists('Activity')) {
	class Activity extends CakeTestModel {

	/**
	 *
	 */
		public $callbackData = array();

	/**
	 *
	 */
		public $useTable = 'activities';

	/**
	 *
	 */
		public $name = 'Activity';
	}

}

/**
 * Activities Test Case
 *
 */
class ActivitiesControllerTestCase extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.Activities.Activity' 
		);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();

		//$this->Activities = new TestActivities();
		$this->Activities = new ActivitiesController;
	}

/**
 * test index
 *
 */
	public function testIndex() {
		$this->assertTrue(true);
		//$this->testAction('/activities/activities/index/4e493854-21c0-43bc-9c6d-7dcd45a3a949', array('return' => 'vars'));
		//$this->assertEqual(2, count($result['activities'])); // test that there are two records returned from the fixture under the activities variable name
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
