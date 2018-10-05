<head>

</head>
<body>

</body>
<?php
$_GET['date_time'] = time();
echo time();
$valset=true;
if (isset($_GET['device_id'])) {
    $device_id= $_GET['device_id'];
}
else{
    $valset=false;
}
if (isset($_GET['card_no'])) {
    $card_no= $_GET['card_no'];

}else{
    $valset=false;
}
if (isset($_GET['date_time'])) {
    $date_time= $_GET['date_time'];
    $date_time= $date_time-21600;
}else{
    $valset=false;
}
//echo "DeviceID=".$device_id ."CardNO=".$card_no ."DateTime=".$date_time;



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "machine";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //die("Connection failed: " . mysqli_connect_error());
    //echo "Connection Fail";
}else{

    //echo "Connection Success!!!</br>";
}

date_default_timezone_set('Asia/Dhaka');
$enter_date = gmdate("Y/m/d",$date_time);
$enter_time = gmdate("H:i:s",$date_time);
if($enter_time < "21:00:00") {
    $qsql="SELECT * FROM teacher_enters where device_id=$device_id and card_no=$card_no and date_time=$date_time and enter_date='$enter_date'";
//   echo $qsql;
} else {
    $qsql="SELECT * FROM teacher_leaves where device_id=$device_id and card_no=$card_no and date_time=$date_time and leave_date='$enter_date'";
//   echo $qsql;
}

$result = mysqli_query($conn, $qsql);
if (mysqli_num_rows($result) > 0){
    echo "Repeat<br>";
}else{
    $enter_date = gmdate("Y/m/d",$date_time);
    $enter_time = gmdate("H:i:s",$date_time);
    if($enter_time < "22:00:00") {
        $sql = "insert into teacher_enters (device_id, card_no, date_time,enter_date,enter_time) VALUES ($device_id,$card_no, $date_time,'$enter_date','$enter_time')";
        $sqlresult = mysqli_query($conn, $sql);
        if($sqlresult) { echo "SUCCESS"; } else { echo "ERROR"; }
    } else if($enter_time > "05:00:00") {
        $sql = "insert into teacher_leaves (device_id, card_no, date_time,leave_date,leave_time) VALUES ($device_id,$card_no, $date_time,'$enter_date','$enter_time')";
        $sqlresult = mysqli_query($conn, $sql);
        if($sqlresult) { echo "SUCCESS"; } else { echo "ERROR"; }
    }  else {
        echo "Enter time is over";
    }
}
mysqli_close($conn);
?>
