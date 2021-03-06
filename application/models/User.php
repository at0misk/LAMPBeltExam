<?php
// model
class User extends CI_Model {
     function getUserByEmail($input)
     {
         return $this->db->query("SELECT * FROM users WHERE email =?", array($input))->row_array();
     }
     function currentUsersPokeCount($id){
        return $this->db->query("SELECT COUNT(poked_by_id) AS count FROM users LEFT JOIN pokes ON pokes.users_id = users.id WHERE users.id=?", array($id))->row_array();
     }

     function getOtherUsers($id)
     {
         return $this->db->query("SELECT users.id, users.name, users.alias, users.email, SUM(pokes.count) AS total FROM users LEFT JOIN pokes ON pokes.users_id = users.id WHERE users.id !=? GROUP BY(users.id)", array($id))->result_array();
     }
     function whoPokedMe($id){
        return $this->db->query("SELECT * FROM users JOIN pokes ON users.id = pokes.poked_by_id WHERE pokes.users_id = ? ORDER BY count DESC", array($id))->result_array();
     }
     function addUser($input)
     {
         $query = "INSERT INTO users (name, alias, email, password, dob, created_at, updated_at) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";
         $values = array($input['name'], $input['alias'], $input['email'], $input['password'], $input['dob']); 
         return $this->db->query($query, $values);
     }
     function addPoke($clicked){
        $query = "INSERT INTO pokes (users_id, poked_by_id, count) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE count=count+1";
        $values = array($clicked, $this->session->userdata('current')['id']);
        return $this->db->query($query, $values);
     }
}
?>