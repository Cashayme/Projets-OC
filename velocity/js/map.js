let marker = [];
let themap;
let mymap = {
    lyon: {
        lat: 45.7532576,
        lng: 4.8689777
    },
    map: function() {
        /*Initialisation de la map centrée sur Lyon*/
        themap = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: this.lyon
        });
    },
    markers: function() {
        /*Création des markers selon les infos de l'API JC Decaux*/
        $.getJSON("https://api.jcdecaux.com/vls/v1/stations?contract=lyon&apiKey=810d31253af902ac2899333575b7379d3ce5333b", function(data) {
            for (let i = 0; i < data.length; i++) {
                if (data[i].status == "OPEN") {
                    /*Si la station est ouverte*/
                    marker[i] = new google.maps.Marker({
                        position: {
                            lat: data[i].position.lat,
                            lng: data[i].position.lng
                        },
                        address: data[i].address,
                        bikes: data[i].available_bikes,
                        places: data[i].available_bike_stands,
                        map: themap,
                        title: data[i].name,
                        icon: 'https://zupimages.net/up/19/25/vtfx.png'
                    });
                } else {
                    /*si elle est fermée*/
                    marker[i] = new google.maps.Marker({
                        position: {
                            lat: data[i].position.lat,
                            lng: data[i].position.lng
                        },
                        address: data[i].address,
                        bikes: data[i].available_bikes,
                        places: data[i].available_bike_stands,
                        map: themap,
                        title: data[i].name,
                        icon: 'https://zupimages.net/up/19/25/q437.png'
                    });
                }

                // au clic sur un marqueur
                marker[i].addListener('click', function() {

                    // cache le message de réservation validée et affiche le formulaire dans le cas où on aurait déjà réservé
                    document.getElementById("resa-form-infos").style.display = "block";
                    document.getElementById("resa-validee").style.display = "none";

                    /*au clic, on injecte les informations de la station dans le formulaire de réservation*/
                    document.getElementById("station-name").innerHTML = `${marker[i].title}`;
                    document.getElementById("station-address").innerHTML = `${marker[i].address}`;
                    document.getElementById("bike-quantity").innerHTML = `${marker[i].bikes}`;
                    document.getElementById("available-place").innerHTML = `${marker[i].places}`;
                    
                    if (data[i].status == "OPEN") {
                        /*Si la station est ouverte, on affiche les champs à remplir*/
                        document.getElementById("reservation").style.display = "block";
                    } else {
                        /*Sinon, on les cache*/
                        document.getElementById("reservation").style.display = "none";
                    }
                });
            }
            let markerCluster = new MarkerClusterer(themap, marker, {
                /*feature Google pour grouper les markers*/
                imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
            });
        })
    }
}