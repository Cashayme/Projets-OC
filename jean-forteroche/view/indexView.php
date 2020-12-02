<?php ob_start(); ?>


<div id="book" class="container jumbotron jumbotron-fluid col-lg-8 col-md-12 col-sm-12 col-xs-12 d-flex flex-wrap justify-content-center ">
    <h1 class="display-4 card-header col-12 text-center"> <i class="fas fa-book"></i>  Billet simple pour l'Alaska</h1>


    <?php
    while ($data = $posts->fetch()) 
    {
    ?>
        <article class="article card col-xl-4 col-lg-5 col-sm-8 border-dark">
            <img class="card-img-top" src="<?= $data['picture'] ?>" alt="Card image cap">
            <div class="card-body">
                <h1 class="card-title"><?= $data['title'] ?></h5>
                <p class="card-text desc-chapter white-text"><?= $data['description'] ?></p>
                <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-primary">Lire l'article</a>
            </div>
        </article>
    <?php
    }   
    ?>


</div>

<div id="author" class="container jumbotron jumbotron-fluid col-lg-8 col-md-12 col-sm-12 col-xs-12 d-flex flex-wrap justify-content-center ">
        <h1 class="display-4 card-header col-12 text-center"> <i class="fas fa-feather-alt"></i> Jean Forteroche </h1>
        <img class="pic-container" id="jf-pic" src="https://img.lemde.fr/2017/09/09/0/0/5472/3648/688/0/60/0/e40d613_32193-12eqpy2.bvaolayvi.jpg" alt="Photo de Jean Forteroche">
        <p class="text-container" id="bio">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur euismod dictum massa, ac luctus diam volutpat lacinia. Sed vel iaculis nibh. Praesent ut ornare libero. Maecenas tincidunt ante non sollicitudin sollicitudin. Proin dui lacus, congue ac tellus eu, maximus laoreet risus. Nunc condimentum massa ac nunc venenatis, sed posuere lectus pharetra. Nullam elementum pretium erat eget ultricies. Proin consectetur egestas mattis. Aenean a ante nec tellus vehicula rutrum. Donec non tempus sapien. Cras id erat lorem. Curabitur vel viverra nibh.<br>

            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus non commodo eros. Donec a turpis tincidunt leo mattis maximus a aliquam erat. Morbi eu dolor euismod, fermentum metus sit amet, ultricies lorem. Phasellus ac vehicula ante. Maecenas semper metus nec dolor ullamcorper, vitae auctor ante placerat. In hac habitasse platea dictumst. Vivamus vel venenatis erat, eget fringilla elit. Quisque posuere dolor ipsum, vitae aliquam eros lobortis id. Nulla dictum, est ac tempor facilisis, velit nibh pharetra nunc, ut consequat diam ante vitae tortor. Donec vel metus neque. Curabitur luctus justo non nunc varius sodales. Pellentesque dui dui, aliquet at mollis eget, mollis at nulla. Aenean consectetur felis fringilla dui aliquet dictum.<br>

            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer sit amet nisl neque. Fusce sed metus ut nisl faucibus vestibulum. Vestibulum ut lacus ex. Vivamus efficitur vel enim a tincidunt. Vestibulum semper justo nec diam vulputate, a commodo urna malesuada. Phasellus sed metus nunc. In in massa ultricies, sagittis dui a, tempor libero. Quisque sit amet posuere libero, ac interdum nisi.<br>

            Fusce nec magna dolor. Fusce auctor nulla eget lectus facilisis, ut luctus dolor lobortis. Donec scelerisque neque eget urna varius, a ornare tortor gravida. Integer convallis eros eget tortor laoreet, vitae efficitur libero vulputate. Duis ut purus mattis, tristique augue a, facilisis neque. Sed non diam nisl. Quisque massa quam, interdum in pulvinar nec, consequat a est. Pellentesque pulvinar nunc quis purus rhoncus auctor. Maecenas vitae orci ligula. Morbi vel sapien laoreet, venenatis leo ut, dignissim tortor. Curabitur eget ultrices odio, eu dignissim elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla pretium urna quis sapien rutrum ullamcorper. Vestibulum tortor turpis, eleifend sit amet massa sed, hendrerit pretium justo.<br>

            Nunc porta, lorem id condimentum mollis, lacus eros ultricies mauris, vitae fermentum neque nisl nec ligula. Vestibulum turpis diam, placerat id finibus eget, bibendum nec eros. Nunc lectus sapien, efficitur et interdum id, euismod luctus sem. Aenean accumsan libero urna, ultrices accumsan turpis vulputate vitae. Aliquam erat volutpat. Aenean convallis pulvinar ex, eget accumsan elit pellentesque aliquam. Aenean ac efficitur purus. Donec nec ligula erat. Morbi a sagittis risus, ac finibus leo. Nunc finibus eros eget purus laoreet, at euismod neque mattis. Sed non felis blandit, vulputate erat sed, ultricies arcu. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget mattis est, et accumsan erat.<br>
        </p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>