<?php

$_source="direct";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if($_REQUEST["srcPage"]){
        $_source=$_REQUEST["srcPage"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_REQUEST['fname']);
  if (empty($name)) {
    echo "Name is empty";
  } else {
    echo $name;
  }
}
?>
<!DOCTYPE html>
<!-- saved from url=(0049)https://technext.github.io/pouseidon/aboutus.html -->
<html class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers no-applicationcache svg inlinesvg smil svgclippaths" lang="en" style=""><!--<![endif]--><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        
        <title>neetastudio.in - Maternity Photography Studio in Pune</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="/images/logo/ns_logo_50.jpg">

        <!--Google Fonts link-->
        <link href="/css/css" rel="stylesheet">
        <link href="/css/css_01" rel="stylesheet">
        <link href="/css/css_02" rel="stylesheet">


        <link rel="stylesheet" href="/css/slick.css">
        <link rel="stylesheet" href="/css/slick-theme.css">
        <link rel="stylesheet" href="/css/animate.css">
        <link rel="stylesheet" href="/css/fonticons.css">
        <link rel="stylesheet" href="/css/font-awesome.min.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/magnific-popup.css">
        <link rel="stylesheet" href="/css/bootsnav.css">


        <!--For Plugins external css-->
        <!--<link rel="stylesheet" href="assets/css/plugins.css" />-->

        <!--Theme custom css -->
        <link rel="stylesheet" href="/css/style.css">
        <!--<link rel="stylesheet" href="assets/css/colors/maron.css">-->

        <!--Theme Responsive css-->
        <link rel="stylesheet" href="/css/responsive.css">

        <script src="/scripts/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    </head>

    <body data-spy="scroll" data-target=".navbar-collapse"><div class="wrapper">


        <!-- Preloader -->
        <div id="loading" style="display: none;">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                    <div class="object" id="object_four"></div>
                </div>
            </div>
        </div><!--End off Preloader -->


        <div class="culmn">
            <!--Home page style-->
            <?php include_once("nav.php") ?>

            <?php
                $banner_name = "maternity-banner";
                if($_source=="Maternity"){
                    $banner_name = "maternity-banner";
                }
                
                if($_source=="Newborn"){
                    $banner_name = "newborn-banner";
                }
                
                if($_source=="Kids"){
                    $banner_name = "kids-banner";
                }
                
                if($_source=="Portraits"){
                    $banner_name = "portraits-banner";
                }
            ?>
            <!--Home Sections-->
            <section id="hello" class="<?php echo $banner_name?> bg-mega">
                <div class="container">
                    <div class="row">
                        <div class="main_home text-center">
                            <div class="about_text">
                                <h1 class="text-white text-uppercase">Packages for  Maternity Pictures</h1>
                                <ol class="breadcrumb">
                                    <li><a href="/htmls/home.php?_dc=fdfs&page=home&sTgt=site">Home</a></li>
                                    <li class="active"><a href="/maternity.php?_dc=fdfs&page=maternity&sTgt=site">Maternity</a></li>
                                </ol>
                            </div>
                        </div>
                    </div><!--End off row-->
                </div><!--End off container -->
            </section> <!--End off Home Sections-->
            <?php
                if($_source=="Maternity" || $_source=="direct"){
                    include_once("maternity-packages.php");
                }
                
                if($_source=="Newborn" || $_source=="direct"){
                    include_once("newborn-packages.php");
                }
                
                if($_source=="Kids" || $_source=="direct"){
                    include_once("kids-packages.php");
                }
                
                if($_source=="Portraits" || $_source=="direct"){
                    include_once("portraits-packages.php");
                }
            ?>


            <hr>
            <!--Package Details Section-->
            <section id="blog_details" class="blog_details roomy-40">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="main_blog_details">

                                <div class="blog_details_left">
                                    <div class="blog_details_img">
                                        <img src="/images/blog-details-img1.jpg" alt="">
                                    </div>
                                    <div class="blog_details_content">
                                        <div class="blog_details_figure m-top-40">
                                            <p>We've built our maternity photo packages in Pune to reflect the quality of our work and the experience we provide. We know these photos are important, so we offer different options to fit different needs and budgets.</p>

                                            <blockquote class="m-top-30 m-l-30">
                                                <h5>
                                                    <em>Each package is designed to make the process easy and enjoyable. We start with a consultation to talk about what you want. We’ll help you choose outfits, jewelry, and props from our collection to create the look you envision.</em>
                                                </h5>
                                            </blockquote>

                                            <p class="m-top-30">We understand that everyone's budget is different, so we've created a range of packages. We believe everyone should have the chance to capture these special moments.</p>
                                            <p class="m-top-30">For all the details on pricing and packages, please get in touch with us. We’re happy to answer your questions and help you find the perfect package for you. We want to make sure you get the photos you'll love.</p>

                                        </div>

                                        <div class="said_arc fix m-top-70">
                                            <h5 class="text-uppercase">Notes:</h5>
                                            <ul class="m-top-40">
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• The weekday offers are valid only for weekday bookings, excluding Saturdays and Sundays and any national holidays.</a></li>
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• All our packages include basic retouching of the images and will be delivered in digital format within 7 working days after the shoot.</a></li>
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Creative Edits or Signature Edits of images is possible if the background is a solid-coloured paper backdrop.</a></li>
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Depending on the package, edited images will be delivered in a combination of high-resolution and web-resolution digital files.</a></li>
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• All outdoor shoots are done in the studio garden and are dependent on weather conditions and safety factors for the client and our dresses and equipment.</li>
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Lying down solo/couple shots will be considered as a separate setup.</a></li>
                                                <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• No cancellations will be possible for any bookings. One rescheduling of the date is allowed in case of any special circumstances or emergencies.</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End off col-md-8 -->

                        <div class="col-md-4">
                            <div class="blog_saidbar sm-m-top-70">
                                <div class="said_arc fix m-top-70">
                                    <h6 class="text-uppercase">All our packages include:</h6>
                                    <ul class="m-top-40">
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Premium maternity outfits for the shoot</a></li>
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Hair and makeup by an industry professional</a></li>
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Matching jewellery, headbands and tiaras</a></li>
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Maternity-specific handheld signs and placards</a></li>
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Posing guidance during the shoot</a></li>
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Pre-shoot meeting and consultation</a></li>
                                        <li><a href="/htmls/blog-details.php?_dc=fdfs&page=blog&sTgt=site#">• Numerous set props and model props</a></li>
                                    </ul>
                                </div>

                                <div class="said_post fix m-top-70">
                                    <h6 class="m-bottom-20 text-uppercase">OPTIONAL EXTRAS:</h6>
                                    <div class="post_item">
                                        <div class="item_text">
                                            <h5>Cinematic Reel (up to 60s):</h5>
                                            <p><i class="fa fa-arrow"></i>• 1 setups: ₹5,000<br>• Each additional setup: ₹4,000</p>
                                        </div>
                                    </div>
                                    <div class="post_item">
                                        <div class="item_text">
                                            <h5>Hair and Makeup:</h5>
                                            <p><i class="fa fa-arrow"></i>• First look: ₹2,000<br>• Each additional look: ₹1,000</p>
                                        </div>
                                    </div>
                                    <div class="post_item">
                                        <div class="item_text">
                                            <h5>Cost per additional image:</h5>
                                            <p><i class="fa fa-arrow"></i>• 2 setups: ₹10,000<br>• Each additional setup: ₹5,000<br>• Creative Edits: ₹2,000<br>• Hi-Res Images: ₹1,000</p>
                                        </div>
                                    </div>
                                    <div class="post_item">
                                        <div class="item_text">
                                            <h5>Cost per additional dress:</h5>
                                            <p><i class="fa fa-arrow"></i>• Exclusive Setup Upgrade: ₹2,500<br>• Each additional setup: ₹3,000</p>
                                        </div>
                                    </div>
                                    <div class="post_item">
                                        <div class="item_text">
                                            <h5>Cost per additional time:</h5>
                                            <p><i class="fa fa-arrow"></i>• Additional 1 Hour : ₹5,000<br>• Additional 30 Minutes: ₹3,000</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End off col-md-4 -->

                    </div><!-- End off row -->

                </div><!-- End off container -->
            </section><!-- End off blog Fashion -->
            <hr>
            <?php
            
                if($_source=="Maternity" || $_source=="direct"){
                    include_once("maternity-gowns.php");
                }
                
                if($_source=="Newborn" || $_source=="direct"){
                    include_once("newborn-props.php");
                }
                
                if($_source=="Kids" || $_source=="direct"){
                    include_once("kids-backdrops.php");
                }
                
                if($_source=="Portraits" || $_source=="direct"){
                    include_once("portraits-background.php");
                }
            ?>
            <hr>
            <!--Simple Section-->
            <section id="simple" class="simple roomy-80">
                <div class="container">
                    <div class="row">
                        <div class="main_simple text-center">
                            <div class="col-md-12">
                                <h2>Maternity Pictures by Neeta Studios</h2>
                                <p>This is the day to celebrate how strong your body is and all the hard work it has done over the last 9 months. This time deserves to be documented.</p>

                                <a href="/htmls/book-session.php?_dc=fdfs&page=contact&sTgt=site#contact" class="btn btn-default m-top-40">Contact Us <i class="fa fa-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
            <!--Testimonial Section-->
            <?php include_once("testimonial.php") ?>
            
            <!--Company section-->
            <?php include_once("company.php") ?>


            <!-- scroll up-->
            <div class="scrollup">
                <a href="/htmls/aboutus.php?_dc=fdfs&page=about&sTgt=site"><i class="fa fa-chevron-up"></i></a>
            </div>
            <!-- End off scroll up -->

            <?php include_once("footer.php") ?>

        </div>

        <!-- JS includes -->

        <script src="/scripts/jquery-1.11.2.min.js"></script>
        <script src="/scripts/bootstrap.min.js"></script>

        <script src="/scripts/isotope.min.js"></script>
        <script src="/scripts/jquery.magnific-popup.js"></script>
        <script src="/scripts/jquery.easing.1.3.js"></script>
        <script src="/scripts/slick.min.js"></script>
        <script src="/scripts/jquery.collapse.js"></script>
        <script src="/scripts/bootsnav.js"></script>


        <!-- paradise slider js -->

        <!--
                <script src="http://maps.google.com/maps/api/js?key=AIzaSyD_tAQD36pKp9v4at5AnpGbvBUsLCOSJx8"></script>
                <script src="assets/js/gmaps.min.js"></script>
        
                <script>
                    function showmap() {
                        var mapOptions = {
                            zoom: 8,
                            scrollwheel: false,
                            center: new google.maps.LatLng(-34.397, 150.644),
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                        $('.mapheight').css('height', '350');
                        $('.maps_text h3').hide();
                    }
        
                </script>-->





        <script src="/scripts/plugins.js"></script>
        <script src="/scripts/main.js"></script>

    

</div></body></html>