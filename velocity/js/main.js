$(document).ready(function() {
	mymap.map();
	mymap.markers();
	slider.sliderauto();
	canvas.signature();
});

/*Au chargement on récupère nom & prénom dans le localstorage*/
document.addEventListener('DOMContentLoaded', function(event) {
    document.getElementById("prenom").value = localStorage.getItem("firstname");
    document.getElementById("nom").value = localStorage.getItem("name");
});

// s'il y a une résa en cours, on relance le timer
$(document).ready(function() {
    
    if (sessionStorage.getItem("endDate") !== null) {

        reservation.compteur();
        
    }

});