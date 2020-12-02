<div class="container-fluid wrapper mb-5">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box">
        <?php if(isset($mine)) { ?>
        <h1 class="p-3">Mes évenements</h1>
        <?php } else { ?>
        <h1 class="p-3">J'y participe</h1>
        <?php } ?>
        <div class="row col-12 mt-4 table-responsive">
        <?php if(!empty($events->result())) { ?>
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
                <tbody>
                <?php  
                foreach($events->result() as $event) 
                { ?>
                    <tr>
                    <th scope="row"><img class="rounded-img" src="../assets/images/uploaded_images/<?php if ($event->event_picture) {
                        echo html_escape( $event->event_picture );
                    } else {
                        echo "default.jpg";
                    }  ?>" alt="image de l'event"></th>
                    <td><?php echo html_escape($event->event_name) ?></td>
                    <td><?php echo html_escape($event->event_date) ?></td>
                    <td><?php echo html_escape($event->city_address) ?></td>
                    <td>
                        <a href="<?php echo ''.site_url('event/plan/'.$event->event_id.'').'' ?>"><button class="btn btn-primary m-1">Voir l'évènement</button></a>
                        <?php if(isset($mine)) { ?>
                            <a href="<?php if($event->event_picture != '') {
                                echo ''.site_url('event/edit/'.$event->event_id.'/'.$event->event_picture.'').'';
                            } else {
                                echo ''.site_url('event/edit/'.$event->event_id.'/0').'';
                            }
                            ?>"><button class="btn btn-primary m-1">Editer</button></a>
                            <a href="<?php echo ''.site_url('event/delete/'.$event->event_id.'/'.$event->event_picture.'').'' ?>"><button class="btn btn-primary m-1" onclick="return confirm('Confirmer la suppression de cet événement ?');">Supprimer</button></a>
                        <?php } ?>
                    </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
            <h3 class="text-center">Aucun évènement ici...</h2>
            <?php } ?>
        </div>
    </div>
</div>
