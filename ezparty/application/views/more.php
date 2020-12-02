
<?php if(isset($events)) {
         foreach($events->result() as $event) { ?>
                    <tr class="hidden">
                    <th scope="row"><img class="rounded-img" src="assets/images/uploaded_images/<?php if ($event->event_picture) {
                        echo html_escape( $event->event_picture );
                    } else {
                        echo "default.jpg";
                    }  ?>" alt="image de l'event"></th>
                    <td><?php echo html_escape($event->event_name) ?></td>
                    <td><?php echo html_escape($event->event_date) ?></td>
                    <td><?php echo html_escape($event->city_address) ?></td>
                    <?php if(isset($admin)) { ?>
                        <td><a onclick="return confirm('Confirmer la suppression de cet événement ?');" href="<?php echo ''.site_url('admin/delevent/'.$event->event_id.'/'.$event->creator_id.'').'' ?>"><button class="btn btn-primary">Supprimer l'évènement</button></a></td>
                    <?php } else { ?>
                    <td><a href="<?php echo ''.site_url('event/plan/'.$event->event_id.'').'' ?>"><button class="btn btn-primary">Voir l'évènement</button></a></td>
                    <?php } ?>
                    </tr>
<?php } } else if(isset($users)) {?>
    <?php foreach($users->result() as $user) { ?>
                    <tr>
                    <th scope="row"><?php echo html_escape($user->alias) ?></th>
                    <td><?php echo html_escape($user->name) ?></td>
                    <td><?php echo html_escape($user->first_name) ?></td>
                    <td><?php echo html_escape($user->email) ?></td>
                    <td><a onclick="return confirm('Confirmer la suppression de cet événement ?');" href="<?php echo ''.site_url('admin/deluser/'.$user->id_user.'').'' ?>"><button class="btn btn-primary">Supprimer l'utilisateur</button></a></td>
                    </tr>
                <?php } } ?>