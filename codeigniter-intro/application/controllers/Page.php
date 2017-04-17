<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller
{
    public function index() {
        $header = array(
            "title" => "Codeigniter Page"
        );

        $content = new Content("This is some data in body content", array("Clean House", "Call Mom", "Run Errands"));

        $this->load->view('shared/header', $header);
        $this->load->view('shared/menu');
        $this->load->view('content', $content);
        $this->load->view('shared/footer');
    }

    public function data_returned() {
        $string = $this->load->view("shared/menu", '', TRUE);
        echo $string;
    }
}

class Content {
    public $content;
    public $todo_list;

    public function __construct($content, $todo_list) {
        $this->content = $content;
        $this->todo_list = $todo_list;
    }
}