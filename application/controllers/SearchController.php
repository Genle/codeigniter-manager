<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 23-Aug-16
 * Time: 3:02 PM
 */
class SearchController extends CI_Controller
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
        $this->showSearch();
    }

    public function showSearch()
    {
        $data['title'] = 'Search-expense';
        $data['id'] = 'search';
//        $data['expenses_limit'] = $this->Expense->buildExpenseArray(5);
        $this->load->view('searchView', $data);
    }

}