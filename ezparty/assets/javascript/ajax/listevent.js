function infiniteScroll() {
    // cette variable contient notre offset
    // par défaut à 15 puisqu'on a d'office les 15 premiers éléments au chargement de la page
    var offset = 15;
  
    $(window).data('ajaxready', true);
    // ici on ajoute un loader qui fera patienter pendant le chargement
    $('#content').append('<div id="loader"><img src="assets/images/rolling.svg" alt="loader ajax"></div>');
  
    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
  
    $(window).scroll(function() {
  
        if ($(window).data('ajaxready') == false) return;
  
        if(($(window).scrollTop() + $(window).height()) == $(document).height()
        || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()){
  
            $(window).data('ajaxready', false);
  
            // on affiche donc loader
            $('#content #loader').fadeIn(400).css("display","table-row");
  
            // puis on fait la requête pour demander les nouveaux éléments
            $.get('event/more/' + offset + '/', function(data){
                // s'il y a des données
                if (data != '') {
                    // on les insère juste avant le loader
                    $('#content #loader').before(data);
  
                    // on les affiche avec un fadeIn
                    $('#content .hidden').fadeIn(400).css("display","table-row");
  
                    /* enfin on incrémente notre offset de 10
                     * afin que la fois d'après il corresponde toujours
                    */
                    offset+= 10;
  
                    $(window).data('ajaxready', true);
                }
  
                // le chargement est terminé, on fait disparaitre notre loader
                $('#content #loader').fadeOut(400);
            });
        }
    });
  };