<div class="container-fluid wrapper">
    <?php if(isset($infos)) {
        echo form_open_multipart('event/edit/'.$infos[0]['event_id'].''); 
    } else {
        echo form_open_multipart('event/create');    
    }
	?>
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box r-form">
        <h1><?php if(isset($infos)) {
            echo 'Modifier un évènement'; 
        } else {
            echo 'Créer un évènement';    
        }
        ?></h1>
        <div class="form-group row">
            <label for="event_name" class="col-4 col-form-label">Nom de l'évènement</label> 
            <div class="col-8">
            <input <?php if(isset($infos)) { echo 'value="'.$infos[0]['event_name'].'"'; }?> id="event_name" name="event_name" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="event_description" class="col-4 col-form-label">Description</label> 
            <div class="col-8">
            <input <?php if(isset($infos)) { echo 'value="'.$infos[0]['event_description'].'"'; }?> id="event_description" name="event_description" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="event_picture" class="col-4 col-form-label">Image de l'évènement</label> 
            <div class="col-8">
                <div class="button-wrapper">
                    <span class="label">
                        Importer une image
                    </span>            
                    <input type="file" name="file_name" id="upload" class="upload-box" placeholder="Upload File">
                    <?php if(isset($infos)) { ?>
                    <input type="hidden" name="actual_pic" id="hiddenField" value="<?php echo $infos[0]['event_picture'] ?>" />
                    <?php } ?>
                </div>
                <?php if(isset($infos)) { ?>
                <img src="./../../../assets/images/uploaded_images/<?php echo $infos[0]['event_picture']; ?>" alt="Image actuelle de l'évenement" class="img-fluid img-thumbnail w-25 mt-1">
                <?php } ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="city_address" class="col-4 col-form-label">Ville de l'évènement</label> 
            <div class="col-8">
            <input <?php if(isset($infos)) { echo 'value="'.$infos[0]['city_address'].'"'; }?> id="city_address" name="city_address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="zip_code_address" class="col-4 col-form-label">Code postal</label> 
            <div class="col-8">
            <input <?php if(isset($infos)) { echo 'value="'.$infos[0]['zip_code_address'].'"'; }?> id="zip_code_address" name="zip_code_address" type="number" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="address" class="col-4 col-form-label">Adresse</label> 
            <div class="col-8">
            <input <?php if(isset($infos)) { echo 'value="'.$infos[0]['address'].'"'; }?> id="address" name="address" type="text" class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label for="event_date" class="col-4 col-form-label">Date de l'évènement</label> 
            <div class="col-8">
            <input id="event_date" name="event_date" type="date" <?php if(isset($infos)) { echo 'value="'.$infos[0]['event_date'].'"'; }?> class="form-control" required="required">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Evènement public</label>
            <div class="col-8">
                <label class="switch form-group row">
                    <input <?php if(isset($infos)) { if($infos[0]['private']) { echo "checked"; } }?> type="checkbox" id="private" name="private" onclick="checkShow();">
                    <span class="slider round"></span>
                </label>
                <p id="private-info"> <small>Un évènement public apparaitra dans la liste des évènements EZ Party et tout le monde pourra demander à y participer</small></p>                
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Cotisation obligatoire</label>
            <div class="col-8">
                <label class="switch form-group row">
                    <input <?php if(isset($infos)) { if($infos[0]['mandatory_fees']) { echo "checked"; } }?> type="checkbox" id="mandatory_fees" name="mandatory_fees" onclick="checkShow();">
                    <span class="slider round"></span>
                </label>                
            </div>
        </div>
        <div class="form-group row" id="maxFees">
            <label for="max_fees" class="col-4 col-form-label">Objectif cotisation</label> 
            <div class="col-8">
            <input <?php if(isset($infos)) { echo 'value="'.$infos[0]['max_fees'].'"'; }?> id="max_fees" name="max_fees" type="number" class="form-control" placeholder="€">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Participation aux besoins obligatoire</label>
            <div class="col-8">
                <label class="switch form-group row">
                    <input <?php if(isset($infos)) { if($infos[0]['mandatory_needs']) { echo "checked"; } }?> type="checkbox" id="mandatory_needs" name="mandatory_needs" onclick="checkShow();">
                    <span class="slider round"></span>
                </label>                
            </div>
        </div>
        <div id="needs-group">
        <?php if(isset($infos)) { echo '<p><small>Ajoutez de nouveaux besoins ici, les besoins déjà existants peuvent être supprimés depuis le plan de l\'évènement</small></p>'; }?>
            <label for="need" class="col-4 col-form-label"><button class="btn btn-primary" type="button" onclick="addElement();"><i class="fas fa-plus-circle" >Ajouter un besoin</i></button></label> 
            <div id="need-block" class="form-group row">
                <div class="col-8 offset-4 d-flex">
                    <input id="need" name="need[]" type="text" class="form-control col-6">
                    <select name="category[]" class="form-control col-4 col-sm-5 offset-1">
                        <option value="2">Boisson/Alcool</option>
                        <option value="3">Matériel</option>
                        <option value="4">Décoration</option>
                        <option value="5">Nourriture</option>
                        <option value="6">Autre</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button name="submit" type="submit" class="btn btn-primary"><?php if(isset($infos)) { echo 'Modifier l\'évènement'; } else { echo 'Créer l\'évènement'; }?></button>
            </div>
        </div>
</div>
    <?php 
		echo form_close(); 
	?>
</div>