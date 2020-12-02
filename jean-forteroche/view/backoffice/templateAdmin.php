<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="icon" href="public/media/favicon.ico">

  <title>Panneau d'administration - Jean Forteroche</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="public/css/adminlte.min.css">
  <link rel="stylesheet" href="public/css/adminstyle.css">
  <link rel="stylesheet" type="text/css" href="public/css/toastr.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Accueil</a>
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index.php?action=admin" class="brand-link">
      <span class="brand-text font-weight-light">Panneau d'administration</span>
    </a>

    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Livre
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=admin" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Tous les articles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=newPost" class="nav-link">
                  <i class="far fa-plus-square nav-icon"></i>
                  <p>Créer un nouvel article</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Commentaires
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?action=listComment" class="nav-link">
                  <i class="fas fa-comments nav-icon"></i>
                  <p>Tous les commentaires</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?action=reportedComment" class="nav-link">
                  <i class="fas fa-exclamation-circle nav-icon"></i>
                  <p>Commentaires signalés</p>
                </a>
              </li>
            </ul>
            <hr>
            <a href="index.php?action=disconnect" class="nav-link bg-danger">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>Se déconnecter</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  
  <?= $content ?>

  <aside class="control-sidebar control-sidebar-dark">
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-inline">
      Billet simple pour l'Alaska
    </div>
    <strong>Copyright &copy; 2019 Jean Forteroche</strong> Tous droits réservés.
  </footer>
</div>

<script src="public/js/jquery-3.4.1.min.js"></script>
<script src="public/js/bootstrap.bundle.min.js"></script>
<script src="public/js/adminlte.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>tinymce.init({selector:'textarea'});</script>
<script type="text/javascript" src="public/js/toastr.js"></script>
<script src="public/js/js.js"></script>

  <?php 
  if (isset($_SESSION["notify"])) {
    if ($_SESSION["notify"] == "newpost") {
      echo '<script type="text/javascript">
              toastr["success"]("Votre article a été posté", "Succès !");
            </script>';
    } elseif ($_SESSION["notify"] == "incomplete-post") {
      echo '<script type="text/javascript">
              toastr["error"]("Tous les champs ne sont pas remplis", "Impossible de poster/éditer l\'article");
            </script>';
    } elseif ($_SESSION["notify"] == "throwed-post") {
      echo '<script type="text/javascript">
              toastr["info"]("L\'article a été supprimé", "Action effectuée");
            </script>';
    } elseif ($_SESSION["notify"] == "deleted-comment") {
      echo '<script type="text/javascript">
              toastr["info"]("Le commentaire a été supprimé", "Action effectuée");
            </script>';
    } elseif ($_SESSION["notify"] == "revoked-comment") {
      echo '<script type="text/javascript">
              toastr["info"]("Le commentaire a été révoqué", "Action effectuée");
            </script>';
    } elseif ($_SESSION["notify"] == "edited-post") {
      echo '<script type="text/javascript">
              toastr["success"]("L\'article a été édité", "Succès !");
            </script>';
    }
    $_SESSION["telltale"] = "1";
  } 

  if (isset($_SESSION["telltale"])) {
    unset($_SESSION["notify"]);
  }
  ?>
</body>
</html>
