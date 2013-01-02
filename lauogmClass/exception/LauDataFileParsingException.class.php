<?php

/**
 *
 * @author throdo
 *         Une exception de type Technique (LauTechnicalException) qui
 *         correspond à un fichier non trouvée.
 *         Il est possible de passer au constructeur le nom et le chemin d'accès
 *         du fichier non trouvé.
 */
class LauDataFileParsingException extends LauTechnicalException {
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauTechnicalException::__construct()
	 */
	public function __construct($file = null) {
		if ($file != null) {
			$message = "Impossible de parser le fichier " . $file;
		} else {
			$message = "Un fichier n'a pas pu être parsé !";
		}
		$code = 3;
		parent::__construct ( $message, $code, null );
	}
	
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauTechnicalException::__toString()
	 */
	public function __toString() {
		// TODO Auto-generated method stub
	}
}

?>