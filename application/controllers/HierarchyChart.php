<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HierarchyChart extends CI_Controller 
{
	public function __construct()
	{

	parent::__construct();
	$this->load->helper('url');
	$this->load->database();
	$this->load->library('session');
	$this->load->model('User_Model');
	
	}
	public function chart()
	{
		$userId= $this->session->userdata('id'); 
		// echo $userId;
		$result=$this->User_Model->get_treeLogin($userId);
		// echo json_encode($result,true);
		$result['data']=json_encode($result,true);
		$this->load->view('hierarchy_chart',$result);
	}
	public function search()
	{
		$data = $this->input->get('id');
		// echo $data;
		$result=$this->User_Model->get_tree_search($data);
		$result['data']=json_encode($result,true);
		$this->load->view('search_hierarchy_chart',$result);
	}
	public function register()
	{
	$this->load->view("register.php");
	}

	public function register_user(){

		$user=array(
		'username'=>$this->input->post('username'),
	
		'password'=>md5($this->input->post('password')),

		  );
		  print_r($user);
  
		$username_check=$this->User_Model->username_check($user['username']);
		
		if($username_check){
			$this->User_Model->register_user($user);
			$this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
			redirect('HierarchyChart/login_view');
		
		}
		else{
		
			$this->session->set_flashdata('error_msg', 'Error occured,Try again.');
			redirect('user');
  
  
  }
  
  }
  public function index(){

	$this->load->view("login.php");
	
	}
	
	function login_user(){ 
	  $user_login=array(
	
	  'username'=>$this->input->post('username'),
	  'password'=>md5($this->input->post('password'))); 
		
		$data['users']=	$this->User_Model->login_user($user_login['username'],$user_login['password']);
		$check =	json_encode(count($data['users']));
			if($check>0)
		  {
			  
			$this->session->set_userdata(array('username' => $this->input->post('username')));
		
			$this->session->set_userdata('id',$data['users'][0]['UserID']);
			// $this->load->view('hierarchy_chart');
			// $userId= $this->session->userdata('id'); 
			redirect('HierarchyChart/chart');
		  }else{
			redirect('HierarchyChart', 'refresh');

		  }
	
	}
	public function user_logout(){

		$this->session->sess_destroy();
		redirect('HierarchyChart', 'refresh');
	  }
		

}