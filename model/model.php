<?php
class model{

	function __construct(PDO $dbh) {
		$this->dbh = $dbh;
	}

	function getDataSQL($prepareSQL, $executeSQL) { //顯示資料
		$dbh = $this->dbh;
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function rowCountSQL($prepareSQL, $executeSQL) { //執行資料並回傳結果的Boolean
		$dbh = $this->dbh;	
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->rowCount();
		// return $dbh->lastInsertId(); //顯示成功筆數
	}

	function getfidfname($did, $pid) { //回傳fid
		$prepareSQL = "SELECT ffunction.fid, ffunction.fname FROM permission, ffunction where permission.did= :did and permission.pid = :pid and permission.fid = ffunction.fid";
		$executeSQL = array(':did' => $did,':pid' => $pid);
		$dbh = $this->dbh;	
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function readbox(){
		$prepareSQL = "SELECT bid, bname, price, reserve FROM box";
		$executeSQL = array();
		$dbh = $this->dbh;	
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function readpouch(){
		$prepareSQL = "SELECT poid, poname, price, reserve FROM pouch";
		$executeSQL = array();
		$dbh = $this->dbh;
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function readchocolate(){
		$prepareSQL = "SELECT chocolate.chid, chocolate.chname, manufacturer.mname, chocolate.price, chocolate.reserve FROM chocolate, manufacturer where chocolate.mid = manufacturer.mid";
		$executeSQL = array();
		$dbh = $this->dbh;	
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function readmid(){
		$prepareSQL = "SELECT mid, mname FROM manufacturer";
		$executeSQL = array();
		$dbh = $this->dbh;
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function readbom($id){
		$prepareSQL = "WITH RECURSIVE directsales(son_id,quantity,lvl,path) AS
						(
						select son_id,quantity,1 as lvl,  CAST(son_id AS CHAR(200)) AS path
						from bom where father_id= :id
						union all

						select a.son_id,a.quantity,lvl+1,CONCAT(b.path, ',', a.son_id) AS path
						from bom a,directsales b
						where a.father_id=b.son_id
						)
						SELECT directsales.son_id,pouch.poname,chocolate.chname,directsales.quantity,directsales.lvl,directsales.path 
						FROM (directsales
						LEFT JOIN pouch on directsales.son_id=pouch.poid) left join chocolate on directsales.son_id=chocolate.chid
						ORDER BY path;";
		$executeSQL = array(':id' => $id);
		$dbh = $this->dbh;
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}

	function readcid(){
		$prepareSQL = "SELECT cid, cname FROM customer";
		$executeSQL = array();
		$dbh = $this->dbh;
		$sql = $dbh->prepare($prepareSQL);
		$sql->execute($executeSQL);
		return $sql->fetchAll();
	}


	
	
}