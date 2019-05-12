<!DOCTYPE html>
<html>
<head>
	<title>commande</title>
	<meta charset="utf-8">

	<style type="text/css">
		.couleur-grey:nth-of-type(odd){
			 background-color:#F1F2F1; 
		}
	</style>

</head>

<body style="font-family:arial;">


<div style=" padding-right:0px;padding-left: 15px;margin-top:15px;  width:95%;">


	<div  style="border-top: 2px solid #EBECEC;border-bottom: 2px solid #EBECEC;width: auto;
	             height: 23px;padding: 10px;margin-bottom: -10px;">
		<div>
			     <span style="display: flex;justify-content: space-between;">
			      	<span class="first" style="display: flex;justify-content: space-between;        font-size:25px;margin-top:-8px; ">

			      	commande 

			        </span>
			        numero : 1522
			        <span style="display: flex;justify-content: space-between;">
			        	Vehicule : 
			        	<b> M2 </b>
			        </span>
			        <span style="display: flex;justify-content: space-between;">Vendeur :
			         <b> Oussema FOURA </b>
			      </span>
			        <span class="date" style="display: flex;padding-right:50px;
			          ">Date : 02/05/2019
			        </span>
			     </span>
		</div>
		
	</div>

	<table style="  padding: 4px; margin:16px; margin-top :16px; margin-left: 0; background-color:white;width: 100%;margin-bottom: 1rem;border-collapse: collapse; ">

		<tr class="couleur-grey" style="border-bottom: 1px solid #F1F2F1; border-top: 1px solid #F1F2F1;padding: 0;">
		    <td style="padding:10px 1px;font-weight: bold;">Designation</td>
		    <td style="padding:10px 1px;font-weight: bold;">Qte initiale</td>
		    <td style="padding:10px 1px;font-weight: bold;">Qte commandé</td>
		    <td style="padding:10px 1px;font-weight: bold;">Qte sortie</td>
		    <td style="padding:10px 1px;font-weight: bold;">Qte chargé</td>
		    <td style="padding:10px 1px;font-weight: bold;">Qte retourné</td>
		    <td style="padding:10px 1px;font-weight: bold;">Qte vendue</td>
		    <td style="padding:10px 1px;font-weight: bold;">Prix unitaire</th>
		</tr>
     
       
		

		 
		<tr class="couleur-grey" style="border-bottom: 1px solid #F1F2F1;">
			<td style="">Eau plate</td>
			<td style="padding: 0;padding-left: 3px;">
				<input type="text" name="" placeholder="0" style="width: 80px;border: 0;font-size: 16px; background: transparent;">
			</td>
			<td style="padding: 0;padding-left: 3px;">
				<input type="text" name="" placeholder="0" style="width: 80px;border: 0;background:transparent; font-size: 16px;">
			</td>
			<td style="padding: 0;padding-left: 3px;">
				<input type="text" name="" placeholder="0" style="width: 80px;border: 0;background:transparent; font-size: 16px;">
			</td>
			<td style="padding: 0;padding-left: 3px;">
				<input type="text" name="" placeholder="0" style="width: 80px;border: 0;background:transparent; font-size: 16px;">
			</td>
			<td style="padding: 0;padding-left: 3px;">
				<input type="text" name="" placeholder="0" style="width: 80px;border: 0;background:transparent; font-size: 16px;">
			</td>
			<td style="padding: 0;padding-left: 3px;">
				<input type="text" name="" placeholder="0" style="width: 80px;border: 0;background:transparent; font-size: 16px;">
			</td>
			<td style="padding: 0; font-size: 16px;padding-left: 3px;">
				<table>
					<tr style="background-color:transparent;">
						<td style="padding: 0; border:0;">dd : </td>
						<td style="padding: 0;padding-right:5px; padding-left:5px; border:0;border-right:1px solid #D5D5D5;">
							<input type="text" name="" placeholder="0" style="width:23px;border: 0;background:transparent;">
						</td>

						<td style="padding: 0; border:0; padding-left:5px;">semi-gros :</td>
						<td style="padding: 0;padding-right:5px;padding-left:5px; border:0;border-right:1px solid #D5D5D5;">
							<input type="text" name="" placeholder="0" style="width:23px;border: 0;background:transparent;">
						</td>
				
						<td style="padding: 0; border:0; padding-left:5px;">gros :</td>
						<td style="padding: 0; border:0;">
							<input type="text" name="" placeholder="0" style="width:23px;border: 0;background:transparent;">
						</td>
					</tr>
				</table>
            </td>
		</tr>

		
    </table>







	<table class="fre" style="margin-bottom: 150px;float: right;">
		 <tr style="">
			<td  align="right" class="total" style="font-size: 22px;padding-left: 30px;">
				Facture :
			</td>
			<td>
		      <span class="c-total" style="font-size: 17px;margin-left: 10px;font-weight: bold;">    250 050.00 
			      <b style="padding-left: 8px;padding-right: 70px;font-weight:bold;">Da</b>
			  </span>
			</td>
		</tr>
			<td align="right" class="total" style="font-size: 22px;">Recette :</td>
			<td>
				<span class="c-total" style="font-size: 17px;margin-left: 10px;font-weight: bold;">
					<input type="text" class="recette" name="" placeholder="0" style="width:80px;border: 0;background:transparent; font-size: 17px; font-weight: bold;font-family: arial;"> Da 
				</span>
			</td>
		<tr>
			<td align="right" class="total" style="font-size: 22px;padding-left: 70px;">Ecart :</td>
			<td >
				<span class="c-total" style="color:red;font-size: 17px;margin-left: 10px;
	                  font-weight: bold;">
	                2 000.00 Da
	            </span>
			</td>
		</tr>
	</table>

	
	
</div>


</body>
</html>