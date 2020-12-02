let slider = {

    slideIndex: 0,
    sliders: document.getElementsByClassName("mySlides"),

    slider: function() {
        /*Le slider*/
        for (let i = 0; i < slider.sliders.length; i++) {
            slider.sliders[i].style.display = "none";
        }
        slider.slideIndex++;
        if (slider.slideIndex > slider.sliders.length) {
            slider.slideIndex = 1
        }
        slider.sliders[slider.slideIndex - 1].style.display = "block";
    },

    sliderauto: function() {
        /*déclenchement du slider toutes les 5 secs*/
        slider.slider();
        autoslide = setInterval(this.slider, 5000);
    },

    slidereverse: function() {
        /*inversement du slider pour revenir en arrière*/
        for (let i = 0; i < slider.sliders.length; i++) {
            slider.sliders[i].style.display = "none";
        }
        slider.slideIndex += -1;
        if (slider.slideIndex < 1) {
            slider.slideIndex = slider.sliders.length;
        } else if (slider.slideIndex > slider.sliders.length) {
            slider.slideIndex = 1
        }
        slider.sliders[slider.slideIndex - 1].style.display = "block";
    },
};

/*Le bouton pause qui stop le défilement auto*/
document.getElementById("pause").addEventListener("click", function() {
    clearInterval(autoslide);
})

/*La flèche droite passe au suivant*/
document.getElementById("right-arrow").addEventListener("click", function() {
    slider.slider();
})

/*la gauche au précédent*/
document.getElementById("left-arrow").addEventListener("click", function() {
    slider.slidereverse();
})

/*flèche droite du clavier*/
$(document).on('keydown', function(e) {
    if (e.which == 39) {
        slider.slider();
    }
})

/*flèche gauche*/
$(document).on('keydown', function(e) {
    if (e.which == 37) {
        slider.slidereverse();
    }
})