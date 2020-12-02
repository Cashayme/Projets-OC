<?php
require_once('controller/backoffice/AdminController.php');
require_once('model/CommentManager.php');

class AdminCommentController extends AdminController
{
	public function listComment() 
	{//Affiche la liste des commentaires
		$commentManager = new CommentManager();
		$comments = $commentManager->adminComments();
		require('view/backoffice/adminCommentView.php');
	}

	public function delComment($id) 
	{//Supprime le commentaire
		$commentManager = new CommentManager();
		$affectedLines = $commentManager->deleteComment($id);

		if ($affectedLines === false) {
			throw new Exception('Impossible de supprimer le commentaire !');
		}
		else {
			$_SESSION["notify"] = "deleted-comment";
			header('Location: index.php?action=listComment');
		}
	}

		public function revokeComment($id)
	{//Révoque le commentaire signalé
		$commentManager = new CommentManager();

		$affectedLines = $commentManager->revComment($id);

		if ($affectedLines === false) {
			throw new Exception('Impossible de révoquer le commentaire !');
		}
		else {
			$_SESSION["notify"] = "revoked-comment";
			header('Location: index.php?action=reportedComment');
		}
	}
}
