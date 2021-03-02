<?php

   class Vrijeme {
	   
	   protected $_GradIme;
	   protected $_GradoviVrijeme = array();
	   
	   public function __construct($lokacija) {
		   
		   $this->_GradIme = $lokacija;
		   $this->prepareData();
	   }
	   
	  protected function prepareData() {
			
			$url = "https://vrijeme.hr/hrvatska_n.xml";
			$xmlstring = file_get_contents($url);
			$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
			
			$json = json_encode($xml);
			$array = json_decode($json, TRUE);
			
			if(is_array($array)) {
				
				$DatumTermin = $array["DatumTermin"];
				$Gradovi 	 = $array["Grad"];
				
				foreach($Gradovi as $key => $Grad) {
					
					$GradIme = $Grad["GradIme"];
					$Temp    = $Grad["Podatci"]["Temp"];
					$Tlak    = $Grad["Podatci"]["Tlak"];
					$Vlaga   = $Grad["Podatci"]["Vlaga"];
					$Vrijeme = $Grad["Podatci"]["Vrijeme"];
					$Lat     = $Grad["Lat"];
					$Lon     = $Grad["Lon"];
					
					$this->_GradoviVrijeme[$GradIme]["Temp"]    = $Temp;
					$this->_GradoviVrijeme[$GradIme]["Tlak"]    = $Tlak;
					$this->_GradoviVrijeme[$GradIme]["Vlaga"]   = $Vlaga;
					$this->_GradoviVrijeme[$GradIme]["Vrijeme"] = $Vrijeme;
					$this->_GradoviVrijeme[$GradIme]["Lat"]     = $Lat;
					$this->_GradoviVrijeme[$GradIme]["Lon"]     = $Lon;
				}
			}		
	   }
	   
	   public function getTemp() {
		   
		   if(isset($this->_GradoviVrijeme[$this->_GradIme])) {
			   
			   return $this->_GradoviVrijeme[$this->_GradIme]["Temp"];
		   }
		   
		   return false;
	   }
   }
   