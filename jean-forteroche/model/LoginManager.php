<?php

require_once('model/Manager.php');

class LoginManager extends Manager
{	
	public function getLogin($email, $password)
	{//Récupère et vérifie le login
		$db = $this->dbConnect();

        if(strlen($email) > 0 && strlen($password) > 0){
        //Si l'email et le mdp n'ont pas 0 caractères on prépare la requete 

            $stmt = $db->prepare("SELECT * FROM user WHERE email= ?");
			
            $stmt->execute(array($email));
            $results = $stmt->fetch();

            if($results){
            //si l'email existe dans la table, on vérifie que le hash (BCRYPT) correspond au mdp envoyé
                $verify = password_verify($password, $results['password']);

                if($verify){

                    return 'login';
                }else{

                    return 'invalid user';
                }
            }
        } 
    }
}