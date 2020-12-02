<?php ob_start(); ?>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark">Articles</h1>
              <a href="index.php?action=newPost" class="btn btn-primary mt-2"><i class="fas fa-plus-square mr-2"></i> Créer un nouvel article</a>
            
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

            <?php
            while ($data = $posts->fetch()) 
            {
            ?>
            <div class="card col-lg-5 m-3">
              <div class="card-header">
                <h5 class="m-0"><?= $data['title'] ?></h5>
              </div>
              <div class="card-body">
                <p class="card-text"><?= $data['description'] ?></p>
                <a href="index.php?action=editPost&amp;id=<?= $data['id'] ?>" class="btn btn-primary"><i class="far fa-edit"></i> Editer</a>
                <a href="index.php?action=delPost&amp;id=<?= $data['id'] ?>" onclick="return confirm('Confirmer la suppression de cet article ?');" class="btn btn-danger"><i class="fas fa-trash"></i> Supprimer</a>
              </div>
            </div>
            <?php
            }   
            ?>

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
