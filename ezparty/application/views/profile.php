<div class="container-fluid wrapper mb-5">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box r-form">
        <h1>Mon profil</h1>
        <?php 
		    echo form_open('profile/'); 
	    ?>
        <?php
            echo validation_errors();
            if (isset($success))
            echo '<div class="alert alert-success" role="alert">'.$success.'</div>';
        ?>
        <?php //var_dump($user[0]['name']) ?>
        <div class="form-group row">
            <label for="alias" class="col-4 col-form-label">Pseudonyme</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['alias'] ?>" id="alias" name="alias" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-4 col-form-label">Email</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['email'] ?>" id="email" name="email" type="email" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="first_name" class="col-4 col-form-label">Prénom</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['first_name'] ?>" id="first_name" name="first_name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Nom</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['name'] ?>" id="name" name="name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="birth_date" class="col-4 col-form-label">Date de naissance</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['birth_date'] ?>" id="birth_date" name="birth_date" type="date" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="sex" class="col-4 col-form-label">Sexe</label> 
            <div class="col-8">
                <select id="sex" name="sex" required="required" class="custom-select">
                    <option value="men" <?php if($user[0]['sex'] == 'men') { echo 'selected'; } ?>>Homme</option>
                    <option value="women" <?php if($user[0]['sex'] == 'women') { echo 'selected'; } ?>>Femme</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_address" class="col-4 col-form-label">Ville</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['city_address'] ?>" id="city_address" name="city_address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="zip_code_address" class="col-4 col-form-label">Code postal</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['zip_code_address'] ?>" id="zip_code_address" name="zip_code_address" type="number" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Adresse</label> 
            <div class="col-8">
            <input value="<?php echo $user[0]['address'] ?>" id="address" name="address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">Valider les modifications</button>
            </div>
        </div>

        <?php 
		    echo form_close(); 
	    ?>

    </div>
</div>