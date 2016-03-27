<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginReg extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){
		if(!$this->session->userdata('RegSuccess')){
			$this->session->set_userdata('RegSuccess', ' ');
		}
		$this->load->view('login');
	}
	public function login(){
	    $this->load->library("form_validation");
	    $this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required");
	    if($this->form_validation->run() === FALSE){
		     $this->session->set_userdata('errorsL', validation_errors());
		     $this->session->set_userdata('RegSuccess', ' ');
		     $this->session->set_userdata('errors', ' ');
		}
		else{   
	        $input = $this->input->post();
	        $this->load->model('User');
	        $logUser = $this->User->getUserByEmail($input['email']);
	        if($logUser && $logUser['password'] == $input['password']){
	        	$this->session->set_userdata('current', $logUser);
	            redirect('Pokes');
	        }
        }
	    redirect('/');
    }
    public function register(){
    	$this->load->library("form_validation");
    	$this->form_validation->set_rules("name", "Name", "trim|required");
		$this->form_validation->set_rules("alias", "Alias", "trim|required");
		$this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
		if($this->form_validation->run() === FALSE){
		     $this->session->set_userdata('errors', validation_errors());
		     $this->session->set_userdata('RegSuccess', ' ');
		}
		else{
    	$input = $this->input->post();
        $this->load->model("User");
        $addedUser = $this->User->addUser($input);
        if($addedUser === TRUE) {
            $this->session->set_userdata('RegSuccess', 'User Added!');
            $this->session->set_userdata('errors', ' ');
        }
    	}	
    	redirect('/');
    }
    public function logout(){
    	session_destroy();
    	redirect('/');
    }	
}
?>