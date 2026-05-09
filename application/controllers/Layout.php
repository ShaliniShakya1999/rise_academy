<?php
if (!class_exists("My_Controller"))
    include_once APPPATH . 'core/My_Controller.php';

class Layout extends My_Controller
{
    function index()
    {
        $this->loadview("Website/index");
    }
 
}
