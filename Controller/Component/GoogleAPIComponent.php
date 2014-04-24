<?php

/**
 * Licensed under The GPL V3 License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @package       GoogleAPI.Controller.Component
 * @license       http://opensource.org/licenses/GPL-3.0 GPL V3 License
 */

App::uses('Component', 'Controller');
Configure::load('GoogleAPI.core');

class GoogleAPIComponent extends Component
{
	public $test = array(
		'test1' => 'test2'
	);
	
	public $settings = array();
	private $_default = array();
	
	public function __construct($collection, $settings = array()) {
		$this->settings = array_merge_recursive($this->_default, Configure::read('GoogleAPI') , $settings);
		
		$this->_new_Google_Client();
		
		debug($this->settings);
	}
	
	private function _new_Google_Client() {
		debug(App::import('Vendor', 'GoogleAPI.Client', array(
			'file' => 'GoogleAPI' . DS . 'src' . DS . 'Google' . DS . 'Client.php'
		)));
	}
	
}
