<?php  /*
    code by Cozy 👽 https://github.com/ItsCosmas
*/
include('connection.php'); // Get the Connection Class

if(isset($_POST['username'], $_POST['password'])){
  
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if (empty($username)  and empty($password))
    {
        $error  = '<div class= "alert alert-warning">
        <strong>Warning!</strong> Enter a Username and Password</div>';
    }
else{
    $query = $pdo -> prepare("SELECT * FROM user WHERE username = ? AND password = ?");
    $query -> bindValue(1,$username);
    $query -> bindValue(2,$password);
    $query -> execute();
}
    $num = $query -> rowCount();
    if($num == 1){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header('Location: ../index.php');
        exit();
    }else{
        $error = '<div class="alert alert-danger">
        <strong>Error!</strong> Incorrect Username or Password
      </div>';
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../CSS/style.css" />
    <script src="main.js"></script>
</head>

<body>

    <div class="container">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 text-left pageBelowNav">
            <form method="Post" action="login.php">
            <div class="form-group">
                <label for="Username">Username *</label>
                <input type="text" class="form-control" name="username" aria-describedby="Username" placeholder="Enter your Username">
                <small id="usernameHelp" class="form-text text-muted">Your Username</small>
            </div>
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
                <small id="passwordHelp" class="form-text text-muted">Your Password</small>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Log In</button>
            <div class="form-group" style="margin-top:5px;"> New User?<a href="signup.php"> Sign Up</a> </div>
            <div style="margin-top:10px">
                                <?php 
                                if(isset($error)){
                                    echo $error;
                                }
                                ?>
                        </div>
            </form>
        </div>
    </div>

</body>
</html>