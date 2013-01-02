<?php

require_once 'PHPUnit/Framework/TestCase.php';

/**
 * test case.
 */
class MyFirstTest extends PHPUnit_Framework_TestCase {

	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();

		// TODO Auto-generated MyFirstTest::setUp()
	}

	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated MyFirstTest::tearDown()
		parent::tearDown ();
	}

	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}

	public function testTrue() {
		$this->assertTrue(TRUE,'Yes !!!');
	}

}

