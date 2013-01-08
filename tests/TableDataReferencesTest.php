<?php

require_once 'tests/testConfigPage.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * TableDataReferences test case.
 */
class TableDataReferencesTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var TableDataReferences
	 */
	private $TableDataReferences;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->TableDataReferences = new TableDataReferences();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated TableDataReferencesTest::tearDown()
		$this->TableDataReferences = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests TableDataReferences->__construct()
	 */
	public function test__construct() {
		$this->TableDataReferences->__construct();
	}
}

