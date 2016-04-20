<?php 
include_once('conn.php');

$type = $_POST['type'];
if($type == 'bug'){
	saveBug();
}elseif($type == 'suggest'){
	saveSuggest();
}else{
	echo '{"error":true,"message":"未定义操作"}';
}
// 


function saveBug(){
	session_start ();
	
	$code = strtolower(trim($_POST['code']));
	$sessionCode = $_SESSION ['code'];
	unset($_SESSION['code']);
	if($sessionCode != $code){
		echo '{"error":true,"message":"验证码错误，请重新输入"}';
		return;
	}
	
	$system = trim($_POST['system']);
	$database = trim($_POST['database']);
	$jdk = trim($_POST['jdk']);
	$container = trim($_POST['container']);
	$detail = trim($_POST['detail']);
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	
	if($system == ''){
		echo '{"error":true,"message":"请选择操作系统"}';
		return;
	}
		
	if($database == ''){
		echo '{"error":true,"message":"请选择数据库"}';
		return;
	}
	
	if($jdk == ''){
		echo '{"error":true,"message":"请选择JDK版本"}';
		return;
	}
	
	if($detail == ''){
		echo '{"error":true,"message":"请填写问题描述"}';
		return;
	}
	
	$conn = @getConn() or die('{"error":true,"message":"无法连接数据库"}');
	if (mysqli_connect_errno()){
		echo ('{"error":true,"message":"无法连接数据库"}');
		return;
	}
	
	if($stmt = $conn->prepare('INSERT INTO feedback_bug(sys, jdk, db, container, detail, name, email) VALUES (?,?,?,?,?,?,?)')){
		$stmt->bind_param('iss', $system, $jdk, $database, $container, $detail, $name, $email);
		$r=$stmt->execute();
		
		if($r){
			echo '{"message":"已经收到反馈，我们会认真阅读，再次感谢您的支持。"}';
		}else{
			echo '{"error":true,"message":"保存失败"}';
		}
		
	}else{
		echo '{"error":true,"message":"保存失败"}';
	}

	$conn->close();
}

function saveSuggest(){
	
}

?>