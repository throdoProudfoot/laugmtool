<?php

/**
 *
 * @author throdo
 *         Une exception de type Technique (LauTechnicalException) qui
 *         correspond une erreur lors de la transformation de l'objet DOM parsé en Array.
 */
class LauDomToArrayException extends LauTechnicalException {
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauTechnicalException::__construct()
	 */
	public function __construct($file = null) {
		if ($file != null) {
			$message = "Impossible de transformer l'objet DOM en Array pour le fichier " . $file;
		} else {
			$message = "Un Objet DOM n'a pu être transformé en Array !";
		}
		$code = 5;
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