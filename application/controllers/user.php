<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
	public function login()
	{
		$username = $this->input->get('username');
		$password = $this->input->get('password');
		if ($this->verify_login($username, $password)) {
			$this->session->set_userdata('idUser', $username);
            
            $this->load->model('role_model');
            $query = $this->role_model->get_role_of_user($username);
			$this->session->set_userdata('isAdmin', false);
            $this->session->set_userdata('isProgramChair', false);
			foreach ($query as $row)
			{
				if($row->idPosition == 1 & $row->idEvent == 1)
				$this->session->set_userdata('isAdmin', true);
                if($row->idPosition == 2)
                $this->session->set_userdata('isProgramChair', true);
			}
        }      
		else {
			$this->session->set_userdata('idUser', false);
            $this->session->set_userdata('isAdmin', false);
            $this->session->set_userdata('isProgramChair', false);
		}
		redirect('Home', 'index'); 
	}
	
	public function register_email()
	{
		$this->load->view('header');
		$this->load->view('user_registration_email');
	}
	
	public function register_form($email, $errors = null)
	{
		$this->load->model('organization_model');
		$this->load->model('department_model');
		$this->load->model('country_model');
		$data['email'] = $email;
		$data['organizations'] = $this->organization_model->get_all_organization();
		$data['departments'] = $this->department_model->get_all_department();
		$data['countries'] = $this->country_model->get_all_country();
		$this->load->view('header');
		$this->load->view('user_registration_form', $data);
	}
	
	public function register_new()
	{
		$this->load->model('user_model');
		$form = $this->input->post();
		if ($this->user_model->create_user($form['username'], $form['password'], $form['firstName'], $form['lastName'], $form['email'], (int)$form['country'], (int)$form['organization'], (int)$form['department'])) {
			$this->load->view('header');
			$this->load->view('user_registration_successful');
		}
		else {
			$this->load->view('header');
			$this->load->view('user_registration_error');
		}
	}
	
	public function logout()
	{
		$this->session->set_userdata('idUser', false);
        $this->session->set_userdata('isAdmin', false);
        $this->session->set_userdata('isProgramChair', false);
		redirect('Home', 'index');
	}
	
	private function verify_login($username, $password)
	{
		$this->load->model('user_model');
		$user = $this->user_model->get_user($username);
		if (!empty($user)) {
			if ($user[0]->password == $password)
				return true;
		}
		else return false;
	}
	
	public function validate_user_registration()
	{
		if (isset($_POST['username'])) {
			$this->load->model('user_model');
			$check = $this->user_model->get_user($_POST['username']);
			if (empty($check)) { echo 1; }
			else echo 0;
		}
	}
}