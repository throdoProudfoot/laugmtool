<?php

require_once 'tests/testConfigPage.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * DataReferences test case.
 */
class DataReferencesTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var DataReferences
	 */
	private $DataReferences;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->DataReferences = new DataReferences ( 'peuples' );
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated DataReferencesTest::tearDown()
		$this->DataReferences = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests DataReferences->__construct()
	 */
	public function test__construct() {
		$df = new DataReferences ( 'peuples' );
		$this->assertNotNull ( $df );
		$retArray = $df->getContent ();
		$this->assertNotNull ( $retArray );
		$this->assertArrayHasKey ( 'Bardide', $retArray );
		$this->assertEquals ( 6, count ( $retArray ) );
	}
}

