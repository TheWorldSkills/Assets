<?php 
	// db 가져오기
	$pdo = new PDO("mysql:host=localhost;dbname=2019_03_04blog2;charset=utf8" , "root" , "" , array(
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
	));

	session_start();
	header("content-type:text/html;charset=utf-8");
	date_default_timezone_set('Asia/Seoul');

	// 주소 가져오기
	$varray = isset($_GET['uri']) ? explode('/', $_GET['uri']) : null;
	$pagemode = isset($varray[0]) ? $varray[0] : null;
	$midx = isset($varray[1]) ? $varray[1] : 'main';
	$page = isset($varray[3]) ? $varray[3] : 1;

	// db
	function execute($sql , $parame = null)
	{
		global $pdo;
		$data = $pdo->prepare($sql);
		$data->execute($parame);
		return $data;
	}

	function fetch($sql , $parame = null)
	{
		return execute($sql , $parame)->fetch();
	}


	function fetchAll($sql , $parame = null)
	{
		return execute($sql , $parame)->fetchAll();
	}

	function rowCount($sql , $parame = null)
	{
		return execute($sql , $parame)->rowCount();
	}

	// 경고창
	function alert($msg = null , $url = null)
	{
		echo "<script>";
		echo $msg ? "alert('{$msg}');" : "";
		echo $url ? "document.location.replace('{$url}')" : "history.back()";
		echo "</script>";
		exit;
	}


	// 데이터 있는지 확인
	function re($data){
		foreach ($data as $key => $value) {
			if($value == null){
				alert("입력을 다 확인해주세요.");
			}
		}
	}

	// member
	$member = isset($_SESSION['member']) ? $_SESSION['member'] : null;
	
	$user_eoe = fetchAll("select * from member");
	foreach ($user_eoe as $key => $value) {
		if($value->userid == $pagemode)
		{
			$midx = '/myblog';
		}
	}

	// pagemode 체크
	if($pagemode == "action")
	{
		include "./lib/action.php";
		exit;
	}

	
	// midx 체크
	if($midx == "/myblog")
	{
		include "./page/myblog.php";
		exit;
	}

 ?>