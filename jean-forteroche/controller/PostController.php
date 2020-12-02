<?php

require_once('model/PostManager.php');

class PostController
{
	public function listPosts()
	{//Affiche les articles
		$postManager = new PostManager();
		$posts = $postManager->getPosts();

		require('view/indexView.php');
	}

	public function post()
	{//Affiche un article
		$postManager = new PostManager();
		$commentManager = new CommentManager();

		$post = $postManager->getPost($_GET['id']);
		$comments = $commentManager->getComments($_GET['id']);

		if ($post === false) {
			$_SESSION["notify"] = "wrong-post";
			header('Location: index.php');
		}
		else {
			require('view/postView.php');
		}

	}
}


