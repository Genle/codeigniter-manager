<?php
if( !defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: shadowx
 * Date: 8/5/16
 * Time: 8:42 PM
 */
class UserController extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        $this->load->database();
        $this->load->model('User');
        $this->load->model('Expense');
        $this->load->helper(array('form','url', 'assets', 'security'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->output->enable_profiler(true);


    }

    public function index()
    {
        $this->load->view('loginView');
    }

    public function userRegistration()
    {
        $this->load->view('registrationView');
    }

    public function newUserRegistration()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[3]|max_length[25]|alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[25]');

        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->User->addUser($username, $password);
            if($result)
            {
                $data['message'] = "Registration Successfully";
                $this->load->view('loginView', $data);
            }
            else
            {
                $data['message'] = "Username already exist";
                $this->load->view('registrationView', $data);
            }

        }

    }

    public function userLoginProcess()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[3]|max_length[25]|alpha_dash');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[25]');




        if($this->form_validation->run())
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $result = $this->User->userExist($username, $password);


            if($result)
            {
                $result = $this->User->getUserInformation($username);
                $session_data = array(
                    'id'=>$result[0]->id,
                    'username'=>$result[0]->username,
                    'password'=>$result[0]->password,
                    'last_login' => $result[0]->lastLogin,
                    'number_of_login' => $result[0]->numberOfLogin,

                );


                $this->session->set_userdata('logged_in',$session_data);
                header("Location: ".base_url("index.php/HomeController/showHomepage"));

            }
            else
            {
                $data = array('message' => 'Invalid username and password');
                $this->load->view('loginView', $data);
            }

        }
        else
        {
            $data = array('message' => 'form validation has failed');
            $this->load->view('loginView', $data);
        }


    }


    public  function logout()
    {
        $this->session->unset_userdata('logged_in');
        $data['message'] = "Successfull logout";
        $this->load->view('loginView', $data);
    }
}