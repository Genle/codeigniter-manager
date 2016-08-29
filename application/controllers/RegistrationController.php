<?php

/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 8/28/16
 * Time: 2:33 PM
 */
class registrationController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->model('User');
        $this->load->helper(array('form','url', 'assets', 'security'));
        $this->load->library('form_validation');
    }


    public function addNewUser()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[3]|max_length[25]|alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[25]');
        $this->form_validation->set_rules('repeat-password', 'Repeated-Password', 'trim|required|min_length[6]|max_length[25]');


        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $repeat_password  = $this->input->post('repeat-password');

            if($password != $repeat_password){
                $data['message'] = "password and repeated password are differents";
                $this->load->view("registrationView", $data);

            }

            $result = $this->User->addUser($username,$password);

            if($result)
            {
                $data['message'] = "New user has been added successfully click on the login link below";
                $this->load->view('registrationView', $data);

            }
            else{
                $data['message'] = "New user hasn't been inserted";
                $this->load->view('registrationView', $data);

            }



        }
        else{

            $data['message'] = "Please fill the field with correct data";
            $this->load->view('registrationView', $data);

        }



    }


}