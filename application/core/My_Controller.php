<?php

class My_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

   
    function loadview($view, $data = [])
    {
        
        $this->load->view("layout", compact("view", "data"));
    }
}