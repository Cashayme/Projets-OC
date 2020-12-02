<div class="container-fluid wrapper">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box">
    <h1 class="col-12 pl-0 mt-3">Panneau d'aministration</h1>
    <div class="row">
    <div class="col-6  mt-4">
        <?php if(isset($events)) { ?>
        <h2 class="text-break">Tous les évènements</h2>
        <?php } else if(isset($users)) {?>
        <h2 class="text-break">Tous les utilisateurs</h2>
        <?php } ?>
        <a href="<?php echo ''.site_url('admin').'' ?>"><button class="btn btn-primary mb-3">Voir tous les évènements</button></a>
        <a href="<?php echo ''.site_url('admin/listuser').'' ?>"><button class="btn btn-primary mb-3">Voir tous les utilisateurs</button></a>
    </div>
    <div class="col-12 mt-4 table-responsive">
        <table class="table table-dark">
        <?php if(isset($events)) { ?>
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Date</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Participation</th>
                    </tr>
                </thead>
                <tbody id="content">
                <?php foreach($events->result() as $event) { ?>
                    <tr>
                    <th scope="row"><img class="rounded-img" src="assets/images/uploaded_images/<?php if ($event->event_picture) {
                        echo html_escape( $event->event_picture );
                    } else {
                        echo "default.jpg";
                    }  ?>" alt="image de l'event"></th>
                    <td><?php echo html_escape($event->event_name) ?></td>
                    <td><?php echo html_escape($event->event_date) ?></td>
                    <td><?php echo html_escape($event->city_address) ?></td>
                    <td><a onclick="return confirm('Confirmer la suppression de cet événement ?');" href="<?php echo ''.site_url('admin/delevent/'.$event->event_id.'/'.$event->creator_id.'').'' ?>"><button class="btn btn-primary">Supprimer l'évènement</button></a></td>
                    </tr>
                <?php } ?>
                </tbody>
                <?php } else if(isset($users)) {?>
                    <thead>
                    <tr>
                    <th scope="col">Alias</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="content">
                <?php foreach($users->result() as $user) { ?>
                    <tr>
                    <th scope="row"><?php echo html_escape($user->alias) ?></th>
                    <td><?php echo html_escape($user->name) ?></td>
                    <td><?php echo html_escape($user->first_name) ?></td>
                    <td><?php echo html_escape($user->email) ?></td>
                    <td><a onclick="return confirm('Confirmer la suppression de cet événement ?');" href="<?php echo ''.site_url('admin/deluser/'.$user->id_user.'').'' ?>"><button class="btn btn-primary">Supprimer l'utilisateur</button></a></td>
                    </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
    </div>
        
    </div>
        <hr>  
</div>