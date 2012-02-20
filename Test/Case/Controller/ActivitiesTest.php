<?php
/* Activities Test cases generated on: 2012-01-13 13:31:26 : 1326461486*/
App::uses('ActivitiesController', 'Activities.Controller');

/**
 * TestActivities *
 */
class TestActivities extends ActivitiesController {
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

		#$this->Activities = new TestActivities();
		$this->Activities = new ActivitiesController;
	}

    public function testIndex() {
    	$result = $this->Activities->index(90);
	    $this->assertContains('Activities', $result);
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
