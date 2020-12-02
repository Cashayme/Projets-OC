$(".btn").removeClass("waves-effect waves-light");

// Quand l'user scroll une page le style de la navbar s'adapte
window.onscroll = function() {scrollFunction()};

function scrollFunction() {

  if (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) {
    document.getElementById("navbar").style.height = "60px";
    document.getElementById("navbar").style.borderBottom = "none";

    document.getElementById("navlogo").style.height = "60px";
    document.getElementById("navlogo").style.width = "60px";
    document.getElementById("navlogo").style.border = "none";

    for (let i = 0; i < document.getElementsByClassName("nav-btn").length; i++) {
        document.getElementsByClassName("nav-btn")[i].style.marginTop = "1rem";
    }

  } else {
    document.getElementById("navlogo").style.height = "100px";
    document.getElementById("navlogo").style.width = "100px";
    document.getElementById("navlogo").style.border = "5px solid #c6c6c6";
    document.getElementById("navbar").style.backgroundColor = "#650696";
    document.getElementById("navbar").style.height = "90px";
    document.getElementById("navbar").style.borderBottom = "6px solid #c6c6c6";

    for (let i = 0; i < document.getElementsByClassName("original-btn").length; i++) {
        document.getElementsByClassName("original-btn")[i].style.marginTop = "3rem";
     }
  }
}


//Anime l'icone du menu burger
let forEach=function(t,o,r){if("[object Object]"===Object.prototype.toString.call(t))for(let c in t)Object.prototype.hasOwnProperty.call(t,c)&&o.call(r,t[c],c,t);else for(let e=0,l=t.length;l>e;e++)o.call(r,t[e],e,t)};

let hamburgers = document.querySelectorAll(".hamburger");
if (hamburgers.length > 0) {
  forEach(hamburgers, function(hamburger) {
    hamburger.addEventListener("click", function() {
      this.classList.toggle("is-active");
    }, false);
  });
}

//Configuration Toastr
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": false,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "100",
  "hideDuration": "100",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "slideDown",
  "hideMethod": "slideUp"
}