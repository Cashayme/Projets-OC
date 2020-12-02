<?php ob_start(); ?>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-dark"><?php if (isset($editPost)) {
              echo "Modifier un article";
            } else {
              echo "Créer un article";
            } ?></h1>
            
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


            <form class="col-lg-11" action=" <?php 
            if (isset($editPost)) { 
              echo 'index.php?action=updatePost&amp;id='. $editPost["id"] . ''; 
            } else { 
              echo 'index.php?action=addPost'; 
            } 
            ?>" method="post" ENCTYPE="multipart/form-data">
              <div class="form-group">
                <label for="title">Titre de l'article</label>
                <input type="text" name="title" value="<?php
                if (isset($editPost)) {
                 echo ''. $editPost["title"] . '';
               } 
               ?>" class="form-control" id="title" placeholder="Le titre de l'article">
              </div>
              <div class="form-group">
                <label for="description">Description de l'article</label>
                <input type="text" class="form-control" name="description" value="<?php
                if (isset($editPost)) {
                 echo ''. $editPost["description"] .'';
                } 
                ?>" id="description" placeholder="Description de l'article">
              </div>
              <div class="form-group">
                  <label for="content">Contenu de l'article</label>
                  <textarea class="form-control" id="content" name="content" rows="6" placeholder="Rédiger l'article..."><?php 
                  if (isset($editPost)) {
                    echo ''. $editPost["content"] .'';
                  }
                  ?></textarea>
              </div>
              <?php if (isset($editPost)) {
                echo '<div class="form-group">
                <label >Image actuelle</label><br>
                <img src="'. $editPost["picture"] .'" class="img-thumbnail w-25">
              </div>';
              } ?>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Image de l'article</span>
                </div>
              <div class="custom-file">
                  <input type="file" name="picture" class="custom-file-input" id="inputGroupFile01">
                  <label class="custom-file-label" for="inputGroupFile01">Ajouter une image</label>
                </div>
             </div>
              <button type="submit" class="btn btn-primary"><?php if (isset($editPost)) {
                echo "Editer l'article";
              } else {
                echo "Ajouter l'article";
              } ?></button>
            </form>
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
