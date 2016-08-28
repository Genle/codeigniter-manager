<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 8/9/16
 * Time: 2:51 AM
 */
class ExpenseController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('Expense');
        $this->load->helper(array('form','url', 'assets', 'security'));
        $this->load->library('form_validation');

    }

    public function newExpense()
    {
        $this->form_validation->set_rules("place", "Place", "required");
        $this->form_validation->set_rules("description[]", "Description", "required");
        $this->form_validation->set_rules("price[]", "Price", "required");
        $this->form_validation->set_rules("date[]", "Date", "required");


        if($this->form_validation->run()) {
            $id = $this->Expense->checkPlace($this->input->post('place'));
            $number_of_elements = count($_POST['description']);
            if($id == false)
            {
                $this->Expense->addPlaceExpense($this->input->post('place'));
                $id = $this->Expense->checkPlace($this->input->post('place'));

            }

            for($i = 0; $i<$number_of_elements; $i++){
                $description = $this->input->post('description')[$i];
                $price = $this->input->post('price')[$i];
                $date = $this->input->post('date')[$i];
                $date_n = strtotime($date);
                $result = $this->Expense->addNewExpense($description, floatval($price),$id, date('d-m-y',$date_n));

                if(!$result){
                    $data['message'] = "One of this insert wasnt done successfully";
                    break;
                }
            }


            if(!isset($data['message']))
                $data['message'] = "New expense added Successfully";
            $data['title'] = 'Home';
            $data['id'] = 'home';
            $data['expenses_limit'] = $this->Expense->buildExpenseArray(5);
            $this->load->view('homeView', $data);

        }
        else
        {
            $data['message'] = "Error in input data";

            $data['title'] = 'Home';
            $data['id'] = 'home';
            $data['expenses_limit'] = $this->Expense->buildExpenseArray(5);
            $this->load->view('homeView', $data);

        }

    }



}