<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Vicksburg Family Dentistry | Style Guide</title>
        <link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Roboto:400,400i,700,700i" rel="stylesheet">
        <link href="/css/theme.min.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="page">
            <header class="header">
                <div class="logo">
                    <img src="/img/vicksburg-family-dentistry-logo.svg" class="img-responsive" alt="Vicksburg Family Dentistry" data-aos="zoom-in">
                </div>
            </header>
            <nav class="nav">
            </nav>
            <!-- Main Section -->
            <section class="section main">
                <div class="content">
                    <div class="row">
                        <div class="col-sm-4 col-sm-push-8">
                            <img class="img-responsive" src="/img/dr-ford.jpg" alt="Dr. Ford">
                        </div>
                        <div class="col-sm-8 col-sm-pull-4">
                            <h1>Committed to Providing an Exceptional Level of Care and Attention</h1>
                            <p class="lead">Dr. Aaron Ford and the staff at Vicksburg Family Dentistry works together as a team to provide high-quality comprehensive care. We take pride in paying close attention to each patient's needs.</p>
                            <p><a href="#services" data-mt-duration="300" class="js-trigger btn btn-lg btn-white-outline">See Our Services <i class="fa fa-chevron-down" aria-hidden="true"></i></a></p>
                        </div>

                    </div>

                </div>
            </section>
            <section class="section services" id="services">
                <div class="content">
                    <h2>Services</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card" data-aos="zoom-in">
                                <h3 class="card-header">Ultrasonic Cleaning and Hygiene</h3>
                                <div class="card-block">
                                    <p>Ultrasonic dental cleaning is available to remove more dental tartar in less time, with no metal scraping!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section about-us">
                <div class="content">
                    <h2>About Us</h2>
                </div>
            </section>
            <section class="section">
                <div id="map"></div>
            </section>
            <section class="section contact">
                <div class="content">
                    <h2>Contact Us</h2>
                </div>
            </section>
            <div class="content">

        <h1>Vicksburg Family Dentistry <?php echo date('Y')?></h1>
        <div>a microframework for PHP</div>

        <?php if (isset($name)) : ?>
            <h2>Hello <?= htmlspecialchars($name); ?>!</h2>
        <?php else: ?>
            <p>Try <a href="http://www.slimframework.com">SlimFramework</a></p>
        <?php endif; ?>


        <div itemscope itemtype="http://schema.org/Dentist">
            <span itemprop="name">Vicksburg Family Dentistry</span>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                <span itemprop="streetAddress">602 West Prairie Street</span>
                <span itemprop="addressLocality">Vicksburg</span>,
                <span itemprop="addressRegion">MI</span>
                <a href="tel:12696491495" itemprop="postalCode">49009</span></a>
            </div>
            Phone: <span itemprop="telephone">269-649-1495</span>
            <a href="http://googlemapsurl.com" itemprop="maps">Get Directions</a>
        </div>

            </div>

            <footer class="footer">
                <p>602 West Prairie Street, Vicksburg, MI 49009 &middot; <a href="tel:12696491495">269-649-1495</a></p>
                <p>Copyright &copy; <?php echo date('Y') ?> Vicksburg Family Dentistry. All Rights Reserved.</p>
                <p>Designated trademarks and brands are the property of their respective owners.</p>
                <p>Website created by Matt Crandell of <a href="http://www.crandelldesign.com" target="_blank">Crandell Design</a>.</p>
            </footer>
        </div>
        <script src="/js/theme.min.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBCqvM0q7JDd9137Vz9BZk9RzkOYkMo5Mc&libraries=places&callback=initMap"></script>
    </body>
</html>
