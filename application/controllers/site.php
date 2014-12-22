<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
        $data[ 'facebook' ] = false;
        $data[ 'twitter' ] = false;
        $facebook = $this->hybridauthlib->authenticate("Facebook");
        $twitter = $this->hybridauthlib->authenticate("Twitter");
        if ($facebook->isUserConnected())
        {
            $data[ 'facebook' ] = true;
        }
        if ($twitter->isUserConnected())
        {
            $data[ 'twitter' ] = true;
        }
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'sex' ] =$this->user_model->getsexdropdown();
		$data[ 'college' ] =$this->college_model->getcollegedropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
//		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('contact','contact','trim');
		$this->form_validation->set_rules('facebookid','facebookid','trim');
		$this->form_validation->set_rules('twitterid','twitterid','trim');
		$this->form_validation->set_rules('instagramid','instagramid','trim');
		$this->form_validation->set_rules('dob','dob','trim');
		$this->form_validation->set_rules('sex','sex','trim');
		$this->form_validation->set_rules('college','college','trim');
//		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'sex' ] =$this->user_model->getsexdropdown();
            $data[ 'college' ] =$this->college_model->getcollegedropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
    //        $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );		
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
//            $status=$this->input->post('status');
            $contact=$this->input->post('contact');
            $facebookid=$this->input->post('facebookid');
            $twitterid=$this->input->post('twitterid');
            $instagramid=$this->input->post('instagramid');
            $dob=$this->input->post('dob');
            $sex=$this->input->post('sex');
            $college=$this->input->post('college');
            
			if($dob != "")
			{
				$dob = date("Y-m-d",strtotime($dob));
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$contact,$facebookid,$twitterid,$instagramid,$dob,$sex,$college)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`contact`";
        $elements[3]->sort="1";
        $elements[3]->header="Contact";
        $elements[3]->alias="contact";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`user`.`timestamp`";
        $elements[4]->sort="1";
        $elements[4]->header="Timestamp";
        $elements[4]->alias="timestamp";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`dob`";
        $elements[5]->sort="1";
        $elements[5]->header="Dob";
        $elements[5]->alias="dob";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`user`.`facebookid`";
        $elements[7]->sort="1";
        $elements[7]->header="Facebookid";
        $elements[7]->alias="facebookid";
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`twitterid`";
        $elements[8]->sort="1";
        $elements[8]->header="twitterid";
        $elements[8]->alias="twitterid";
       
        $elements[9]=new stdClass();
        $elements[9]->field="`user`.`instagramid`";
        $elements[9]->sort="1";
        $elements[9]->header="instagramid";
        $elements[9]->alias="instagramid";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` ");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data[ 'sex' ] =$this->user_model->getsexdropdown();
		$data[ 'college' ] =$this->college_model->getcollegedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
//		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('contact','contact','trim');
        
		$this->form_validation->set_rules('facebookid','facebookid','trim');
		$this->form_validation->set_rules('twitterid','twitterid','trim');
		$this->form_validation->set_rules('instagramid','instagramid','trim');
		$this->form_validation->set_rules('dob','dob','trim');
		$this->form_validation->set_rules('sex','sex','trim');
		$this->form_validation->set_rules('college','college','trim');
        
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'sex' ] =$this->user_model->getsexdropdown();
            $data[ 'college' ] =$this->college_model->getcollegedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
//            $status=$this->input->get_post('status');
            $contact=$this->input->get_post('contact');
            
            $facebookid=$this->input->post('facebookid');
            $twitterid=$this->input->post('twitterid');
            $instagramid=$this->input->post('instagramid');
            $dob=$this->input->post('dob');
            $sex=$this->input->post('sex');
            $college=$this->input->post('college');
//            $category=$this->input->get_post('category');
            
            
			if($dob != "")
			{
				$dob = date("Y-m-d",strtotime($dob));
			}
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$contact,$facebookid,$twitterid,$instagramid,$dob,$sex,$college)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    //college
    function viewcollege()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewcollege';
        $data['base_url'] = site_url("site/viewcollegejson");
        
		$data['title']='View college';
		$this->load->view('template',$data);
	} 
    function viewcollegejson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`college`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`college`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`college`.`address`";
        $elements[2]->sort="1";
        $elements[2]->header="Address";
        $elements[2]->alias="address";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `college`");
        
		$this->load->view("json",$data);
	} 
    
    public function createcollege()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createcollege';
		$data[ 'title' ] = 'Create college';
		$this->load->view( 'template', $data );	
	}
	function createcollegesubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('address','Address','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data[ 'page' ] = 'createcollege';
            $data[ 'title' ] = 'Create college';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $address=$this->input->post('address');
            
			if($this->college_model->create($name,$address)==0)
			$data['alerterror']="New College could not be created.";
			else
			$data['alertsuccess']="College created Successfully.";
			$data['redirect']="site/viewcollege";
			$this->load->view("redirect",$data);
		}
	}
    
	function editcollege()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='editcollege';
		$data['title']='Edit College';
		$data['before']=$this->college_model->beforeedit($this->input->get('id'));
		$this->load->view('template',$data);
	}
	function editcollegesubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required');
		$this->form_validation->set_rules('address','address','trim');
        
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['page']='editcollege';
            $data['before']=$this->college_model->beforeedit($this->input->get('id'));
			$data['title']='Edit College';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $address=$this->input->get_post('address');
            
			if($this->college_model->edit($id,$name,$address)==0)
			$data['alerterror']="College Editing was unsuccesful";
			else
			$data['alertsuccess']="College edited Successfully.";
			
			$data['redirect']="site/viewcollege";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deletecollege()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->college_model->deletecollege($this->input->get('id'));
		$data['alertsuccess']="College Deleted Successfully";
		$data['redirect']="site/viewcollege";
		$this->load->view("redirect",$data);
	}
    
    
    
    //post
    function viewpost()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewpost';
        $data['base_url'] = site_url("site/viewpostjson");
        
		$data['title']='View post';
		$this->load->view('template',$data);
	} 
    function viewpostjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`post`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`post`.`text`";
        $elements[1]->sort="1";
        $elements[1]->header="Text";
        $elements[1]->alias="text";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`post`.`image`";
        $elements[2]->sort="1";
        $elements[2]->header="Image";
        $elements[2]->alias="image";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`post`.`posttype`";
        $elements[3]->sort="1";
        $elements[3]->header="posttype";
        $elements[3]->alias="posttype";
        
        
        $elements[4]=new stdClass();
        $elements[4]->field="`post`.`timestamp`";
        $elements[4]->sort="1";
        $elements[4]->header="timestamp";
        $elements[4]->alias="timestamp";
        
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `post`");
        
		$this->load->view("json",$data);
	} 
    
    public function createpost()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createpost';
        $data['posttype']=$this->post_model->getposttypedropdown();
		$data[ 'title' ] = 'Create post';
		$this->load->view( 'template', $data );	
	}
	function createpostsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('text','text','trim|required');
		$this->form_validation->set_rules('posttype','posttype','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $data[ 'page' ] = 'createpost';
            $data['posttype']=$this->post_model->getposttypedropdown();
            $data[ 'title' ] = 'Create post';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $text=$this->input->post('text');
            $posttype=$this->input->post('posttype');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                }  
                else
                {
                    $image=$this->image_lib->dest_image;
                }
                
			}
            
			if($this->post_model->create($text,$image,$posttype)==0)
			$data['alerterror']="New post could not be created.";
			else
			$data['alertsuccess']="post created Successfully.";
			$data['redirect']="site/viewpost";
			$this->load->view("redirect",$data);
		}
	}
    
	function editpost()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='editpost';
		$data['title']='Edit post';
        $data['posttype']=$this->post_model->getposttypedropdown();
		$data['before']=$this->post_model->beforeedit($this->input->get('id'));
		$this->load->view('template',$data);
	}
	function editpostsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('text','text','trim|required');
		$this->form_validation->set_rules('posttype','posttype','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['page']='editpost';
            $data['posttype']=$this->post_model->getposttypedropdown();
            $data['before']=$this->post_model->beforeedit($this->input->get('id'));
			$data['title']='Edit post';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $text=$this->input->get_post('text');
            $posttype=$this->input->get_post('posttype');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                }  
                else
                {
                    $image=$this->image_lib->dest_image;
                }
                
			}
            
            if($image=="")
            {
                $image=$this->post_model->getpostimagebyid($id);
                $image=$image->image;
            }
            
			if($this->post_model->edit($id,$text,$image,$posttype)==0)
			$data['alerterror']="post Editing was unsuccesful";
			else
			$data['alertsuccess']="post edited Successfully.";
			
			$data['redirect']="site/viewpost";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deletepost()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->post_model->deletepost($this->input->get('id'));
		$data['alertsuccess']="post Deleted Successfully";
		$data['redirect']="site/viewpost";
		$this->load->view("redirect",$data);
	}
    
    
    //userpost
    
    function viewuserpost()
	{
		$access = array("1");
		$this->checkaccess($access);
        $userid=$this->input->get('id');
		$data['before']=$this->user_model->beforeedit($userid);
		$data['table']=$this->userpost_model->viewuserpostbyuser($userid);
		$data['page']='viewuserpost';
		$data['page2']='block/userblock';
        $data['title']='View User Post';
		$this->load->view('templatewith2',$data);
	}
    
    
    
    public function createuserpost()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'page' ] = 'createuserpost';
		$data[ 'title' ] = 'Create userpost';
        $data['post']=$this->post_model->getpostdropdown();
		$data[ 'userid' ] = $this->input->get('id');
		$this->load->view( 'template', $data );	
	}
    function createuserpostsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('user','user','trim|required');
		$this->form_validation->set_rules('likes','likes','trim');
		$this->form_validation->set_rules('share','share','trim');
		$this->form_validation->set_rules('post','post','trim|required');

		if($this->form_validation->run() == FALSE)	
		{
            
			$data['alerterror'] = validation_errors();
			$data[ 'page' ] = 'createuserpost';
            $data[ 'title' ] = 'Create userpost';
            $data['post']=$this->post_model->getpostdropdown();
            $data[ 'userid' ] = $this->input->get_post('id');
            $this->load->view( 'template', $data );	
		}
		else
		{
			$user=$this->input->post('user');
			$likes=$this->input->post('likes');
			$share=$this->input->post('share');
			$post=$this->input->post('post');
           
            
            if($this->userpost_model->create($user,$likes,$share,$post)==0)
               $data['alerterror']="New userpost could not be created.";
            else
               $data['alertsuccess']="userpost created Successfully.";
			
			$data['redirect']="site/viewuserpost?id=".$user;
			$this->load->view("redirect2",$data);
		}
	}
    
    function edituserpost()
	{
		$access = array("1");
		$this->checkaccess($access);
        $userid=$this->input->get('id');
        $data['userid']=$userid;
        $userpostid=$this->input->get('userpostid');
		$data['before']=$this->userpost_model->beforeedit($this->input->get('userpostid'));
        $data['post']=$this->post_model->getpostdropdown();
		$data['page']='edituserpost';
		$data['title']='Edit userpost';
		$this->load->view('template',$data);
	}
	function edituserpostsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
        
		$this->form_validation->set_rules('user','user','trim|required');
		$this->form_validation->set_rules('likes','likes','trim');
		$this->form_validation->set_rules('share','share','trim');
		$this->form_validation->set_rules('post','post','trim|required');
        
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
            $userid=$this->input->post('user');
            $userpostid=$this->input->post('userpostid');
            $data['userid']=$userid;
			$data['before']=$this->userpost_model->beforeedit($this->input->post('userpostid'));
            $data['post']=$this->post_model->getpostdropdown();
			$data['page']='edituserpost';
			$data['title']='Edit userpost';
			$this->load->view('template',$data);
		}
		else
		{
            
			$id=$this->input->post('userpostid');
            $user=$this->input->post('user');
			$likes=$this->input->post('likes');
			$share=$this->input->post('share');
			$post=$this->input->post('post');
            
			if($this->userpost_model->edit($id,$user,$post,$likes,$share)==0)
			$data['alerterror']="userpost Editing was unsuccesful";
			else
			$data['alertsuccess']="userpost edited Successfully.";
			
			$data['redirect']="site/viewuserpost?id=".$user;
			$this->load->view("redirect2",$data);
			
		}
	}
    
	function deleteuserpost()
	{
		$access = array("1");
		$this->checkaccess($access);
        $userid=$this->input->get('id');
        $userpostid=$this->input->get('userpostid');
		$this->userpost_model->deleteuserpost($this->input->get('userpostid'));
		$data['alertsuccess']="userpost Deleted Successfully";
		$data['redirect']="site/viewuserpost?id=".$userid;
		$this->load->view("redirect2",$data);
	}
    
    
    
    
    
    
    
    
    
    
}
?>