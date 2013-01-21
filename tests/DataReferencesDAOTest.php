<?php

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
		
		$this->DataReferencesDAO = new Peuples ( 'peuples' );
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
		$df = new Peuples ( 'peuples' );
		$this->assertNotNull ( $df );
		$resultArray = $df->getDataReferenceContent();
		$this->assertNotNull ( $resultArray );
	}
	
	/**
	 * @expectedException LauDataFileNotFoundException
	 * @expectedExceptionCode 2
	 * @expectedExceptionMessage Impossible de trouver le fichier
	 * /media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/tests/testDataReferences/notExistReferences.xml
	 */
	public function test__constructWithFileNotExist() {
		$df = new Peuples ( 'notExist' );
	}
	
	/**
	 * Tests DataReferencesDAO->getDataReferenceContents()
	 */
	public function test__constructParsingOk() {
		$df = new Peuples ( 'tables' );
		$resultArray = $df->getDataReferenceContent();		
		$this->assertTrue ( gettype ( $resultArray ) == "array" );
		$this->assertNotNull ( $resultArray );
		$this->assertEquals ( 3, count ( $resultArray ) );
		$this->assertArrayHasKey ( 'lauPeuples', $resultArray );
		$this->assertArrayHasKey ( 'lauVocations', $resultArray );
		$this->assertArrayHasKey ( 'lauAvantages', $resultArray );
	}
	
	/**
	 * @expectedException LauDataFileParsingException
	 * @expectedExceptionCode 3
	 * @expectedExceptionMessage Impossible de parser le fichier
	 * /media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/tests/testDataReferences/badDataReferences.xml
	 */
	public function test__constructParsingFailure() {
		$df = new Peuples ( WPLAUOGM_PLUGIN_TESTDATA_DIR . '/badDataReferences.xml', true, 'root' );
		$resultArray = $df->getDataReferenceContent();
	}

	/**
	 * @expectedException LauDataFileStructureException
	 * @expectedExceptionCode 4
	 * @expectedExceptionMessage childNode existe dans structure - Impossible de
	 * récupérer le contenu du fichier de données
	 * /media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/tests/testDataReferences/badStructureFile.xml
	 */
	public function test__constructBadStructure() {
		$df = new Peuples ( WPLAUOGM_PLUGIN_TESTDATA_DIR . '/badStructureFile.xml', true, 'peuples' );
		$resultArray = $df->getDataReferenceContent();		
	}
	
	/**
	 * @expectedException LauDataFileStructureException
	 * @expectedExceptionCode 4
	 * @expectedExceptionMessage Recupérer childNode valeur - Impossible de
	 * récupérer le contenu du fichier de données
	 * /media/www-dev/private/wordpress/wp-content/plugins/lauOutilsGM/tests/testDataReferences/childNodeNotFound.xml.xml
	 */
	public function test__constructChildNodeNotFound() {
		$df = new Peuples ( WPLAUOGM_PLUGIN_TESTDATA_DIR . '/childNodeNotFound.xml', true, 'peuples' );
		$resultArray = $df->getDataReferenceContent();
	}
	
}

