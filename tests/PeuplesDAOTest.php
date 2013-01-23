<?php

require_once 'tests/testConfigPage.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * PeuplesDAO test case.
 */
s-class PeuplesDAOTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var PeuplesDAO
	 */
	private $PeuplesDAO;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->PeuplesDAO = new DataReferencesDAO();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->PeuplesDAO = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests PeuplesDAO->__construct()
	 */
	public function test__construct() {
		$this->PeuplesDAO->__construct();
		$this->assertNotNull($this->PeuplesDAO->getData());
		$this->assertEquals('array', gettype($this->PeuplesDAO->getData()));
	}
}

