<?php

class VrijemeNew extends Vrijeme {
	
	public function __construct($lokacija) {
		
		parent::__construct($lokacija);
	}
	
	
	public function getTlak() {
	
		if(isset($this->_GradoviVrijeme[$this->_GradIme])) {
			   
			   return $this->_GradoviVrijeme[$this->_GradIme]["Tlak"];
		   }
		   
		   return false;
	}
	
	public function getVlaga() {
		   
		   if(isset($this->_GradoviVrijeme[$this->_GradIme])) {
			   
			   return $this->_GradoviVrijeme[$this->_GradIme]["Vlaga"];
		   }
		   
		   return false;
	   }
	 
	public function getVrijeme() {
		   
		   if(isset($this->_GradoviVrijeme[$this->_GradIme])) {
			   
			   return $this->_GradoviVrijeme[$this->_GradIme]["Vrijeme"];
		   }
		   
		   return false;
	   }
	
	public function getCoordinates() {
		   
		   if(isset($this->_GradoviVrijeme[$this->_GradIme])) {
			   
			   return array($this->_GradoviVrijeme[$this->_GradIme]["Lat"], $this->_GradoviVrijeme[$this->_GradIme]["Lon"]);
		   }
		   
		   return false;
	   }
}