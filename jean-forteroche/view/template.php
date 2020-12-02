<!DOCTYPE html>
<html>
   <head>
      <title>Billet simple pour l'Alaska - Jean Forteroche</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" href="public/media/favicon.ico">
      <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="public/css/mdb.min.css">
      <link rel="stylesheet" type="text/css" href="public/css/toastr.css">
      <link rel="stylesheet" type="text/css" href="public/css/style.css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   </head>
   <body>
      <div class="bg-image"></div>
      <div class="container-fluid">
         <header class="row">
            <nav class="navbar navbar-expand-lg navbar-dark col-12">
               <a class="navbar-brand d-none d-lg-block" href="index.php">Billet simple pour l'Alaska</a>
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                     <a class="nav-link" href="index.php#book">
                     Roman
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="index.php#author">
                     Auteur
                     </a>
                  </li>
                  <li class="nav-item connexion">
                     <?php 
                        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
                           echo '<a class="nav-link" href="index.php?action=admin"><i class="fas fa-cogs"></i> Panneau d\'administration</a>';
                        } else {
                           echo '<a class="nav-link" href="#" data-toggle="modal" data-target="#modalLoginForm" > <i class="fas fa-user"></i> Connexion</a>';
                        }
                     ?>
                  </li>
                  <form method="post" action="index.php?action=admin" class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                     <div class="modal-content">
                        <div class="modal-header text-center">
                           <h4 class="modal-title w-100 font-weight-bold">Connexion</h4>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                           </button>
                        </div>
                        <div class="modal-body mx-3">
                           <div class="md-form mb-5">
                              <i class="fas fa-envelope prefix grey-text"></i>
                              <input type="email" id="email" name="email" class="form-control validate" value="
                              <?php if(isset($_SESSION['email'])){
                                 echo $_SESSION['email'];
                              }
                              ?>">
                              <label data-error="Incorrect" data-success="Valide" for="defaultForm-email">Email</label>
                           </div>
                           <div class="md-form mb-4">
                              <i class="fas fa-lock prefix grey-text"></i>
                              <input type="password" id="password" name="password" class="form-control validate">
                              <label for="defaultForm-pass">Mot de passe</label>
                           </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                           <input type="submit" value="Accéder au panneau d'adminstration" class="btn btn-primary waves-effect waves-light">
                        </div>
                     </form>
                  </div>
                  </div>
               </ul>
               </div>
               
            </nav>
         </header>
         <?= $content ?>
         <footer class="row">
            <div id="footer" class="col-12 d-flex flex-row">
               <div class="col-4 footer-content pt-3">
                  <a href="">Contacter l'auteur</a>
               </div>
               <div class="col-4 footer-content pt-3">Mentions légales</div>
               <div class="col-4 footer-content pt-3">Réseaux sociaux</div>
            </div>
         </footer>
      </div>
      <script type="text/javascript" src="public/js/jquery-3.4.1.min.js"></script>
      <script type="text/javascript" src="public/js/mdb.min.js"></script>
      <script type="text/javascript" src="public/js/popper.min.js"></script>
      <script type="text/javascript" src="public/js/toastr.js"></script>
      <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="public/js/js.js"></script>

      <?php 
      if (isset($_SESSION["notify"])) {
         if ($_SESSION["notify"] == "wrong-user") {
            echo '<script type="text/javascript">
            toastr["error"]("Identifiants invalides", "Désolé !");
            </script>';
         } elseif ($_SESSION["notify"] == "com-success") {
            echo '<script type="text/javascript">
            toastr["success"]("Votre commentaire a été ajouté", "Succès !");
            </script>';
         }  elseif ($_SESSION["notify"] == "report-success") {
            echo '<script type="text/javascript">
            toastr["info"]("Le modérateur va traiter votre demande", "Commentaire signalé");
            </script>';
         } elseif ($_SESSION["notify"] == "wrong-post") {
            echo '<script type="text/javascript">
            toastr["error"]("Cet article n\'existe pas", "Désolé !");
            </script>';
         } elseif ($_SESSION["notify"] == "not-authorized") {
            echo '<script type="text/javascript">
            toastr["error"]("Vous n\'êtes pas autorisé à faire ça", "Désolé !");
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