<?php

namespace App\Exceptions;

class DuplicatedException extends \Exception{
    public function __construct($class_name, $property_name){
        if(!is_string($class_name)) {
			throw new TypeException("TypeException's VariableName", "string", gettype($var_name));
		}
        if(!is_string($property_name)) {
			throw new TypeException("TypeException's ExpectedType", "string", gettype($expected_type));
		}
        $this->class_name = $class_name;
        $this->property_name = $property_name;
		parent::__construct($this->errorMessage());
    }
	public function errorMessage() {
	//error message
		$errorMsg = "There is another ".$this->getClassName()." with the same ".$this->getPropertyName()." already in the database.";
		return $errorMsg;
	}
	public function getClassName(){ return $this->class_name; }
	public function getPropertyName(){ return $this->property_name; }
}
