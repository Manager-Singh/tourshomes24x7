<?php

$purchase_code = $_POST['purchasecode'];
$db_host = $_POST['dbhost'];
$db_user = $_POST['dbuser'];
$db_password = $_POST['dbpass'];
$db_name = $_POST['dbname'];

$url = 'https://demo.lion-coders.com/soft/sarchholmverify/';
$post_string = 'purchasecode='.urlencode($purchase_code);
// $ch = curl_init();
// curl_setopt($ch,CURLOPT_URL, $url);
// curl_setopt($ch,CURLOPT_POST, true);
// curl_setopt($ch,CURLOPT_POSTFIELDS, $post_string);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// $result = curl_exec($ch);
// $object = new \stdClass();
// $object = json_decode(strip_tags($result));
// curl_close($ch);
//$object->codecheck
if (true) {
 
    //write in database
    try {
        
        $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
        
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$dbh->exec($object->dbdata);
    }
    catch(PDOException $e) {
        if ($e->getCode() == 2002) {
            header('location: step3.php?_error=Unable to Connect Database, Please make sure Host info is correct and try again !');
            exit;
        } 
        elseif ($e->getCode() == 1045) {
            header('location: step3.php?_error=Unable to Connect Database, Please make sure database username and password is correct and try again !');
            exit;
        }
        elseif ($e->getCode() == 1049) {
            header('location: step3.php?_error=Unable to Connect Database, Please make sure database name is correct and try again !');
            exit;
        }
    }
} else {
    header("location: step3.php?_error=Wrong Purchase Code !");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>SarchHolm Installer</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="col-md-6 offset-md-3">
        <div class='wrapper'>
            <header>
                <img src="assets/images/logo-blue.png" alt="Logo"/>
                <h1 class="text-center">SarchHolm Auto Installer</h1>
            </header>
            <hr>
            <div class="content pad-top-bot-50">
                <p>
                    <h5><strong class="theme-color">Congratulations!</strong>
                    You have successfully installed SarchHolm!</h5><br>
                    Please login here -  <strong><a href="<?php echo '../'; ?>">Login</a></strong>
                    <br>
                    Email: <strong>admin@lion-coders.com</strong><br>
                    Password: <strong>admin</strong><br><br>
                    After login, go to Settings to change other Configurations.
                </p>
                <strong>Note: </strong><i>If 'install' folder exists in your project folder, please delete it ('install' folder)</i>.
            </div>
            <hr>
            <footer>Copyright &copy; lionCoders. All Rights Reserved.</footer>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script>
        $( document ).ready(function() {
            $.ajax({
                method:'get',
                url: 'delete.php',
                success:function(response){
                    if (response == 1) {
                        alert('Please delete "install" folder from your project folder.');
                    }
            }
        });
        });
    </script>
</body>
</html>