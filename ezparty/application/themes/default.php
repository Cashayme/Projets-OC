<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EZ PARTY - Organiser un évènement c'est EZ !</title>
    <link rel="icon" href="<?php echo ''.img_url('favicon').'' ?>">
    <?php foreach($css as $url): ?>
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $url; ?>" />
    <?php endforeach; ?>
    <link href="https://fonts.googleapis.com/css?family=Lexend+Deca&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rajdhani&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav id="navbar">
            <a class="navbar-brand" href="<?php echo ''.site_url('/index').'' ?>"> EZ PARTY</a>
            <button class="btn burger hamburger hamburger--squeeze" data-toggle="collapse" data-target="#burger-nav" >  
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span> 
            </button>
            <ul id="burger-nav" class="collapse">
                <li class="nav-btn"><a href="<?php echo ''.site_url('/index').'' ?>"><em class="fas fa-home"></em>Accueil</a></li>
                <li class="nav-btn"><a href="<?php echo ''.site_url('/index/informations').'' ?>"><em class="fas fa-info"></em>Informations</a></li>
                <li class="nav-btn"><a href="<?php echo ''.site_url('event').'' ?>"><em class="fas fa-glass-cheers"></em>Evènements</a></li>
                <?php if(!($this->session->userdata('logged')))
                        echo '<li class="nav-btn"><a href="'.site_url('login/index').'"><em class="fas fa-sign-in-alt"></em>Connexion</a></li>';
                    else 
                    {
                        echo '<li class="nav-btn"><a href="'.site_url('login/logout').'"><em class="fas fa-sign-out-alt"></em>Déconnexion</a></li>';
                    }
                ?>
            </ul>
            <div class="dropdown profile-view" <?php if(!($this->session->userdata('logged'))) echo 'style= "display:none"'; ?>>
                <button id="btn-lg" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ''.html_escape($this->session->userdata('alias')).'' ?>
                </button>
                <button id="btn-sm" class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <em class="fas fa-user-circle"></em>
                </button>
                    <div class="dropdown-menu" >
                      <a class="dropdown-item" href="<?php echo ''.site_url('/profile').'' ?>"><em class="fas fa-user-alt"></em> Mon profil</a>
                      <a class="dropdown-item" href="<?php echo ''.site_url("event/myevents").'' ?>"><em class="fas fa-glass-cheers"></em> Mes évènements</a>
                      <a class="dropdown-item" href="<?php echo ''.site_url("event/iparticipate").'' ?>"><em class="fas fa-users"></em> J'y participe</a>
                      <?php if(null !== $this->session->userdata('admin')) { ?>
                        <a class="dropdown-item" href="<?php echo ''.site_url("admin").'' ?>"><em class="fas fa-tools"></em> Panneau d'administration</a>
                      <?php } ?>
                    </div>
            </div>
            <ul id="original-nav">
                <li class="nav-btn original-btn"><a href="<?php echo ''.site_url('/index').'' ?>"><em class="fas fa-home"></em>Accueil</a></li>
                <li class="nav-btn original-btn"><a href="<?php echo ''.site_url('/index/informations').'' ?>"><em class="fas fa-info"></em>Informations</a></li>
                <li id="linav" ><img id="navlogo" src="<?php echo ''.img_url('logo').'' ?>" alt="logo de EZ Party"></li>
                <li class="nav-btn original-btn"><a href="<?php echo ''.site_url('event').'' ?>"><em class="fas fa-glass-cheers"></em>Evènements</a></li>
                <?php if(!($this->session->userdata('logged')))
                        echo '<li class="nav-btn original-btn"><a href="'.site_url('login/index').'"><em class="fas fa-sign-in-alt"></em>Connexion</a></li>';
                    else 
                    {
                        echo '<li class="nav-btn original-btn"><a href="'.site_url('login/logout').'"><em class="fas fa-sign-out-alt"></em>Déconnexion</a></li>';
                    }
                ?>
            </ul>
        </nav>
    </header>

    <?php echo $output; ?>

    <footer class="sticky-bottom d-flex flex-wrap">
        <div id="foot-left" class="col-lg-4 col-sm-12">
            <ul class="d-flex">
                <li><a href="#">Blog</a></li>
                <li><a href="#">Support</a></li>
                <li><a href="#">Légal</a></li>
                <li><a href="#">Presse</a></li>
            </ul>
            <p>
                Copyright © 2019 EZ Party.
            </p>
        </div>
        <div id="foot-center" class="col-lg-4 d-sm-none d-md-none d-lg-block">
            <img src="<?php echo ''.img_url('logo').'' ?>" alt="Logo du pied de page">
        </div>
        <div id="foot-right" class="col-lg-4 col-sm-12">
            <h3>Suivez-nous sur tous nos réseaux sociaux :</h3>
            <ul>
                <li>
                    <a href=""><em class="fab fa-twitter-square"></em></a>
                </li>
                <li>
                    <a href=""><em class="fab fa-facebook-square"></em></a>
                </li>
                <li>
                    <a href=""><em class="fab fa-instagram"></em></a>
                </li>
                <li>
                    <a href=""><em class="fab fa-youtube-square"></em></a>
                </li>
            </ul>
        </div>
    </footer>

<?php foreach($js as $url): ?>
		<script type="text/javascript" src="<?php echo $url; ?>"></script> 
<?php endforeach; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php if($this->session->userdata('toast-error')) { ?>

<script type="text/javascript">
    toastr["error"]("<?php echo $this->session->userdata('toast-error'); ?>", "Désolé !");
</script>
</html>
<?php $this->session->unset_userdata('toast-error'); ?>
<?php } ?>

<?php if($this->session->userdata('toast-success')) { ?>

<script type="text/javascript">
    toastr["success"]("<?php echo $this->session->userdata('toast-success'); ?>", "Succès !");
</script>
</html>
<?php $this->session->unset_userdata('toast-success'); ?>
<?php } ?>

<?php if($this->session->userdata('toast-info')) { ?>

<script type="text/javascript">
    toastr["info"]("<?php echo $this->session->userdata('toast-info'); ?>", "Action confirmée !");
</script>
</html>
<?php $this->session->unset_userdata('toast-info'); ?>
<?php } ?>
</body>