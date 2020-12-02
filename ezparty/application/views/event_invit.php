<div class="container-fluid wrapper mb-5">
    <div class="col-lg-8 col-md-10 col-sm-12 mx-auto box e-plan">
    <?php foreach(html_escape($event) as $data) { ?>
        <h1 class="p-3">Souhaitez vous participer à "<?php echo $data['event_name'] ?>" ?</h1>
        <div class="d-flex">
            <div class="col-6"><img class="img-fluid img-thumbnail mb-5" src="./../../assets/images/uploaded_images/<?php echo $data['event_picture']; ?>" alt="Image de l'évènement"></div>
            <div class="col-6 e-infos mb-5">
                <h2><?php echo $data['event_name']; ?></h2>
                <strong>Date : </strong>
                <p><?php echo $data['event_date']; ?></p>
                <strong>Description :</strong>
                <p><?php echo $data['event_description']; ?></p>
            </div>
        </div>
        <?php if(isset($msg)) { 
            echo '<div class="alert alert-dark col-5 mx-auto text-center">'.$msg.'</div> '; 
            } else {
                echo '<a href="'.site_url('event/claim/'.$data['event_id'].'/'.$this->session->userdata('id').'').'"><button class="btn btn-primary col-5 mb-3 mx-auto d-block">Je souhaite participer !</button></a>';
            }  ?>
               
    </div>
    <?php } ?>
</div>
