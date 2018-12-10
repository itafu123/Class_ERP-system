<?php
require("db_connection.php");
require("model/model.php");
if(isset($_GET['action'])){

	$model = new model($dbh);

	$urlError = "請重新確認網址";

	switch ($_GET['action']) {
		case 'login':
			require("view/login.php");
			break;

		case 'logout': 
			session_destroy();
			echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=home>';
			break;

		case 'login_data': 
			$uid = $_POST['uid'];
			$passwd = $_POST['passwd'];
			$hashpasswd=hash("sha256", $passwd);
			$prepareSQL = "SELECT uid FROM user where uid = :uid";
			$executeSQL = array(':uid' => $uid);
			$result = $model->getDataSQL($prepareSQL, $executeSQL);
			if($result){
				$prepareSQL = "SELECT uid,passwd,did,pid FROM user where uid = :uid and passwd = :passwd and employment='1'";
				$executeSQL = array(':uid' => $uid,':passwd' => $hashpasswd);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);
				if($result){
					foreach($result as $e){
						$_SESSION['uid'] = $e['uid'];
						$_SESSION['did'] = $e['did'];
						$_SESSION['pid'] = $e['pid'];
					}
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=home>';
				}else{
					echo "try again, passwd error";
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
				}
			}else{
				echo "try again no this uid";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
			}
			break;

		case 'home':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				require("view/home.php");
			}else{
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
			}
			break;

		case 'self':
			require("view/self.php");
			break;

		case 'staff':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				$c=0;
				foreach($fidfname_result as $f) {
						if($f['fid']=='f005'){
							$c=1;
						}
				}
				if($c==1){
					$prepareSQL = "SELECT did,dname FROM department";
					$executeSQL = array();
					$result = $model->getDataSQL($prepareSQL, $executeSQL);
				}else{
					$prepareSQL = "SELECT did,dname FROM department where did = :did";
					$executeSQL = array(':did' => $_SESSION['did']);
					$result = $model->getDataSQL($prepareSQL, $executeSQL);
				}

				if(isset($_GET['onclick'])&&isset($_GET['clickid'])&&isset($_GET['updid'])&&isset($_GET['uppid'])){
					$prepareSQL = "SELECT ffunction.fid, ffunction.fname FROM permission, ffunction where permission.did= :did and permission.pid = :pid and permission.fid = ffunction.fid";
					$executeSQL = array(':did' => $_GET['updid'],':pid' => $_GET['uppid']);
					$haveresult = $model->getDataSQL($prepareSQL, $executeSQL);

					$prepareSQL = "SELECT fid,fname from ffunction where fid NOT IN (SELECT ffunction.fid FROM permission, ffunction where permission.did = :did and permission.pid = :pid and permission.fid = ffunction.fid)";
					$executeSQL = array(':did' => $_GET['updid'],':pid' => $_GET['uppid']);
					$nothaveresult = $model->getDataSQL($prepareSQL, $executeSQL);
				}
		
				require("view/staff.php");
			}else{
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
			}
			break;

		case 'add_department_data': 
			$add_dname = $_POST['add_dname'];

			$prepareSQL = "SELECT did,dname FROM department order by did desc limit 1";
			$executeSQL = array();
			$result = $model->getDataSQL($prepareSQL, $executeSQL);
			foreach($result as $e){
				$last_did = $e['did'];
				$last_dname = $e['dname'];
			}
			echo "<script>javascript: alert(".$last_did.")></script>";
			$enddid=substr($last_did, -3, 3)+1;
			echo "<script>javascript: alert(".$enddid.")></script>";
			if ($enddid < 10) {
				$nowendid='00'.$enddid;
			}elseif (100>$enddid && $enddid>=10) {
				$nowendid='0'.$enddid;
			}elseif (1000>$enddid && $enddid>=100) {
				$nowendid=$enddid;
			}
			$add_did='d'.$nowendid;

			$prepareSQL = "INSERT INTO department (did,dname) VALUES(:did,:dname)";
			$executeSQL = array(':did' => $add_did , ':dname' => $add_dname);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('新增部門成功!')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}else{
				echo "try again";
			}

			break;

		case 'register':  
			require("view/register.php");
			break;

		case 'register_data': 
			
			break;

		case 'delete': 
			$uid = $_GET['uid'];
			$prepareSQL = "UPDATE user SET employment=0 WHERE uid= :uid;";
			$executeSQL = array(':uid' => $uid);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('刪除成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}
			break;

		case 'staff_add_position': 
			$add_position_name=$_POST['character_name'];
			$add_position_did=$_POST['did'];

			$prepareSQL = "SELECT pid FROM position order by pid desc limit 1";
			$executeSQL = array();
			$presult = $model->getDataSQL($prepareSQL, $executeSQL);
			foreach($presult as $p){
				$last_pid = $p['pid'];
			}
			echo "<script>javascript: alert('last_pid: ".$last_pid."')'></script>";
			$endpid=substr($last_pid, -3, 3)+1;
			echo "<script>javascript: alert('endpid: ".$endpid."')></script>";
			if ($endpid < 10) {
				$nowenpid='00'.$endpid;
			}elseif (100>$endpid && $endpid>=10) {
				$nowenpid='0'.$endpid;
			}elseif (1000>$endpid && $endpid>=100) {
				$nowenpid=$endpid;
			}
			$add_pid='p'.$nowenpid;

			$prepareSQL = "INSERT INTO position (pid,pname,did) VALUES(:pid,:pname,:did)";
			$executeSQL = array(':pid' => $add_pid , ':pname' => $add_position_name, ':did' => $add_position_did);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('新增角色成功!')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}else{
				echo "try again";
			}
			break;

		case 'upd_permission_data':
			$str="";
			$text_updid=$_POST['text_updid'];
			$text_uppid=$_POST['text_uppid'];
			echo "<script>alert('text_updid: ".$text_updid."');</script>";
			echo "<script>alert('text_uppid: ".$text_uppid."');</script>";

			$prepareSQL = "DELETE FROM permission WHERE did=:did and pid=:pid";
			$executeSQL = array(':did' => $text_updid , ':pid' => $text_uppid);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			echo "<script>alert('DELETE num: ".$sql."');</script>";

			if(!empty($_POST['right_checkbox'])){
		    foreach($_POST['right_checkbox'] as $r){
					echo "<script>alert('".$r."');</script>";

					$prepareSQL = "SELECT ssid FROM permission order by ssid desc limit 1";
					$executeSQL = array();
					$ssidresult = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($ssidresult as $s){
						$last_ssid = $s['ssid'];
					}
					echo "<script>alert('last_ssid: ".$last_ssid."');</script>";
					$endssid=substr($last_ssid, -3, 3)+1;
					echo "<script>alert('endssid: ".$endssid."');</script>";
					if ($endssid < 10) {
						$nowendssid='00'.$endssid;
					}elseif (100>$endssid && $endssid>=10) {
						$nowendssid='0'.$endssid;
					}elseif (1000>$endssid && $endssid>=100) {
						$nowendssid=$endssid;
					}
					$add_ssid='s'.$nowendssid;
					echo "<script>alert('add_ssid: ".$add_ssid."');</script>";

					$prepareSQL = "INSERT INTO permission (ssid,did,pid,fid) VALUES (:ssid,:did,:pid,:fid)";
					$executeSQL = array(':ssid' => $add_ssid , ':did' => $text_updid,':pid' => $text_uppid, ':fid' => $r);
					$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
				}
				echo "<script>alert('更改成功!!');</script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}
		    
			break;

		case 'staff_add':
			$udate;
			$todaydate;
			$uidno;
			$prepareSQL = "SELECT uid FROM user WHERE 1=:a order by uid desc limit 1";
			$executeSQL = array(':a' => 1);
			$result = $model->getDataSQL($prepareSQL,$executeSQL);
			if($result) {
				foreach($result as $e){
					$last_uid=$e['uid'];
				}
				$udate=(int)(substr($last_uid, 1, 8));
				$todaydate=(int)(date("Ymd"));
				if ($udate != $todaydate) {//今天還沒新增人員
					$today=(string)(date("Ymd"));
					$uidno='u'. substr($today, 2, 6).'000001';
				}elseif ($udate == $todaydate) {//今天已經有新增人員了
					$endid=substr($last_uid, -6, 6)+1;
					if ($endid < 10) {
						$nowendid='00000'.$endid;
					}elseif (100>$endid && $endid>=10) {
						$nowendid='0000'.$endid;
					}elseif (1000>$endid && $endid>=100) {
						$nowendid='000'.$endid;
					}elseif (10000>$endid && $endid>=1000) {
						$nowendid='00'.$endid;
					}elseif (100000>$endid && $endid>=10000) {
						$nowendid='0'.$endid;
					}elseif (1000000>$endid && $endid>=100000) {
						$nowendid=$endid;
					}
					$today=(string)(date("Ymd"));
					$uidno='u'.substr($today, 2, 6).$nowendid;
				}
			}

			echo "<script>alert('uidno".$uidno."');</script>";

			$name = $_POST['uname'];
			$passwd=$_POST['passwd'];
			$hashpasswd=hash("sha256", $passwd);
			$tel = $_POST['tel'];
			$mail = $_POST['email'];
			$salary = $_POST['salary'];
			$selectOptionD = $_POST['text_adddid'];
			$selectOptionP = $_POST['text_addpid'];
			$prepareSQL = "INSERT INTO user (uid,passwd,uname,tel,salary,begin,end,email,did,pid,employment) VALUES(:uid,:passwd,:uname,:tel,:salary,:begin,:end,:email,:did,:pid,:employment)";
			$executeSQL = array(':uid' => $uidno ,':passwd' => $hashpasswd, ':uname' => $name ,':tel'=> $tel,':salary'=> $salary,':begin'=> date("Ymd"),':end'=>'0000-00-00',':email'=> $mail, ':did' => $selectOptionD,':pid' => $selectOptionP,':employment'=> '1');
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('新增成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
			}
			
			break;

		case 'staff_change':
			$uid=$_POST['uid'];
			$change_name=$_POST['change_name'];
			$change_tel=$_POST['change_tel'];
			$change_salary=$_POST['change_salary'];
			$change_email=$_POST['change_email'];
			$prepareSQL = "UPDATE user SET uname=:uname,tel=:tel,salary=:salary,email=:email WHERE 1=1 and uid=:uid";
			$executeSQL = array(':uname' => $change_name, ':tel' => $change_tel, ':salary' => $change_salary, ':email' => $change_email, ':uid' => $uid);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('修改成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=staff>';
			}
			break;
			
		case 'basic':
			$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
			$prepareSQL = "SELECT * FROM company";
			$executeSQL = array();
			$result = $model->getDataSQL($prepareSQL, $executeSQL);

			$prepareSQLCustomer = "SELECT * FROM customer where usingg=0";
			$executeSQLCustomer = array();
			$resultCustomer = $model->getDataSQL($prepareSQLCustomer, $executeSQLCustomer);

			$prepareSQLManufacturer = "SELECT * FROM manufacturer where usingg=0";
			$executeSQLManufacturer = array();
			$resultManufacturer = $model->getDataSQL($prepareSQLManufacturer, $executeSQLManufacturer);

			require("view/basic.php");
			
			break;

		case 'Company_edit': 
			$nam = $_POST['inputName'];
			$tel = $_POST['inputTel'];
			$add = $_POST['inputAddress'];
			$tax = $_POST['inputTaxid'];
			$lea = $_POST['inputLeader'];
			$prepareSQL = "UPDATE company SET name=:name,tel=:tel,address=:address,taxid=:taxid,leader=:leader WHERE 1=1";
			$executeSQL = array(':name' => $nam, ':tel' => $tel, ':address' => $add, ':taxid' => $tax, ':leader' => $lea);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('修改成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'Customer_add':
			$udate;
			$todaydate;
			$uidno;
			$prepareSQL = "SELECT cid FROM customer WHERE 1=:a order by cid desc limit 1";
			$executeSQL = array(':a' => 1);
			$result = $model->getDataSQL($prepareSQL,$executeSQL);
			if($result) {
				foreach($result as $e){
					$last_cid= $e['cid'];
				}
				$udate=(int)(substr($last_cid, 1, 8));
				$todaydate=(int)(date("Ymd"));
				if ($udate != $todaydate) {//今天還沒新增人員
					$today=(string)(date("Ymd"));
					$uidno='c'. $today.'000001';
				}elseif ($udate == $todaydate) {//今天已經有新增人員了
					$endid=substr($last_cid, -6, 6)+1;
					if ($endid < 10) {
						$nowendid='00000'.$endid;
					}elseif (100>$endid && $endid>=10) {
						$nowendid='0000'.$endid;
					}elseif (1000>$endid && $endid>=100) {
						$nowendid='000'.$endid;
					}elseif (10000>$endid && $endid>=1000) {
						$nowendid='00'.$endid;
					}elseif (100000>$endid && $endid>=10000) {
						$nowendid='0'.$endid;
					}elseif (1000000>$endid && $endid>=100000) {
						$nowendid=$endid;
					}
					$today=(string)(date("Ymd"));
					$uidno='c'. $today.$nowendid;
				}
			}else{
				$uidno='c'. $today.'000001';
			}
			
			$nam = $_POST['inputName'];
			$tel = $_POST['inputTel'];
			$add = $_POST['inputAddress'];
			$tax = $_POST['inputTaxid'];
			$lea = $_POST['inputLeader'];
			$prepareSQL = "INSERT INTO customer (cid,cname,tel,address,taxid,leader,tcondition,begin,usingg) VALUES(:cid,:cname,:tel,:address,:taxid,:leader,:tcondition,:begin,:using)";
			$executeSQL = array(':cid' => $uidno ,':cname' => $nam , ':tel' => $tel,':address' => $add,':taxid' => $tax,':leader' => $lea,':tcondition' => '???',':begin' => date("Ymd"),':using' => 0);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alrt('新增成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				
			}
			break;

			case 'Manufacturer_add':
			$udate;
			$todaydate;
			$uidno;
			$today=(string)(date("Ymd"));
			$prepareSQL = "SELECT mid FROM manufacturer WHERE 1=:a order by mid desc limit 1";
			$executeSQL = array(':a' => 1);
			$result = $model->getDataSQL($prepareSQL,$executeSQL);
			if($result) {
				foreach($result as $e){
					$last_mid=$e['mid'];
				}
				$udate=(int)(substr($last_mid, 1, 8));
				$todaydate=(int)(date("Ymd"));
				if ($udate != $todaydate) {//今天還沒新增人員	
					$uidno='m'. $today.'000001';
				}elseif ($udate == $todaydate) {//今天已經有新增人員了
					$endid=substr($last_mid, -6, 6)+1;
					if ($endid < 10) {
						$nowendid='00000'.$endid;
					}elseif (100>$endid && $endid>=10) {
						$nowendid='0000'.$endid;
					}elseif (1000>$endid && $endid>=100) {
						$nowendid='000'.$endid;
					}elseif (10000>$endid && $endid>=1000) {
						$nowendid='00'.$endid;
					}elseif (100000>$endid && $endid>=10000) {
						$nowendid='0'.$endid;
					}elseif (1000000>$endid && $endid>=100000) {
						$nowendid=$endid;
					}
					$uidno='m'. $today.$nowendid;
				}
			}else{
				$uidno='m'. $today.'000001';
			}
			
			$nam = $_POST['inputName'];
			$tel = $_POST['inputTel'];
			$add = $_POST['inputAddress'];
			$tax = $_POST['inputTaxid'];
			$lea = $_POST['inputLeader'];
			$prepareSQL = "INSERT INTO manufacturer (mid,mname,tel,address,taxid,leader,tcondition,begin,usingg) VALUES(:mid,:mname,:tel,:address,:taxid,:leader,:tcondition,:begin,:using)";
			$executeSQL = array(':mid' => $uidno ,':mname' => $nam , ':tel' => $tel,':address' => $add,':taxid' => $tax,':leader' => $lea,':tcondition' => '???',':begin' => date("Ymd"),':using' => 0);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('新增成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				
			}
			break;

		case 'Customer_edit': 
			$id = $_POST['CidInput'];
			$nam = $_POST['inputName'];
			$tel = $_POST['inputTel'];
			$add = $_POST['inputAddress'];
			$tax = $_POST['inputTaxid'];
			$lea = $_POST['inputLeader'];
			$prepareSQL = "UPDATE customer SET cname=:name,tel=:tel,address=:address,taxid=:taxid,leader=:leader WHERE 1=1 and cid=:cid";
			$executeSQL = array(':name' => $nam, ':tel' => $tel, ':address' => $add, ':taxid' => $tax, ':leader' => $lea, ':cid' => $id);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('修改成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'Manufacturer_edit': 
			$id = $_POST['MidInput'];
			$nam = $_POST['inputName'];
			$tel = $_POST['inputTel'];
			$add = $_POST['inputAddress'];
			$tax = $_POST['inputTaxid'];
			$lea = $_POST['inputLeader'];
			$prepareSQL = "UPDATE manufacturer SET mname=:name,tel=:tel,address=:address,taxid=:taxid,leader=:leader WHERE 1=1 and mid=:mid";
			$executeSQL = array(':name' => $nam, ':tel' => $tel, ':address' => $add, ':taxid' => $tax, ':leader' => $lea, ':mid' => $id);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('修改成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'Customer_delete': 
			$id = $_GET['id'];
			$prepareSQL = "UPDATE customer SET usingg=1 WHERE 1=1 and cid=:id";
			$executeSQL = array(':id' => $id);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('修改成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'Manufacturer_delete': 
			$id = $_GET['id'];
			$prepareSQL = "UPDATE manufacturer SET usingg=1 WHERE 1=1 and mid=:id";
			$executeSQL = array(':id' => $id);
			$sql = $model->rowCountSQL($prepareSQL, $executeSQL);
			if($sql == 1) {
				echo "<script>javascript: alert('修改成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'box_insert':

			if(isset($_POST['add_dname']) && isset($_POST['box_or_pouch']) && isset($_POST['pc_item']) && isset($_POST['pc_num'])) {
			  $arr_box_or_pouch = $_POST['box_or_pouch'];
			  $arr_pc_item = $_POST['pc_item'];
			  $arr_pc_num = $_POST['pc_num'];

			  if((count($arr_box_or_pouch)==count($arr_pc_item)) && (count($arr_pc_item)==count($arr_pc_num))){
			  	$b=0;
			  	$i=0;
			  	$n=0;
			  	foreach ($arr_box_or_pouch as $arr_b) {
			  		if($arr_b=='0'){
			  			$b+=1;
			  			echo "<script>alert('arr_box_or_pouch break);</script>";
			  			break;
			  		}
			  	}
			  	foreach ($arr_pc_item as $arr_i) {
			  		if($arr_i=='0'){
			  			$i+=1;
			  			echo "<script>alert('arr_pc_item break);</script>";
			  			break;
			  		}
			  	}
			  	foreach ($arr_pc_num as $arr_n) {
			  		if($arr_n==''){
			  			$n+=1;
			  			echo "<script>alert('arr_pc_num break);</script>";
			  			break;
			  		}
			  	}
			  	
			  	if($b==0 && $i==0 && $n==0){
			  		echo "<script>alert('it is ok');</script>";
			  		$add_dname = $_POST['add_dname'];

			  		$prepareSQL = "SELECT bid FROM box order by bid desc limit 1";
					$executeSQL = array();
					$bidresult = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($bidresult as $br){
						$last_bid = $br['bid'];
					}
					echo "<script>alert('last_bid: ".$last_bid."');</script>";
					$endbid=substr($last_bid, -3, 3)+1;
					if ($endbid < 10) {
						$nowendbid='00'.$endbid;
					}elseif (100>$endbid && $endbid>=10) {
						$nowendbid='0'.$endbid;
					}elseif (1000>$endbid && $endbid>=100) {
						$nowendbid=$endbid;
					}
					$add_bid='b'.$nowendbid;
					echo "<script>alert('add_bid: ".$add_bid."');</script>";

					$addprice=0;
					for ($x = 0; $x < count($arr_box_or_pouch); $x++) {
						$prepareSQL = "SELECT price FROM pouch where poid= :poid";
						$executeSQL = array(':poid' =>$arr_pc_item[$x]);
						$price_result = $model->getDataSQL($prepareSQL, $executeSQL);
						foreach($price_result as $por){
							$addprice += ($por['price'])*$arr_pc_num[$x];
						}
					}
					echo "<script>alert('addprice: ".$addprice."');</script>";

			  		$reserve=0;
			  		$prepareSQL = "INSERT INTO box (bid,bname,price,reserve) VALUES(:bid,:bname,:price,:reserve)";
					$executeSQL = array(':bid' => $add_bid ,':bname' => $add_dname , ':price' => $addprice,':reserve' => $reserve);
					$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

					if($sql==1){
						for ($x = 0; $x < count($arr_box_or_pouch); $x++) {
							$prepareSQL = "INSERT INTO box_pouch (bid,poid,quantity) VALUES(:bid,:poid,:quantity)";
							$executeSQL = array(':bid' => $add_bid ,':poid' =>$arr_pc_item[$x]  , ':quantity' => $arr_pc_num[$x] );
							$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

							$prepareSQL2 = "INSERT INTO bom (father_id,son_id,quantity) VALUES(:father_id,:son_id,:quantity)";
							$executeSQL2 = array(':father_id' => $add_bid ,':son_id' =>$arr_pc_item[$x]  , ':quantity' => $arr_pc_num[$x] );
							$sql2 = $model->rowCountSQL($prepareSQL2, $executeSQL2);
						}
					} 

			  		echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';

			  	}else{
			  		echo "<script>alert('資料輸入不完整');</script>";
			  		echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			  	}
			  }

			}else{
				echo "<script>alert('is not set isset');</script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'pouch_insert':
					
			if(isset($_POST['add_poname']) && isset($_POST['chocolate']) && isset($_POST['c_item']) && isset($_POST['c_num'])) {
			  $arr_chocolate = $_POST['chocolate'];
			  $arr_c_item = $_POST['c_item'];
			  $arr_c_num = $_POST['c_num'];

			  if((count($arr_chocolate)==count($arr_c_item)) && (count($arr_c_item)==count($arr_c_num))){
			  	$ch=0;
			  	$i=0;
			  	$n=0;
			  	foreach ($arr_chocolate as $arr_ch) {
			  		if($arr_ch=='0'){
			  			$ch+=1;
			  			echo "<script>alert('arr_chocolate break);</script>";
			  			break;
			  		}
			  	}
			  	foreach ($arr_c_item as $arr_i) {
			  		if($arr_i=='0'){
			  			$i+=1;
			  			echo "<script>alert('arr_c_item break);</script>";
			  			break;
			  		}
			  	}
			  	foreach ($arr_c_num as $arr_n) {
			  		if($arr_n==''){
			  			$n+=1;
			  			echo "<script>alert('arr_c_num break);</script>";
			  			break;
			  		}
			  	}
			  	
			  	if($ch==0 && $i==0 && $n==0){
			  		echo "<script>alert('it is ok');</script>";
			  		$add_poname = $_POST['add_poname'];

			  		$prepareSQL = "SELECT poid FROM pouch order by poid desc limit 1";
					$executeSQL = array();
					$poidresult = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($poidresult as $por){
						$last_poid = $por['poid'];
					}
					echo "<script>alert('last_poid: ".$last_poid."');</script>";
					$endpoid=substr($last_poid, -3, 3)+1;
					if ($endpoid < 10) {
						$nowendpoid='00'.$endpoid;
					}elseif (100>$endpoid && $endpoid>=10) {
						$nowendpoid='0'.$endpoid;
					}elseif (1000>$endpoid && $endpoid>=100) {
						$nowendpoid=$endpoid;
					}
					$add_poid='po'.$nowendpoid;
					echo "<script>alert('add_poid: ".$add_poid."');</script>";

					
					$addprice=0;
					for ($x = 0; $x < count($arr_chocolate); $x++) {
						$prepareSQL = "SELECT price FROM chocolate where chid= :chid";
						$executeSQL = array(':chid' =>$arr_c_item[$x] );
						$price_result = $model->getDataSQL($prepareSQL, $executeSQL);
						foreach($price_result as $por){
							$addprice += ($por['price'])*$arr_c_num[$x];
						}
					}
					echo "<script>alert('addprice: ".$addprice."');</script>";



			  		$reserve=0;
			  		$prepareSQL = "INSERT INTO pouch (poid,poname,price,reserve) VALUES(:poid,:poname,:price,:reserve)";
					$executeSQL = array(':poid' => $add_poid ,':poname' => $add_poname , ':price' => $addprice,':reserve' => $reserve);
					$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

					if($sql==1){
						for ($x = 0; $x < count($arr_chocolate); $x++) {
							$prepareSQL = "INSERT INTO pouch_chocolate (poid,chid,quantity) VALUES(:poid,:chid,:quantity)";
							$executeSQL = array(':poid' => $add_poid ,':chid' =>$arr_c_item[$x]  , ':quantity' => $arr_c_num[$x] );
							$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

							$prepareSQL2 = "INSERT INTO bom (father_id,son_id,quantity) VALUES(:father_id,:son_id,:quantity)";
							$executeSQL2 = array(':father_id' => $add_poid ,':son_id' =>$arr_c_item[$x]  , ':quantity' => $arr_c_num[$x] );
							$sql2 = $model->rowCountSQL($prepareSQL2, $executeSQL2);
						}
					} 

			  		echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';

			  	}else{
			  		echo "<script>alert('資料輸入不完整');</script>";
			  		echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			  	}
			  }

			}else{
				echo "<script>alert('is not set isset, 資料輸入不完整');</script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;


		case 'chocolate_insert':
			if(isset($_POST['mid']) && isset($_POST['chname'])) {
				$select_mid = $_POST['mid'];
				$input_chname=$_POST['chname'];

				$prepareSQL = "SELECT chid FROM chocolate order by chid desc limit 1";
				$executeSQL = array();
				$chidresult = $model->getDataSQL($prepareSQL, $executeSQL);
				foreach($chidresult as $cr){
					$last_chid = $cr['chid'];
				}
				echo "<script>alert('last_chid: ".$last_chid."');</script>";
				$endchid=substr($last_chid, -3, 3)+1;
				if ($endchid < 10) {
					$nowendchid='00'.$endchid;
				}elseif (100>$endchid && $endchid>=10) {
					$nowendchid='0'.$endchid;
				}elseif (1000>$endchid && $endchid>=100) {
					$nowendchid=$endchid;
				}
				$add_chid='ch'.$nowendchid;
				echo "<script>alert('add_chid: ".$add_chid."');</script>";

				$reserve=0;
				$prepareSQL = "INSERT INTO chocolate (chid,chname,mid,price,reserve) VALUES(:chid,:chname,:mid,:price,:reserve)";
				$executeSQL = array(':chid' => $add_chid ,':chname' => $input_chname , ':mid' =>$select_mid, ':price' => 0, ':reserve' => $reserve);
				$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

				if($sql==1){
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
				}else{
			  		echo "<script>alert('ch insert error');</script>";
			  		echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			  	}
			}else{
		  		echo "<script>alert('資料輸入不完整');</script>";
		  		echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
		  	}
			break;

		case 'box_delete': 
			$bid = $_GET['bid'];
			$prepareSQL = "DELETE FROM box WHERE bid = :bid";
			$executeSQL = array(':bid' => $bid);
			$sql1 = $model->rowCountSQL($prepareSQL, $executeSQL);

			$prepareSQL = "DELETE FROM box_pouch WHERE bid = :bid";
			$executeSQL = array(':bid' => $bid);
			$sql2 = $model->rowCountSQL($prepareSQL, $executeSQL);

			$prepareSQL = "DELETE FROM bom WHERE father_id = :bid";
			$executeSQL = array(':bid' => $bid);
			$sql3 = $model->rowCountSQL($prepareSQL, $executeSQL);

			if(($sql1 != 0) && ($sql2 != 0) && ($sql3 != 0)){
				echo "<script>javascript: alert('刪除成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'pouch_delete': 
			$poid = $_GET['poid'];
			$prepareSQL = "DELETE FROM pouch WHERE poid = :poid";
			$executeSQL = array(':poid' => $poid);
			$sql1 = $model->rowCountSQL($prepareSQL, $executeSQL);

			$prepareSQL = "DELETE FROM pouch_chocolate WHERE poid = :poid";
			$executeSQL = array(':poid' => $poid);
			$sql2 = $model->rowCountSQL($prepareSQL, $executeSQL);

			$prepareSQL = "DELETE FROM bom WHERE father_id = :poid";
			$executeSQL = array(':poid' => $poid);
			$sql3 = $model->rowCountSQL($prepareSQL, $executeSQL);

			if(($sql1 != 0) && ($sql2 != 0) && ($sql3 != 0)){
				echo "<script>javascript: alert('刪除成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;

		case 'chocolate_delete': 
			$chid = $_GET['chid'];
			$prepareSQL = "DELETE FROM chocolate WHERE chid = :chid";
			$executeSQL = array(':chid' => $chid);
			$sql1 = $model->rowCountSQL($prepareSQL, $executeSQL);

			$prepareSQL = "DELETE FROM bom WHERE father_id = :chid";
			$executeSQL = array(':chid' => $chid);
			$sql3 = $model->rowCountSQL($prepareSQL, $executeSQL);

			if(($sql1 != 0) && ($sql3 != 0)){
				echo "<script>javascript: alert('刪除成功')></script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}else{
				echo "try again";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=basic>';
			}
			break;


		case 'purchase':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
			}

			$prepareSQL = "SELECT * FROM purchase_header";
			$executeSQL = array();
			$result = $model->getDataSQL($prepareSQL, $executeSQL);

			$prepareSQL_C = "SELECT chid,chname FROM chocolate";
			$executeSQL_C = array();
			$result_C = $model->getDataSQL($prepareSQL_C, $executeSQL_C);

			$prepareSQL_M = "SELECT mid,mname FROM manufacturer";
			$executeSQL_M = array();
			$result_M = $model->getDataSQL($prepareSQL_M, $executeSQL_M);

			$prepareSQL_PC = "SELECT * FROM purchase_content";
			$executeSQL_PC = array();
			$result_PC = $model->getDataSQL($prepareSQL_PC, $executeSQL_PC);

			$prepareSQL_RH = "SELECT * FROM return_header";
			$executeSQL_RH = array();
			$result_RH = $model->getDataSQL($prepareSQL_RH, $executeSQL_RH);


			require("view/purchase.php");
			break;

		case 'Purchase_add':
			$mid = $_POST['inputMid'];
			$acce = $_POST['inputAcceptance'];
			$udate;
			$todaydate;
			$uidno;
			$today=(string)(date("Ymd"));

			$prepareSQLH = "SELECT phid FROM purchase_header WHERE 1=:a AND mid=:mid AND acceptance=:acce AND date=:dat" ;// 
			$executeSQLH = array(':a' => 1,':mid' => $mid,':acce' => $acce,':dat' => $today);//
			$resultH = $model->getDataSQL($prepareSQLH,$executeSQLH);
			if($resultH) {//如果今天已經有這個驗收人跟這個廠商訂購的紀錄,就取得他的phid
				foreach($resultH as $e){
						$uidno = $e['phid'];
				}
				
				$prepareSQLB = "SELECT pbid FROM purchase_content WHERE 1=:a AND phid=:phid order by pbid desc limit 1" ;
				$executeSQLB = array(':a' => 1,':phid' => $uidno);
				$resultB = $model->getDataSQL($prepareSQLB,$executeSQLB);
				foreach($resultB as $b){
						$tail = substr($b['pbid'], 2, 12);
				}
				$pbi = 'pb'.($tail+1);//PBID
			}else{//如果今天沒有這個驗收人跟這個廠商訂購的紀錄
				$prepareSQL = "SELECT phid FROM purchase_header WHERE 1=:a order by phid desc limit 1";
				$executeSQL = array(':a' => 1);
				$result = $model->getDataSQL($prepareSQL,$executeSQL);
				if($result) {
					foreach($result as $e){
						$phid['phid'] = $e['phid'];//ita
					}
					$udate=(int)(substr($phid['phid'], 2, 8));//ita
					$todaydate=(int)(date("Ymd"));
					if ($udate != $todaydate) {//今天還沒新增人員	
						$uidno='ph'. $today.'000001';
					}elseif ($udate == $todaydate) {//今天已經有新增人員了
						$endid=substr($phid['phid'], 10, 4)+1;//ita
						if ($endid < 10) {
							$nowendid='000'.$endid;
						}elseif (100>$endid && $endid>=10) {
							$nowendid='00'.$endid;
						}elseif (1000>$endid && $endid>=100) {
							$nowendid='0'.$endid;
						}elseif (10000>$endid && $endid>=1000) {
							$nowendid=$endid;
						}
						$uidno='ph'. $today.$nowendid;
					}
				}else{
					$uidno='ph'. $today.'0001';
				}

				//新增purchase_header
				$prepareSQL = "INSERT INTO purchase_header (phid,mid,date,acceptance) VALUES(:phid,:mid,:date,:acceptance)";
				$executeSQL = array(':phid' => $uidno ,':mid' => $mid , ':date' => date("Ymd") ,':acceptance' => $acce);
				$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

				$pbi = 'pb'.substr($uidno, 2, 11).'1';//PBID

			}
			
			
			$ite = $_POST['inputPCount'];
			for ( $i=1 ; $i<=$ite ; $i++ ) {
				$chi = $_POST['SelectChocolate'.$i];
				$qua = $_POST['inputQu'.$i];
				$uni = $_POST['inputPr'.$i];
				$tot = $uni*$qua;
				$rem = $_POST['inputRe'.$i];
				$prepareSQLContent = "INSERT INTO purchase_content (phid,pbid,item,chid,quantity,unit_price,total_price,remark) VALUES(:phid,:pbid,:item,:chid,:quantity,:unit_price,:total_price,:remark)";
				$executeSQLContent = array(':phid' => $uidno ,':pbid' => $pbi ,':item' => $i , ':chid' => $chi ,':quantity' => $qua,':unit_price' => $uni,':total_price' => $tot,':remark' => $rem);
				$sqlContent = $model->rowCountSQL($prepareSQLContent, $executeSQLContent);
			}

			if($sqlContent == 1) {
				echo "<script> alert('新增成功');</script>";
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=purchase>';
			}else{
				echo "try again";
				
			}
			break;

		case 'Purchase_seeContent':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
			}

			$phid = $_GET['phid'];
			
			$prepareSQL = "SELECT * FROM purchase_content where 1=:a AND phid=:phid order by phid ,pbid ";
			$executeSQL = array(':a' => 1 ,':phid' => $phid);
			$result = $model->getDataSQL($prepareSQL, $executeSQL);
			
			require("view/purchase_seeContent.php");
			break;

		case 'Purchase_ContentCancel':
			$phid = $_GET['phid'];
			$pbid = $_GET['pbid'];
			$chid = $_GET['chid'];
			
			$prepareSQL = "DELETE FROM purchase_content WHERE 1=:a and phid = :phid and pbid = :pbid and chid = :chid";
			$executeSQL = array(':a' => 1 ,':phid' => $phid,':pbid' => $pbid,':chid' => $chid);
			$result = $model->getDataSQL($prepareSQL, $executeSQL);
			
			echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=purchase>';
			break;

			case 'Purchase_arrive':
				$arr = $_POST['inputArrive'];
				$ph = $_POST['inputArrivePh'];
				$pb = $_POST['inputArrivePb'];
				
				$prepareSQL = "UPDATE purchase_content SET arrive=:arrive WHERE 1=:a and phid=:phid and pbid=:pbid";
				$executeSQL = array(':arrive' => $arr,':a' => 1 ,':phid' => $ph,':pbid' => $pb);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);

				$prepareSQLGetCh = "SELECT chid,quantity FROM purchase_content WHERE 1=:a and phid=:phid and pbid=:pbid";
				$executeSQLGetCh = array(':a' => 1 ,':phid' => $ph,':pbid' => $pb);
				$resultGetCh = $model->getDataSQL($prepareSQLGetCh, $executeSQLGetCh);
				foreach($resultGetCh as $GetCh){
					$GetChID = $GetCh['chid'];
					$GetQuan = $GetCh['quantity'];

					$prepareSQLCHR = "SELECT reserve FROM chocolate WHERE 1=:a and  chid=:chid";
					$executeSQLCHR = array(':a' => 1 ,':chid' => $GetChID);
					$resultCHR = $model->getDataSQL($prepareSQLCHR, $executeSQLCHR);
					foreach($resultCHR as $e){
						$CR = $e['reserve'];
					}

					$reser=$CR+$GetQuan;
					$prepareSQLCH = "UPDATE chocolate SET reserve=:reserve WHERE 1=:a and chid=:chid";
					$executeSQLCH = array(':reserve' => $reser,':a' => 1 ,':chid' => $GetChID);
					$resultCH = $model->getDataSQL($prepareSQLCH, $executeSQLCH);
				}
				
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=purchase>';
				break;

			case 'Purchase_return':
				$arr = $_POST['inputRacceptance'];
				$ph = $_POST['inputReturnPh'];
				$pb = $_POST['inputReturnPB'];
				$ch = $_POST['inputReturnCH'];
				$up = $_POST['inputReturnUP'];
				$tp = $_POST['inputReturnTP'];
				$qu = $_POST['inputReturnQU'];
				$it = $_POST['inputReturnIT'];
				$mid;
				$pdate;
				$pacc;


				echo "<script> alert('".$arr."','".$ph."');</script>";
				

				$prepareSQLSR = "SELECT phid FROM return_header WHERE 1=:a and phid=:phid";
				$executeSQLSR = array(':a' => 1 ,':phid' => $ph);
				$resultSR = $model->getDataSQL($prepareSQLSR, $executeSQLSR);
				if ($resultSR) {//return_header已經有這個phid
					# nothing
				}else{//return_header還沒有這個phid
					$prepareSQL = "SELECT * FROM purchase_header WHERE 1=:a and phid=:phid";
					$executeSQL = array(':a' => 1 ,':phid' => $ph);
					$result = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($result as $e){
						$mid = $e['mid'];
						$pdate = $e['date'];
						$pacc = $e['acceptance'];
					}

					$prepareSQLIR = "INSERT INTO return_header (phid,mid,pdate,pacceptance) VALUES(:phid,:mid,:pdate,:pacceptance)";
					$executeSQLIR = array(':phid' => $ph,':mid' => $mid ,':pdate' => $pdate,':pacceptance' => $pacc);
					$resultIR = $model->getDataSQL($prepareSQLIR, $executeSQLIR);
				}
				

				$prepareSQLIRC = "INSERT INTO return_content (phid,pbid,item,chid,quantity,unit_price,total_price,rdate,racceptance) VALUES(:phid,:pbid,:item,:chid,:quantity,:unit_price,:total_price,:rdate,:racceptance)";
				$executeSQLIRC = array(':phid' => $ph,':pbid' => $pb ,':item' => $it,':chid' => $ch,':quantity' => $qu,':unit_price' => $up,':total_price' => $tp,':rdate' => date("Ymd"),':racceptance' => $arr);
				$resultIRC = $model->getDataSQL($prepareSQLIRC, $executeSQLIRC);

				$prepareSQLCHR = "SELECT reserve FROM chocolate WHERE 1=:a and  chid=:chid";
				$executeSQLCHR = array(':a' => 1 ,':chid' => $ch);
				$resultCHR = $model->getDataSQL($prepareSQLCHR, $executeSQLCHR);
				foreach($resultCHR as $e){
					$CR = $e['reserve'];
				}

				$reser=$CR-$qu;
				$prepareSQLCH = "UPDATE chocolate SET reserve=:reserve WHERE 1=:a and chid=:chid";
				$executeSQLCH = array(':reserve' => $reser,':a' => 1 ,':chid' => $ch);
				$resultCH = $model->getDataSQL($prepareSQLCH, $executeSQLCH);

				$prepareSQLPR = "UPDATE purchase_content SET preturn=:preturn WHERE 1=:a and phid=:phid and pbid=:pbid and chid=:chid";
				$executeSQLPR = array(':preturn' => 1,':a' => 1 ,':phid' => $ph,':pbid' => $pb,':chid' =>$ch);
				$resultPR = $model->getDataSQL($prepareSQLPR, $executeSQLPR);


				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=purchase>';
				break;

			
			case 'Return_seeContent':
				if(isset($_SESSION["uid"])){
					$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				}

				$phid = $_GET['phid'];
				
				$prepareSQL = "SELECT * FROM return_content where 1=:a AND phid=:phid order by phid ,pbid ";
				$executeSQL = array(':a' => 1 ,':phid' => $phid);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);
				
				require("view/return_seeContent.php");
				break;

			case 'sale':
				if(isset($_SESSION["uid"])){
					$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				}

				$prepareSQL = "SELECT * FROM sale_header";
				$executeSQL = array();
				$result = $model->getDataSQL($prepareSQL, $executeSQL);

				$prepareSQL_C = "SELECT chid,chname FROM chocolate";
				$executeSQL_C = array();
				$result_C = $model->getDataSQL($prepareSQL_C, $executeSQL_C);

				$prepareSQL_M = "SELECT cid,cname FROM customer";
				$executeSQL_M = array();
				$result_M = $model->getDataSQL($prepareSQL_M, $executeSQL_M);

				$prepareSQL_PC = "SELECT * FROM sale_content";
				$executeSQL_PC = array();
				$result_PC = $model->getDataSQL($prepareSQL_PC, $executeSQL_PC);

				$prepareSQL_RH = "SELECT * FROM sale_return_header";
				$executeSQL_RH = array();
				$result_RH = $model->getDataSQL($prepareSQL_RH, $executeSQL_RH);


				require("view/sale.php");
				break;

		

			case 'Sale_add':
				$mid = $_POST['inputMid'];
				$acce = $_POST['inputAcceptance'];
				$udate;
				$todaydate;
				$uidno;
				$today=(string)(date("Ymd"));

				$prepareSQLH = "SELECT shid FROM sale_header WHERE 1=:a AND cid=:cid AND acceptance=:acce AND date=:dat" ;// 
				$executeSQLH = array(':a' => 1,':cid' => $mid,':acce' => $acce,':dat' => $today);//
				$resultH = $model->getDataSQL($prepareSQLH,$executeSQLH);
				if($resultH) {//如果今天已經有這個驗收人跟這個廠商訂購的紀錄,就取得他的phid
					foreach($resultH as $e){
							$uidno = $e['shid'];
					}
					
					$prepareSQLB = "SELECT sbid FROM sale_content WHERE 1=:a AND shid=:shid order by sbid desc limit 1" ;
					$executeSQLB = array(':a' => 1,':shid' => $uidno);
					$resultB = $model->getDataSQL($prepareSQLB,$executeSQLB);
					foreach($resultB as $b){
							$tail = substr($b['sbid'], 2, 12);
					}
					$pbi = 'sb'.($tail+1);//PBID
				}else{//如果今天沒有這個驗收人跟這個廠商訂購的紀錄
					$prepareSQL = "SELECT shid FROM sale_header WHERE 1=:a order by shid desc limit 1";
					$executeSQL = array(':a' => 1);
					$result = $model->getDataSQL($prepareSQL,$executeSQL);
					if($result) {
						foreach($result as $e){
							$shid['shid'] = $e['shid'];//ita
						}
						$udate=(int)(substr($shid['shid'], 2, 8));//ita
						$todaydate=(int)(date("Ymd"));
						if ($udate != $todaydate) {//今天還沒新增人員	
							$uidno='sh'. $today.'0001';
						}elseif ($udate == $todaydate) {//今天已經有新增人員了
							$endid=substr($shid['shid'], 10, 4)+1;//ita
							if ($endid < 10) {
								$nowendid='000'.$endid;
							}elseif (100>$endid && $endid>=10) {
								$nowendid='00'.$endid;
							}elseif (1000>$endid && $endid>=100) {
								$nowendid='0'.$endid;
							}elseif (10000>$endid && $endid>=1000) {
								$nowendid=$endid;
							}
							$uidno='sh'. $today.$nowendid;
						}
					}else{
						$uidno='sh'. $today.'0001';
					}

					//新增purchase_header
					$prepareSQL = "INSERT INTO sale_header (shid,cid,date,acceptance) VALUES(:phid,:mid,:date,:acceptance)";
					$executeSQL = array(':phid' => $uidno ,':mid' => $mid , ':date' => date("Ymd") ,':acceptance' => $acce);
					$sql = $model->rowCountSQL($prepareSQL, $executeSQL);

					$pbi = 'sb'.substr($uidno, 2, 11).'1';//PBID

				}
				
				
				$ite = $_POST['inputPCount'];
				for ( $i=1 ; $i<=$ite ; $i++ ) {
					$kin = $_POST['box_or_pouch'.$i];
					$chi = $_POST['pc_item'.$i];
					$qua = $_POST['inputQu'.$i];
					$uni = $_POST['inputPr'.$i];
					$tot = $uni*$qua;
					$rem = $_POST['inputRe'.$i];
					$prepareSQLContent = "INSERT INTO sale_content (shid,sbid,item,kind,chid,quantity,unit_price,total_price,remark) VALUES(:phid,:pbid,:item,:kind,:chid,:quantity,:unit_price,:total_price,:remark)";
					$executeSQLContent = array(':phid' => $uidno ,':pbid' => $pbi ,':item' => $i ,':kind' => $kin , ':chid' => $chi ,':quantity' => $qua,':unit_price' => $uni,':total_price' => $tot,':remark' => $rem);
					$sqlContent = $model->rowCountSQL($prepareSQLContent, $executeSQLContent);
				}

				if($sqlContent == 1) {
					echo "<script> alert('新增成功');</script>";
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=sale>';
				}else{
					echo "try again";
					
				}
				break;

			case 'Sale_seeContent':
				if(isset($_SESSION["uid"])){
					$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				}

				$phid = $_GET['phid'];
				
				$prepareSQL = "SELECT * FROM sale_content where 1=:a AND shid=:phid order by shid ,sbid ";
				$executeSQL = array(':a' => 1 ,':phid' => $phid);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);
				
				require("view/sale_seeContent.php");
				break;

			case 'Sale_ContentCancel':
				$phid = $_GET['phid'];
				$pbid = $_GET['pbid'];
				$chid = $_GET['chid'];
				
				$prepareSQL = "DELETE FROM sale_content WHERE 1=:a and shid = :phid and sbid = :pbid and chid = :chid";
				$executeSQL = array(':a' => 1 ,':phid' => $phid,':pbid' => $pbid,':chid' => $chid);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);
				
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=sale>';
				break;

			case 'Sale_arrive':
				$arr = $_POST['inputArrive'];
				$ph = $_POST['inputArrivePh'];
				$pb = $_POST['inputArrivePb'];
				
				$prepareSQL = "UPDATE sale_content SET arrive=:arrive WHERE 1=:a and shid=:phid and sbid=:pbid";
				$executeSQL = array(':arrive' => $arr,':a' => 1 ,':phid' => $ph,':pbid' => $pb);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);

				$prepareSQLGetCh = "SELECT chid,quantity FROM sale_content WHERE 1=:a and shid=:phid and sbid=:pbid";
				$executeSQLGetCh = array(':a' => 1 ,':phid' => $ph,':pbid' => $pb);
				$resultGetCh = $model->getDataSQL($prepareSQLGetCh, $executeSQLGetCh);
				foreach($resultGetCh as $GetCh){
					$GetChID = $GetCh['chid'];
					$GetQuan = $GetCh['quantity'];

					$prepareSQLCHR = "SELECT reserve FROM chocolate WHERE 1=:a and  chid=:chid";
					$executeSQLCHR = array(':a' => 1 ,':chid' => $GetChID);
					$resultCHR = $model->getDataSQL($prepareSQLCHR, $executeSQLCHR);
					foreach($resultCHR as $e){
						$CR = $e['reserve'];
					}

					$reser=$CR-$GetQuan;
					$prepareSQLCH = "UPDATE chocolate SET reserve=:reserve WHERE 1=:a and chid=:chid";
					$executeSQLCH = array(':reserve' => $reser,':a' => 1 ,':chid' => $GetChID);
					$resultCH = $model->getDataSQL($prepareSQLCH, $executeSQLCH);
				}
				
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=sale>';
				break;

			case 'Sale_return':
				$ph = $_POST['inputReturnPh'];
				$pb = $_POST['inputReturnPB'];
				$ch = $_POST['inputReturnCH'];
				$up = $_POST['inputReturnUP'];
				$tp = $_POST['inputReturnTP'];
				$qu = $_POST['inputReturnQU'];
				$it = $_POST['inputReturnIT'];
				$arr = $_POST['inputRacceptance'];
				$mid;
				$pdate;
				$pacc;

				echo "<script> alert('".$arr."','".$ph."','".$pb."','".$ch."','".$up."');</script>";

				$prepareSQLSR = "SELECT shid FROM sale_return_header WHERE 1=:a and shid=:phid";
				$executeSQLSR = array(':a' => 1 ,':phid' => $ph);
				$resultSR = $model->getDataSQL($prepareSQLSR, $executeSQLSR);
				if ($resultSR) {//return_header已經有這個phid
					# nothing
				}else{//return_header還沒有這個phid
					$prepareSQL = "SELECT * FROM sale_header WHERE 1=:a and shid=:phid";
					$executeSQL = array(':a' => 1 ,':phid' => $ph);
					$result = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($result as $e){
						$mid = $e['cid'];
						$pdate = $e['date'];
						$pacc = $e['acceptance'];
					}

					$prepareSQLIR = "INSERT INTO sale_return_header (shid,cid,pdate,pacceptance) VALUES(:phid,:mid,:pdate,:pacceptance)";
					$executeSQLIR = array(':phid' => $ph,':mid' => $mid ,':pdate' => $pdate,':pacceptance' => $pacc);
					$resultIR = $model->getDataSQL($prepareSQLIR, $executeSQLIR);
				}
				

				$prepareSQLIRC = "INSERT INTO sale_return_content (shid,sbid,item,chid,quantity,unit_price,total_price,rdate,racceptance) VALUES(:phid,:pbid,:item,:chid,:quantity,:unit_price,:total_price,:rdate,:racceptance)";
				$executeSQLIRC = array(':phid' => $ph,':pbid' => $pb ,':item' => $it,':chid' => $ch,':quantity' => $qu,':unit_price' => $up,':total_price' => $tp,':rdate' => date("Ymd"),':racceptance' => $arr);
				$resultIRC = $model->getDataSQL($prepareSQLIRC, $executeSQLIRC);

				$prepareSQLCHR = "SELECT reserve FROM chocolate WHERE 1=:a and  chid=:chid";
				$executeSQLCHR = array(':a' => 1 ,':chid' => $ch);
				$resultCHR = $model->getDataSQL($prepareSQLCHR, $executeSQLCHR);
				foreach($resultCHR as $e){
					$CR = $e['reserve'];
				}

				$reser=$CR+$qu;
				$prepareSQLCH = "UPDATE chocolate SET reserve=:reserve WHERE 1=:a and chid=:chid";
				$executeSQLCH = array(':reserve' => $reser,':a' => 1 ,':chid' => $ch);
				$resultCH = $model->getDataSQL($prepareSQLCH, $executeSQLCH);

				$prepareSQLPR = "UPDATE sale_content SET preturn=:preturn WHERE 1=:a and shid=:phid and sbid=:pbid and chid=:chid";
				$executeSQLPR = array(':preturn' => 1,':a' => 1 ,':phid' => $ph,':pbid' => $pb,':chid' =>$ch);
				$resultPR = $model->getDataSQL($prepareSQLPR, $executeSQLPR);


				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=sale>';
				break;

			
			case 'Sale_Return_seeContent':
				if(isset($_SESSION["uid"])){
					$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				}
				$phid = $_GET['phid'];
				
				$prepareSQL = "SELECT * FROM sale_return_content where 1=:a AND shid=:phid order by shid ,sbid ";
				$executeSQL = array(':a' => 1 ,':phid' => $phid);
				$result = $model->getDataSQL($prepareSQL, $executeSQL);
				
				require("view/sale_return_seeContent.php");
				break;

		case 'package':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				require("view/package.php");
			}
			break;

		case 'package_form':
			$b_pid = $_POST['b_pid'];
			$num = $_POST['num'];
			if(substr( $b_pid,0,1)=='b'){
				echo "<script>alert('bbb');</script>";
				$prepareSQL = "select * from bom where father_id = :father_id ;";
				$executeSQL = array(':father_id' => $b_pid);
				$son_id_result = $model->getDataSQL($prepareSQL, $executeSQL);
				$reserve_count=0;
				foreach($son_id_result as $so){	
					if(substr( $so['son_id'],0,1)=='p'){
						echo "<script>alert('select * from pouch where poid= ".$so['son_id']." and reserve < ".$num*$so['quantity'].";');</script>";
						$prepareSQL = "select * from pouch where poid= :son_id and reserve < :reserve;";
						$executeSQL = array(':son_id' => $so['son_id'], ':reserve' =>$num*$so['quantity']);
						$reserve_result = $model->rowCountSQL($prepareSQL, $executeSQL);
						echo "<script>alert('$reserve_result: ".$reserve_result."');</script>";
						if($reserve_result!=0){
							echo "<script>alert('".$b_pid."中的 ".$so['son_id']." 不夠');</script>";
							$reserve_count=1;
						}
					}elseif (substr( $so['son_id'],0,1)=='c') {
						// echo "<script>alert('select * from pouch where poid= ".$so['son_id']." and reserve <= ".$num*$so['quantity'].";');</script>";
						$prepareSQL = "select * from chocolate where chid= :son_id and reserve < :reserve;";
						$executeSQL = array(':son_id' => $so['son_id'], ':reserve' =>$num*$so['quantity']);
						$reserve_result = $model->rowCountSQL($prepareSQL, $executeSQL);
						// echo "<script>alert('$reserve_result: ".$reserve_result."');</script>";
						if($reserve_result!=0){
							echo "<script>alert('".$b_pid."中的 ".$so['son_id']." 不夠');</script>";
							$reserve_count=1;
						}
					}
				}
				if($reserve_count==0){
					echo "<script>alert('可以封裝');</script>";
					$prepareSQL = "select * from bom where father_id = :father_id ;";
					$executeSQL = array(':father_id' => $b_pid);
					$son_id_result = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($son_id_result as $so){
						if(substr( $so['son_id'],0,1)=='p'){
							$prepareSQL = "UPDATE pouch SET reserve=(reserve- :num) WHERE poid= :son_id;";
							$executeSQL = array(':son_id' => $so['son_id'], ':num' =>$num*$so['quantity']);
							$reserve_result = $model->rowCountSQL($prepareSQL, $executeSQL);
						}elseif (substr( $so['son_id'],0,1)=='c'){
							$prepareSQL = "UPDATE chocolate SET reserve=(reserve- :num) WHERE chid= :son_id;";
							$executeSQL = array(':son_id' => $so['son_id'], ':num' =>$num*$so['quantity']);
							$reserve_result = $model->rowCountSQL($prepareSQL, $executeSQL);
						}
					}
					$prepareSQL = "UPDATE box SET reserve=(reserve+ :num) WHERE bid= :bid;";
					echo "<script>alert('UPDATE box SET reserve=(reserve + ".$num.") WHERE bid= ".$b_pid.";');</script>";
					$executeSQL = array(':num' => $num, ':bid' =>$b_pid);
					$reserve_add_result = $model->rowCountSQL($prepareSQL, $executeSQL);
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=package>';
				}else{
					echo "<script>alert('原料不足');</script>";
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=package>';
				}

			}elseif (substr( $b_pid,0,1)=='p') {
				echo "<script>alert('ppp');</script>";
				$prepareSQL = "select * from bom where father_id = :father_id ;";
				$executeSQL = array(':father_id' => $b_pid);
				$son_id_result = $model->getDataSQL($prepareSQL, $executeSQL);
				$reserve_count=0;
				foreach($son_id_result as $so){
					echo "<script>alert('select * from chocolate where chid= ".$so['son_id']." and reserve < ".$num*$so['quantity'].";');</script>";
					$prepareSQL = "select * from chocolate where chid= :son_id and reserve < :reserve;";
					$executeSQL = array(':son_id' => $so['son_id'], ':reserve' =>$num*$so['quantity']);
					$reserve_result = $model->rowCountSQL($prepareSQL, $executeSQL);
					echo "<script>alert('$reserve_result: ".$reserve_result."');</script>";
					if($reserve_result!=0){
						echo "<script>alert('".$b_pid."中的 ".$so['son_id']." 不夠');</script>";
						$reserve_count=1;
					}
				}

				if($reserve_count==0){
					echo "<script>alert('可以封裝');</script>";
					$prepareSQL = "select * from bom where father_id = :father_id ;";
					$executeSQL = array(':father_id' => $b_pid);
					$son_id_result = $model->getDataSQL($prepareSQL, $executeSQL);
					foreach($son_id_result as $so){
						$prepareSQL = "UPDATE chocolate SET reserve=(reserve- :num) WHERE chid= :son_id;";
						$executeSQL = array(':son_id' => $so['son_id'], ':num' =>$num*$so['quantity']);
						$reserve_result = $model->rowCountSQL($prepareSQL, $executeSQL);
					}
					$prepareSQL = "UPDATE pouch SET reserve=(reserve+ :num) WHERE poid= :poid;";
					echo "<script>alert('UPDATE pouch SET reserve=(reserve + ".$num.") WHERE poid= ".$b_pid.";');</script>";
					$executeSQL = array(':num' => $num, ':poid' =>$b_pid);
					$reserve_add_result = $model->rowCountSQL($prepareSQL, $executeSQL);
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=package>';

				}else{
					echo "<script>alert('原料不足');</script>";
					echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=package>';
				}
			}
			break;

		case 'purchase_sale_search':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				require("view/purchase_sale_search.php");
			}else{
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
			}
			break;

		case 'reserve_search':
			if(isset($_SESSION["uid"])){
				$fidfname_result=$model->getfidfname($_SESSION['did'],$_SESSION['pid']);
				require("view/reserve_search.php");
			}else{
				echo '<meta http-equiv=REFRESH CONTENT=1;url=?action=login>';
			}
			break;


		default:
			require("view/error.php");
			break;
	}

}
else{
	require("view/error.php");
}