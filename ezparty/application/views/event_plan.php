<div class="container-fluid wrapper">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box e-plan">
        <div class="row col-12 mt-4">
            <div class="col-lg-6 col-md-5 col-sm-12 e-img">

            <?php foreach($event as $data) { ?>

                <img class="img-fluid img-thumbnail" src="./../../assets/images/uploaded_images/<?php echo $data['event_picture']; ?>" alt="Image de l'évènement">
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 e-infos">
                <h2><?php echo $data['event_name']; ?></h2>
                <strong>Date : </strong>
                <p><?php echo $data['event_date']; ?></p>
                <strong>Description :</strong>
                <p><?php echo $data['event_description']; ?></p>
            </div>
        </div>
        <hr>
        <div class="row col-12 mt-4">
            <div class="col-lg-6 col-md-5 col-sm-12 e-map">
            <div id="map"></div>
            </div>
            <div class="col-lg-6 col-md-7 col-sm-12 e-infos">
                <h2 id="city-address"><?php echo $data['city_address']; ?></h2>
                <p><strong><?php echo $data['zip_code_address']; ?></strong></p>
                <p id="address"><?php echo $data['address']; ?></p>

            <?php } ?>

                <a target="_blank" rel="noopener noreferrer" id="itinerary" ><button class="btn btn-primary">Itinéraire vers le lieu</button></a>
            </div>
        </div>
        <hr>
        <div class="row col-12 mt-4 table-responsive" >
            <h2 id="participants">Participants</h2>
            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">Pseudonyme</th>
                    <th scope="col">Rang</th>
                    <th scope="col">Cotisation</th>
                    <th scope="col">Participation</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($participants as $data) { ?>
                    <tr>
                        <th scope="row"><?php if($p_rank['creator_id'] != $data['id_user']) { ?>
                        <?php if(isset($creator) || isset($admin)) { ?>
                            <a class="text-danger" href="<?php echo site_url('event/deleteparticipant/'.$event[0]['event_id'].'/'.$data['id_user'].'')?>"><i class="fas fa-user-times" data-toggle="tooltip" data-placement="top" title="" data-original-title='Retirer "<?php echo $data['alias'] ?>" des participants'></i></a>
                        <?php }} ?>
                        <?php echo $data['alias']; ?>
                        </th>
                        <td>
                            <?php if($p_rank['creator_id'] == $data['id_user']) {
                                echo '<i class="fas fa-crown"></i>Créateur de l\'évènement';
                            } else if ($data['super_user']) {
                                echo '<i class="fas fa-user-shield"></i>Administrateur';
                                if(isset($creator)) {
                                    echo '  <a class="text-warning" href="'.site_url('event/rank/'.$event[0]['event_id'].'/'.$data['id_user'].'/down').'"><i class="far fa-arrow-alt-circle-down" data-toggle="tooltip" data-placement="top" title="" data-original-title="Rétrograder '.$data['alias'].' simple invité de l\'évènement"></i></a>';
                                }                                
                            } else {
                                echo '<i class="fas fa-user"></i>Invité';
                                if(isset($creator)) {
                                    echo '  <a class="text-warning" href="'.site_url('event/rank/'.$event[0]['event_id'].'/'.$data['id_user'].'/up').'"><i class="far fa-arrow-alt-circle-up" data-toggle="tooltip" data-placement="top" title="" data-original-title="Promouvoir '.$data['alias'].' administrateur de l\'évènement"></i></a>';
                                }
                            }?>
                        <td><?php
                        if ($data['fees']) {
                            echo ''.$data['fees'].'€';     
                        }?>
                        </td>
                        <td> 
                        <ul class="p-0">
                            <?php foreach($p_needs as $need) { 
                                if($data['id_user'] == $need['supplier_id']) {
                                    echo ' <li> '.$need['need_name'].' ('.$need['category_name'].')</li> ';
                                }
                            } ?>
                        </ul>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if((isset($creator)) || (isset($admin))) { ?>
        <?php if(!empty($claimers)) { ?>
        <div class="row col-12 mt-4 table-responsive" >
            <h2 id="participants">Participants en attente</h2>
            <table class="table table-dark">
                <thead>
                    <tr>
                    <th scope="col">Pseudonyme</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($claimers as $data) { ?>
                    <tr>
                        <th scope="row"><?php echo $data['alias']; ?></th>
                        <td>
                            <a href="<?php echo site_url('event/acceptclaim/'.$data['event_id'].'/'.$data['id_user']) ?>"><button class="btn btn-primary"><i class="fas fa-user-check"></i> Accepter</button></a>
                            <a href="<?php echo site_url('event/deleteparticipant/'.$data['event_id'].'/'.$data['id_user']) ?>"><button class="btn btn-primary"><i class="fas fa-user-slash"></i> Décliner</button></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <?php }} ?>
        <?php foreach($event as $data) { ?>

        <div class="row col-12 mt-4 table-responsive"<?php if($data['mandatory_needs'] == FALSE) { echo 'style="display:none;"'; } ?>>

        <?php } ?>

            <h2 id="needs">Besoins de l'évenement</h2>
            <table class="table table-dark" >
                <thead>
                    <tr>
                    <th scope="col">Besoin</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Etat</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach($needs->result() as $need) { ?>

                    <tr>
                    <th scope="row">
                    <?php if((isset($creator)) || (isset($admin))) { ?>
                        <a class="text-danger" href="<?php echo site_url('event/removeneed/'.$need->event_id.'/'.$need->event_needs_id.'')?>"><i class="fas fa-trash" data-toggle="tooltip" data-placement="top" title="" data-original-title='Supprimer "<?php echo $need->need_name ?>" '></i></a>
                    <?php } ?>
                    <?php echo html_escape($need->need_name); ?></th>

                    <td><?php echo $need->category_name; 
                    ?></td>

                    <td><?php 
                    if($need->supplier_id) {
                        echo '<i class="far fa-check-circle"></i> '.$need->alias.'';
                            if((isset($creator)) || (isset($admin))) {
                                echo '<a class="text-danger" href="'.site_url('event/removesupplier/'.$need->event_id.'/'.$need->event_needs_id.'').'"><i class="fas fa-times" data-toggle="tooltip" data-placement="top" title="" data-original-title="'.$need->alias.' ne s\'occupera plus de ce besoin"></i></a>';
                            }
                    } else {
                        echo form_open('event/supplier/'.$data['event_id'].'/'.$need->event_needs_id.'');
                        echo ' <button name="submit" type="submit" class="btn btn-primary">Je m\'occupe de ça !</button>';
                        echo form_close();
                    } ?></td>
                    </tr>
                <?php } ?>    
                </tbody>
            </table>
            
        </div>
        <?php foreach($event as $data) { ?>
        <div class="row">
            <div class="col-12 col-lg-6 mt-4" <?php if($data['mandatory_fees'] == FALSE) { echo 'style="display:none;"'; } ?>>
                <h2 id="fees" class="col-12">Cotisations</h2>
                <?php foreach($total_fees as $fees) { ?>
                <p class="col-12"><?php if(isset($fees['fees'])) {echo $fees['fees'];} else { echo "0";}  ?>€ sur les <?php echo $data['max_fees']; ?>€ nécessaires</p>
                
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: <?php echo ($fees['fees'] / $data['max_fees']) * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="10"></div>
                    </div>
                    <button id="new-fees" class="btn btn-primary mt-3 mb-3" onclick="newFees();">Nouvelle cotisation</button>
                    <?php
                        echo form_open('event/fees/'.$data['event_id'].'');
                    ?>
                    <div class="form-group row" id="form-fees">
                        <label for="new_fees" class="col-8 col-form-label">Nouvelle cotisation</label> 
                        <div class="col-8">
                            <input id="new_fees" name="new_fees" type="number" class="form-control" placeholder="€" required>
                            <button name="submit" type="submit" class="btn btn-primary mt-3">Envoyer</button>
                        </div>
                    </div>
                    <?php 
                        echo form_close(); 
                    ?>
                </div>

            </div>
            <div class="col-12 col-lg-6 mt-4 mb-3">
                    <h2>Envoyer un invitation</h2>
                    <p><small>Envoyez ce lien aux personnes que vous souhaitez inviter à l'évènement :</small></p>
                    <input class="col-10" type="text" value="<?php echo site_url('event/plan/'.$data['event_id'].'')?>">
            </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXRn5rmqdbhE0SknwFL8ILrBnnfiQA_lM&callback=initMap">google.maps.event.addDomListener(window,'load', initMap);
</script>