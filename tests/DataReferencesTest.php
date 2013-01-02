<?php

// use lauogmClass\LauDataFileParsingException;
// use lauogmClass\LauDataFileNotFoundException;

require_once '../lauogmClass/dao/DataReferencesDAO.class.php';
// require_once 'lauogmClass/LauDataFileNotFoundException.php';
// require_once 'lauogmClass/LauDataFileParsingException.php';

require_once 'lauogmClass/DataReferences.class.php';
require_once 'PHPUnit/Framework/TestCase.php';

define ( 'WPLAUOGM_PLUGIN_DIR', '/media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM' );
define ( 'WPLAUOGM_PLUGIN_CLASS_DIR', constant ( 'WPLAUOGM_PLUGIN_DIR' ) . '/lauogmClass' );
define ( 'WPLAUOGM_PLUGIN_DATA_DIR', constant ( 'WPLAUOGM_PLUGIN_DIR' ) . '/tests/testDataReferences' );

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
		
		$this->DataReferences = new DataReferences ();
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
	 * Tests DataReferences->getTableReferences()
	 */
	public function testGetTableReferences() {
		$this->assertNotNull ( $this->DataReferences->getTableReferences () );
	}
	
	/**
	 * Tests DataReferences->setTableReferences()
	 */
	public function testSetTableReferences() {
		// TODO Auto-generated DataReferencesTest->testSetTableReferences()
		$this->markTestIncomplete ( "setTableReferences test not implemented" );
		
		$this->DataReferences->setTableReferences(/* parameters */);
	}
	
	/**
	 * Tests DataReferences->__construct()
	 */
	public function test__construct() {
		$df = new DataReferences ();
		$this->assertNotNull ( $df );		
		$this->assertNotNull ($df->getTableReferences());
		$this->assertArrayHasKey('lauPeuples', $df->getTableReferences());
	}
	
	/**
	 * Tests DataReferences->getTableList()
	 */
	public function testGetTableList() {
		$gtl = $this->DataReferences->getTableList();
		$this->assertNotNull ($gtl);
		$this->assertArrayHasKey('lauPeuples', $gtl);
	}
}

