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
    <style type="text/css">
    	/* Style the tab content */
		.tabcontent2 {
		    display: none;
		    padding: 6px 12px;
		    border: 1px solid #ccc;
		    border-top: none;
		}
		div.tab {
		    overflow: hidden;
		    border: 1px solid #ccc;
		    background-color: #f1f1f1;
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
	<div style="margin-top: 100px"><?php include('menu.php');?></div> <!-- 匯入menu -->
	<!-- package -->
	<div id="add_package_modal" class="modal3">
		  <!-- Modal content -->
		  <div class="modal-content">
			    <span class="close3">&times;</span>
			    <form method="POST" action="?action=package_form" id="box_package_form">
	      			數量：<input name="num" type="text"/><br/> <br/>
      			<button class="btn btn-primary">確認封裝</button>
	      		</form>
		  </div>
	</div>

	
	<div id="Product" class="tabcontent">
			  <button type="button" class="tablinks2 btn btn-secondary btn-sm" onclick="openCity2(event,'Box')">封裝箱</button>
			  <button type="button" class="tablinks2 btn btn-secondary btn-sm" onclick="openCity2(event,'Pouch')">封裝袋</button>

			  <div id="Box" class="tabcontent2">
				  	<?php $box_result=$model->readbox();?>
					<table class="table">
						<thead class="thead-dark">
						  <tr>
						    <th scope="col">bid</th>
						    <th scope="col">bname</th>
						    <th scope="col">price</th>
						    <th scope="col">reserve</th>
						    <th scope="col">封裝</th>
						  </tr>
					    </thead>
					  <tbody>
					  	<?php foreach($box_result as $b){?>
					  		<tr>
					  			<th ><?php echo $b['bid'] ?></th>
							    <th ><?php echo $b['bname'] ?></th>
							    <th ><?php echo $b['price'] ?></th>
							    <th ><?php echo $b['reserve'] ?></th>
							    <th >
									<button type="button" id="bt_box_package" class="btn btn-warning btn-sm" value=<?php echo $b['bid']?> onclick='nowaddvalue(this.id,this.value)'>封裝</button>
								</th>
					  		</tr>
					    <?php }?>
					  </tbody>
					</table>
			  </div>

			  <div id="Pouch" class="tabcontent2">
			  		<?php $pouch_result=$model->readpouch();?>
					<table class="table">
						<thead class="thead-dark">
						  <tr>
						    <th scope="col">poid</th>
						    <th scope="col">poname</th>
						    <th scope="col">price</th>
						    <th scope="col">reserve</th>
						    <th scope="col">封裝</th>
						</tr>
					    </thead>
					  <tbody>
					  	<?php foreach($pouch_result as $p){?>
					  		<tr>
					  			<th ><?php echo $p['poid'] ?></th>
							    <th ><?php echo $p['poname'] ?></th>
							    <th ><?php echo $p['price'] ?></th>
							    <th ><?php echo $p['reserve'] ?></th>
							    <th >
									<button type="button" id="bt_box_package" class="btn btn-warning btn-sm" value=<?php echo $p['poid']?> onclick='nowaddvalue(this.id,this.value)'>封裝</button>
								</th>
					  		</tr>
					    <?php }?>
					  </tbody>
					</table>
			  </div>
	</div>
	

</body>
<script>
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

	// Get the modal
		var modal3 = document.getElementById('add_package_modal');
		// Get the button that opens the modal
		var btn3 = document.getElementById("bt_box_package");
		// Get the <span> element that closes the modal
		var span3 = document.getElementsByClassName("close3")[0];
		// When the user clicks on the button, open the modal 
		// btn3.onclick = function() {
		//     modal3.style.display = "block";
		// }
		// When the user clicks on <span> (x), close the modal
		span3.onclick = function() {
		    modal3.style.display = "none";
		     window.location.href = "index.php?action=package";
		}
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
		    if (event.target == modal) {
		        modal3.style.display = "none";
		        window.location.href = "index.php?action=package";
		    }
		}
	function nowaddvalue(clicked_id,clicked_value){
			// alert('nowaddvalue');
			var bid=clicked_value;
			var input_text = document.createElement('input');
			input_text.type = "text";
			input_text.name = "b_pid";
			input_text.setAttribute("value",clicked_value);
			input_text.style.display = "none";
			document.getElementById("box_package_form").appendChild(input_text);
			modal3.style.display = "block";
		}

	
</script>
</html>