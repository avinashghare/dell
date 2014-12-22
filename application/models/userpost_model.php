<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class Userpost_model extends CI_Model
{
	//topic
	public function create($user,$likes,$share,$post)
	{
		$data  = array(
			'user' => $user,
			'likes' => $likes,
			'post' => $post,
			'share' => $share
		);
		$query=$this->db->insert( 'userpost', $data );
		
		return  1;
	}
	function viewuserpostbyuser($id)
	{
		$query="SELECT `userpost`.`id`,`userpost`.`post`, `userpost`.`likes`, `userpost`.`user`,`userpost`.`share`, `userpost`.`timestamp`,`user`.`name` AS `username`,`post`.`text` AS `posttext`
        FROM `userpost`
        LEFT OUTER JOIN `user` ON `user`.`id`=`userpost`.`user`
        LEFT OUTER JOIN `post` ON `post`.`id`=`userpost`.`post`
        WHERE `userpost`.`user`='$id'";
        $result=$this->db->query($query)->result();
        
        return $result;
        
//		return $query;
	}
	public function beforeedit( $id )
	{
		$this->db->where( 'id', $id );
		$query=$this->db->get( 'userpost' )->row();
		return $query;
	}
    
	public function getuserpostbyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `userpost` WHERE `id`='$id'")->row();
		return $query;
	}
	
	public function edit( $id,$user,$post,$likes,$share)
	{
		$data = array(
			'user' => $user,
			'likes' => $likes,
			'post' => $post,
			'share' => $share
		);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'userpost', $data );
		
		return 1;
	}
	function deleteuserpost($id)
	{
		$query=$this->db->query("DELETE FROM `userpost` WHERE `id`='$id'");
		
	}
    
     public function getpropertydropdown()
	{
		$query=$this->db->query("SELECT * FROM `property`  ORDER BY `id` ASC")->result();
		$return=array();
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    
}
?>