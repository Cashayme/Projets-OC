<div class="container-fluid wrapper mb-5">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box">
        <h1 class="p-3">Tous les évènements publics</h1>

        <a href="<?php echo ''.site_url('event/create').'' ?>"><button class="btn btn-primary"><i class="fas fa-plus-circle"></i>  Créer un évènement</button></a>

        <div class="row col-12 mt-4 table-responsive">
        <table class="table table-dark">
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
                    <td><a href="<?php echo ''.site_url('event/plan/'.$event->event_id.'').'' ?>"><button class="btn btn-primary">Voir l'évènement</button></a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
