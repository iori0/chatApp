<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
<title>chat</title>
<script type="text/javascript">
function doReload() {
    // reloadメソッドによりページをリロード
    window.location.reload();
}
window.addEventListener('load', function () {
    // 5秒間隔でリロード
    setTimeout(doReload, 5000);
});
</script>
</head>
<body>
<form method="post" action="chat_a.php">
	<input type="text" name="msg">
	<button type="submit" name="send">送信</button>
</form>
<?php
if (empty($_POST['msg'])) {
    $db = mysqli_connect('localhost','root','','chat');
    if($db == false) {
        exit();
    }
    //DBの中身表示
    $sql = 'SELECT * FROM chat';
    $get = mysqli_query($db,$sql);
    while($row = mysqli_fetch_assoc($get)){
        if($row["name"]=='a'){
            echo "<div class='box-right'><div class='message-boxR'>"  . $row['msg'] . "</div></div><br/>";
        }else{
            echo "<div class='box-left'><div class='message-boxL'>" . $row['msg'] . "</div></div><br/>";
        }
    }

    //DBアクセス終了
    $db->close();
}

//insert
if(isset($_POST['send'])) {
    session_start();
    if(empty($_SESSION['msgb']) || $_SESSION['msgb']!=$_POST['msg']){
        $_SESSION['msgb']=$_POST['msg'];
        //DBアクセス
        $db = mysqli_connect('localhost','root','','chat');
        if($db == false) {
            exit();
        }

       //incert
        $sql = "INSERT INTO chat(name,msg) VALUES ('a','" . $_POST['msg'] . "')";
        $set = mysqli_query($db,$sql);

        //DBの中身表示
        $sql = 'SELECT * FROM chat';
        $get = mysqli_query($db,$sql);
        while($row = mysqli_fetch_assoc($get)){
            if($row["name"]=='a'){
                echo "<div class='box-right'><div class='message-boxR'>"  . $row['msg'] . "</div></div><br/>";
            }else{
                echo "<div class='box-left'><div class='message-boxL'>" . $row['msg'] . "</div></div><br/>";
            }
        }

        //DBアクセス終了
        $db->close();
    }else {
        $db = mysqli_connect('localhost','root','','chat');
        if($db == false) {
            exit();
        }
        //DBの中身表示
        $sql = 'SELECT * FROM chat';
        $get = mysqli_query($db,$sql);
        while($row = mysqli_fetch_assoc($get)){
            if($row["name"]=='a'){
                echo "<div class='box-right'><div class='message-boxR'>"  . $row['msg'] . "</div></div><br/>";
            }else{
                echo "<div class='box-left'><div class='message-boxL'>" . $row['msg'] . "</div></div><br/>";
            }
        }

        //DBアクセス終了
        $db->close();
    }
}
?>
</body>
</html>
