<?php

/**
 *
 * @author throdo
 *         Une exception de type Fonctionnelle (LauFunctionnalException) qui
 *         correspond à une table dont la structure est introuvable dans le XML.
 *         On doit passer au constructeur le nom de la table non trouvée.        
 */
class LauDataFileStructureNotFoundException extends LauFunctionnalException {
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauTechnicalException::__construct()
	 */
	public function __construct($table) {
		$message = "Impossible de trouver la structure de la tables " . $table;
		$code = 1001;
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