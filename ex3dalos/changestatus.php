<?php
require_once "autoload.php";
$modelo = new Lightning();

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
    $task_id = $_GET["id"];
    
    $task = $modelo->encotrarID($task_id);
}

$status="";
if($status=1){
    $status=0;
}else{
    $status=1;
}
$modelo->changestatus($task_id,$status);
    header("Location: index.php");
    exit(); 

?>