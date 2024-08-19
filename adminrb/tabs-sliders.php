<?php 
session_start();
include 'config.php';
global $editMode, $tabName, $tabID, $sliderEnable, $sliderID, $sliderHeading, $sliderSubHeading, $sliderLink, $sliderLinkText, $sliderOrder, $errorMessage;

$tabName=$_GET["TName"];
$tabID=$_GET["TID"];
$editMode="0";
$sliderHeading="";
$sliderSubHeading="";
$sliderLink="";
$sliderLinkText="";
$sliderEnable="";
$sliderOrder="";
$sliderID="";


//Get Tab Details to Edit or Delete
if(count($_GET)==3)
{
    $editMode="1";
    $sliderID = $_GET['ID'];
}

//Add New Tab
if (isset($_POST["btnAdd"]))
{
    
    try
    {
        $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
        $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $statement = $db->prepare("INSERT INTO tabs_slider (sliderSubHead, sliderHead, sliderLinkText, sliderLink, sliderOrder, sliderEnable, ref_tabID, sliderAdded) VALUES (:sliderSubHead, :sliderHead, :sliderLinkText, :sliderLink, :sliderOrder :sliderEnable, :ref_tabID, :sliderAdded)");

        
        $statement->bindValue(':ref_tabID', $tabID);
        $statement->bindValue(':sliderSubHead', $_POST["txtSubHead"]);
        $statement->bindValue(':sliderHead', $_POST["txtHead"]);
        $statement->bindValue(':sliderLinkText', $_POST["txtLinkText"]);
        $statement->bindValue(':sliderLink', $_POST["txtLink"]);
        $statement->bindValue(':sliderOrder', $_POST["txtOrder"]);
        

        
        
        
        $sliderEnable = 1;
        if(count($_POST)==5)
        {
            $sliderEnable = 0;
        }
        $statement->bindValue(':sliderEnable', $sliderEnable);
        $statement->bindValue(':sliderAdded',  $_SESSION['adminID']);
        $statement->execute();
        $sliderID = $db->lastInsertId();

         
        if(isset($_FILES["fDesktopImage"]["tmp_name"]))
        {
            move_uploaded_file($_FILES["fDesktopImage"]["tmp_name"], "../assets/sliders/".$sliderID."-d.png");
        }
        if(isset($_FILES["fMobileImage"]["tmp_name"]))
        {
            move_uploaded_file($_FILES["fMobileImage"]["tmp_name"], "../assets/sliders/".$sliderID."-m.png");
        }
        $errorMessage = '<div class="m-4 alert alert-success" role="alert">Slider successfully added</div>';
        
        
    }
    catch(exception $e)
    {
        $errorMessage = '<div class="m-4 alert alert-danger" role="alert">Failed to add new slider</div>';
        echo $e;
    }
}
else if (isset($_POST["btnUpdate"]))
{
    //Update Tab Details
    try
    {
        $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
        $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $statement = $db->prepare("UPDATE tabs_slider SET sliderSubHead=:sliderSubHead, sliderHead=:sliderHead, sliderLinkText=:sliderLinkText, sliderLink=:sliderLink, sliderOrder=:sliderOrder, sliderEnable=:sliderEnable, sliderUpdated=:sliderUpdated where (sliderID=:sliderID)");


        //

        
        $statement->bindValue(':sliderID', $sliderID);
        $statement->bindValue(':sliderSubHead', $_POST["txtSubHead"]);
        $statement->bindValue(':sliderHead', $_POST["txtHead"]);
        $statement->bindValue(':sliderLinkText', $_POST["txtLinkText"]);
        $statement->bindValue(':sliderLink', $_POST["txtLink"]);
        $statement->bindValue(':sliderOrder', $_POST["txtOrder"]);

        
        $sliderEnable = 1;
        if(count($_POST)==5)
        {
            $sliderEnable = 0;
        }
        $statement->bindValue(':sliderEnable', $sliderEnable);
        $statement->bindValue(':sliderUpdated',  $_SESSION['adminID']);
        $statement->execute();
        
        if(is_uploaded_file($_FILES["fDesktopImage"]["tmp_name"]))
        {
            if(file_exists("../assets/sliders/".$sliderID."-d.png")){
                unlink( "../assets/sliders/".$sliderID."-d.png");
            }
            move_uploaded_file($_FILES["fDesktopImage"]["tmp_name"], "../assets/sliders/".$sliderID."-d.png");
        }
        if(is_uploaded_file($_FILES["fMobileImage"]["tmp_name"]))
        {
            if(file_exists("../assets/sliders/".$sliderID."-m.png")){
                unlink("../assets/sliders/".$sliderID."-m.png");
            }
            move_uploaded_file($_FILES["fMobileImage"]["tmp_name"], "../assets/sliders/".$sliderID."-m.png");
        }


        $count = $statement->rowCount();
        if($count =='0'){
            $errorMessage = '<div class="m-4 alert alert-danger" role="alert">Failed to update slider</div>';
        }
        else{
            $errorMessage = '<div class="m-4 alert alert-success" role="alert">Slider successfully updated</div>';
        }

        
       
    }
    catch(exception $e)
    {
        echo $e;
    }


}
else if (isset($_POST["btnDelete"]))
{
    //Delete Tab Details

    try
    {
        $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
        $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $statement = $db->prepare("delete from tabs_slider where (sliderID=:sliderID)");
        $statement->bindValue(':sliderID', $sliderID);
        
        
       
        $statement->execute();
        if(file_exists("../assets/sliders/".$sliderID."-d.png")){
            unlink( "../assets/sliders/".$sliderID."-d.png");
        }
        if(file_exists("../assets/sliders/".$sliderID."-m.png")){
            unlink("../assets/sliders/".$sliderID."-m.png");
        }


        
        

        $count = $statement->rowCount();
        if($count =='0'){
            $errorMessage = '<div class="m-4 alert alert-danger" role="alert">Failed to delete slider</div>';
        }
        else{
            $errorMessage = '<div class="m-4 alert alert-success" role="alert">Slider successfully deleted</div>';
        }

        
       
    }
    catch(exception $e)
    {
        echo $e;
    }
}

//Get Tab Details to Edit or Delete
if(count($_GET)==3 )
{
   
    try
    {
        $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
        $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        

        $statement = $db->prepare("Select * from tabs_slider where (sliderID =:sliderID )");
        $statement->bindValue(':sliderID',  $sliderID );
        $statement->execute();
        if($tab = $statement->fetch())
        {


            $editMode="1";



        $sliderHeading=$tab["sliderHead"];
        $sliderSubHeading=$tab["sliderSubHead"];
        $sliderLink=$tab["sliderLink"];
        $sliderLinkText=$tab["sliderLinkText"];
        $sliderOrder = $tab["sliderOrder"];
        $tabEnable=$tab["sliderEnable"];
        }
    }
    catch(exception $e)
    {
       // echo $e;
    }
}

?>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?= ($editMode==1)?  'Edit Sliders':'Add New Sliders'?> | <?=$tabName?> Tab Sliders | WPoets | Dashboard</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="WPoets | Dashboard">
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include 'header.php';?>
</head> <!--end::Head--> <!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->
    <div class="app-wrapper"> <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i class="bi bi-list"></i> </a> </li>
                    <li class="nav-item d-none d-md-block"> <a href="dashboard.php" class="nav-link">Home</a> </li>
                </ul> <!--end::Start Navbar Links--> <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto"> <!--begin::Navbar Search-->
                    
                    <li class="nav-item"> <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i> <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none;"></i> </a> </li> <!--end::Fullscreen Toggle--> <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <span class="d-none d-md-inline"><?= $_SESSION['adminName'];?></span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end"> <!--begin::User Image-->
                            <li class="user-header text-bg-primary"> <img src="adminlte/dist/assets/img/user2-160x160.jpg" class="rounded-circle shadow" alt="User Image">
                                <p>
                                    <?= $_SESSION['adminName'];?>
                                </p>
                            </li> <!--end::User Image--> <!--begin::Menu Body-->
                            <li class="user-footer"> <a href="logout.php" class="btn btn-default btn-flat float-end">Log out</a> </li> <!--end::Menu Footer-->
                        </ul>
                    </li> <!--end::User Menu Dropdown-->
                </ul> <!--end::End Navbar Links-->
            </div> <!--end::Container-->
        </nav> <!--end::Header--> <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
            <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="dashboard.php" class="brand-link"> <!--begin::Brand Image--> <img src="assets/images/WPoets-logo-1.svg" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span class="brand-text fw-light"></span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div> <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2"> <!--begin::Sidebar Menu-->
                <?php
                    global $currentPage;
                    $currentPage='Tabs';
                    include 'sidemenu.php'
                ?>   
                <!--end::Sidebar Menu-->
                </nav>
            </div> <!--end::Sidebar Wrapper-->
        </aside> <!--end::Sidebar--> <!--begin::App Main-->
        <main class="app-main"> <!--begin::App Content Header-->
            <div class="app-content-header"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0"><?=$tabName?> Sliders</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="tabs.php">Tabs</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Sliders
                                </li>
                            </ol>
                        </div>
                    </div> <!--end::Row-->
                </div> <!--end::Container-->
            </div> <!--end::App Content Header--> <!--begin::App Content-->

            <div class="app-content"> 
                <div class="container-flud">
                    <div class="row">
                        <div class="col-md-6 ">
                            <div class="card m-3">
                                <div class="card-header">
                                        <h3 class="card-title">Sliders</h3>
                                        
                                </div> <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Name</th>
                                                <th>Order</th>
                                                <th>Mobile Image</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                                try
                                                {
                                                    $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
                                                    $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
                                                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                    
                                                    

                                                    $data = $db->query("Select * from tabs_slider where (ref_tabID=".$tabID.") order by sliderID ")->fetchAll();
                                                    // and somewhere later:
                                                    foreach ($data as $row) {
                                                        
                                                        $enable = ($row['sliderEnable']==1)? '<span class="badge text-bg-success">Enable</span>':'<span class="badge text-bg-danger">Disbale</span>';
                                                        echo '<tr class="align-middle">
                                                                    <td><a href="tabs-sliders.php?ID='. $row['sliderID'].'&TName='. str_replace("&","and", $tabName)  .'&TID='. $tabID .'">'. $row['sliderID'].'</a></td>
                                                                    
                                                                    <td>'. $row['sliderHead'].'</td>
                                                                     <td>'. $row['sliderOrder'].'</td>
                                                                    <td><span class="badge"><img style="width:40px;" src="../assets/sliders/'.$row['sliderID'].'-m.png"/></span></td>
                                                                    <td>'.  $enable.'</td>
                                                                    
                                                                </tr>';

                                                        
                                                    }
                                                    

                                                    
                                                }
                                                catch(exception $e)
                                                {
                                                    //echo $e;
                                                }


                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div> <!-- /.card-body -->
                            </div> <!-- /.card -->
                        </div>



                        <div class="col-md-6"> <!--begin::Add New Tab-->
                            <div class="card card-primary card-outline m-3"> <!--begin::Header-->
                                <div class="card-header">
                                    <div class="card-title"><?= ($editMode==1)?  'Edit Slider':'Add New Slider'?></div>
                                </div> <!--end::Header--> <!--begin::Form-->



                                <form method="post" enctype="multipart/form-data"> <!--begin::Body-->
                                    <div class="card-body">
                                        <div class="mb-3"> 
                                            <label for="exampleInputEmail1" class="form-label">Headline</label> 
                                            <input type="text" class="form-control" id="txtHead" name="txtHead" value="<?=$sliderHeading?>"  required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="exampleInputEmail1" class="form-label">Sub Headline</label> 
                                            <input type="text" class="form-control" id="txtSubHead" name="txtSubHead" value="<?=$sliderSubHeading?>"  required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="exampleInputEmail1" class="form-label">Link Text</label> 
                                            <input type="text" class="form-control" id="txtLinkText" name="txtLinkText" value="<?=$sliderLinkText?>"  required>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="exampleInputEmail1" class="form-label">Link</label> 
                                            <input type="text" class="form-control" id="txtLink" name="txtLink" value="<?=$sliderLink?>"  required>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="fDesktopImage" name="fDesktopImage">
                                            <label class="input-group-text" for="inputGroupFile02">Upload Desktop Image</label>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="fMobileImage" name="fMobileImage">
                                            <label class="input-group-text" for="inputGroupFile02">Upload Mobile Image</label>
                                        </div>
                                        <div class="mb-3"> 
                                            <label for="exampleInputEmail1" class="form-label">Order By</label> 
                                            <input type="number" class="form-control" id="txtOrder" name="txtOrder" value="<?=$sliderOrder?>"  required>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input type="checkbox" class="form-check-input" value="1" id="txtEnable" name="txtEnable" <?=($sliderEnable==0)? '':'checked'?> >
                                            <label class="form-check-label" for="txtEnable">Enable</label>
                                        </div>
                                    </div> <!--end::Body--> <!--begin::Footer-->
                                    <div class="card-footer">
                                        <?php if($editMode=="1")
                                        {
                                            ?>
                                            <button type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-primary">Update</button>
                                            <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger">Delete</button>
                                            <a href="tabs-sliders.php?TName=<?=$tabName?>&TID=<?=$tabID?>" class="btn btn-success">Add New</a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <button type="submit" id="btnAdd" name="btnAdd" class="btn btn-primary">Add</button>
                                            <?php
                                        }
                                        ?>
                                     </div> <!--end::Footer-->
                                </form> <!--end::Form-->
                                <?= $errorMessage; ?>
                            </div> <!--end::Add New Tab--> 
                        </div>


                    </div>
                </div>
            </div>
            
        </main> <!--end::App Main--> <!--begin::Footer-->
        <footer class="app-footer"> <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">Anything you want</div> <!--end::To the end--> <!--begin::Copyright--> <strong>
                Copyright &copy; <?= date("Y"); ?>&nbsp;
                <a href="https://www.wpoets.com/" class="text-decoration-none">WPoets Technology</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->
    
    <?php include 'footer.php';?>
    
</body><!--end::Body-->

</html>