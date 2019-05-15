function calculCharge(id,value) {
  var charge=document.getElementById("qte_charge_"+id);
  var init=document.getElementById("qte_init_"+id);
  charge.value=parseInt(init.value)+parseInt(value);
  calculRetoune(id);
}
function collVide(qte_vendue) {
  if(qte_vendue.value==""){qte_vendue.value=0;}
  if((qte_vendue.value.length>1)&&(qte_vendue.value[0]=="0")){
    qte_vendue.value=parseInt(qte_vendue.value.substring(1,qte_vendue.value.length));
  }
}

function calculRetoune(id) {
  var charge=document.getElementById("qte_charge_"+id);
  var retoune=document.getElementById("qte_retoune_"+id);
  var qte_vendue_dd=document.getElementById("qte_vendue_dd_"+id);
  var qte_vendue_dg=document.getElementById("qte_vendue_dg_"+id);
  var qte_vendue_sg=document.getElementById("qte_vendue_sg_"+id);
  collVide(qte_vendue_dd);
  collVide(qte_vendue_dg);
  collVide(qte_vendue_sg);
  vendue=parseInt(qte_vendue_dd.value)+parseInt(qte_vendue_dg.value)+parseInt(qte_vendue_sg.value);
  retoune.value=parseInt(charge.value)-vendue;
  if(parseInt(retoune.value)<0){
    retoune.style.background="#FF0000";
    retoune.style.color="white";
  }else{
    retoune.style.background="";
    retoune.style.color="";
  }
  somme(id);
  facture();
}
function somme(id) {
  var prix_dd=document.getElementById("prix_dd_"+id);
  var prix_dg=document.getElementById("prix_dg_"+id);
  var prix_sg=document.getElementById("prix_sg_"+id);
  var qte_vendue_dd=document.getElementById("qte_vendue_dd_"+id);
  var qte_vendue_dg=document.getElementById("qte_vendue_dg_"+id);
  var qte_vendue_sg=document.getElementById("qte_vendue_sg_"+id);
  var somme=document.getElementById("somme_"+id);
  somme.value=parseInt(prix_dd.value)*parseInt(qte_vendue_dd.value)
            +parseInt(prix_dg.value)*parseInt(qte_vendue_dg.value)
            +parseInt(prix_sg.value)*parseInt(qte_vendue_sg.value);
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
