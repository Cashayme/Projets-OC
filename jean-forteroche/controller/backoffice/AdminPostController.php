<?php
require_once('controller/backoffice/AdminController.php');
require_once('model/PostManager.php');

class AdminPostController extends AdminController
{
	public function listPostsAdmin()
	{//afiche la liste des articles dans le panneau d'admin
		$postManager = new PostManager();
		$posts = $postManager->getPosts();

		require('view/backoffice/indexViewAdmin.php');
	}

	public function newPost() 
	{//affiche la vue des nouveaux articles
		require('view/backoffice/adminPostView.php');
	}

	public function addPost($title, $content, $picture, $description )
	{//envoi les informations du nouvel article
		$postManager = new PostManager();
		$content_dir = 'public/media/';
		$tmp_file = $picture;

		//on vérifie si l'image existe et son format
		if( !is_uploaded_file($tmp_file) )
		{
			exit("Le fichier est introuvable");
		}
		$type_file = $_FILES['picture']['type'];

		if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
		{
			exit("Le fichier n'est pas une image");
		}

		$name_file = $_FILES['picture']['name'];

		if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
		{
			exit("Impossible de copier le fichier dans $content_dir");
		}

		$dir_file = 'public/media/'.$name_file.'';
		$affectedLines = $postManager->sendPost($title, $content, $dir_file, $description );

		if ($affectedLines === false) {
			throw new Exception('Impossible d\'ajouter l\'article !');
		}
		else {
			$_SESSION["notify"] = "newpost";
			header('Location: index.php?action=admin');
		}
	}

	public function delPost($id) 
	{//Appel la suppression de l'article
		$postManager = new PostManager();

		$delPost = $postManager->deletePost($id);

		if ($affectedLines === false) {
			throw new Exception('Cet article n\'existe pas.');
		}
		else {
			$_SESSION["notify"] = "throwed-post";
			header('Location: index.php?action=admin');
		}
	}

	public function editPost($id) 
	{//appel l'édition d'article
		$postManager = new PostManager();
		$editPost = $postManager->editingPost($id);
		require('view/backoffice/adminPostView.php');
	}

	public function updatePost($id, $title, $content, $picture, $description) 
	{//met à jour l'article
		$postManager = new PostManager();
		$editPost = $postManager->editingPost($id);
		$content_dir = 'public/media/';
		$tmp_file = $picture;
		if ($picture != '') {
		//Si l'utilisateur a upload une nouvelle image, on recheck le format
			if( !is_uploaded_file($tmp_file) )
			{
				exit("Le fichier est introuvable");
			}
			$type_file = $_FILES['picture']['type'];

			if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') && !strstr($type_file, 'png'))
			{
				exit("Le fichier n'est pas une image");
			}

			$name_file = $_FILES['picture']['name'];

			if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
			{
				exit("Impossible de copier le fichier dans $content_dir");
			}
			$dir_file = 'public/media/'.$name_file.'';

			unlink($editPost['picture']);
		} else {
		//Sinon, on recupère l'image précédente 
			$dir_file = $editPost['picture'];
		}
		
		$affectedLines = $postManager->updateEdit($id, $title, $content, $dir_file, $description );

		if ($affectedLines === false) {
			throw new Exception("l'article n'a pas pu être modifié.");			
		}
		else {
			$_SESSION["notify"] = "edited-post";
			header('Location: index.php?action=admin');
		}
	}

	public function listComment() 
	{ //Appelle la liste des commentaires
		$postManager = new PostManager();
		require('view/backoffice/adminCommentView.php');
	}
}


