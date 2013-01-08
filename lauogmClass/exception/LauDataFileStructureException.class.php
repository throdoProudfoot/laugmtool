<?php

/**
 *
 * @author throdo
 *         Une exception de type Technique (LauTechnicalException) qui
 *         correspond à une erreur lors de la récupération du contenu d'un fichier de données.
 *         Cette erreur survient car il y a un soucis dans la structure du fichier de données.
 */
class LauDataFileStructureException extends LauTechnicalException {
	/*
	 * (non-PHPdoc) @see \lauogmClass\LauTechnicalException::__construct()
	 */
	public function __construct($file = null, $step = null) {
		if ($step == null) {
			$step = "Pas de Step spécifié";
		}
		if ($file != null) {
			$message = $step . " - Impossible de récupérer le contenu du fichier de données " . $file;
		} else {
			$message = $step . " - Impossible de récupérer le contenu d'un fichier de données !";
		}
		$code = 4;
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