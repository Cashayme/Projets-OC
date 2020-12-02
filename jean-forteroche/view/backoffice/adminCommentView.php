<?php ob_start(); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">
              <?php
              if ($_GET['action'] == 'listComment') {
                echo "Tous les commentaires";
              } else {
                echo "Commentaires signalés";
              } 
              ?>
            </h1>
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 d-flex flex-wrap">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Auteur</th>
                  <th scope="col" class="d-none d-md-block">Message</th>
                  <th scope="col">Date</th>
                  <th scope="col">Statut</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
              <?php
              while ($comment = $comments->fetch()) {
              ?>
              <?php if ($_GET['action'] == 'reportedComment') {
                if ($comment['reported'] == 1) {
                  echo ' <tr>
                  <th scope="row"> '. $comment["id"] .'</th>
                  <td>' . htmlspecialchars($comment["author"]) . '</td>
                  <td class="d-none d-md-block">' . htmlspecialchars($comment["comment"]) .'</td>
                  <td>' . $comment["comment_date_fr"] . '</td>
                  <td class="text-danger text-center"><i class="fas fa-exclamation-triangle"></i></td>
                  <td>
                    <a href="index.php?action=delComment&amp;id='.$comment["id"].'" class="btn btn-danger mb-2 text-white" onclick="return confirm(\'Confirmer la suppression de ce commentaire ?\');">Supprimer</a>
                    <a href="index.php?action=revokeComment&amp;id='.$comment["id"].'" class="btn btn-success mb-2 text-white">Révoquer</a>
                  </td>
                </tr>';
                }

              } else {
                echo '<tr>
                  <th scope="row">' .$comment["id"]. '</th>
                  <td>' .htmlspecialchars($comment["author"]). '</td>
                  <td class="d-none d-md-block">' .htmlspecialchars($comment["comment"]). '</td>
                  <td>' . $comment["comment_date_fr"]. '</td>
                  <td class="text-danger text-center ">';
                  if ($comment["reported"] == 1) {
                    echo '<i class="fas fa-exclamation-triangle"></i>';
                  }
                  echo '</td>
                    <td>
                    <a href="index.php?action=delComment&amp;id='.$comment["id"].'" class="btn btn-danger mb-2 text-white mr-1" onclick="return confirm(\'Confirmer la suppression de ce commentaire ?\');">Supprimer</a>';
                    if ($comment["reported"] == 1) {
                      echo '<a href="index.php?action=revokeComment&amp;id='.$comment["id"].'" class="btn btn-success mb-2 text-white">Révoquer</a>';
                    }
                    echo "</td></tr>";         
              } ?>
               
              <?php
              }
              ?>
              </tbody>
              </table>
          </div>
        </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $content = ob_get_clean(); ?>

<?php require('templateAdmin.php'); ?>
