function calcul(id,value) {
  var init=document.getElementById("Init-"+id);
  var commande=document.getElementById("commande-"+id);
  var charge=document.getElementById("charge-"+id);
  if(commande.value==""){
    charge.value=parseInt(init.value);
    commande.value=0;
  }else{ if(parseInt(commande.value)<0){
            commande.value=-parseInt(commande.value);
        }else{
          charge.value=parseInt(init.value)+parseInt(value);
        }
  }
}
