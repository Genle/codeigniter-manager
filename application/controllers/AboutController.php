<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 23-Aug-16
 * Time: 3:10 PM
 */
class AboutController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Expense');
        $this->load->helper(array('form','url', 'assets', 'security'));
        $this->load->library('session');

    }

    public function index()
    {
        $this->showAbout();
    }

    public function showAbout()
    {
        $data['title'] = 'About';
        $data['id'] = 'about';
        $this->load->view('aboutView', $data);
    }

}