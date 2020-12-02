<?php
require_once("model/Manager.php");

class PostManager extends Manager
{
	public function getPosts()
	{//Recupère les articles dans la db ordonnés par id
		$db = $this->dbConnect();
		$req = $db->query('SELECT * FROM billets ORDER BY ID ');

		return $req;
	}

	public function getPost($postId)
    {//Recupère un article selon l'id envoyé en paramètre
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, picture, content FROM billets WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

	public function sendPost($title, $content, $picture, $description )
	{//Envoi dans la table des articles le nouvel article posté par l'admin
        $db = $this->dbConnect();
        $newpost = $db->prepare('INSERT INTO billets(title, content, picture, description ) VALUES(?, ?, ?, ?)');
        $affectedLines = $newpost->execute(array($title, $content, $picture, $description));

        return $affectedLines;
		
	}

	public function deletePost($id) 
	{//Récupère les informations de l'article pour avoir le lien de l'image associée et la supprimer puis supprime de la db l'article ayant l'id envoyé en paramètre
		$db = $this->dbConnect();

		$req = $db->prepare('SELECT * FROM billets WHERE id = ?');
		$req->execute(array($id));
        $infos = $req->fetch();

        unlink($infos['picture']);

		$deletePost = $db->prepare('DELETE FROM billets WHERE id= ?');
		$affectedLines = $deletePost->execute(array($id));

		return $affectedLines;
	}

	public function editingPost($id) 
	{//Récupère le contenu de l'article passé en paramètre pour remplir les values de l'éditeur
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM billets WHERE id = ?');
		$req->execute(array($id));
        $infos = $req->fetch();

        return $infos;
	}

	public function updateEdit($id, $title, $content, $picture, $description ) 
	{//Met à jour l'article avec les informations envoyés en paramètre
        $db = $this->dbConnect();
        $editPost = $db->prepare('UPDATE billets SET title = ?, content = ?, picture = ?, description = ? WHERE id= ?');
        $affectedLines = $editPost->execute(array($title, $content, $picture, $description, $id));

        return $affectedLines;
		
	}
}