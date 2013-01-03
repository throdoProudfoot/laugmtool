<?php

use lauogmClass\LauDataFileParsingException;
use lauogmClass\LauDataFileNotFoundException;

require_once 'tests/testConfigPage.php';
require_once 'PHPUnit/Framework/TestCase.php';

/**
 * DataReferencesDAO test case.
 */
class DataReferencesDAOTest extends PHPUnit_Framework_TestCase {
	
	/**
	 *
	 * @var DataReferencesDAO
	 */
	private $DataReferencesDAO;
	
	/**
	 * Prepares the environment before running a test.
	 */
	protected function setUp() {
		parent::setUp ();
		
		$this->DataReferencesDAO = new DataReferencesDAO ( 'peuples' );
	}
	
	/**
	 * Cleans up the environment after running a test.
	 */
	protected function tearDown() {
		$this->DataReferencesDAO = null;
		
		parent::tearDown ();
	}
	
	/**
	 * Constructs the test case.
	 */
	public function __construct() {
		// TODO Auto-generated constructor
	}
	
	/**
	 * Tests DataReferencesDAO->__construct()
	 */
	public function test__constructWithFileExist() {
		$df = new DataReferencesDAO ( 'peuples' );
		$this->assertNotNull ( $df );
	}
	
	/**
	 * @expectedException LauDataFileNotFoundException
	 * @expectedExceptionCode 2
	 * @expectedExceptionMessage Impossible de trouver le fichier
	 * /media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/tests/testDataReferences/notExistReferences.xml
	 */
	public function test__constructWithFileNotExist() {
		$df = new DataReferencesDAO ( 'notExist' );
	}
	
	/**
	 * Tests DataReferencesDAO->getFile()
	 */
	public function testGetFile() {
		$this->assertNotNull ( $this->DataReferencesDAO->getFile () );
		$this->assertFileExists ( $this->DataReferencesDAO->getFile () );
	}
	
	/**
	 * Tests DataReferencesDAO->setFile()
	 */
	public function testSetFile() {
		// TODO Auto-generated DataReferencesDAOTest->testSetFile()
		$this->markTestIncomplete ( "setFile test not implemented" );
		
		$this->DataReferencesDAO->setFile(/* parameters */);
	}
	
	/**
	 * Tests DataReferencesDAO->getDataReferenceContents()
	 */
	public function testGetDataReferenceContentsParsingOk() {
		$df = new DataReferencesDAO ( 'tables' );
		$retArray = $df->getDataReferenceContents ();
		$this->assertTrue ( gettype ( $retArray ) == "array" );
		$this->assertNotNull ( $retArray );
		$this->assertEquals ( 3, count ( $retArray ) );
		$this->assertArrayHasKey ( 'lauPeuples', $retArray );
		$this->assertArrayHasKey ( 'lauVocations', $retArray );
		$this->assertArrayHasKey ( 'lauAvantages', $retArray );
	}
	
	/**
	 * @expectedException LauDataFileParsingException
	 * @expectedExceptionCode 3
	 * @expectedExceptionMessage Impossible de parser le fichier
	 * /media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/tests/testDataReferences/badDataReferences.xml
	 */
	public function testGetDataReferenceContentsParsingFailure() {
		$df = new DataReferencesDAO ( WPLAUOGM_PLUGIN_TESTDATA_DIR . '/badDataReferences.xml', true, 'root' );
		$retArray = $df->getDataReferenceContents ();
	}
	
	/**
	 * Tests DataReferencesDAO->setDataReferenceContents()
	 */
	public function testSetDataReferenceContents() {
		
		$this->DataReferencesDAO->setDataReferenceContents(null);
	}
}

