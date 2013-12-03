<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
        $this->load->model('country_model');
        $this->load->model('department_model');
        $this->load->model('organization_model');
        $this->load->model('topic_model');
        $this->load->model('topicHierarchy_model');
        $this->load->model('interestInTopic_model');
        $this->load->model('expertInTopic_model');
	}
    
	public function manageUsers()
    {     
        $this->load->view('header');
        $param['users'] = $this->user_model->get_all_users();
        $this->load->view('manage_user', $param);
    }
    
    public function editUser()
    {

        $this->load->view('header');
        $param['topic'] = $this->topic_model->get_all_topic();
        
        $topicParents = $this->topicHierarchy_model->get_all_topicHierarchy();
        $hierarchy = array();
        foreach($topicParents as $parent){
            array_push($hierarchy, array('idTopic' => $parent->idTopic, 'idTopicHierarchy' =>$parent->idTopicHierarchy));
        }
        
        $tree = array();
        foreach($param['topic'] as $topic){
            if($this->isParent($topic->idTopic, $topicParents)){
                array_push($tree, $this->constructHierarchy($hierarchy, $topic->idTopic));
            }
        }
        $param['hierarchy'] = "";
        foreach($tree as $parent){
           $param['hierarchy'] .= $this->displayTree($parent, $topicParents);
        }
        
        $UserID = $this->input->get("id");
        
        $param['interest'] = $this->interestInTopic_model->get_interestInTopic_of_user($UserID);
        $param['expert'] = $this->expertInTopic_model->get_expertInTopic_of_user($UserID);
        $param['users'] = $this->user_model->get_user($UserID);
        $param['country'] = $this->country_model->get_all_country();
        $param['department'] = $this->department_model->get_all_department();
        $param['organization'] = $this->organization_model->get_all_organization();
        $this->load->view('edit_user', $param);
    }
    function isParent($topic, $topicHierarchy){
        foreach($topicHierarchy as $relation){
            if($relation->idTopic == $topic)
                return false;
        }
        return true;
    }
    function displayTree($parent,$topicParents,$str=""){    
        foreach($parent as $key => $value){
            if($key === "id"){
                if( $this->isParent($parent["id"], $topicParents)){
                    $str = $str ."&". $parent["id"];
                } else {
                    $str = $str . $parent["id"];
                }
            }
            if($key !== "id"){
                $str = $str . "["; 
                $str = $this->displayTree($value, $topicParents, $str);
                $str = $str . "]";                
            }
        }
        return $str;
    }
    
    function constructHierarchy(array $hierarchyData, $parentId) {
        $hierarchy = array("id" => $parentId);
        foreach ($hierarchyData as $relation) {
            if ($relation['idTopicHierarchy'] == $parentId) {
                $child = array("id"=>$relation['idTopic']);
                $children = $this->constructHierarchyNoParent($hierarchyData, $relation['idTopic']);
                if ($children) {
                    $child[] = $children;
                }
                    $hierarchy[] = $child;
            }
        }
        //print_r($hierarchy);
        return $hierarchy;
    }
    function constructHierarchyNoParent(array $hierarchyData, $parentId = 1) {
        $hierarchy = array();
        foreach ($hierarchyData as $relation) {
            if ($relation['idTopicHierarchy'] == $parentId) {
                $child = array("id"=>$relation['idTopic']);
                $children = $this->constructHierarchyNoParent($hierarchyData, $relation['idTopic']);
                if ($children) {
                    $child[] = $children;
                }
                    $hierarchy[] = $child;
            }
        }
        return $hierarchy;
    }
   
    public function updateUser()
    {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $country = $_POST['country'];
        $organization = $_POST['organization'];
        $department = $_POST['department'];
        $interests = $_POST['interest'];
        $experts = $_POST['expert'];
        

        $oldInterests =  $this->interestInTopic_model->get_interestInTopic_of_user($username);
        $oldExperts = $this->expertInTopic_model->get_expertInTopic_of_user($username);
        
        $this->user_model->update_user($username, $password, $firstname, $lastname, $email, $country, $organization, $department);
        
        foreach($oldExperts as $oldE){
            $delete = true;
            foreach($experts as $key => $e){
                if($e == $oldE->idTopic){
                    $delete = false;
                    unset($experts[$key]);
                }
            }
            if($delete){
                $this->expertInTopic_model->delete_expertInTopic($username, $oldE->idTopic);
            }
        }
        foreach($oldInterests as $oldI){
            $delete = true;
            foreach($interests as $key => $i){
                if($i == $oldI->idTopic){
                    $delete = false;
                    unset($interests[$key]);
                }
            }
            if($delete){
                $this->interestInTopic_model->delete_interestInTopic($username, $oldI->idTopic);
            }
        }
        
        foreach($interests as $i){
            $this->interestInTopic_model->create_interestInTopic($username, $i);
        }
        
        foreach($experts as $e){
            $this->expertInTopic_model->create_expertInTopic($username, $e);
        }
        
        $param['topic'] = $this->topic_model->get_all_topic();
        
        $topicParents = $this->topicHierarchy_model->get_all_topicHierarchy();
        $hierarchy = array();
        foreach($topicParents as $parent){
            array_push($hierarchy, array('idTopic' => $parent->idTopic, 'idTopicHierarchy' =>$parent->idTopicHierarchy));
        }
        
        $tree = array();
        foreach($param['topic'] as $topic){
            if($this->isParent($topic->idTopic, $topicParents)){
                array_push($tree, $this->constructHierarchy($hierarchy, $topic->idTopic));
            }
        }
        $param['hierarchy'] = "";
        foreach($tree as $parent){
           $param['hierarchy'] .= $this->displayTree($parent, $topicParents);
        }
        $param['interest'] = $this->interestInTopic_model->get_interestInTopic_of_user($username);
        $param['expert'] = $this->expertInTopic_model->get_expertInTopic_of_user($username);
        $param['successMessages'][0] = "The user has been successfully updated.";
		$this->load->view('header', $param);
        $param['users'] = $this->user_model->get_user($username);
        $param['country'] = $this->country_model->get_all_country();
        $param['department'] = $this->department_model->get_all_department();
        $param['organization'] = $this->organization_model->get_all_organization();
        $this->load->view('edit_user', $param);	
    }
	
}