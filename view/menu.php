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
</head>
<body>

	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="?action=home">home</a>
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <?php if(isset($_SESSION["uid"])){ ?>
              <li class="nav-item">
                <a class="nav-link" href="?action=staff">管理員工</a>
              </li>
               <li class="nav-item">
                <a class="nav-link" href="?action=basic">基本資料</a>
              </li>

              <?php foreach($fidfname_result as $fr) {
                if($fr['fid']=='f009'){
                  echo 
                    '<li class="nav-item">
                      <a class="nav-link" href="?action=package">封裝商品</a>
                    </li>';
                }
                if($fr['fid']=='f011'){
                  echo 
                    '                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          庫存管理
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="?action=purchase_sale_search">進銷查詢</a>
                          <a class="dropdown-item" href="?action=reserve_search">庫存查詢</a>
                      </li>';
                }
                if($fr['fid']=='f007'){
                  echo 
                     '<li class="nav-item">
                      <a class="nav-link" href="?action=purchase">進退貨管理</a>
                     </li>';
                }
                if($fr['fid']=='f008'){
                  echo 
                     '<li class="nav-item">
                      <a class="nav-link" href="?action=purchase">訂出退貨管理</a>
                     </li>';
                }
                
              } ?> 
              <li class="nav-item">
                <a class="nav-link" href="?action=logout">登出</a>
              </li>
            <?php }else{?>
              <li class="nav-item">
                <a class="nav-link" href="?action=login">登入</a>
              </li>
            <?php } ?>

            
          </ul>
        </div>
      </div>
    </nav>
	

	

	
</body>
</html>