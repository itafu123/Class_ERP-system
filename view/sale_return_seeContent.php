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
			<h2 ID>查看退貨單細項</h2>
			<?php 
			$count=0;
			foreach($result as $e){ 
				if($count=="0"){
					$tbodyid="tbody".$e['sbid'];?>
					<table class="table">
						<thead class="thead-dark">
							<tr> 
								<th scope= "col">#</th>
								<th scope= "col">巧克力ID</th>
								<th scope= "col">單價</th>
								<th scope= "col">數量</th>
								<th scope= "col">總價</th>
								<th scope= "col">退貨日期</th>
								<th scope= "col">退貨經辦人</th>
							</tr>
						</thead>
						<tbody id= <?php echo "\"". $tbodyid ."\""?>>
							<tr>
								<th scope= "row "><?php echo $e['item'] ?></th>
								<td><?php echo $e['chid'] ?></td>
								<td><?php echo $e['unit_price'] ?></td>
								<td><?php echo $e['quantity'] ?></td>
								<td><?php echo $e['total_price'] ?></td>
								<td><?php echo $e['rdate'] ?></td>
								<td><?php echo $e['racceptance'] ?></td>
							</tr>
						</tbody>
					</table>
			 <?php 
				} elseif ($count!="0" AND $pb==$e['sbid']) {
					echo "<script>$('#".$tbodyid."').append(\"<tr><th scope='row'>". $e['item'] ."</th><td>". $e['chid'] ."</td><td>". $e['unit_price'] ."</td><td>". $e['quantity'] ."</td><td>". $e['total_price'] ."</td><td>". $e['rdate'] ."</td><td>". $e['racceptance'] ."</td></tr>\");</script>";
				}elseif ($count!="0" AND $pb!=$e['sbid']) {
					$tbodyid="tbody".$e['sbid'];?>
					<table class="table">
						<thead class="thead-dark">
							<tr> 
								<th scope= "col">#</th>
								<th scope= "col">巧克力ID</th>
								<th scope= "col">單價</th>
								<th scope= "col">數量</th>
								<th scope= "col">總價</th>
								<th scope= "col">退貨日期</th>
								<th scope= "col">退貨經辦人</th>
							</tr>
						</thead>
						<tbody id= <?php echo "\"". $tbodyid ."\""?>>
							<tr>
								<th scope= "row "><?php echo $e['item'] ?></th>
								<td><?php echo $e['chid'] ?></td>
								<td><?php echo $e['unit_price'] ?></td>
								<td><?php echo $e['quantity'] ?></td>
								<td><?php echo $e['total_price'] ?></td>
								<td><?php echo $e['rdate'] ?></td>
								<td><?php echo $e['racceptance'] ?></td>
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
	
		// function Receiving(){
		// 	$("#btCancel").attr("disabled","disabled");
		// 	$("#btReceive").attr("disabled","disabled");
		// 	$("#btReturn").removeAttr("disabled");
		// }	
	</script>

</html>