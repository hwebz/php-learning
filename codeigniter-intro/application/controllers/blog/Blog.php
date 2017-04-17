<?php

class Blog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->model('blog_model');
    }

    public function index() {
        $data['query'] = $this->blog_model->get_last_ten_entries();

        $this->load->view('blog', $data);
    }

    public function entry($id) {

        $data['query'] = $this->blog_model->get_entry($id)[0];

        $this->load->view('blog_detail', $data);
    }
}