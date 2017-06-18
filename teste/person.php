<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of person
 *
 * @author Danilo
 */
class person {
    var $name; 
		function set_name($new_name) { 
			$this->name = $new_name;  
 		}
 
   		function get_name() {
			return $this->name;
		}
}
