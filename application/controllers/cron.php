<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller 
{
    function checkfacebooklike() 
    {
    $userpostquery=$this->db->query("SELECT `id`,`returnpostid`,`posttype` FROM `userpost`")->result();
    foreach($userpostquery as $userpost)
    {
        $returnpostid=$userpost->returnpostid;
        $posttype=$userpost->posttype;
        $id=$userpost->id;
        if($posttype==1)
        {
//            echo $returnpostid;
            $facebook = $this->hybridauthlib->authenticate("Facebook");
            $likes=$facebook->api()->api("v2.2/'$returnpostid'/likes?summary=1");
            if(isset($likes["summary"]["total_count"]))
            {
            $likes=$likes["summary"]["total_count"];
            }
            else
            {
            $likes=0;
            }
            
            $share=$facebook->api()->api("v2.2/'$returnpostid'");
            if(isset($share["shares"]))
            {
            $shares=$share["shares"];
            }
            else
            {
            $shares=0;
            }
            $comment=$facebook->api()->api("v2.2/'$returnpostid'/comments?summary=1");
            if(isset($comment["summary"]["total_count"]))
            {
            $comments=$comment["summary"]["total_count"];
            }
            else
            {
            $comments=0;
            }
            $this->userpost_model->addfacebookcrondata($id,$likes,$shares,$comments);
        }
        else if($posttype==2)
        {
            $this->load->library('twitteroauth');
		// Loading twitter configuration.
		    $this->config->load('twitter');
            $this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
            $data["message"] = $this->twitteroauth->get('statuses/show.json?id='.$returnpostid);
            if(isset($data["message"]->retweet_count))
            {
                $retweet=$data["message"]->retweet_count;
            }
            else
            {
                $retweet=0;
            }
            if(isset($data["message"]->favorite_count))
            {
                $favourites=$data["message"]->favorite_count;
            }
            else
            {
                $favourites=0;
            }
            $this->userpost_model->addtwittercrondata($id,$retweet,$favourites);
        }
    }
	
	}
    
}
//EndOfFile
?>