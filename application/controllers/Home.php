<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->model('learning/Internship_model', 'internship_model');
        $this->load->view('website/landing_standalone', [
            'page_title' => 'Internmo  -  Welcome',
            'internships' => $this->internship_model->active(4)
        ]);
    }
}
