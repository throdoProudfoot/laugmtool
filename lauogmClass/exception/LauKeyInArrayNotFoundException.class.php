<?php

/**
 *
 * @author throdo
 *         Une exception de type Fonctionnelle (LauFunctionnalException) qui
 *         correspond à une erreur lorsque l'on vérifie si une clé existe dans un tableau.
 */
class LauKeyInArrayNotFoundException extends LauFunctionnalException {
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauFunctionnalException::__construct()
	 */
	public function __construct($key, $arrayName) {
		$message = "Impossible de récupérer la clé " . $key . " dans le tableau " . $arrayName;
		$code = 1003;
		parent::__construct ( $message, $code, null );
	}
	
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauFunctionnalException::__toString()
	 */
	public function __toString() {
		// TODO Auto-generated method stub
	}
}

?>