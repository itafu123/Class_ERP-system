<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>home</title>
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

		/* Style the tab content */
		.tabcontent2 {
		    display: none;
		    padding: 6px 12px;
		    border: 1px solid #ccc;
		    border-top: none;
		}
		.modal4{
		    display: none; /* Hidden by default */
		    position: fixed; /* Stay in place */
		    z-index: 1; /* Sit on top */
		    padding-top: 100px; /* Location of the box */
		    left: 0;
		    top: 0;
		    width: 100%; /* Full width */
		    height: 100%; /* Full height */
		    overflow: auto; /* Enable scroll if needed */
		    background-color: rgb(0,0,0); /* Fallback color */
		    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}
		.modal5{
		    display: none; /* Hidden by default */
		    position: fixed; /* Stay in place */
		    z-index: 1; /* Sit on top */
		    padding-top: 100px; /* Location of the box */
		    left: 0;
		    top: 0;
		    width: 100%; /* Full width */
		    height: 100%; /* Full height */
		    overflow: auto; /* Enable scroll if needed */
		    background-color: rgb(0,0,0); /* Fallback color */
		    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
		}
    </style>

</head>
<body>

	<div><?php include('menu.php');?></div> <!-- 匯入menu -->
	<div class="row">
		<div class="col-lg-2"></div>
		<div id="divTab" class="col-lg-8">
			<div class="tab" style="margin-top:100px ">
			  <button class="tablinks" onclick="openCity(event, 'Company')">公司資料</button>
			  <button class="tablinks" onclick="openCity(event, 'Customer')">客戶資料</button>
			  <button class="tablinks" onclick="openCity(event, 'Manufacturer')">廠商資料</button>
			  <button class="tablinks" onclick="openCity(event, 'Product')">商品資料</button>
			</div>
			<div id="Company" class="tabcontent ">
				<div class="row">
					<div class="col-lg-2"></div>
					<div class="col-lg-8">
						<div class="text-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCompany_edit" style="margin-bottom: 10px;margin-top: 20px">
							  修改
							</button>
						</div>
						<table class="table">
						  <tbody>
						  	<?php foreach($result as $e){?>
							    <tr>
							    	<td>name</td>
								    <td><?php echo $e['name'] ?></td>
							    </tr>
							    <tr>
								    <td>Tel</td>
								    <td><?php echo $e['tel'] ?></td>
							    </tr>
							    <tr>
								    <td>Address</td>
								    <td><?php echo $e['address'] ?></td>
							    </tr>
							    <tr>
								    <td>Taxid</td>
								    <td><?php echo $e['taxid'] ?></td>
							    </tr>
							    <tr>
								    <td>Leader</td>
								    <td><?php echo $e['leader'] ?></td>
							    </tr>
						    <?php }?>
						  </tbody>
						</table>
					</div>
					<div class="col-lg-2"></div>
				</div>
			</div>
			<div id="Customer" class="tabcontent">
				<div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<div class="text-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCustomer_add" style="margin-bottom: 10px;margin-top: 20px">
							  新增客戶
							</button>
						</div>
						<table class="table">
							<thead class="thead-dark">
							  <tr>
							    <th scope="col">名稱</th>
							    <th scope="col">電話</th>
							    <th scope="col">國家</th>
							    <th scope="col">taxid</th>
							    <th scope="col">負責人</th>
							    <th scope="col">修改</th>
							    <th scope="col">刪除</th>
							  </tr>
						    </thead>
						  <tbody>
						  	<?php foreach($resultCustomer as $eCus){?>
						  		<tr>
						  			<th ><?php echo $eCus['cname'] ?></th>
								    <th ><?php echo $eCus['tel'] ?></th>
								    <th ><?php echo $eCus['address'] ?></th>
								    <th ><?php echo $eCus['taxid'] ?></th>
								    <th ><?php echo $eCus['leader'] ?></th>
								    <th ><button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalCustomer_edit" onclick="bcCuEd(<?php echo "'".$eCus['cid']."','".$eCus['cname']."','".$eCus['tel']."','".$eCus['address']."','".$eCus['taxid']."','".$eCus['leader']."'"?>)">修改</button></th>
								    <th >
										<form method="POST" action="<?php echo '?action=Customer_delete&id='.$eCus['cid']; ?>">
											<button type="submit" class="btn btn-secondary btn-sm">刪除</button>
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
			<div id="Manufacturer" class="tabcontent">
			  <div class="row">
					<div class="col-lg-1"></div>
					<div class="col-lg-10">
						<div class="text-right">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalManufacturer_add" style="margin-bottom: 10px;margin-top: 20px">
							  新增廠商
							</button>
						</div>
						<table class="table">
							<thead class="thead-dark">
							  <tr>
							    <th scope="col">名稱</th>
							    <th scope="col">電話</th>
							    <th scope="col">國家</th>
							    <th scope="col">taxid</th>
							    <th scope="col">負責人</th>
							    <th scope="col">修改</th>
							    <th scope="col">刪除</th>
							  </tr>
						    </thead>
						  <tbody>
						  	<?php foreach($resultManufacturer as $eMan){?>
						  		<tr>
						  			<th ><?php echo $eMan['mname'] ?></th>
								    <th ><?php echo $eMan['tel'] ?></th>
								    <th ><?php echo $eMan['address'] ?></th>
								    <th ><?php echo $eMan['taxid'] ?></th>
								    <th ><?php echo $eMan['leader'] ?></th>
								    <th >
								    	<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleModalManufacturer_edit" onclick="bcMaEd(<?php echo "'".$eMan['mid']."','".$eMan['mname']."','".$eMan['tel']."','".$eMan['address']."','".$eMan['taxid']."','".$eMan['leader']."'"?>)">修改</button>
								    </th>
								    <th >
										<form method="POST" action="<?php echo '?action=Manufacturer_delete&id='.$eMan['mid']; ?>">
											<button type="submit" class="btn btn-secondary btn-sm">刪除</button>
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
			<div id="Product" class="tabcontent">
			  <button type="button" class="tablinks2 btn btn-secondary btn-sm" onclick="openCity2(event,'Box')">箱</button>
			  <button type="button" class="tablinks2 btn btn-secondary btn-sm" onclick="openCity2(event,'Pouch')">袋</button>
			  <button type="button" class="tablinks2 btn btn-secondary btn-sm" onclick="openCity2(event,'Chocolate')">零售</button>

			  <div id="Box" class="tabcontent2">
			  		
			  		<?php  
				    $f8=0;
				    foreach($fidfname_result as $f) {
							if($f['fid']=='f008'){
								$f8=1;
							}
					}
					if($f8==1){?>
						<button type="button" class="btn btn-success" id="bt_add_box">新增箱</button><br>
						<div id="box_insert" class="modal">
						  <!-- Modal content -->
						  <div class="modal-content">
							    <span class="close">&times;</span>
							    <form method="POST" action="?action=box_insert">
					      			箱名稱：<input name="add_dname" type="text"/><br/><br/>
					      			<a onclick="box_add_option()">+</a>
					      			<div id="bdiv"></div>
					      			<button class="btn btn-primary">提交</button>
					      		</form>
						  </div>
					</div>
					<?php }?>
			  		
				  	<?php $box_result=$model->readbox();?>
					<table class="table">
						<thead class="thead-dark">
						  <tr>
						    <th scope="col">bid</th>
						    <th scope="col">bname</th>
						    <th scope="col">price</th>
						    <th scope="col">reserve</th>
						    <th scope="col">bom</th>
						    <th scope="col">刪除</th>
						  </tr>
					    </thead>
					  <tbody>
					  	<?php foreach($box_result as $b){?>
					  		<tr>
					  			<th ><?php echo $b['bid'] ?></th>
							    <th ><?php echo $b['bname'] ?></th>
							    <th ><?php echo $b['price'] ?></th>
							    <th ><?php echo $b['reserve'] ?></th>
							    <th ><button type="button" class="btn btn-success" value=<?php echo $b['bid']?> onclick="bbonclick(this.value)">Bom</button><br></th>
						    	<th ><?php if($b['reserve']==0){?>
						    		<?php echo '<form method="POST" action="?action=box_delete&bid='.$b['bid'].'">'; ?>
										<button class="btn btn-light">刪除</button>
									</form>
						    	<?php } ?>
								</th>
					  		</tr>
					    <?php }?>
					    <div id="box_bom_modal" class="modal4">
							  <!-- Modal content -->
							  <div class="modal-content">
								    <span id="spanclose4" class="close4" onclick="box_bom_modal_none()">&times;</span>
								    <div id="bbdiv"></div>
							  </div>
						</div>
					  </tbody>
					</table>
			  </div>

			  <div id="Pouch" class="tabcontent2">
			  		<?php  
				    $f8=0;
				    foreach($fidfname_result as $f) {
							if($f['fid']=='f008'){
								$f8=1;
							}
					}
					if($f8==1){?>
						<button type="button" class="btn btn-success" id="bt_add_pouch">新增袋</button><br>
				  		<div id="pouch_insert" class="modal">
							  <!-- Modal content -->
							  <div class="modal-content">
								    <span class="close2">&times;</span>
								    <form method="POST" action="?action=pouch_insert">
						      			袋名稱：<input name="add_poname" type="text"/><br/><br/>
						      			<a onclick="pouch_add_option()">+</a>
						      			<div id="podiv"></div>
						      			<button class="btn btn-primary">提交</button>
						      		</form>
						      		
							  </div>
						</div>
					<?php }?>
			  		
			  		<?php $pouch_result=$model->readpouch();?>
					<table class="table">
						<thead class="thead-dark">
						  <tr>
						    <th scope="col">poid</th>
						    <th scope="col">poname</th>
						    <th scope="col">price</th>
						    <th scope="col">reserve</th>
						    <th scope="col">Bom</th>
						    <th scope="col">刪除</th>
						  </tr>
					    </thead>
					  <tbody>
					  	<?php foreach($pouch_result as $p){?>
					  		<tr>
					  			<th ><?php echo $p['poid'] ?></th>
							    <th ><?php echo $p['poname'] ?></th>
							    <th ><?php echo $p['price'] ?></th>
							    <th ><?php echo $p['reserve'] ?></th>
							    <th ><button type="button" class="btn btn-success" value=<?php echo $p['poid']?> onclick="pbonclick(this.value)">Bom</button><br></th>
							    <th ><?php if($p['reserve']==0){?>
							    	<?php echo '<form method="POST" action="?action=pouch_delete&poid='.$p['poid'].'">'; ?>
										<button class="btn btn-light">刪除</button>
									</form>
									<?php } ?>
								</th>
					  		</tr>
					    <?php }?>
					    <div id="pouch_bom_modal" class="modal5" onclick="pouch_bom_modal_none()">
							  <!-- Modal content -->
							  <div class="modal-content">
								    <span class="close5">&times;</span>
								    <div id="pbdiv"></div>
							  </div>
						</div>
					  </tbody>
					</table>
			  </div>

			  <div id="Chocolate" class="tabcontent2">
			  		<?php  
				    $f8=0;
				    foreach($fidfname_result as $f) {
							if($f['fid']=='f008'){
								$f8=1;
							}
					}
					if($f8==1){?>
						<button type="button" class="btn btn-success" id="bt_add_chocolate">新增零售</button><br>
				  		<div id="chocolate_insert" class="modal">
							  <!-- Modal content -->
							  <div class="modal-content">
								    <span class="close3">&times;</span>
								    <form method="POST" action="?action=chocolate_insert">
						      			<!-- 零售名稱：<input name="add_chname" type="text"/><br/><br/> -->
						      			<!-- <a onclick="chocolate_add_option()">+</a> -->
						      			<div id="chdiv"></div>
						      			<button class="btn btn-primary">提交</button>
						      		</form>
							  </div>
						</div>
					<?php }?>

			  		<?php $chocolate_result=$model->readchocolate();?>
					<table class="table">
						<thead class="thead-dark">
						  <tr>
						    <th scope="col">chid</th>
						    <th scope="col">chname</th>
						    <th scope="col">mname</th>
						    <th scope="col">price</th>
						    <th scope="col">reserve</th>
						    <th scope="col">刪除</th>
						  </tr>
					    </thead>
					  <tbody>
					  	<?php foreach($chocolate_result as $c){?>
					  		<tr>
					  			<th ><?php echo $c['chid'] ?></th>
							    <th ><?php echo $c['chname'] ?></th>
							    <th ><?php echo $c['mname'] ?></th>
							    <th ><?php echo $c['price'] ?></th>
							    <th ><?php echo $c['reserve'] ?></th>
							    <th ><?php if($c['reserve']==0){?>
							    	<?php echo '<form method="POST" action="?action=chocolate_delete&chid='.$c['chid'].'">'; ?>
										<button class="btn btn-light">刪除</button>
									</form>
									<?php } ?>
								</th>
					  		</tr>
					    <?php }?>
					  </tbody>
					</table>
			  </div>

			</div>
		</div>
		<div class="col-lg-2"></div>
	</div>

	<!-- Modal Company_edit-->
	<div class="modal fade" id="exampleModalCompany_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCompany_edit" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelCompany_edit">修改公司資料</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Company_edit">
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Name</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputName" placeholder="Account" name="inputName" value="<?php echo $e['name'] ?>">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputName" class="col-sm-4 col-form-label">Tel</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTel" placeholder="Name" name="inputTel" value="<?php echo $e['tel'] ?>">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Address</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputAddress" placeholder="Account" name="inputAddress" value="<?php echo $e['address'] ?>">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Taxid</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTaxid" placeholder="Account" name="inputTaxid" value="<?php echo $e['taxid'] ?>">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Leader</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputLeader" placeholder="Account" name="inputLeader" value="<?php echo $e['leader'] ?>">
			    </div>
			  </div>
			  <div class="text-right">
				  	<input type="button" class="btn btn-secondary" data-dismiss="modal" value="取消"/>
				 	<input type="submit" class="btn btn-primary" value="修改"/>
			  </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal Customer_edit-->
	<div class="modal fade" id="exampleModalCustomer_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCustomer_edit" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelCustomer_edit">修改客戶資料</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Customer_edit">
	          <input readonly class="form-control-plaintext" id="CidInput" name="CidInput" style="display: none;">
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Name</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputNameCeEd" placeholder="Account" name="inputName" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputName" class="col-sm-4 col-form-label">Tel</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTelCeEd" placeholder="Name" name="inputTel">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Address</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputAddressCeEd" placeholder="Account" name="inputAddress">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Taxid</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTaxidCeEd" placeholder="Account" name="inputTaxid">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Leader</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputLeaderCeEd" placeholder="Account" name="inputLeader">
			    </div>
			  </div>
			  <div class="text-right">
				  	<input type="button" class="btn btn-secondary" data-dismiss="modal" value="取消"/>
				 	<input type="submit" class="btn btn-primary" value="修改"/>
			  </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal Manufacturer_edit-->
	<div class="modal fade" id="exampleModalManufacturer_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelManufacturer_edit" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelManufacturer_edit">修改廠商資料</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Manufacturer_edit">
	         	<input readonly class="form-control-plaintext" id="MidInput" name="MidInput" style="display: none;">
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Name</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputNameMaEd" placeholder="Account" name="inputName">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputName" class="col-sm-4 col-form-label">Tel</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTelMaEd" placeholder="Name" name="inputTel" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Address</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputAddressMaEd" placeholder="Account" name="inputAddress">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Taxid</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTaxidMaEd" placeholder="Account" name="inputTaxid">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Leader</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputLeaderMaEd" placeholder="Account" name="inputLeader">
			    </div>
			  </div>
			  <div class="text-right">
				  	<input type="button" class="btn btn-secondary" data-dismiss="modal" value="取消"/>
				 	<input type="submit" class="btn btn-primary" value="修改"/>
			  </div>
			</form>
	      </div>
	    </div>
	  </div>
	</div>


	<!-- Modal Customer_add-->
	<div class="modal fade" id="exampleModalCustomer_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelCustomer_add" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelCustomer_add">新增客戶</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Customer_add">
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Name</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputName" placeholder="Account" name="inputName" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputName" class="col-sm-4 col-form-label">Tel</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTel" placeholder="Name" name="inputTel" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Address</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputAddress" placeholder="Account" name="inputAddress" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Taxid</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTaxid" placeholder="Account" name="inputTaxid">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Leader</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputLeader" placeholder="Account" name="inputLeader">
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

	<!-- Modal Manufacturer_add-->
	<div class="modal fade" id="exampleModalManufacturer_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelManufacturer_add" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabelManufacturer_add">新增廠商</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	         <form method="POST" action="?action=Manufacturer_add">
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Name</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputName" placeholder="Account" name="inputName" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputName" class="col-sm-4 col-form-label">Tel</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTel" placeholder="Name" name="inputTel" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Address</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputAddress" placeholder="Account" name="inputAddress" >
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Taxid</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputTaxid" placeholder="Account" name="inputTaxid">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputAccount" class="col-sm-4 col-form-label">Leader</label>
			    <div class="col-sm-8">
			      <input  class="form-control" id="inputLeader" placeholder="Account" name="inputLeader">
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

		    <?php  if(isset($_GET['onclick'])&&($_GET['onclick']=="bbonclick")&&isset($_GET['clicked_value'])){  ?>
				openCity2(event,'Box');
			<?php } ?>
			<?php  if(isset($_GET['onclick'])&&($_GET['onclick']=="pbonclick")&&isset($_GET['clicked_value'])){  ?>
				openCity2(event,'Pouch');
			<?php } ?>

		    evt.currentTarget.className += " active";
		}

		function openCity2(evt, cityName) {
			// alert('openCity2');
		    // Declare all variables
		    var i, tabcontent2, tablinks2;

		    // Get all elements with class="tabcontent" and hide them
		    tabcontent2 = document.getElementsByClassName("tabcontent2");
		    for (i = 0; i < tabcontent2.length; i++) {
		        tabcontent2[i].style.display = "none";
		    }

		    // Get all elements with class="tablinks" and remove the class "active"
		    tablinks2 = document.getElementsByClassName("tablinks2");
		    for (i = 0; i < tablinks2.length; i++) {
		        tablinks2[i].className = tablinks2[i].className.replace(" active", "");
		    }

			    // Show the current tab, and add an "active" class to the button that opened the tab
			    document.getElementById(cityName).style.display = "block";
			    <?php  if(isset($_GET['onclick'])&&($_GET['onclick']=="bbonclick")&&isset($_GET['clicked_value'])){  ?>
					bbonclick("<?php echo $_GET['clicked_value'];?>");
				<?php } ?>
				<?php  if(isset($_GET['onclick'])&&($_GET['onclick']=="pbonclick")&&isset($_GET['clicked_value'])){  ?>
					pbonclick("<?php echo $_GET['clicked_value'];?>");
				<?php } ?>
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

		// Get the modal
		var modal = document.getElementById('box_insert');
		// Get the button that opens the modal
		var btn = document.getElementById("bt_add_box");
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		// When the user clicks on the button, open the modal 
		btn.onclick = function() {
		    modal.style.display = "block";
		    var bdiv = document.getElementById("bdiv");
			bdiv.innerHTML = '';
		}
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() {
		    modal.style.display = "none";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal.style.display = "none";
		    }
		}

		function box_add_option(){
			var d=document.createElement("div");
			d.setAttribute("class","row");
			document.getElementById("bdiv").appendChild(d); 

			var x = document.createElement("SELECT");
		    x.setAttribute("name", "box_or_pouch[]");
		    x.setAttribute("onchange", "box_option_onchange(this)");
		    d.appendChild(x);

		    var v = document.createElement("option");
		    v.setAttribute("value", "0");
		    v.setAttribute("selected", "selected");
		    var t = document.createTextNode("Select Value");
		    v.appendChild(t);
		    x.appendChild(v);

		    var p = document.createElement("option");
		    p.setAttribute("value", "pouch");
		    var t1 = document.createTextNode("袋");
		    p.appendChild(t1);
		    x.appendChild(p);

		    var ch = document.createElement("option");
		    ch.setAttribute("value", "chocolate");
		    var t2 = document.createTextNode("零售");
		    ch.appendChild(t2);
		    x.appendChild(ch);

		}

		function box_option_onchange(selectObject) {
		    var value = selectObject.value; 
		    // alert("box_onchange: "+value); 

		    var input = document.createElement("input");
		    input.setAttribute("name", "pc_num[]");
		    input.setAttribute("placeholder", "請填數量");

		    var x = document.createElement("SELECT");
		    x.setAttribute("name", "pc_item[]");

		    var v = document.createElement("option");
		    v.setAttribute("value", "0");
		    v.setAttribute("selected", "selected");
		    var t = document.createTextNode("Select Value");
		    v.appendChild(t);
		    x.appendChild(v);
		   
		    
		    if(value=="pouch"){
		    	<?php $pc_result=$model->readpouch();?>
		    	<?php foreach($pc_result as $pc){?>
			    	var v1 = document.createElement("option");
				    v1.setAttribute("value", "<?php echo $pc['poid']; ?>");
				    var t1 = document.createTextNode("<?php echo $pc['poname']; ?>");
				    v1.appendChild(t1);
				    x.appendChild(v1);
			    <?php }?>
		    }else if(value=="chocolate"){
		    	<?php $pc_result=$model->readchocolate();?>
		    	<?php foreach($pc_result as $pc){?>
			    	var v1 = document.createElement("option");
				    v1.setAttribute("value", "<?php echo $pc['chid']; ?>");
				    var t1 = document.createTextNode("<?php echo $pc['chname']; ?>");
				    v1.appendChild(t1);
				    x.appendChild(v1);
			    <?php }?>
		    }

		    selectObject.parentNode.insertBefore(input, selectObject.nextSibling);
		    selectObject.parentNode.insertBefore(x, selectObject.nextSibling);
		}

		// Get the modal
		var modal2 = document.getElementById('pouch_insert');
		// Get the button that opens the modal
		var btn2 = document.getElementById("bt_add_pouch");
		// Get the <span> element that closes the modal
		var span2 = document.getElementsByClassName("close2")[0];
		// When the user clicks on the button, open the modal 
		btn2.onclick = function() {
		    modal2.style.display = "block";
		    var podiv = document.getElementById("podiv");
			podiv.innerHTML = '';
		}
		// When the user clicks on <span> (x), close the modal
		span2.onclick = function() {
		    modal2.style.display = "none";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal2) {
		        modal2.style.display = "none";
		    }
		}

		function pouch_add_option(){
			var d=document.createElement("div");
			d.setAttribute("class","row");
			document.getElementById("podiv").appendChild(d); 

			var x = document.createElement("SELECT");
		    x.setAttribute("name", "chocolate[]");
		    x.setAttribute("onchange", "pouch_option_onchange(this)");
		    d.appendChild(x);

		    var v = document.createElement("option");
		    v.setAttribute("value", "0");
		    v.setAttribute("selected", "selected");
		    var t = document.createTextNode("Select Value");
		    v.appendChild(t);
		    x.appendChild(v);

		    var ch = document.createElement("option");
		    ch.setAttribute("value", "chocolate");
		    var t2 = document.createTextNode("零售");
		    ch.appendChild(t2);
		    x.appendChild(ch);
		}

		function pouch_option_onchange(selectObject) {
		    var value = selectObject.value; 
		    // alert("box_onchange: "+value); 

		    var input = document.createElement("input");
		    input.setAttribute("name", "c_num[]");
		    input.setAttribute("placeholder", "請填數量");

		    var x = document.createElement("SELECT");
		    x.setAttribute("name", "c_item[]");

		    var v = document.createElement("option");
		    v.setAttribute("value", "0");
		    v.setAttribute("selected", "selected");
		    var t = document.createTextNode("Select Value");
		    v.appendChild(t);
		    x.appendChild(v);
		   		   
	    	<?php $c_result=$model->readchocolate();?>
	    	<?php foreach($c_result as $c){?>
		    	var v1 = document.createElement("option");
			    v1.setAttribute("value", "<?php echo $c['chid']; ?>");
			    var t1 = document.createTextNode("<?php echo $c['chname']; ?>");
			    v1.appendChild(t1);
			    x.appendChild(v1);
		    <?php }?>
		   
		    selectObject.parentNode.insertBefore(input, selectObject.nextSibling);
		    selectObject.parentNode.insertBefore(x, selectObject.nextSibling);
		}

		// Get the modal
		var modal3 = document.getElementById('chocolate_insert');
		// Get the button that opens the modal
		var btn3 = document.getElementById("bt_add_chocolate");
		// Get the <span> element that closes the modal
		var span3 = document.getElementsByClassName("close3")[0];
		// When the user clicks on the button, open the modal 
		btn3.onclick = function() {
		    modal3.style.display = "block";
		    var chdiv = document.getElementById("chdiv");
			chdiv.innerHTML = '';

			var d=document.createElement("div");
			d.setAttribute("class","row");
			document.getElementById("chdiv").appendChild(d); 

			var chname_input = document.createElement("input");
		    chname_input.setAttribute("name", "chname");
		    chname_input.setAttribute("placeholder", "請填零售名稱");

		    var x = document.createElement("SELECT");
		    x.setAttribute("name", "mid");
		    d.appendChild(x);

		    <?php $mid_result=$model->readmid();?>
	    	<?php foreach($mid_result as $m){?>
		    	var v = document.createElement("option");
			    v.setAttribute("value", "<?php echo $m['mid']; ?>");
			    var t = document.createTextNode("<?php echo $m['mname']; ?>");
			    v.appendChild(t);
			    x.appendChild(v);
		    <?php }?>

		    d.appendChild(chname_input);
		}
		// When the user clicks on <span> (x), close the modal
		span3.onclick = function() {
		    modal3.style.display = "none";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal3) {
		        modal3.style.display = "none";
		    }
		}

		

		// Get the modal
		<?php  if(isset($_GET['onclick'])&&isset($_GET['clicked_value'])){  ?>
			openCity(event, 'Product');
		<?php } ?>

		var modal4 = document.getElementById('box_bom_modal');
		// Get the button that opens the modal
		// Get the <span> element that closes the modal
		var span4 = document.getElementsByClassName('close4')[0];
		// When the user clicks on the button, open the modal 
		function bbonclick(clicked_value){
			<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="bbonclick")&&isset($_GET['clicked_value'])){ ?>
				// alert("bbonclick isset");
				document.getElementById('box_bom_modal').style.display = "block";
				var bbdiv = document.getElementById("bbdiv");
				bbdiv.innerHTML = '';

				<?php $prepareSQL = "SELECT bname FROM box where bid = :bid";
				$executeSQL = array(':bid' => $_GET['clicked_value']);
				$bnameresult = $model->getDataSQL($prepareSQL, $executeSQL);
				foreach($bnameresult as $bn){
					$bname = $bn['bname'];?>
					var h = document.createElement("h3");
					var bt = document.createTextNode("<?php echo $bn['bname']; ?>");
					h.appendChild(bt);
					document.getElementById("bbdiv").appendChild(h);
				<?php }?>


				<?php $bom_result=$model->readbom($_GET['clicked_value']);?>
		    	<?php foreach($bom_result as $bb){?>
			    	var v = document.createElement("p");
			    	var c = <?php echo $bb['lvl']; ?>;
			    	var str = "";
			    	if(c==2){
			    		for (var i = 0; i <= c; i++) {
				    		str+="---";
				    	}
			    	}
			    	
				    var t = document.createTextNode(str+"<?php echo $bb['poname'].$bb['chname']; ?>"+"		數量:"+"<?php echo $bb['quantity']; ?>");
				    v.appendChild(t);
				    var d=document.createElement("div");
					d.setAttribute("class","row");
					d.appendChild(v);
					document.getElementById("bbdiv").appendChild(d);
			    <?php }?>
			<?php }else{ ?>
				window.location.href = "index.php?action=basic&onclick=bbonclick&clicked_value="+clicked_value;
			<?php } ?>

		}
		// When the user clicks on <span> (x), close the modal
		// span4.onclick = function() {
		//     modal4.style.display = "none";
		//     window.location.href = "index.php?action=basic";
		// }
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal4) {
		        modal4.style.display = "none";
		        window.location.href = "index.php?action=basic";
		    }
		}

		function box_bom_modal_none(){
			document.getElementById('box_bom_modal').style.display = "block";
			window.location.href = "index.php?action=basic";
		}

		// Get the modal
		var modal5 = document.getElementById('pouch_bom_modal');
		// Get the button that opens the modal
		// Get the <span> element that closes the modal
		var span5 = document.getElementsByClassName("close5")[0];
		// When the user clicks on the button, open the modal 
		function pbonclick(clicked_value){
			<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="pbonclick")&&isset($_GET['clicked_value'])){ ?>
				// alert("bbonclick isset");
				document.getElementById('pouch_bom_modal').style.display = "block";
				var pbdiv = document.getElementById("pbdiv");
				pbdiv.innerHTML = '';

				<?php $prepareSQL = "SELECT poname FROM pouch where poid = :poid";
				$executeSQL = array(':poid' => $_GET['clicked_value']);
				$ponameresult = $model->getDataSQL($prepareSQL, $executeSQL);
				foreach($ponameresult as $pon){
					$poname = $pon['poname'];?>
					var h = document.createElement("h3");
					var bt = document.createTextNode("<?php echo $pon['poname']; ?>");
					h.appendChild(bt);
					document.getElementById("pbdiv").appendChild(h);
				<?php }?>

				<?php $bom_result=$model->readbom($_GET['clicked_value']);?>
		    	<?php foreach($bom_result as $bb){?>
			    	var v = document.createElement("p");
			    	var c = <?php echo $bb['lvl']; ?>;
			    	var str = "";
			    	if(c==2){
			    		for (var i = 0; i <= c; i++) {
				    		str+="---";
				    	}
			    	}
			    	
				    var t = document.createTextNode(str+"<?php echo $bb['poname'].$bb['chname']; ?>"+"		數量:"+"<?php echo $bb['quantity']; ?>");
				    v.appendChild(t);
				    var d=document.createElement("div");
					d.setAttribute("class","row");
					d.appendChild(v);
					document.getElementById("pbdiv").appendChild(d);
			    <?php }?>
			<?php }else{ ?>
				window.location.href = "index.php?action=basic&onclick=pbonclick&clicked_value="+clicked_value;
			<?php } ?>
		}
		// When the user clicks on <span> (x), close the modal
		span5.onclick = function() {
		    modal5.style.display = "none";
		    window.location.href = "index.php?action=basic";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal5) {
		        modal5.style.display = "none";
		        window.location.href = "index.php?action=basic";
		    }
		}
		function pouch_bom_modal_none(){
			document.getElementById('pouch_bom_modal').style.display = "block";
			window.location.href = "index.php?action=basic";
		}
		document.getElementById("defaultOpen").click();
	</script>

</html>