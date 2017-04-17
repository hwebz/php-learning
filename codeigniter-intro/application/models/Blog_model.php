<?php

class Blog_model extends CI_Model
{
    public $title;
    public $content;
    public $date;

    public function __construct() {
        parent::__construct();
        // Your own constructor code
        $this->load->database();
    }

    public function get_last_ten_entries() {
        $query = $this->db->get('entries', 10);
        return $query->result();
    }

    public function get_entry($id) {
        $query = $this->db->get_where("entries", array("id" => $id));
        return $query->result();
    }

    public function insert_entry() {
        $this->title = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date = time();

        $this->db->insert('entries', $this);
    }

    public function update_entry() {
        $this->title = $_POST['title'];
        $this->content = $_POST['content'];
        $this->date = time();

        $this->db->update('entries', $this, array('id' => $_POST['id']));
    }
}