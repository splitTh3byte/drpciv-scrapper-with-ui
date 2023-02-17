<?php
if (!isset($_SESSION['loggedin'])) {
    header('Location: https://drpciv.codeflow.ro/drpciv/index.php?page=login');
    exit;
}


$db = Database::getInstance();
$link = $db->getConnection();
$obj=new websitePanel($link,TABLE);



$results=$obj->getData();


$antiCaptcha=getAntiCaptcha();

$antiCaptcha=$antiCaptcha['balance'];

$query="SELECT `pids` from `drpciv`.`pids` where 1";
$result=mysqli_query($link,$query);
while($row=mysqli_fetch_assoc($result)){
    $pidId=$row['pids'];

}
if(isset($pidId)){
    $pid=$pidId;
}else{

    $pid=null;
}



function getAntiCaptcha()
{

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "https://api.anti-captcha.com/getBalance");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Accept: application/json",
        "Content-Type: application/json"

    ));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, '{ "clientKey":"" }');
    $source = curl_exec($curl);
    curl_close($curl);

    return json_decode($source, true);


}


require __DIR__.'/../view/dashboard.php';
?>