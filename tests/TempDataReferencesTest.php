<?php

require_once 'tests/testConfigPage.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * DataReferences test case.
 */
class TempDataReferencesTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var DataReferences
	 */
	private $TempDataReferences;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->TempDataReferences = new DataReferences ();
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		// TODO Auto-generated DataReferencesTest::tearDown()
		$this->TempDataReferences = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests DataReferences->getTableReferences()
	 */
	public function testGetTableReferences() {
		$this->assertNotNull ( $this->TempDataReferences->getTableReferences () );
	}
	
	/**
	 * Tests DataReferences->setTableReferences()
	 */
	public function testSetTableReferences() {
		// TODO Auto-generated DataReferencesTest->testSetTableReferences()
		$this->markTestIncomplete ( "setTableReferences test not implemented" );
		
		$this->TempDataReferences->setTableReferences(/* parameters */);
	}
	
	/**
	 * Tests DataReferences->__construct()
	 */
	public function test__construct() {
		$df = new DataReferences ();
		$this->assertNotNull ( $df );
		$this->assertNotNull ( $df->getTableReferences () );
		$this->assertArrayHasKey ( 'lauPeuples', $df->getTableReferences () );
	}
	
	/**
	 * Tests DataReferences->getTableList()
	 */
	public function testGetTableList() {
		$gtl = $this->TempDataReferences->getTableList ();
		$this->assertNotNull ( $gtl );
		$this->assertArrayHasKey ( 'lauPeuples', $gtl );
	}


	/**
	 * Tests DataReferences->processFormResult()
	 */
	public function testProcessFormResult() {
		$post = array (
				'lauPeuples' => 'on',
				'lauVocations' => 'on',
				'save' => 'Valider' 
		);
		$gtl = $this->TempDataReferences->processFormResult($post);
		$this->assertNotNull ( $gtl );
		$this->assertContains ( 'peuples', $gtl );
		$this->assertContains ( 'vocations', $gtl );		
	}
}

