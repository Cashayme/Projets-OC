<?php
class Login_model extends CI_Model
{
    public function login($email)
    {//Connexion (retourne 1 si tout est bon)
        $this->db->select('password') -> from('user') -> where(['email' => $email]);
        //On récupère le mdp crypté associé à l'adresse mail
        $query = $this->db->get();
        
        if ($query->row() != null) {
            //Si un mdp est bien associé à cet email, vérifie qu'il correspond (BCrypt)
            $verify = password_verify($this->input->post('password'), $query->row() -> password);

            if ($verify) {
                $password = $query->row() -> password;
            } else {
                $password = '';
            }

            $query = $this->db->where(['email' => $email, 'password' => $password])->get('user');
            return (int) $query->num_rows();
        }
    }

    public function getInfos($email, $line) 
    {//Récupère une info sur l'user en fonction du param $line
        $this->db->select('*') -> from('user') -> where(['email' => $email]);
        $query = $this->db->get();
        return $query->row() -> $line;
    }

    public function checkLogin()
    {//Vérifie si l'user est connecté
        $email = $this->session->userdata('email');
        $password = $this->session->userdata('password');
        $query = $this->db->where(['email' => $email, 'password' => $password])->get('user');
        return (int) $query->num_rows();
    }
}