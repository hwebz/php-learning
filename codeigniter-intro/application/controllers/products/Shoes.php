<?php

class Shoes extends CI_Controller
{

    public function __construct() {
        parent::__construct();
        // Own code
    }

    public function index() {
        echo is_php('5.6.16');
        echo "Shoes index page";
    }

    public function show($id) {
        echo "Shoes ID: $id";
    }
}