<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paper extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('paper_model');
	}
	public function submitPaper($eventId)
	{	
		$this->load->model('event_model');
		$query['events'] = $this->event_model->get_all_event();
		
		if($eventId != 0){
			$this->load->model('eventTopic_model');
			$this->load->model('topic_model');
			
			$query['eventTopic'] = $this->eventTopic_model->get_eventTopic($eventId);
			$query['topics'] = $this->topic_model->get_all_topic();
			$query['eventId'] = $eventId;
			$event = $this->event_model->get_event($eventId);
			$query['eventName'] = $event[0]->eventName;
		}
		
		$username = $this->session->userdata('idUser');
		if ($username) {
			$this->load->view('header');
			$this->load->view('submit_new_paper', $query);
		}
		else {
			$errors['errorMessages'] = array("Sorry but you have to be logged in to submit papers");
			$this->load->view('header', $errors);
			$this->load->view('home_page');
		}
	}

	public function submit()
	{	
		$this->load->model('event_model');
		$query['events'] = $this->event_model->get_all_event();
		
		$username = $this->session->userdata('idUser');
		if ($username) {
			$this->load->view('header');
			$this->load->view('submit_new_paper', $query);
		}
		else {
			$errors['errorMessages'] = array("Sorry but you have to be logged in to submit papers");
			$this->load->view('header', $errors);
			$this->load->view('home_page');
		}
	}
	
	public function submittedPapers()
	{
		$username = $this->session->userdata('idUser');
		if ($username) {
			$query['papers'] = $this->paper_model->get_paper_by_user($username);
			$this->load->view('header');
			$this->load->view('submitted_papers', $query);
		}
		else {
			$errors['errorMessages'] = array("Sorry but you have to be logged in to submit papers");
			$this->load->view('header', $errors);
			$this->load->view('home_page');
		}
	}

	public function search()
	{
		$this->load->view('header');
		$this->load->view('search_papers');
	}
    
    	public function paperReview()
	{
		$this->load->view('header');
		$this->load->view('paper_review');
	}
    
   	public function detailedPaperReview()
	{
		$this->load->view('header');
		$this->load->view('detailed_paper_review');
	}

	public function submitted()
	{
		$this->load->model('paperTopics_model');
		$username = $this->session->userdata('idUser');
		if ($username) {
			$title = $this->input->get('title');
			$abstract = $this->input->get('abstract');
			$document = $this->input->get('file');
			$keywords = $this->input->get('keywords');
			$subjects = $this->input->get('subjects');
			$submittedby = $username;
			
			$this->paper_model->create_paper($title, $abstract, $submittedby, $document, $keywords);
			$idpaper = mysql_insert_id();
			
			print $subjects[0];
			//die();
			for ($i = 0; $i < count($subjects); $i++) {
    			$this->paperTopics_model->create_paperTopics($idpaper, $subjects[$i]);
			}
			
			$this->load->view('header');
			$this->load->view('paper_submitted_successfully');
		}
		else {
			$errors['errorMessages'] = array("Sorry but you have to be logged in to submit papers");
			$this->load->view('header', $errors);
			$this->load->view('home_page');
		}
	}

	public function getSearchDetails()
	{
		$event = $this->input->get('event');
		$author = $this->input->get('author');
		$keywords = $this->input->get('keywords');
		$title = $this->input->get('title');
	}	

}