<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>purchase</title>
	<!-- 匯入my_css -->
	<link rel="stylesheet" href="css/my_css.css" type="text/css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <style>
    	#btADD{
    		right: 5px; 
    	}
    	div.tab {
		    overflow: hidden;
		    border: 1px solid #ccc;
		    background-color: #f1f1f1;
		}

		/* Style the buttons inside the tab */
		div.tab button {
		    background-color: inherit;
		    float: left;
		    border: none;
		    outline: none;
		    cursor: pointer;
		    padding: 14px 16px;
		    transition: 0.3s;
		}

		/* Change background color of buttons on hover */
		div.tab button:hover {
		    background-color: #ddd;
		}

		/* Create an active/current tablink class */
		div.tab button.active {
		    background-color: #ccc;
		}

		/* Style the tab content */
		.tabcontent {
		    display: none;
		    padding: 6px 12px;
		    border: 1px solid #ccc;
		    border-top: none;
		}
    </style>

</head>
<body>

	<div><?php include('menu.php');?></div> <!-- 匯入menu -->
	<div class="row">
		<div class="col-lg-2"></div>
		<div id="divTab" class="col-lg-8">
			<div class="tab" style="margin-top:100px ">
			  <button class="tablinks" onclick="openCity(event, 'Purchase')">進貨維護</button>
			  <button class="tablinks" onclick="openCity(event, 'Return')">退貨維護</button>
			</div>
			<div id="Purchase" class="tabcontent ">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<div class="text-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPurchase" style="margin-bottom: 10px;margin-top: 20px">
							  進貨
							</button>
						</div>
						<table class="table table-hover">
							<thead class="thead-dark">
							  <tr>
							    <th scope="col">id</th>
							    <th scope="col">廠商編號</th>
							    <th scope="col">日期</th>
							    <th scope="col">驗收人</th>
							    <th scope="col">進貨單細項</th>
							  </tr>
						    </thead>
						  <tbody>
						  	<?php foreach($result as $e){?>
						  		<tr>
						  			<th><?php echo $e['phid'] ?></th>
								    <th><?php echo $e['mid'] ?></th>
								    <th><?php echo $e['date'] ?></th>
								    <th><?php echo $e['acceptance'] ?></th>
								    <th>
								    	<?php echo '<form method="POST" action="?action=Purchase_seeContent&phid='.$e['phid'].'">'; ?>
									    	<button type="submit" class="btn btn-primary">
											  查看
											</button>
										</form>
										
									</th>
						  		</tr>
						    <?php }?>
						  </tbody>
						</table>
					</div>
					<div class="col-lg-1"></div>
				</div>
			</div>
			<div id="Return" class="tabcontent">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						
						<table class="table table-hover">
							<thead class="thead-dark">
							  <tr>
							    <th scope="col">PBid</th>
							    <th scope="col">廠商編號</th>
							    <th scope="col">進貨日期</th>
							    <th scope="col">進貨經辦人</th>
							    <th scope="col">退貨單細項</th>
							  </tr>
						    </thead>
						  <tbody>
						  	<?php foreach($result_RH as $rh){?>
						  		<tr>
						  			<th><?php echo $rh['phid'] ?></th>
								    <th><?php echo $rh['mid'] ?></th>
								    <th><?php echo $rh['pdate'] ?></th>
								    <th><?php echo $rh['pacceptance'] ?></th>
								    <th>
								    	<?php echo '<form method="POST" action="?action=Return_seeContent&phid='.$rh['phid'].'">'; ?>
									    	<button type="submit" class="btn btn-primary">
											  查看
											</button>
										</form>
										
									</th>
						  		</tr>
						    <?php }?>
						  </tbody>
						</table>
					</div>
					<div class="col-lg-1"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-2"></div>
	</div>



	<!-- Modal Purchase_add-->
	<div class="modal fade bd-example-modal-lg" id="ModalPurchase" tabindex="-1" role="dialog" aria-labelledby="ModalLabelPurchase" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalLabelPurchase">進貨單</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Purchase_add">
				  <div class="form-group row">
				    <label for="inputMid" class="col-sm-4 col-form-label">廠商編號</label>
				    <div class="col-sm-8">
				      <select class="form-control" id="inputMid" name="inputMid">
						      <?php foreach($result_M as $eM){
						  		echo'<option value="'.$eM['mid'].'">'.$eM['mname'].'</option>';
							  }?>
						    </select>
				    </div>
				  </div>
				  <div class="form-group row">
				    <label for="inputAcceptance" class="col-sm-4 col-form-label">驗收人</label>
				    <div class="col-sm-8">
				      <input  class="form-control" id="inputAcceptance" placeholder="Name" name="inputAcceptance">
				    </div>
				  </div>
				  <hr>
				  <input readonly class="form-control-plaintext" id="inputPCount" name="inputPCount" style="display: none;" value="1">
				  <div id="Pcontent">
				  	<div class="row">
					    <div class="col">
						    <select class="form-control" id="SelectChocolate1" name="SelectChocolate1">
						      <?php foreach($result_C as $eCh){
						  		echo'<option value="'.$eCh['chid'].'">'.$eCh['chname'].'</option>';
							  }?>
						    </select>
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" name="inputQu1" placeholder="數量">
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" name="inputPr1" placeholder="單價">
					    </div>
					    <div class="col">
					      <input type="text" class="form-control" name="inputRe1" placeholder="備註">
					    </div>
					</div>
				  </div>
				

				  <button type="button" class="btn btn-outline-success" style="margin-top: 10px" onclick="addPcontent()">+</button>
				  <div class="text-right">
					  	<input type="button" class="btn btn-secondary" data-dismiss="modal" value="取消"/>
					 	<input type="submit" class="btn btn-primary" value="新增"/>
				  </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	
	

</body>
<script>
  		function openCity(evt, cityName) {
		    // Declare all variables
		    
		    var i, tabcontent, tablinks;

		    // Get all elements with class="tabcontent" and hide them
		    tabcontent = document.getElementsByClassName("tabcontent");
		    for (i = 0; i < tabcontent.length; i++) {
		        tabcontent[i].style.display = "none";
		    }

		    // Get all elements with class="tablinks" and remove the class "active"
		    tablinks = document.getElementsByClassName("tablinks");
		    for (i = 0; i < tablinks.length; i++) {
		        tablinks[i].className = tablinks[i].className.replace(" active", "");
		    }

			    // Show the current tab, and add an "active" class to the button that opened the tab
			    document.getElementById(cityName).style.display = "block";
			    evt.currentTarget.className += " active";
		}

		function hiden_high(){
			document.getElementById('but_high').style.visibility = 'hidden';
		}

		//触发模态框的同时调用此方法  
		function sCHANGE(acc) {  
		    //向模态框中传值
		    document.getElementById('Cacc').value=acc;
		}  

		function bcCuEd(cid,name,tel,add,tax,lea){
			document.getElementById('CidInput').value=cid;
			document.getElementById('inputNameCeEd').value = name;
			document.getElementById('inputTelCeEd').value = tel;
			document.getElementById('inputAddressCeEd').value = add;
			document.getElementById('inputTaxidCeEd').value = tax;
			document.getElementById('inputLeaderCeEd').value = lea;
		}
		
		function bcMaEd(mid,name,tel,add,tax,lea){
			document.getElementById('MidInput').value=mid;
			document.getElementById('inputNameMaEd').value = name;
			document.getElementById('inputTelMaEd').value = tel;
			document.getElementById('inputAddressMaEd').value = add;
			document.getElementById('inputTaxidMaEd').value = tax;
			document.getElementById('inputLeaderMaEd').value = lea;
		}

		
		var divPC= document.getElementById('Pcontent');
		var pccount=1;

		function PCcount(){
			pccount+=1;
		}
		
		function addPcontent() {
			PCcount();
		
			$('#Pcontent').append("<div class='row'><div class='col'><select class='form-control' id='SelectChocolate"+pccount+"' name='SelectChocolate"+pccount+"'></select></div><div class='col'><input type='text' class='form-control' name='inputQu"+pccount+"' placeholder='數量'></div><div class='col'><input type='text' class='form-control' name='inputPr"+pccount+"' placeholder='單價'></div><div class='col'><input type='text' class='form-control' name='inputRe"+pccount+"' placeholder='備註'></div></div>");
			
			<?php foreach($result_C as $eCh){?>
			 	var opt = document.createElement('option');
			    opt.value = <?php echo "\"". $eCh['chid'] ."\""?>;
			    opt.text = <?php echo "\"". $eCh['chname'] ."\""?>;
			    var sel= document.getElementById("SelectChocolate"+pccount);
			    sel.appendChild(opt);
			<?php }?>

			document.getElementById('inputPCount').value=pccount;
		}

		// function Receiving(){
		// 	$("#btCancel").attr("disabled","disabled");
		// 	$("#btReceive").attr("disabled","disabled");
		// 	$("#btReturn").removeAttr("disabled");
		// }

	


		

		document.getElementById("defaultOpen").click();
	</script>

</html>