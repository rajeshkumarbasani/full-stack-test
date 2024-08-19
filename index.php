<?php 
session_start();
global $currentPage, $tab_sliders, $tabs, $tabsArrya;
$tabsArrya =  $emptyArray = [[]];
$currentPage="Home";
$errorMessage="";

include 'adminrb/config.php';



try
{
    $dbhost = 'mysql:host='. constant('DB_HOST') .';dbname='.constant('DB_NAME');
    $db = new PDO($dbhost, constant('DB_USER'), constant('DB_PASSWORD'));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    

    $data = $db->query("SELECT tabID, sliderID, sliderSubHead, sliderHead, sliderLinkText, sliderLink, ref_tabID, tabName FROM tabs_slider INNER JOIN tabs ON tabs_slider.ref_tabID=tabs.tabID WHERE(tabs.tabEnable=1) and (tabs_slider.sliderEnable=1) order by tabs.tabName, tabs_slider.sliderHead;")->fetchAll();
    // and somewhere later:
    $tabs="";
    $tab_sliders="";
    foreach ($data as $row) {
        $tabsArrya[$row['tabID']][$row['sliderID']] =   $row;

        if(strpos($tabs, '#accordionTab'.$row['tabID'])===false)
        {
            $tabs=$tabs.'<button class="accordion-button font-size-large gray-dark" type="button" data-bs-toggle="collapse" data-bs-target="#accordionTab'.$row['tabID'].'" aria-expanded="true" aria-controls="collapseOne">
                   <img src="assets/icons/'.$row['tabID'].'.svg"/> '.$row['tabName'].'
                </button>';
        }

    }
    //var_dump($tabsArrya[22][6]);
}
catch(exception $e)
{
    //echo $e;
}



?>
<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Home | WPoets</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="Home | WPoets">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php include 'header.php';?>
    <style>
        .textTab .carousel-caption
        {
            bottom: 0;
            height: 100%;
    align-content: center;
        }
        .textTab img.w-100
        {
            opacity: 0;
            
        }
        .imageTab  img.w-100, .imageTab .carousel-inner, .imageTab .carousel-item, .imageTab, .textTab  img.w-100, .textTab .carousel-inner, .textTab .carousel-item, .textTab
        {
            object-fit: cover;
            height: 100%;
        }
        svg, svg path  {
            fill: white; 
        }
        .textTab a:hover svg path
        {
            fill: var(--brand-secondary);
        }
        .textTab a:hover
        {
            color: var(--brand-secondary);
        }
        .textTab .carousel-item
        {
            min-height:60vh;
        }
        .tabLeftControls
        {
            padding:40px 20px !important;
        }
        .tabLeftControls .accordion-button
        {
            font-family: "Titillium Web", sans-serif;
            font-weight:700;
           padding:15px 10px;
            width: 100%;
            margin:20px 0px;
        }
        .tabLeftControls .accordion-button img, .accordion-button img
        {
            width: 40px;
            margin-right:15px;
        }
        .tabLeftControls .accordion-button.active, .tabLeftControls .accordion-button:hover
        {
            -webkit-box-shadow: 0px 0px 10px 0px rgba(173,173,173,1);
-moz-box-shadow: 0px 0px 10px 0px rgba(173,173,173,1);
box-shadow: 0px 0px 10px 0px rgba(173,173,173,1);
        }
        .tabLeftControls .accordion-button.active
        {
            pointer-events: none;

        }
        .tabLeftControls .accordion-button.active:after
        {
            content: '';
    display: block;
    position: absolute;
    left: 100%;
    top: 50%;
    margin-top: -10px;
    width: 0;
    height: 0;
    border-top: 10px solid transparent;
    border-right: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: 10px solid #64b4c8;
    transform: rotate(180deg);
        }
        .tabRightSliders .accordion-header
        {
            display:none;
        }
        .carousel-caption h3
            {
                margin-top : 10px !important;
                margin-bottom : 20px !important;
            }
        .accordion-body
        {
            padding:0px;
        }
        .accordion-body .row
        {
margin:0px; 
        }
        .accordion-item, .accordion
        {
            border:0px !important;
            margin:0px 0px !important;
            padding:0px 0px !important;
        }
        .carousel-dark .carousel-indicators [data-bs-target]
        {
            border:2px solid #ffffff;
            background-color: transparent;
            border-radius: 50%;
    height: 10px;
    width: 10px;
        }
        .carousel-indicators .active
        {
            background-color: #ffffff !important;
            opacity:0.5 !important
        }
        .carousel-caption div
        {
            width: fit-content;
            margin:0 auto;
        }


        /* -----------------------------  big mobile and tablet ------------------------ */

        @media (min-width: 768px) and (max-width: 1200px)
        {
            .tabLeftControls
            {
                width: 100%;
                text-align:center;
            }
            .tabRightSliders
            {
                width: 100%;
            }
            .tabLeftControls .accordion-button
            {
                width: 30%;
                text-align:center;
                display:inline-block;
                padding:15px 20px;
                margin-right:20px;
                margin-top:0px;
                margin-bottom:0px;
            }
            .tabLeftControls .accordion-button.active:after
            {
                display:none;
            }
        }

        /*   --------------------------- Mobile Style -------------------------------- */
        @media (max-width: 767.98px) { 
            .textTab
            {
                height:fit-content;
            }
            .tabRightSliders
            {
                padding-left:20px !important;
                padding-right:20px !important;
            }
        
            .textTab img.w-100
            {
                opacity: 0.2;
                width: 160% !important;
            }
            .carousel-caption
            {
                display:block !important;
            }
            
            .tabRightSliders .accordion-header
            {
                display:block;
            }
            .imageTab, .tabLeftControls 
            {
                display:none !important;
            }
            .accordion-item
            {
                background:transparent;
            }
            .accordion-item .accordion-header .accordion-button
            {
                border-radius : var(--bs-accordion-border-radius) !important;
                margin-bottom:20px;
                
            }
            .accordion-item .carousel
            {
                margin-bottom:20px;
            }
            .textTab:after
            {
  

    content: '';
    display: block;
    position: absolute;
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    bottom: 100%;
    width: 0;
    height: 0;
    border-bottom: 10px solid #64b4c8;
    border-top: 10px solid transparent;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
            }
           .accordion-button::after
           {
            background-image:url('assets/icons/plus-01.svg') !important;
           }
            .accordion-button:not(.collapsed)::after
            {
                background-image:url('assets/icons/minus-01.svg') !important;
            }
            .accordion-button:focus
            {
                    box-shadow: none;
            }
            .accordion-button
            {
                background-color:#ffffff;
            }
           
            .accordion-button:not(.collapsed)
            {
                background-color:#ffffff;
            }
            .textTab .carousel-caption
            {
                width: 90%;
    right: 0px;
    left: 5%;
            }
            .textTab .carousel-item
            {
                min-height: fit-content;
            }
            
        }

        
        </style>
</head> <!--end::Head--> <!--begin::Body-->

<body class="login-page bg-body-secondary">
<?php include 'menu.php';?>
<div class="container-flud brand-secondary-bg py-5">
    <div class="container text-center py-5 brand-white">
        <h1 class="">DelphianLogic in Action</h1>
        <p>Lorem ipsum dolor sit amet, consecteture adipiscing elit, Aenean commodo</p>
    </div>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-3 tabLeftControls p-0 brand-white-bg">
                
                    <?=$tabs;?>
                
            </div>
            <div class="col-md-9 p-0 tabRightSliders">
            <div class="accordion" id="accordionExample">


<?php 

$rowIndex=-1;

array_shift($tabsArrya);



foreach ($tabsArrya as $tabrow) {
    $rowIndex=$rowIndex+1;
    

    //-------------------------------Accordation Items ----------------------------------//
?>
    <div class="accordion-item">
                <h2 class="accordion-header" id="heading<?=$tabrow[array_key_first($tabrow)]['tabID']?>">
                <button class="accordion-button gray-dark font-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accordionTab<?=$tabrow[array_key_first($tabrow)]['tabID']?>" aria-expanded="true" aria-controls="accordionTab<?=$tabrow[array_key_first($tabrow)]['tabID']?>">
                <img src="assets/icons/<?=$tabrow[array_key_first($tabrow)]['tabID']?>.svg"/>  <?=$tabrow[array_key_first($tabrow)]['tabName']?>
                </button>
                </h2>
                <div id="accordionTab<?=$tabrow[array_key_first($tabrow)]['tabID']?>" class="accordion-collapse collapse <?=($rowIndex=='0')? 'show':''?>" aria-labelledby="heading<?=$tabrow[array_key_first($tabrow)]['tabID']?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 p-0">
                                <div id="textTab<?=$tabrow[array_key_first($tabrow)]['tabID']?>" class="carousel carousel-dark slide textTab brand-fourth-bg">
                                    <div class="carousel-indicators">
                                        <?php

                                        ///---------------------Slider Controls -------------------------------------////
                                            $tabIndex=-1;
                                            foreach ($tabrow as $tabslider) {
                                                $tabIndex=$tabIndex+1;
                                                if($tabIndex==0)
                                                {
                                                    echo '<button type="button"  data-bs-target="#textTab'.$tabrow[array_key_first($tabrow)]['tabID'].'" data-bs-slide-to="0" class="active " aria-current="true" aria-label="Slide 1"></button>';
                                                }
                                                else
                                                {
                                                    echo '<button type="button"  data-bs-target="#textTab'.$tabrow[array_key_first($tabrow)]['tabID'].'" data-bs-slide-to="'.$tabIndex.'" aria-label="Slide 1"></button>';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="carousel-inner">

                                    <?php

                                        ///---------------------Slider Text -------------------------------------////
                                            $tabIndex=-1;
                                            foreach ($tabrow as $tabslider) {
                                                $tabIndex=$tabIndex+1;
                                                if($tabIndex==0)
                                                {
                                                    echo '<div class="carousel-item active" >
                                                            <img src="assets/sliders/'.$tabslider['sliderID'].'-m.png" class="d-block w-100" alt="...">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <div class="brand-secondary-bg pad-1 brand-white pad-x-4 mb-2 " ><p class="m-0" >'.$tabslider['sliderSubHead'].'</p></div>
                                                                <h3 class="font-semibold brand-white" >'.$tabslider['sliderHead'].'</h3>
                                                                <a href="'.$tabslider['sliderLink'].'" class="brand-white text-decoration-none font-semibold" >'.$tabslider['sliderLinkText'].' <svg xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve"> <path d="M11,4l-0.883,0.883l3.492,3.492H2v1.25h11.608l-3.492,3.492L11,14l5-5L11,4z"/> </svg></a>
                                                            </div>
                                                        </div>';
                                                }
                                                else
                                                {
                                                    echo '<div class="carousel-item" >
                                                            <img src="assets/sliders/'.$tabslider['sliderID'].'-m.png" class="d-block w-100" alt="...">
                                                            <div class="carousel-caption d-none d-md-block">
                                                                <div class="brand-secondary-bg  pad-1 brand-white pad-x-4 mb-2 " ><p class="m-0">'.$tabslider['sliderSubHead'].'</p></div>
                                                                <h3 class="font-semibold brand-white" >'.$tabslider['sliderHead'].'</h3>
                                                                <a href="'.$tabslider['sliderLink'].'" class="brand-white text-decoration-none font-semibold" >'.$tabslider['sliderLinkText'].' <svg xmlns="http://www.w3.org/2000/svg"  xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve"> <path d="M11,4l-0.883,0.883l3.492,3.492H2v1.25h11.608l-3.492,3.492L11,14l5-5L11,4z"/> </svg></a>
                                                            </div>
                                                        </div>';
                                                }
                                            }
                                        ?>


                                      


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 p-0">
                            <div id="imageTab" class="carousel carousel-dark slide imageTab">
                                    <div class="carousel-inner">

                                    <?php

                                        ///---------------------Slider Text -------------------------------------////
                                            $tabIndex=-1;
                                            foreach ($tabrow as $tabslider) {
                                                $tabIndex=$tabIndex+1;
                                                if($tabIndex==0)
                                                {
                                                    echo '<div class="carousel-item active" >
                                                            <img src="assets/sliders/'.$tabslider['sliderID'].'-d.png" class="d-block w-100" alt="...">
                                                        </div>';
                                                }
                                                else
                                                {
                                                    echo '<div class="carousel-item" >
                                                            <img src="assets/sliders/'.$tabslider['sliderID'].'-d.png" class="d-block w-100" alt="...">
                                                        </div>';
                                                }
                                            }
                                        ?>

                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


<?php
    
    

}
    


?>



            













            </div>
            </div>
        </div>
    </div>

























    <?php include 'footer.php';?>
  


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
    jQuery(document).ready(function($) {


        
    $('.tabLeftControls .accordion-button:first-child').addClass('active');

    $('.tabLeftControls .accordion-button').click(function(event){

        $('.tabLeftControls .accordion-button').removeClass('active');

        $(this).addClass('active');

    });


        $('button[data-bs-slide-to="0"]').click(function(event) {
            $('.imageTab').carousel(0);

        });
        $('button[data-bs-slide-to="1"]').click(function(event) {
                    $('.imageTab').carousel(1);

        });

        $('button[data-bs-slide-to="2"]').click(function(event) {
                    $('.imageTab').carousel(2);

        });

        /*
        $('#textTab').on('slide.bs.carousel', function() {

            $('#textTab2').carousel($("#textTab .carousel-inner .carousel-item").index( listItem ));
        });
        */

});
    </script>


</body>
</html>