<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		
	}
	public function index(){
		//load session library
		$this->load->library('session');

		//restrict users to go back to login if session has been set
		if($this->session->userdata('admin')){
			redirect('User/home');
		}
		else{
			$this->load->view('login_page');
		}
	}
	public function login(){
		$this->load->library('session');

		$output = array('error' => false);

		$username = $_POST['username'];
		$password = $_POST['password'];

		$data = $this->user_model->login($username, $password);

		if($data){
			$this->session->set_userdata('admin', $data);
			$output['message'] = 'Logging in. Please wait...';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Login Invalid. User not found';
		}

		echo json_encode($output);
	}
	public function logout(){
		//load session library
		$this->load->library('session');
		$this->session->unset_userdata('admin');
		redirect('/User');
	}
	public function home(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('dashboard');
		}
		else{
			redirect('/User');
		}
		
	}
	public function new_month(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('newmonth');
		}
		else{
			redirect('/User');
		}
		
	}
		public function new_year(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('newyear');
		}
		else{
			redirect('/User');
		}
		
	}
		public function add_user(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('adduser');
		}
		else{
			redirect('/User');
		}
		
	}
	
		public function show_user(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('userlist');
		}
		else{
			redirect('/User');
		}
		
	}

public function insert_user(){
		$user['username'] = $this->input->post('username');
		$user['password'] = $this->input->post('password');
		$user['role'] = $this->input->post('role');
		$query = $this->user_model->insert_user($user);
	}	
public function getuser(){
		$id = $this->input->post('userid');
		$data = $this->user_model->get_user($id);
		echo json_encode($data);
	}
	
	


	public function delete_user(){
		$userid = $this->input->post('userid');
		$query = $this->user_model->users_del($userid);
	}

	public function delete_payment(){
		$id = $this->input->post('id');
		$query = $this->user_model->payment_del($id);
	}	
	
//STUDENT SECTION
	public function add_student(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('addstudent');
		}
		else{
			redirect('/User');
		}
		}
		public function show_students(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('studentlist');
		}
		else{
			redirect('/User');
		}
		}
		public function print_statement(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('print_stat');
		}
		else{
			redirect('/User');
		}
		}
		public function audit_trail(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('audit');
		}
		else{
			redirect('/User');
		}
		}
		public function new_term(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('newterm');
		}
		else{
			redirect('/User');
		}
		}
		public function insert_student(){
		$student['name'] = $this->input->post('name');
		$student['surname'] = $this->input->post('surname');
		$student['sibling'] = $this->input->post('sibling');
		$student['idnu'] = $this->input->post('idnu');
		$student['kin1'] = $this->input->post('kin');
		$student['kin'] = $this->input->post('kin1');
		$student['phone1'] = $this->input->post('phone1');
		$student['phone'] = $this->input->post('phone');
		$student['address1'] = $this->input->post('address1');
		$student['address'] = $this->input->post('address');
		$student['email'] = $this->input->post('email');
		$student['whatsapp1'] = $this->input->post('whatsapp1');
		$student['whatsapp'] = $this->input->post('whatsapp');
		$student['email1'] = $this->input->post('email1');
		$student['datejoined'] = $this->input->post('datejoined');
		$student['grade'] = $this->input->post('grade');
		$student['status'] = $this->input->post('status');
		$student['balance'] = $this->input->post('balance');
		$student['amount'] = $this->input->post('amount');
		$student['period'] = $this->input->post('period');
		$student['type'] = $this->input->post('type');
		$student['gender'] = $this->input->post('gender');
		$student['boarding'] = $this->input->post('boarding');
		$student['dob'] = $this->input->post('dob');
		$student['notify'] = $this->input->post('notify');
		$query = $this->user_model->insert_student($student);
	}		
	public function getstudent() {
		$id = $this->input->post('id');
		$data = $this->user_model->get_student($id);
		echo json_encode($data);
		}
		public function getallstudent() {
		$data = $this->user_model->show_students();
		echo json_encode($data);
		}
		
		//FOR VIEWING PAYMENT STATEMENT
		public function get_pay() {
		$id = $this->input->post('id');
		$data = $this->user_model->show_studentspay($id);
		echo json_encode($data);
		}
		public function get_fee() {
		$id = $this->input->post('id');
		$data = $this->user_model->show_studentfee($id);
		echo json_encode($data);
		}
	//FOR VIEWING SINGLE PAYMENT INFO
	public function get_studpay() {
		$id = $this->input->post('id');
		$data = $this->user_model->get_studentpayy($id);
		echo json_encode($data);
		}
	//UPDATING STUDENT DETAILS
	public function update_student(){
		$id = $this->input->post('id');
		$student['name'] = $this->input->post('name');
		$student['idnu'] = $this->input->post('idnu');
		$student['kin'] = $this->input->post('kin');
		$student['phone'] = $this->input->post('phone');
		$student['address'] = $this->input->post('address');
		$student['email'] = $this->input->post('email');
		$student['datejoined'] = $this->input->post('datejoined');
		$student['grade'] = $this->input->post('grade');
		$student['status'] = $this->input->post('status');
		$student['balance'] = $this->input->post('balance');
		$student['amount'] = $this->input->post('amount');
		$student['period'] = $this->input->post('period');
		$student['type'] = $this->input->post('type');
		$student['gender'] = $this->input->post('gender');
		$student['dob'] = $this->input->post('dob');
		$query = $this->user_model->updatestudent($student,$id);
	}
	public function send_paymail() { 
         $from_email = "psmawarire@gmail.com"; 
         $to_email = $this->input->post('email'); 
   
         //Load email library 
         $this->load->library('email'); 
   
         $this->email->from($from_email, 'Your Name'); 
         $this->email->to($to_email);
         $this->email->subject('Email Test'); 
         $this->email->message('Testing the email class.'); 
   
         //Send mail 
         if($this->email->send()) 
         $this->session->set_flashdata("email_sent","Email sent successfully."); 
         else 
         $this->session->set_flashdata("email_sent","Error in sending Email."); 
         $this->load->view('email_form'); 
      } 
 
	public function fees_statement(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('stud_statement');
		}
		else{
			redirect('/User');
		}
		}	
	
	//UPDATING STUDENT BALANCE AFTER MAKING PAYMENT
	public function update_studentpay(){
		$id = $this->input->post('id');
		$student['balance'] = $this->input->post('balance');
		$query = $this->user_model->updatestudentpay($student,$id);
		
	}
	//UPDATING STUDENT GRADE
	public function update_grades(){
		$id = $this->input->post('id');
		$student['grade'] = $this->input->post('grade');
		$query = $this->user_model->update_grade($student,$id);
		
	}
	//UPDATING STUDENT STATIONERY AT THE BEGINING OF THE TERM
	public function update_studentstat(){
		$id = $this->input->post('id');
		$student['stationery'] = $this->input->post('stationery');
		$query = $this->user_model->updatestudentsta($student,$id);
		
	}
	//UPDATE USER DETAILS
	public function update_user(){
		$id = $this->input->post('userid');
		$user['username'] = $this->input->post('username');
		$user['password'] = $this->input->post('password');
		$user['role'] = $this->input->post('role');
		$query = $this->user_model->updateuser($user,$id);
	}
		
	public function update_studentsup(){
		$id = $this->input->post('id');
		$student['stationery'] = $this->input->post('stationery');
		$query = $this->user_model->updatestudent($student,$id);
	}
	
	public function delete_student(){
		$id = $this->input->post('id');
		$query = $this->user_model->student_del($id);
	}
	
	//PAYMENT PLANS SECTION
	public function add_paymentplan(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('addpaymentplan');
		}
		else{
			redirect('/User');
		}
		}
		public function show_paymentplans(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('paymentplanlist');
		}
		else{
			redirect('/User');
		}
		}
		public function insert_studentfee(){
			
		$studentfees['studentid'] = $this->input->post('studentid');
		//$studentfees['year'] = $this->input->post('year');
		$studentfees['disc'] = $this->input->post('disc');
		$studentfees['fees'] = $this->input->post('fees');
		$studentfees['datereceipt'] = $this->input->post('datereceipt');
		
		$query = $this->user_model->insert_studentfees($studentfees);
	}	
	public function insert_paymentplans(){
		$paymentplans['studentid'] = $this->input->post('studentid');
		$paymentplans['studentname'] = $this->input->post('studentname');
		$paymentplans['duedate'] = $this->input->post('duedate');
		$paymentplans['amount'] = $this->input->post('amount');
		$paymentplans['date'] = $this->input->post('date');
		$paymentplans['balance'] = $this->input->post('balance');
		$query = $this->user_model->insert_paymentplans($paymentplans);
	}	
	
	public function getpaymentplans() {
		$id = $this->input->post('id');
		$data = $this->user_model->get_paymentplans($id);
		echo json_encode($data);
		}
	
		//DELETE A PAYMENT PLAN
	public function delete_paymentplan(){
		$id = $this->input->post('id');
		$query = $this->user_model->paymentplans_del($id);
	}
	
	//UPDATING PAYMENT PLANS
	public function update_paymentplans(){
		$id = $this->input->post('id');
		$paymentplans['studentid'] = $this->input->post('studentid');
		$paymentplans['studentname'] = $this->input->post('studentname');
		$paymentplans['duedate'] = $this->input->post('duedate');
		$paymentplans['amount'] = $this->input->post('amount');
		$paymentplans['date'] = $this->input->post('date');
		$paymentplans['balance'] = $this->input->post('balance');
		$paymentplans['amountpaid'] = $this->input->post('amountpaid');
		$paymentplans['datepaid'] = $this->input->post('datepaid');
		$query = $this->user_model->updatepaymentplans($paymentplans,$id);
	}
	
	//PAYMENT SECTION

public function add_payments(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('addpayments');
		}
		else{
			redirect('/User');
		}
		}
	public function show_payments(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('paymentlist');
		}
		else{
			redirect('/User');
		}
		}

	public function insert_pay() {
		$payments['studentid'] = $this->input->post('studentid');
		$payments['studentname'] = $this->input->post('studentname');
		$payments['datepaid'] = $this->input->post('datepaid');
		$payments['amount'] = $this->input->post('amount');
		$payments['methods'] = $this->input->post('methods');
		$payments['receipt'] = $this->input->post('reciept');
		$payments['userid'] = $this->input->post('userid');
		$payments['bf'] = $this->input->post('bf');
		$payments['datereceipt'] = $this->input->post('datereciept');
		//echo json_encode($payments);
		$query = $this->user_model->insert_payments($payments);
		
	}
	
	public function getpayments() {
		$id = $this->input->post('id');
		$data = $this->user_model->get_payments($id);
		echo json_encode($data);
	}
	
	public function update_payments(){
		$id = $this->input->post('id');
		$payments['studentid'] = $this->input->post('studentid');
		$payments['datepaid'] = $this->input->post('datepaid');
		$payments['amount'] = $this->input->post('amount');
		$payments['method'] = $this->input->post('methods');
		$payments['reciept'] = $this->input->post('reciept');
		$payments['userid'] = $this->input->post('userid');
		$payments['bf'] = $this->input->post('bf');
		$payments['datereciept'] = $this->input->post('datereciept');
		$query = $this->user_model->updatepayments($payments,$id);
	}
	
	//STATIONERY SECTION
public function add_stationery(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('addstationery');
		}
		else{
			redirect('/User');
		}
		}
public function show_stationery(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('stationerylist');
		}
		else{
			redirect('/User');
		}
		}

	public function insert_stationery(){
		$stationery['studentid'] = $this->input->post('studentid');
		$stationery['year'] = $this->input->post('year');
		$stationery['term'] = $this->input->post('term');
		$stationery['name'] = $this->input->post('name');
		$stationery['quantity'] = $this->input->post('quantity');
		$query = $this->user_model->insert_stationery($stationery);
		
	}
	//DELETE A PAYMENT PLAN
	public function delete_stationery(){
		$id = $this->input->post('id');
		$query = $this->user_model->stationery_del($id);
	}

	public function getstationery() {
		$id = $this->input->post('id');
		$data = $this->user_model->get_stationery($id);
		echo json_encode($data);
		}
	
	public function update_stationery(){
		$id = $this->input->post('id');
		$stationery['year'] = $this->input->post('year');
		$stationery['term'] = $this->input->post('term');
		$stationery['name'] = $this->input->post('name');
		$stationery['quantity'] = $this->input->post('quantity');
		$query = $this->user_model->update_stationery($stationery,$id);
	}
	
	//UPDATING STUDENT STATIONERY BALANCES AFTER ADDING NEW STATIONERY
		public function update_stat(){
		//$id = $this->input->post('id');
		$quantity = $this->input->post('quantity');
		$query = $this->user_model->updatestudentstat($quantity);
		
	}
	
	
	
	//STATIONARY SUPPLIED SECTION
public function add_stat_sup(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('addstat_sup');
		}
		else{
			redirect('/User');
		}
		}
		public function show_stat_sup(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('stat_suplist');
		}
		else{
			redirect('/User');
		}
		}

	public function insert_stat_sup(){
		$stat_sup['student_id'] = $this->input->post('studentid');
		$stat_sup['studentname'] = $this->input->post('studentname');
		$stat_sup['balance'] = $this->input->post('balance');
		$stat_sup['qty'] = $this->input->post('qty');
		$stat_sup['date'] = $this->input->post('date');
		$stat_sup['receiver'] = $this->input->post('receiver');
		$query = $this->user_model->insert_stat_sup($stat_sup);
	}
	
	public function getstat_sup() {
		$id = $this->input->post('id');
		$data = $this->user_model->get_stat_sup($id);
		echo json_encode($data);
		}
		
	public function update_stat_sup(){
		$id = $this->input->post('id');
		$stat_sup['studentid'] = $this->input->post('studentid');
		$stat_sup['year'] = $this->input->post('year');
		$stat_sup['term'] = $this->input->post('term');
		$stat_sup['name'] = $this->input->post('name');
		$stat_sup['qty'] = $this->input->post('qty');
		$stat_sup['date'] = $this->input->post('date');
		
	}
	
	// report section herer
	public function due_plans()
{

	
}
	// report section
		public function out_fee(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('outstanding');
		}
		else{
			redirect('/User');
		}
		}
			public function out_stat(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('outstationery');
		}
		else{
			redirect('/User');
		}
		}
			public function plan_report(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('planreport');
		}
		else{
			redirect('/User');
		}
		}
				public function collected_fee(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('collectedfee');
		}
		else{
			redirect('/User');
		}
		}
				public function total_owing(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('totalowing');
		}
		else{
			redirect('/User');
		}
		}
				public function owing_per(){
			//load session library
		$this->load->library('session');

		//restrict users to go to home if not logged in
		if($this->session->userdata('admin')){
			$this->load->view('owingpergrade');
		}
		else{
			redirect('/User');
		}
		}
		// audit trial here
		public function insert_log(){
		$log['activity'] = $this->input->post('activity');
		$log['user'] = $this->input->post('user');
		$log['date'] = $this->input->post('date');
		$log['time'] = $this->input->post('time');
		$log['studentid'] = $this->input->post('studentid');
		$query = $this->user_model->insert_log($log);
	}

}
