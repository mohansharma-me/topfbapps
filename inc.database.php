<?php
function apps() {
	$appArray=array();
	$resDB=exeSQL("select * from apps limit 9");
	if(mysql_affected_rows()>0) {
		while($app=mysql_fetch_assoc($resDB)) {
			$appArray[]=$app;
		}
	}
	return $appArray;
}

function connectMySQL() {
	mysql_connect("localhost","root","");
	mysql_select_db("topfbapps");
}

function exeSQL($query) {
	connectMySQL();
	return mysql_query($query);
}