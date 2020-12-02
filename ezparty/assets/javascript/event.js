//Pour le formulaire d'event, affiche les infos/input suplémentaires si leurs checkbox sont check
function checkShow() {
  if(document.getElementById("mandatory_fees")) {
    if (document.getElementById("mandatory_fees").checked) {
      document.getElementById("maxFees").style.display = "flex";
    } else {
      document.getElementById("maxFees").style.display = "none";
    }
  }

  if(document.getElementById("private")) {
    if (document.getElementById("private").checked) {
      document.getElementById("private-info").style.display = "block";
    } else {
      document.getElementById("private-info").style.display = "none";
    }
  }

  if(document.getElementById("mandatory_needs")) {
    if (document.getElementById("mandatory_needs").checked) {
      document.getElementById("needs-group").style.display = "block";
    } else {
      document.getElementById("needs-group").style.display = "none";
    }
  }
}

//Ajoute une ligne pour la liste des besoins(event_form)
function addElement()
{
  d = document.getElementById("need-block"); 
  d_prime = d.cloneNode(true);
  document.getElementById("needs-group").appendChild(d_prime);
}

//révèle le formulaire de nouvelle cotisation au clic sur le button (event_plan)
function newFees()
{ 
  if(document.getElementById("form-fees")) {
    document.getElementById("form-fees").style.display = "none";

    document.getElementById("new-fees").addEventListener("click", function(){
      document.getElementById("form-fees").style.display = "block";  
      document.getElementById("new-fees").style.display = "none";
    });     
  }
}
