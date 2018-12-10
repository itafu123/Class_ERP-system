<!DOCTYPE html>

<html lang="en">
<head>
	 <!-- 匯入my_css -->
  <link rel="stylesheet" href="css/my_css.css" type="text/css">
  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<body>
	<div style="margin-top: 100px"><?php include('menu.php');?></div> <!-- 匯入menu -->
	<div class="row">
    <div class="col-lg-2"></div>
    <div id="divTab" class="col-lg-8">
      <div class="row">
        <select class="form-control" id="inputtop" name="inputtop" onchange="box_option_onchange(this)">
          <option value="1">商品進退貨</option>
          <option value="1">商品進退貨</option>
          <option value="2">廠商進退貨</option>
          <option value="3">商品出退貨</option>
          <option value="4">客戶出退貨</option>
        </select>
        <select class="form-control" id="inputsecon" name="inputsecon"></select>
      </div>
      
      <div class="tab" style="margin-top:100px ">
        <button class="tablinks" onclick="openCity(event, 'Purchase')">訂貨維護</button>
        <button class="tablinks" onclick="openCity(event, 'Return')">退貨處理</button>
      </div>
      <div id="Purchase" class="tabcontent ">
        <div class="row">
          <div class="col-lg-1"></div>
          <div class="col-lg-10">
            <div class="text-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalPurchase" style="margin-bottom: 10px;margin-top: 20px">
                訂貨
              </button>
            </div>
            <table class="table table-hover">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">客戶編號</th>
                  <th scope="col">日期</th>
                  <th scope="col">經辦人</th>
                  <th scope="col">訂貨單細項</th>
                </tr>
                </thead>
              <tbody>
                <?php foreach($result as $e){?>
                  <tr>
                    <th><?php echo $e['shid'] ?></th>
                    <th><?php echo $e['cid'] ?></th>
                    <th><?php echo $e['date'] ?></th>
                    <th><?php echo $e['acceptance'] ?></th>
                    <th>
                      <?php echo '<form method="POST" action="?action=Sale_seeContent&phid='.$e['shid'].'">'; ?>
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
                  <th scope="col">id</th>
                  <th scope="col">客戶編號</th>
                  <th scope="col">訂貨日期</th>
                  <th scope="col">訂貨經辦人</th>
                  <th scope="col">退貨單細項</th>
                </tr>
                </thead>
              <tbody>
                <?php foreach($result_RH as $rh){?>
                  <tr>
                    <th><?php echo $rh['shid'] ?></th>
                    <th><?php echo $rh['cid'] ?></th>
                    <th><?php echo $rh['pdate'] ?></th>
                    <th><?php echo $rh['pacceptance'] ?></th>
                    <th>
                      <?php echo '<form method="POST" action="?action=Sale_Return_seeContent&phid='.$rh['shid'].'">'; ?>
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
	

</body>

<script>
  
    function box_option_onchange(selectObject) {
        var value = selectObject.value; 

        var v = document.createElement("option");
        v.setAttribute("value", "0");
        v.setAttribute("selected", "selected");
        var t = document.createTextNode("Select Value");
        v.appendChild(t);
        document.getElementById("inputsecon").appendChild(v);
       
        
        if(value=="1"){
          <?php $pc_result=$model->readchocolate();?>
          <?php foreach($pc_result as $pc){?>
            var v1 = document.createElement("option");
            v1.setAttribute("value", "<?php echo $pc['chid']; ?>");
            var t1 = document.createTextNode("<?php echo $pc['chname']; ?>");
            v1.appendChild(t1);
            document.getElementById("inputsecon").appendChild(v1);
          <?php }?>
        }else if(value=="2"){
          <?php $pc_result=$model->readmid();?>
          <?php foreach($pc_result as $pc){?>
            var v1 = document.createElement("option");
            v1.setAttribute("value", "<?php echo $pc['mid']; ?>");
            var t1 = document.createTextNode("<?php echo $pc['mname']; ?>");
            v1.appendChild(t1);
            document.getElementById("inputsecon").appendChild(v1);
          <?php }?>
        }else if(value=="3"){
          $('#inputsecon').append("<option value='1'>箱</option><option value='2'>袋</option><option value='3'>單片</option>");
        }else if(value=="4"){
          <?php $pc_result=$model->readcid();?>
          <?php foreach($pc_result as $pc){?>
            var v1 = document.createElement("option");
            v1.setAttribute("value", "<?php echo $pc['cid']; ?>");
            var t1 = document.createTextNode("<?php echo $pc['cname']; ?>");
            v1.appendChild(t1);
            document.getElementById("inputsecon").appendChild(v1);
          <?php }?>
        }

        selectObject.parentNode.insertBefore(x, selectObject.nextSibling);
        document.getElementById('inputPCount').value=pccount;
    }

</script>
</html>