<?php
class User_Model extends CI_Model 
{
public function get_tree()
{   
    $this->db->select('*'); 
    $this->db->from('users'); 
    $this->db->where('parentID',0); 
    //  $this->db->limit(10, 5);
    $query= $this->db->get(); 
    $result = $query->result_array();

    $roles = null;

    foreach($result as $key=>$value)
    {   
        //  return $result[$key]['parentID'];
            $role = array();
            $role['parentID'] = $result[$key]['parentID'];

            $role['title'] = $result[$key]['UserID'];
            $role['name'] = $result[$key]['name'];
            $children = $this->build_child($result[$key]['UserID']);              
            if( !empty($children) ) {
                $finalChildren=[];                   
                foreach($children as $key=>$child){
                    // return $child['children'];
                    if(!empty($children[$key]['title']) && !empty($children[$key]['parentID'])){
                        $finalChildren=[...$finalChildren,$child];
                    }
                    else {
                        $finalChildren=[...$finalChildren,...$child['children']];

                    }
                }
                $role['children'] = $finalChildren;

            }
            $roles = $role;             

    }       
    return $roles;
}


public function get_tree_search($id)
{   
     
    $this->db->select('*'); 
    $this->db->from('users'); 
    $this->db->where('UserID',$id); 
    //  $this->db->limit(10, 5);
    $query= $this->db->get(); 
     $result = $query->result_array();

    $roles = null;

    foreach($result as $key=>$value)
    {   
        //  return $result[$key]['parentID'];
            $role = array();
            $role['parentID'] = $result[$key]['parentID'];
            if ($result[$key]['status'] == 0) {
                $role['id'] = "red";
                if ($result[$key]['UserID'] ==   $id) {
                    $role['id'] = "red";
                }

            }
          
            

            $role['title'] = $result[$key]['UserID'];
            $role['name'] = $result[$key]['username'];
            $children = $this->build_child($result[$key]['UserID']);              
            if( !empty($children) ) {
                $finalChildren=[];                   
                foreach($children as $key=>$child){
                    // return $child['children'];
                    if(!empty($children[$key]['title']) && !empty($children[$key]['parentID'])){
                        $finalChildren=[...$finalChildren,$child];
                    }
                    else {
                        $finalChildren=[...$finalChildren,...$child['children']];

                    }
                }
                $role['children'] = $finalChildren;

            }
            $roles = $role;             

    }       
    return $roles;
}
public function build_child($parent)
{
    $this->db->select('*'); 
    $this->db->from('users'); 
    $this->db->where('parentID', $parent); 
    
   $query = $this->db->get(); 
    $result = $query->result_array();

    $roles = array();       

    foreach($result as $key => $val) {

            $role = array();
        if ($result[$key]['status']==1) {
           
   
            $role['parentID'] = $result[$key]['parentID'];

            $role['title'] = $result[$key]['UserID'];
            $role['name'] = $result[$key]['username'];


            // $role['contents'] = $result[$key]['dateAdded'];

            $children = $this->build_child($result[$key]['UserID'],$result[$key]['status']);

            if( !empty($children) ) {
                $finalChildren=[];                   
                foreach($children as $key=>$child){
                    // return $child['children'];
                    if(!empty($children[$key]['parentID']) && !empty($children[$key]['title'])){
                        $finalChildren=[...$finalChildren,$child];
                    }
                    else {
                        if ($child) {
                            $finalChildren=[...$finalChildren,...$child['children']];

                        }

                    }
                }
                $role['children'] = $finalChildren;

            }
            $roles[] = $role;
    //     }
        }
        else {

            $children = $this->build_child($result[$key]['UserID']);

            if( !empty($children) ) {
                $finalChildren=[];                   
                foreach($children as $key=>$child){
                    // return $child['children'];
                    if(!empty($children[$key]['parentID']) && !empty($children[$key]['title'])){
                        $finalChildren=[...$finalChildren,$child];
                    }
                    else {
                        $finalChildren=[...$finalChildren,...$child['children']];

                    }
                }
                $role['children'] = $finalChildren;

            }
            $roles[] = $role;
        }
    }
    return $roles;

}

public function register_user($user){
 
 
    $this->db->insert('users', $user);
     
    }

    
public function login_user($name,$pass){
    //$email,
    // return $pass;
     $this->db->select('*');
     $this->db->from('users');
    $this->db->where('username',$name);
    $this->db->where('password',$pass);
    // $query=$this->db->get();
    // return $query->result_array();

     if($query=$this->db->get())
     {
         return $query->result_array();
     }
     else{
       return false;
     }
    
    
   }public function username_check($username){
 
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('username',$username);
    $query=$this->db->get();
   
    if($query->num_rows()>0){
      return false;
    }else{
      return true;
    }
   
  }
}