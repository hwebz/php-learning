<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view("welcome_message");
	}

	public function greet() {
	    echo "Hello user!";
    }

    public function buy($sandals, $id) {
	    echo "ID: $id, Name: $sandals";
    }

    /*public function _remap($method, $params = array()) {
	    if ($method === 'buy') {
            $this->buy($params);
        }
        $this->index();
    }*/

    public function _remap($method, $params = array()) {
	    if (method_exists($this, $method)) {
	        return call_user_func_array(array($this, $method), $params);
        }
        show_404();
    }

    /*public function _output($output) {
	    echo $output;

        if ($this->output->cache_expiration > 0) {
            $this->output->_write_cache($output);
        }
    }*/

    // Private methods
    private function _utility() {
        echo "utility method";
    }
}
