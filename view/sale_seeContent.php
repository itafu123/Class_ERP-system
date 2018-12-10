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
	<div class="row" style="margin-top: 100px;">
		<div class="col-lg-2"></div>
		<div id="divTab" class="col-lg-8">
			<h2 ID>查看訂貨單細項</h2>
			<?php 
			$count=0;
			foreach($result as $e){ 
				if($count=="0"){
					$tbodyid="tbody".$e['sbid'];?>
					<div class="text-right">
						<?php if (empty($e['arrive'])){?>
				    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalArrive" style="margin-bottom: 10px;margin-top: 20px" onclick="arrive(<?php echo "'".$e['shid']."','".$e['sbid']."'"?>)">
				    	<?php } else{?>
				    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalArrive" style="margin-bottom: 10px;margin-top: 20px" onclick="arrive(<?php echo "'".$e['shid']."','".$e['sbid']."'"?>)" disabled>
				    	<?php } ?>
						 出貨
						</button>
					</div>
					<table class="table">
						<thead class="thead-dark">
							<tr> 
								<th scope= "col">#</th>
								<th scope= "col">巧克力ID</th>
									<th scope= "col">單價</th>
									<th scope= "col">數量</th>
									<th scope= "col">總價</th>
									<th scope= "col">備註</th>
									<th scope= "col">取消</th>
									<th scope= "col">退貨</th>
								</tr>
							</thead>
							<tbody id= <?php echo "\"". $tbodyid ."\""?>>
								<tr>
									<th scope= "row "><?php echo $e['item'] ?></th>
									<td><?php echo $e['chid'] ?></td>
									<td><?php echo $e['unit_price'] ?></td>
									<td><?php echo $e['quantity'] ?></td>
									<td><?php echo $e['total_price'] ?></td>
									<td><?php echo $e['remark'] ?></td>
									<td>
										<?php echo '<form method="POST" action="?action=Sale_ContentCancel&phid='.$e['shid'].'&pbid='.$e['sbid'].'&chid='.$e['chid'].'">'; ?>
									    	<?php if (empty($e['arrive'])){?>
									    	<button type="submit" class="btn btn-primary">
									    	<?php } else{?>
									    	<button type="submit" class="btn btn-primary" disabled>
									    	<?php } ?>
											  取消
											</button>
										</form>
									</td>
									<td>
								    	<?php if (empty($e['arrive']) or ($e['preturn']==1)){?>
								    	<button type="submit" class="btn btn-primary" disabled>
								    	<?php } else{?>
								    	<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ModalReturn" onclick="Preturn(<?php echo "'".$e['shid']."','".$e['sbid']."','".$e['chid']."','".$e['unit_price']."','".$e['total_price']."','".$e['quantity']."','".$e['item']."'"?>)">
								    	<?php } ?>
										  退貨
										</button>
									</td>
								</tr>
							</tbody>
						</table>

						
			 <?php 
				} elseif ($count!="0" AND $pb==$e['sbid']) {
					if (empty($e['arrive'])){//還沒到貨
						echo "<script>$('#".$tbodyid."').append(\"<tr><th scope='row'>". $e['item'] ."</th><td>". $e['chid'] ."</td><td>". $e['unit_price'] ."</td><td>". $e['quantity'] ."</td><td>". $e['total_price'] ."</td><td>". $e['remark'] ."</td><td><form method='POST' action='?action=Sale_ContentCancel&phid=".$e['shid']."&pbid=".$e['sbid']."&chid=".$e['chid']."'><button type='submit' class='btn btn-primary'>取消</button></form></td><td><button type='submit' class='btn btn-primary' disabled>退貨</button></td></tr>\");</script>";
					}else{//到貨
						if ($e['preturn']==1) {//已經退貨過
							echo "<script>$('#".$tbodyid."').append(\"<tr><th scope='row'>". $e['item'] ."</th><td>". $e['chid'] ."</td><td>". $e['unit_price'] ."</td><td>". $e['quantity'] ."</td><td>". $e['total_price'] ."</td><td>". $e['remark'] ."</td><td><form method='POST' action='?action=Sale_ContentCancel&phid=".$e['shid']."&pbid=".$e['sbid']."&chid=".$e['chid']."'><button type='submit' class='btn btn-primary' disabled>取消</button></form></td><td><button type='submit' class='btn btn-primary' disabled>退貨</button></td></tr>\");</script>";
						}else{//還沒退貨過
							echo "<script>$('#".$tbodyid."').append(\"<tr><th scope='row'>". $e['item'] ."</th><td>". $e['chid'] ."</td><td>". $e['unit_price'] ."</td><td>". $e['quantity'] ."</td><td>". $e['total_price'] ."</td><td>". $e['remark'] ."</td><td><form method='POST' action='?action=Sale_ContentCancel&phid=".$e['shid']."&pbid=".$e['sbid']."&chid=".$e['chid']."'><button type='submit' class='btn btn-primary' disabled>取消</button></form></td><td><button type='submit' class='btn btn-primary' id='btReturn".$count."' data-toggle='modal' data-target='#ModalReturn'>退貨</button></td></tr>\");</script>";

							echo "<script>document.getElementById(\"btReturn".$count."\").onclick=function(){Preturn('".$e['shid']."','".$e['sbid']."','".$e['chid']."','".$e['unit_price']."','".$e['total_price']."','".$e['quantity']."','".$e['item']."')};</script>";

						}


					}
					

				}elseif ($count!="0" AND $pb!=$e['sbid']) {
					$tbodyid="tbody".$e['sbid'];?>
					<div class="text-right">
						<?php if (empty($e['arrive'])){?>
				    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalArrive" style="margin-bottom: 10px;margin-top: 20px" onclick="arrive(<?php echo "'".$e['shid']."','".$e['sbid']."'"?>)">
				    	<?php } else{?>
				    	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalArrive" style="margin-bottom: 10px;margin-top: 20px" onclick="arrive(<?php echo "'".$e['shid']."','".$e['sbid']."'"?>)" disabled>
				    	<?php } ?>
						  出貨
						</button>
					</div>
					<table class="table">
						<thead class="thead-dark">
							<tr> 
								<th scope= "col">#</th>
								<th scope= "col">巧克力ID</th>
									<th scope= "col">單價</th>
									<th scope= "col">數量</th>
									<th scope= "col">總價</th>
									<th scope= "col">備註</th>
									<th scope= "col">取消</th>
									<th scope= "col">退貨</th>
								</tr>
							</thead>
							<tbody id= <?php echo "\"". $tbodyid ."\""?>>
								<tr>
									<th scope= "row "><?php echo $e['item'] ?></th>
									<td><?php echo $e['chid'] ?></td>
									<td><?php echo $e['unit_price'] ?></td>
									<td><?php echo $e['quantity'] ?></td>
									<td><?php echo $e['total_price'] ?></td>
									<td><?php echo $e['remark'] ?></td>
									<td>
										<?php echo '<form method="POST" action="?action=Sale_ContentCancel&phid='.$e['shid'].'&pbid='.$e['sbid'].'&chid='.$e['chid'].'">'; ?>
									    	<?php if (empty($e['arrive'])){?>
									    	<button type="submit" class="btn btn-primary">
									    	<?php } else{?>
									    	<button type="submit" class="btn btn-primary" disabled>
									    	<?php } ?>
											  取消
											</button>
										</form>
									</td>
									<td>
								    	<?php if (empty($e['arrive']) or ($e['preturn']==1)){?>
								    	<button type="submit" class="btn btn-primary" disabled>
								    	<?php } else{?>
								    	<button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#ModalReturn" onclick="Preturn(<?php echo "'".$e['shid']."','".$e['sbid']."','".$e['chid']."','".$e['unit_price']."','".$e['total_price']."','".$e['quantity']."','".$e['item']."'"?>)">
								    	<?php } ?>
										  退貨
										</button>
									</td>
								</tr>
							</tbody>
						</table>
				<?php }
				$count+=1;
				$pb=$e['sbid'];
			}?>
			
		</div>
		<div class="col-lg-2"></div>
	</div>

	<!-- Modal Purchase_add-->
	<div class="modal fade" id="ModalArrive" tabindex="-1" role="dialog" aria-labelledby="ModalLabelArrive" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalLabelArrive">出貨</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Sale_arrive">
	         	  <input  class="form-control" id="inputArrivePh" name="inputArrivePh" style="display: none;">
	         	  <input  class="form-control" id="inputArrivePb" name="inputArrivePb" style="display: none;">
				  <div class="form-group row">
				    <label for="inputArrive" class="col-sm-4 col-form-label">批號</label>
				    <div class="col-sm-8">
				      <input  class="form-control" id="inputArrive" placeholder="" name="inputArrive">
				    </div>
				  </div>
				  <div class="text-right">
					  	<input type="button" class="btn btn-secondary" data-dismiss="modal" value="取消"/>
					 	<input type="submit" class="btn btn-primary" value="確認"/>
				  </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Purchase_return-->
	<div class="modal fade" id="ModalReturn" tabindex="-1" role="dialog" aria-labelledby="ModalLabelReturn" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalLabelReturn">退貨</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Sale_return">
	         	  <input  class="form-control" id="inputReturnPh" name="inputReturnPh" style="display: none;"><!-- style="display: none;" -->
	         	  <input  class="form-control" id="inputReturnPB" name="inputReturnPB" style="display: none;">
	         	  <input  class="form-control" id="inputReturnCH" name="inputReturnCH" style="display: none;">
	         	  <input  class="form-control" id="inputReturnUP" name="inputReturnUP" style="display: none;">
	         	  <input  class="form-control" id="inputReturnTP" name="inputReturnTP" style="display: none;">
	         	  <input  class="form-control" id="inputReturnQU" name="inputReturnQU" style="display: none;">
	         	  <input  class="form-control" id="inputReturnIT" name="inputReturnIT" style="display: none;">
				  <div class="form-group row">
				    <label for="inputRacceptance" class="col-sm-4 col-form-label">退貨經辦人</label>
				    <div class="col-sm-8">
				      <input  class="form-control" id="inputRacceptance" placeholder="" name="inputRacceptance">
				    </div>
				  </div>
				  <div class="text-right">
					  	<input type="button" class="btn btn-secondary" data-dismiss="modal" value="取消"/>
					 	<input type="submit" class="btn btn-primary" value="確認"/>
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

		
		function arrive(ph,pb,ch,re){
			document.getElementById('inputArrivePh').value=ph;
			document.getElementById('inputArrivePb').value = pb;
		}

	
		function Preturn(ph,pb,ch,up,tp,qu,it){
			
			document.getElementById('inputReturnPh').value=ph;
			document.getElementById('inputReturnPB').value = pb;
			document.getElementById('inputReturnCH').value=ch;
			document.getElementById('inputReturnUP').value = up;
			document.getElementById('inputReturnTP').value=tp;
			document.getElementById('inputReturnQU').value = qu;
			document.getElementById('inputReturnIT').value = it;
		}

		// function Receiving(){
		// 	$("#btCancel").attr("disabled","disabled");
		// 	$("#btReceive").attr("disabled","disabled");
		// 	$("#btReturn").removeAttr("disabled");
		// }


		


		
	</script>

</html>