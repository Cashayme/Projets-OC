<?php

session_start();

require('controller/CommentController.php');
require('controller/PostController.php');
require('controller/backoffice/AdminPostController.php');
require('controller/backoffice/AdminCommentController.php');

$postController = new PostController();
$commentController = new CommentController();

try {
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            $postController->listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $postController->post();
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $commentController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
            else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'admin') {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $adminPostController = new AdminPostController($_POST['email'], $_POST['password']);
                $adminPostController->listPostsAdmin();
            } else {
                $adminPostController = new AdminPostController($_SESSION['email'], $_SESSION['password']);
                $adminPostController->listPostsAdmin();
            }
        }
        elseif ($_GET['action'] == 'newPost') {
            $adminPostController = new AdminPostController($_SESSION['email'], $_SESSION['password']);
            $adminPostController->newPost();
        }
        elseif ($_GET['action'] == 'addPost') {
            
            if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['content'] && !empty($_FILES['picture']['tmp_name']))) {
                $adminPostController = new AdminPostController($_SESSION['email'], $_SESSION['password']);
                $adminPostController->addPost($_POST['title'], $_POST['content'], $_FILES['picture']['tmp_name'], $_POST['description']);
            }else{
                $_SESSION["notify"] = "incomplete-post";
                header('Location: index.php?action=newPost');
            }
        }
        elseif ($_GET['action'] == 'delPost') {
            $adminPostController = new AdminPostController($_SESSION['email'], $_SESSION['password']);
            $adminPostController->delPost($_GET['id']);   
        }
        elseif ($_GET['action'] == 'editPost') {
            $adminPostController = new AdminPostController($_SESSION['email'], $_SESSION['password']);
            $adminPostController->editPost($_GET['id']);
        }
        elseif ($_GET['action'] == 'updatePost') {
            $adminPostController = new AdminPostController($_SESSION['email'], $_SESSION['password']);
            if (!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['content'])) {
                $adminPostController->updatePost($_GET['id'], $_POST['title'], $_POST['content'], $_FILES['picture']['tmp_name'], $_POST['description']);
            }else{
                $_SESSION["notify"] = "incomplete-post";
                header('Location: index.php?action=admin');
            }                
        }
        elseif ($_GET['action'] == 'listComment') {
            $adminCommentController = new AdminCommentController($_SESSION['email'], $_SESSION['password']);
            $adminCommentController->listComment();
        }
        elseif ($_GET['action'] == 'reportedComment') {
            $adminCommentController = new AdminCommentController($_SESSION['email'], $_SESSION['password']);
            $adminCommentController->listComment();
        }
        elseif ($_GET['action'] == 'delComment') {
            $adminCommentController = new AdminCommentController($_SESSION['email'], $_SESSION['password']);
            $adminCommentController->delComment($_GET['id']);
        }
        elseif ($_GET['action'] == 'revokeComment') {
            $adminCommentController = new AdminCommentController($_SESSION['email'], $_SESSION['password']);
            $adminCommentController->revokeComment($_GET['id']);
        }
        elseif ($_GET['action'] == 'reportComment') {
            $commentController->reportComment($_GET['id'], $_GET['p_id']);
        }
        elseif ($_GET['action'] == 'notAuthorized') 
        {
            $_SESSION["notify"] = "not-authorized";
            header('Location: index.php');
        }
        elseif ($_GET['action'] == 'wrongUser') 
        {
            $_SESSION["notify"] = "wrong-user";
            header('Location: index.php');
        } 
        elseif ($_GET['action'] == 'disconnect') 
        {
            session_destroy();
            header('Location: index.php');
        }
    }
    else {
    	$postController->listPosts();
    }
}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
