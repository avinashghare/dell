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
        else
        {
            $twitter = $this->hybridauthlib->getAdapter("Twitter");
            $data["message"]=$twitter->api()->get("statuses/show.json?id=548520769760673792");
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