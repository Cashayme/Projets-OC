let reservation = {

    interval: '',

    compteur: function() {

        // affichage du bandeau de réservation
        document.getElementById("bandeau").style.visibility = "visible";
        document.getElementById("bandeau-station").innerHTML = sessionStorage.getItem("bandeau-station");
        document.getElementById("bandeau-adresse").innerHTML = sessionStorage.getItem("bandeau-adresse");
        document.getElementById("resa-form-infos").style.display = "none";
        document.getElementById("resa-validee").style.display = "block";

        // si une réservation est déjà en cours
        if (sessionStorage.getItem("endDate") !== null){

            var datefin = new Date(sessionStorage.getItem("endDate"));
            var expTime = sessionStorage.getItem("expTime");

        }else{
            // si aucune résa n'est en cours
            var datefin = new Date();
            datefin.setMinutes(datefin.getMinutes() + 20);
            var expTime = `${datefin.getHours()}:${datefin.getMinutes()}:${datefin.getSeconds()}`;

            sessionStorage.setItem("endDate", datefin);
            sessionStorage.setItem("expTime", expTime);
        }
        
        document.getElementById("bandeau-expiration").innerHTML = expTime;

        // si un interval existe déjà, on le détruit
        if(reservation.interval != ''){
            clearInterval(reservation.interval);
        }

        /* Fonction qui fait le décompte entre l'heure actuelle et l'heure d'expiration*/
        reservation.interval = setInterval(function() {
            
            let now = new Date().getTime();
            let t = datefin.getTime() - now;

            if (t >= 0) {
                /*Si le temps d'expiration n'est pas à zéro ou moins, affiche le décompte*/
                let mins = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
                let secs = Math.floor((t % (1000 * 60)) / 1000);
                document.getElementById("bandeau-time").innerHTML = `${mins} minutes et ${secs} secondes`;
            } else {
                /*Sinon, affiche temps écoulé, fait disparaitre le bandeau de réservation et vide le sessionStorage*/
                document.getElementById("reserv-ok").innerHTML = "Temps écoulé";
                sessionStorage.removeItem('bandeau-station');
                sessionStorage.removeItem('bandeau-adresse');
                sessionStorage.removeItem('endDate');
                sessionStorage.removeItem('expTime');
                document.getElementById("bandeau").style.visibility = "hidden";
            }

        }, 1000);
    },

    isCanvasBlank: function(canvas) {
        /*fonction qui renvoie true si le canvas est blanc*/
        return !document.getElementById("canvas").getContext('2d')
            .getImageData(0, 0, document.getElementById("canvas").width, document.getElementById("canvas").height).data
            .some(channel => channel !== 0);
    }

}

// Au clic sur le bouton réserver
document.getElementById("reserver").addEventListener("click", function() {

    let wrongValueText = document.getElementsByClassName("wrong-value");

    let nom = document.getElementById("nom");
    let prenom = document.getElementById("prenom");

    if ((nom.value === "") || (prenom.value === "")) {

        /* Si nom et prénom sont vides, affiche un message*/
        for (var i = wrongValueText.length - 1; i >= 0; i--) {
            wrongValueText[i].style.display = "block";
        }

    } else {

        // le nom et prenom sont insérés
        if (reservation.isCanvasBlank() === true) {
            /* Si le canvas est vide, demande de le remplir*/
            document.getElementById("canvas-check").style.display = "block";
        } else {

            // le nom et prenom sont insérés et le canvas est rempli

            // je cache les eventuels message d'erreurs
            document.getElementById("canvas-check").style.display = "none";

            for (var i = wrongValueText.length - 1; i >= 0; i--) {
                wrongValueText[i].style.display = "none";
            }

            let sNameContent = document.getElementById("station-name").innerHTML;
            let sAdressContent = document.getElementById("station-address").innerHTML;

            // on stock les infos de réservation
            localStorage.setItem("firstname", document.getElementById("prenom").value);
            localStorage.setItem("name", document.getElementById("nom").value);

            sessionStorage.setItem("bandeau-station", sNameContent);
            sessionStorage.setItem("bandeau-adresse", sAdressContent);

            // si une session storage existe, on la détruit
            if (sessionStorage.getItem("endDate")){
                sessionStorage.removeItem("endDate");
            }

            reservation.compteur();

        }

    }

});