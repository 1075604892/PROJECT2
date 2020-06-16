<?php
$second = $_POST['second'];
if($second == "请选择城市"){
    header('location:browser.php');
}else{
    header('location:browser.php?hotcity='.$second);
}
?>