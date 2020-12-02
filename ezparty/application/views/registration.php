<div class="container-fluid wrapper">
    <?php
		echo form_open('registration/index');
	?>
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box r-form">
    <h1>Inscription</h1>
        <div class="form-group row">
            <label class="col-4 col-form-label" for="email">Email</label> 
            <div class="col-8">
            <input id="email" name="email" type="text" required="required" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-4 col-form-label">Nom</label> 
            <div class="col-8">
            <input id="name" name="name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="first_name" class="col-4 col-form-label">Prénom</label> 
            <div class="col-8">
            <input id="first_name" name="first_name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="alias" class="col-4 col-form-label">Nom de compte</label> 
            <div class="col-8">
            <input id="alias" name="alias" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="birth_date" class="col-4 col-form-label">Date de naissance</label> 
            <div class="col-8">
            <input id="birth_date" name="birth_date" type="date" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="sex" class="col-4 col-form-label">Sexe</label> 
            <div class="col-8">
            <select id="sex" name="sex" required="required" class="custom-select">
                <option value="men">Homme</option>
                <option value="women">Femme</option>
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="password" class="col-4 col-form-label">Mot de passe</label> 
            <div class="col-8">
            <input id="password" minlength=6 maxlength=35 name="password" type="password" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="city_address" class="col-4 col-form-label">Ville</label> 
            <div class="col-8">
            <input id="city_address" name="city_address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="zip_code_address" class="col-4 col-form-label">Code postal</label> 
            <div class="col-8">
            <input id="zip_code_address" minlength=5 maxlength=5 name="zip_code_address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Adresse</label> 
            <div class="col-8">
            <input id="address" name="address" type="text" class="form-control" required="required">
            </div>
        </div> 
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary">S'enregister</button>
            </div>
        </div>
</div>
    <?php 
		echo form_close(); 
	?>
</div>