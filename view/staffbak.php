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
    	.tabcontent {
		    display: none;
		}
		.tabcontent2 {
		    display: none;
		}
		.modal2{
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
		.modal3{
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
		.close2 {
		    color: #aaaaaa;
		    float: right;
		    font-size: 28px;
		    font-weight: bold;
		}

		.close2:hover,
		.close2:focus {
		    color: #000;
		    text-decoration: none;
		    cursor: pointer;
		}
		.close3 {
		    color: #aaaaaa;
		    float: right;
		    font-size: 28px;
		    font-weight: bold;
		}

		.close3:hover,
		.close3:focus {
		    color: #000;
		    text-decoration: none;
		    cursor: pointer;
		}
    </style>

</head>
<body>
	<div><?php include('menu.php');?></div> <!-- 匯入menu -->

	<br><br> <br>
	<?php foreach($fidfname_result as $f) {
			if($f['fid']=='f005'){
				echo '<button type="button" class="btn btn-success" id="bt_add_department">新增部門</button><br>';
			}
	}?>

	<!-- The Modal -->
	<div id="add_department_modal" class="modal">
		  <!-- Modal content -->
		  <div class="modal-content">
			    <span class="close">&times;</span>
			    <form method="POST" action="?action=add_department_data">
	      			部門名稱：<input name="add_dname" type="text"/><br/><br/>
	      			<button class="btn btn-primary">提交</button>
	      		</form>
		  </div>
	</div>

	<!-- The Modal -->
	<div id="upd_permission_modal" class="modal2">
		  <!-- Modal content -->
		  <div class="modal-content">
			    <span class="close2">&times;</span>
			    <form method="POST" action="?action=upd_permission_data">
	      			upd_permission_modal：
	      			<br>
	      			<div style="width:300px;height:300px;border:3px #cccccc dashed; Float:left;" id="leftdiv"></div>
	      			<div style="Float:left;">
	      				<div style="Float:none;"><a href="#" onclick="btadd()">-></a></div>
	      				<div style="Float:none;"><a href="#" onclick="btremove()"><-</a></div>
	      			</div>
	      			<div style="width:300px;height:300px;border:3px #cccccc dashed; Float:left;" id="rightdiv"></div>

	      			<button class="btn btn-primary">確認更改</button>
	      		</form>
		  </div>
	</div>

	<!-- The Modal -->
	<div id="add_user_modal" class="modal3">
		  <!-- Modal content -->
		  <div class="modal-content">
			    <span class="close3">&times;</span>
			    <form method="POST" action="?action=staff_add" id="staff_add_form">
	      			uname：<input name="uname" type="text"/><br/> <br/>
      				tel：<input name="tel" type="text"/><br/> <br/>
      				salary：<input name="salary" type="text"/><br/> <br/>
      				email：<input name="email" type="text"/><br/> <br/>
      			<button class="btn btn-primary">確認註冊</button>
	      		</form>
		  </div>
	</div>

	<br>
	<!-- Tab links 部門大按鈕 --> 
	<div class="tab">
		<?php foreach($result as $r) {
	          echo '<button class="tablinks btn btn-primary btn-lg" onclick="openCity(event,\''.$r['did'].'\')">'.$r['dname'].'</button>';
	    }?>
    </div>
		
	<!-- Tab content -->
	<?php foreach($result as $r) {
		$prepareSQL = "select a.pid,p.pname from (select DISTINCT pid from permission where did=:did) as a,position as p where a.pid=p.pid";
		$executeSQL = array(':did' => $r['did']);
		$pidresult = $model->getDataSQL($prepareSQL, $executeSQL);
		?>

          <div id=<?php echo $r['did']?> class="tabcontent">
				  <br>
				  <?php if($pidresult){?>
				  		<div class="tab">
						<?php foreach($pidresult as $e){?>
							<!-- Tab links -->
							<button type="button" class="tablinks2 btn btn-secondary btn-sm" onclick="openCity2(event,<?php echo "'tabcontent2".$e['pid']."'"?>)"><?php echo $e['pname'] ?></button>
						<?php }?>
						</div><br>

						<br>

						<?php foreach($pidresult as $e){?>
							<!-- Tab content -->
							<?php 
							$prepareSQL = "select uid,uname from user where did=:did and pid=:pid";
							$executeSQL = array(':did' => $r['did'],':pid'=> $e['pid']);
							$uid_uname_result = $model->getDataSQL($prepareSQL, $executeSQL);
							?>
							
							<div id=<?php echo 'tabcontent2'.$e['pid']?> class="tabcontent2">
								<?php  $c=0; $x=0;
							    foreach($fidfname_result as $f) {
										if($f['fid']=='f003'){
											$c=1;
										}
										if($f['fid']=='f002'){
											$x=1;
										}
								}
								if($c==1){?>
									<button type="button" id="bt_upd_permission" value=<?php echo $r['did'].$e['pid']?> onclick='nowupvalue(this.id,this.value)'>更改<?php echo $e['pname'] ?>權限</button>
								<?php }?>
								<?php if($x==1){?>
									<button type="button" id="bt_add_user" value=<?php echo $r['did'].$e['pid']?> onclick='nowaddvalue(this.id,this.value)'>註冊<?php echo $e['pname'] ?>員工</button>
								<?php }?>
								
					  			 <table class="table">
									  <thead class="thead-dark">
										  <tr>
										    <th scope="col">帳號</th>
										    <th scope="col">名稱</th>
										    <?php  $c=0;
										    foreach($fidfname_result as $f) {
													if($f['fid']=='f004'){
														$c=1;
													}
											}
											if($c==1){?>
												<th scope="col">刪除</th>
											<?php }?>
										    
										  </tr>
									    </thead>
									    <?php if($uid_uname_result){
											foreach($uid_uname_result as $u){?>
												<tr>
													<td scope="row"><?php echo $u['uid']?></td>
													<td><?php echo $u['uname']?></td>
													<?php  if($c==1){?>
 														<td>
													    	<?php echo '<form method="POST" action="?action=delete&uid='.$u['uid'].'">'; ?>
																<button class="btn btn-light">刪除</button>
															</form>
													    </td>
													<?php }?>
												   
												</tr>
											<?php }?>
							  			<?php }?>
								 </table>	
				  			</div>

				  			
				  		<?php }?>
					    
				  <?php }?>
		  </div>

	<?php }?>
		
</body>
<script>
	// Get the modal
		var modal = document.getElementById('add_department_modal');
		// Get the button that opens the modal
		var btn = document.getElementById("bt_add_department");
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		// When the user clicks on the button, open the modal 
		btn.onclick = function() {
		    modal.style.display = "block";
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

		// Get the modal
		var modal2 = document.getElementById('upd_permission_modal');
		// Get the button that opens the modal
		var btn2 = document.getElementById("bt_upd_permission");
		// Get the <span> element that closes the modal
		var span2 = document.getElementsByClassName("close2")[0];
		// When the user clicks on the button, open the modal 
		// btn2.onclick = function() {
		//     modal2.style.display = "block";
		// }
		// When the user clicks on <span> (x), close the modal
		span2.onclick = function() {
		    modal2.style.display = "none";
		     window.location.href = "index.php?action=staff";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal2.style.display = "none";
		        window.location.href = "index.php?action=staff";
		    }
		}

		// Get the modal
		var modal3 = document.getElementById('add_user_modal');
		// Get the button that opens the modal
		var btn3 = document.getElementById("bt_add_user");
		// Get the <span> element that closes the modal
		var span3 = document.getElementsByClassName("close3")[0];
		// When the user clicks on the button, open the modal 
		// btn3.onclick = function() {
		//     modal3.style.display = "block";
		// }
		// When the user clicks on <span> (x), close the modal
		span3.onclick = function() {
		    modal3.style.display = "none";
		     window.location.href = "index.php?action=staff";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal3.style.display = "none";
		        window.location.href = "index.php?action=staff";
		    }
		}

		var leftNode = document.getElementById("leftdiv");
		var rightNode = document.getElementById("rightdiv");
		var addform = document.getElementById("staff_add_form");

		function btadd(){
			var c = document.getElementsByName('left_checkbox[]');
			// var l = document.getElementsByName('left_lable');
			// var l = document.getElementsByTagName("label");
			for(var i=0;i<c.length;i++)
			{
				// alert("i:"+i+" c:"+c[i]);
				if (c[i].checked){
					// alert(c[i].value+"is selected");
					var k='la'+c[i].value;
					alert("k: "+k);
					var l = document.getElementById(k);

					// c[i].name="right_checkbox";
					var change = document.getElementById(c[i].id);
					change.name="right_checkbox[]";
					rightNode.appendChild(change);
					rightNode.appendChild(l);
				}
			}
		}

		function btremove(){
			var c = document.getElementsByName('right_checkbox[]');
			// var l = document.getElementsByName('left_lable');
			var l = document.getElementsByTagName("label");
			for(var i=0;i<c.length;i++)
			{
				// alert("i:"+i+" c:"+c[i]);
				if (c[i].checked){
					// alert(c[i].value+"is selected");
					var k='la'+c[i].value;
					alert("k: "+k);
					var l = document.getElementById(k);
					
					var change2 = document.getElementById(c[i].id);
					change2.name="left_checkbox[]";
					leftNode.appendChild(change2);
					leftNode.appendChild(l);
					
				}
			}
		}

		<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowupvalue")&&isset($_GET['clickid'])&&isset($_GET['updid'])&&isset($_GET['uppid'])){ ?>
				alert('isset nowupvalue');
				openCity(event,"<?php echo $_GET['updid']; ?>");
		<?php }?>

		<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowaddvalue")&&isset($_GET['clickid'])&&isset($_GET['adddid'])&&isset($_GET['addpid'])){ ?>
				alert('isset nowaddvalue');
				openCity(event,"<?php echo $_GET['adddid']; ?>");
		<?php }?>

		function openCity(evt, cityName) {
			alert('openCity');

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

		    <?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowupvalue")&&isset($_GET['clickid'])&&isset($_GET['updid'])&&isset($_GET['uppid'])){  ?>
		    		alert('openCityopenCity');
		    		openCity2(event,"<?php echo 'tabcontent2'.$_GET['uppid'];?>");
			<?php } ?>
			<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowaddvalue")&&isset($_GET['clickid'])&&isset($_GET['adddid'])&&isset($_GET['addpid'])){ ?>
					alert('openCityopenCity');
					openCity2(event,"<?php echo 'tabcontent2'.$_GET['addpid'];?>");
			<?php }?>

		    evt.currentTarget.className += " active";

		    
		}

		function openCity2(evt, cityName) {
		    // Declare all variables
		    var i, tabcontent2, tablinks2;

		    // Get all elements with class="tabcontent2" and hide them
		    tabcontent2 = document.getElementsByClassName("tabcontent2");
		    for (i = 0; i < tabcontent2.length; i++) {
		        tabcontent2[i].style.display = "none";
		    }

		    // Get all elements with class="tablinks2" and remove the class "active"
		    tablinks2 = document.getElementsByClassName("tablinks2");
		    for (i = 0; i < tablinks2.length; i++) {
		        tablinks2[i].className = tablinks2[i].className.replace(" active2", "");
		    }

		    // Show the current tab, and add an "active" class to the button that opened the tab
		    document.getElementById(cityName).style.display = "block";

		    <?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowupvalue")&&isset($_GET['clickid'])&&isset($_GET['updid'])&&isset($_GET['uppid'])){  ?>
					alert('openCity2');
					nowupvalue('bt_upd_permission',"<?php echo  $_GET['updid'].$_GET['uppid'];?>");
			<?php }?>
			<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowaddvalue")&&isset($_GET['clickid'])&&isset($_GET['adddid'])&&isset($_GET['addpid'])){ ?>
					alert('openCity2');
					nowaddvalue('bt_add_user',"<?php echo  $_GET['adddid'].$_GET['addpid'];?>");
			<?php }?>

		    evt.currentTarget.className += " active2";
		}

		var upd_permission = '';
		var add_user = '';

		function nowupvalue(clicked_id,clicked_value){
			alert('nowupvalue');
			
			upd_permission=clicked_value;

			//清空div
			leftNode.innerHTML = '';
			rightNode.innerHTML = '';

			
			var updid=clicked_value.substr(0, 4);
			alert('updid:'+updid);
			var uppid=clicked_value.substr(4, 4);
			alert('uppid:'+uppid);

			<?php if(isset($_GET['onclick'])&&($_GET['onclick']=="nowupvalue")&&isset($_GET['clickid'])&&isset($_GET['updid'])&&isset($_GET['uppid'])){ ?>
				alert('nowupvalue isset');

				var input_text = document.createElement('input');
				input_text.type = "text";
				input_text.name = "text_updid";
				input_text.value = "<?php echo $_GET['updid']; ?>";
				input_text.style.display = "none";
				rightNode.appendChild(input_text);

				var input_text2 = document.createElement('input');
				input_text2.type = "text";
				input_text2.name = "text_uppid";
				input_text2.value = "<?php echo $_GET['uppid']; ?>";
				input_text2.style.display = "none";
				rightNode.appendChild(input_text2);

				//read職位現有fid
				<?php foreach ($haveresult as $h){ ?>
					// var para = document.createElement("P");
					// var t = document.createTextNode("<?php echo $h['fname'] ?>");
					// para.appendChild(t);

					var checkbox = document.createElement('input');
					checkbox.type = "checkbox";
					checkbox.name = "right_checkbox[]";
					checkbox.value = "<?php echo $h['fid'] ?>";
					checkbox.id = "<?php echo 'ch_'.$h['fid'] ?>";

					var label = document.createElement('label')
					// label.name="right_lable";
					label.id="<?php echo 'la'.$h['fid'] ?>";
					label.htmlFor = "<?php echo $h['fid'] ?>";
					label.appendChild(document.createTextNode("<?php echo $h['fname'] ?>"));

	    			rightNode.appendChild(checkbox);
	    			rightNode.appendChild(label);
				<?php } ?>
				//read職位沒有的fid
				<?php foreach ($nothaveresult as $n){ ?>
					// var para = document.createElement("P");
					// var t = document.createTextNode("<?php echo $n['fname'] ?>");
					// para.appendChild(t);

					var checkbox = document.createElement('input');
					checkbox.type = "checkbox";
					checkbox.name = "left_checkbox[]";
					checkbox.value = "<?php echo $n['fid'] ?>";
					checkbox.id = "<?php echo 'ch_'.$n['fid'] ?>";

					var label = document.createElement('label')
					// label.name="left_lable";
					label.id="<?php echo 'la'.$n['fid'] ?>";
					label.htmlFor = "<?php echo $n['fid'] ?>";
					label.appendChild(document.createTextNode("<?php echo $n['fname'] ?>"));

	    			leftNode.appendChild(checkbox);
	    			leftNode.appendChild(label);
				<?php } ?>

				modal2.style.display = "block";

			<?php }else{ ?>
				window.location.href = "index.php?action=staff&onclick=nowupvalue&clickid="+clicked_id+"&updid=" + updid+"&uppid="+uppid;
			<?php } ?>


		}

		function nowaddvalue(clicked_id,clicked_value){
			alert('nowaddvalue');
			add_user=clicked_value;
			
			var adddid=clicked_value.substr(0, 4);
			alert('adddid:'+adddid);
			var addpid=clicked_value.substr(4, 4);
			alert('addpid:'+addpid);
			<?php  if(isset($_GET['onclick'])&&($_GET['onclick']=="nowaddvalue")&&isset($_GET['clickid'])&&isset($_GET['adddid'])&&isset($_GET['addpid'])){  ?>
				alert('nowaddvalue isset');

				var input_text3 = document.createElement('input');
				input_text3.type = "text";
				input_text3.name = "text_adddid";
				input_text3.value = "<?php echo $_GET['adddid']; ?>";
				input_text3.style.display = "none";
				addform.appendChild(input_text3);

				var input_text4 = document.createElement('input');
				input_text4.type = "text";
				input_text4.name = "text_addpid";
				input_text4.value = "<?php echo $_GET['addpid']; ?>";
				input_text4.style.display = "none";
				addform.appendChild(input_text4);
				
				modal3.style.display = "block";

			<?php }else{ ?>
				window.location.href = "index.php?action=staff&onclick=nowaddvalue&clickid="+clicked_id+"&adddid=" + adddid+"&addpid="+addpid;
			<?php } ?>
		}

</script>

</html>