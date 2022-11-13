<?php
class mGoogleLogin extends CI_Model
{
    function Is_already_register($email)
    {
        $this->db->where('email_pj', $email);
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function Update_user_data($data, $email)
    {
        $this->db->where('email_pj', $email);
        $this->db->update('user', $data);
    }

    function Insert_user_data($data)
    {
        $this->db->insert('user', $data);
    }
}
