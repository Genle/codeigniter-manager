<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 23-Aug-16
 * Time: 2:51 PM
 */
class ListExpensesController extends CI_Controller
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
        $this->showExpenses();
    }

    public function showExpenses()
    {
        $data['title'] = 'Expenses';
        $data['id'] = 'expenses';
        $data['expenses_limit'] = $this->Expense->getAllExpenses();
        $this->load->view('expensesView', $data);
    }



}