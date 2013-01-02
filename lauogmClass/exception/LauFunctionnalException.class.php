<?php

/**
 *
 * @author throdo
 *        
 */
class LauFunctionnalException extends \Exception {
	/*
	 * (non-PHPdoc) @see Exception::__construct()
	 */
	public function __construct($message = null, $code = null, $previous = null) {
		if ($message == null) {
			$message = "Erreur Fonctionnel dans le Plugin Lauogm";
		}
		if ($code == null) {
			$code = 1000;
		}
		parent::__construct ( $message, $code, null );
	}
	
	/*
	 * (non-PHPdoc) @see Exception::__toString()
	 */
	public function __toString() {
		return ($this->getCode () . ": " . $this->getMessage ());
	}
}

?>