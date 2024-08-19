<?php 
session_start();
$errorMessage="";
include 'db.php'; 
if (isset($_POST["btnSubmit"]))
{
    $rValue = doLogin($_POST["txtUsername"], $_POST["txtPassword"]);
    switch($rValue)
    {
        case '1':
            header("Location: dashboard.php"); 
            exit();
            //$errorMessage = '<div class="alert alert-success" role="alert">Valid Username and Password</div>';
            break;
        case '0':
            $errorMessage = '<div class="alert alert-danger" role="alert">Please enter valid username and password</div>';
            break;
        case '-1':
            $errorMessage = '<div class="alert alert-danger" role="alert">Systax Error, Please try again</div>';
            break;
    }

}



?>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>WPoets | Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="AdminLTE 4 | Login Page">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include 'header.php';?>

</head> <!--end::Head--> <!--begin::Body-->

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="login-logo"> <img src="assets/images/WPoets-logo-1.svg" class="mb-3" > </div> <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="post">
                    <div class="input-group mb-3"> <input id="txtUsername" name="txtUsername" type="email" class="form-control" placeholder="Email">
                        <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    </div>
                    <div class="input-group mb-3"> <input id="txtPassword" name="txtPassword" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    </div> <!--begin::Row-->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-grid gap-2"> <button id="btnSubmit" name="btnSubmit" type="submit" class="btn btn-primary">Sign In</button> </div>
                        </div> <!-- /.col -->
                    </div> <!--end::Row-->
                    <div class="row mt-4">
                        <div class="col-12">
                            <?= $errorMessage; ?>
                        </div>
                    </div>
                </form>
            </div> <!-- /.login-card-body -->
        </div>
    </div>




    <?php include 'footer.php';?>
</body>
</html>