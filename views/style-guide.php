<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Slim 3</title>
        <link href='//fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
        <style>
            body {
                margin: 50px 0 0 0;
                padding: 0;
                width: 100%;
                font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
                text-align: center;
                color: #aaa;
                font-size: 18px;
            }

            h1 {
                color: #719e40;
                letter-spacing: -3px;
                font-family: 'Lato', sans-serif;
                font-size: 100px;
                font-weight: 200;
                margin-bottom: 0;
            }
        </style>
    </head>
    <body>
        <h1>Vicksburg Family Dentistsry <?php echo date('Y')?></h1>
        <div>a microframework for PHP</div>

        <?php if (isset($name)) : ?>
            <h2>Hello <?= htmlspecialchars($name); ?>!</h2>
        <?php else: ?>
            <p>Try <a href="http://www.slimframework.com">SlimFramework</a>
        <?php endif; ?>

        <div class="content">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Color Palette</h1>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="color-swatch swatch1">
                                Vermillion<br>
                                #F44503
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch2">
                                Coral<br>
                                #FD7947
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch3">
                                Mona Lisa<br>
                                #FEB092
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch4">
                                Midnight Blue<br>
                                #003163
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch5">
                                Azure<br>
                                #007DFC
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch6">
                                Endeavour<br>
                                #0057B0
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch7">
                                Blue Charcoal<br>
                                #000B17
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="color-swatch swatch8">
                                Ship Gray<br>
                                #404041
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h1>Buttons</h1>

                    <button class="btn btn-lg btn-vermillion margin-bottom-10">This is a large button</button>&nbsp;

                    <div class="hidden-sm-up margin-bottom-10"></div>

                    <button class="btn btn-midnight-blue">This is another smaller button</button>

                    <hr class="visible-xs-block">

                </div>
                <div class="col-sm-6">
                    <h1>Typography</h1>

                    <h1>Heading 1</h1>
                    <p class="details">Font: Poppins Semibold / Shiraz #592d2f</p>

                    <hr>

                    <h2>Heading 2</h2>
                    <p class="details">Font: Poppins Semibold / Salem #2a4e3a</p>

                    <hr>

                    <h3>Heading 3</h3>
                    <p class="details">Font: Poppins Medium / Dark Burgundy #252525</p>

                    <hr>

                    <p>Body Text</p>
                    <p>Lorem ipsum dolor sit amet, quis quam, fusce duis. Montes vestibulum esse, tristique dui lorem. Wisi cubilia. Nonummy justo, eros aliquet elit, nulla sollicitudin ut. Iaculis sit lacus, nisi orci nunc, pede convallis vestibulum.</p>
                    <p>Sed tellus. Posuere est quis, lacus sit nec. Ultricies vehicula arcu, nunc nonummy id. Vivamus odio neque, faucibus duis. Non diam amet, elit nec semper.</p>

                    <p><a href="#">This is a link</a> - <a href="#" class="hover">This is a hover link</a></p>

                    <p class="details">Font: Poppins 300 #252525</p>
                </div>
            </div>
        </div>
    </body>
</html>
