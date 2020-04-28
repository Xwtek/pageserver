<?php

namespace App\Exceptions;

class TypeException extends \Exception{
    public function __construct($var_name, $expected_type, $got_type){
        if(!is_string($var_name)) {
			throw new TypeException("TypeException's VariableName", "string", gettype($var_name));
		}
        if(!is_string($expected_type)) {
			throw new TypeException("TypeException's ExpectedType", "string", gettype($expected_type));
		}
        if(!is_string($got_type)) {
			throw new TypeException("TypeException's ActualType", "string", gettype($got_type));
		}
        $this->var_name = $var_name;
        $this->expected_type = $expected_type;
		$this->got_type = $got_type;
		parent::__construct($this->errorMessage());
    }
	public function errorMessage() {
	//error message
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
		.': <b>'.$this->getVariableName().' is expected to have type '.$this->getExpectedType().' but it instead got '.$this->getExpectedType().'</b>';
		return $errorMsg;
	}
	public function getVariableName(){ return $this->var_name; }
	public function getExpectedType(){ return $this->expected_type; }
	public function getActualType(){ return $this->got_type; }
}
