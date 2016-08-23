<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 8/12/16
 * Time: 11:34 PM
 */
class HomeController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Expense');
        $this->load->helper(array('form','url', 'assets', 'security'));
        $this->load->library('form_validation');
        $this->load->library('session');


    }

    public function index()
    {
        $this->showHomepage();
    }

    public function showHomepage()
    {
        $data['title'] = 'Home';
        $data['id'] = 'home';
        $data['expenses_limit'] = $this->Expense->buildExpenseArray(5);
//        var_dump($data['expenses_limit']);
        $this->load->view('homeView', $data);

    }


}