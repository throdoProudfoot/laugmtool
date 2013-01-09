<?php

/**
 *
 * @author throdo
 *        
 */
class LauTechnicalException extends Exception {
	/*
	 * (non-PHPdoc) @see Exception::__construct()
	 */
	public function __construct($message = null, $code = null, $previous = null) {
		if ($message == null) {
			$message = "Erreur Technique dans le Plugin Lauogm";
		}
		if ($code == null) {
			$code = 1;
		}
		parent::__construct ( $message, $code,$previous);
	}
	
	/*
	 * (non-PHPdoc) @see Exception::__toString()
	 */
	public function __toString() {
		return ($this->getCode () . ": " . $this->getMessage ());
	}
}

?>