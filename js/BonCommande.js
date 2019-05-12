function calculCharge(id,value) {
  var charge=document.getElementById("qte_charge_"+id);
  var init=document.getElementById("qte_init_"+id);
  var vendue=document.getElementById("id_vendue_"+id);
  charge.value=parseInt(init.value)+parseInt(value);
  calculRetoune(id,parseInt(vendue.value));
}

function calculRetoune(id,value) {
  var charge=document.getElementById("qte_charge_"+id);
  var retoune=document.getElementById("qte_retoune_"+id);
  var vendue=document.getElementById("id_vendue_"+id);
  if(value==""){
    vendue.value=0;
  }
  if(parseInt(charge.value)<parseInt(vendue.value)){
    retoune.value=0;
    vendue.value=parseInt(charge.value);
  }else{
    retoune.value=parseInt(charge.value)-parseInt(value);
  }
  somme(id,vendue.value);
  facture();
}
function somme(id,value) {
  var prix=document.getElementById("prix_"+id);
  var somme=document.getElementById("somme_"+id);
  somme.value=parseInt(prix.value)*value;
}

function facture() {
  var list=document.getElementsByClassName("sommeclass");
  var facture=document.getElementById("facture");
  var somme=0;
  for (var i = 0; i < list.length; i++) {
    somme+=parseInt(list[i].value);
  }
  facture.value=somme;
  _ecart();
}
function _ecart() {
   var facture=document.getElementById("facture");
   var recette=document.getElementById("recette");
   var ecart=document.getElementById("ecart");
   ecart.value=parseInt(recette.value)-parseInt(facture.value);
}
