<?php

$uri = explode('/', $_SERVER['REQUEST_URI']);
define('SITE_URI', '/' . $uri[1] . '/jackson/');

include __DIR__ . '/bootstrap.php';

?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Паттерны программирования</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Паттерны программирования"/>
    <meta name="keywords" content="Паттерны программирования"/>

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="favicon.ico">

    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/animate.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/icomoon.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/flexslider.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/style.css">
    <script src="<?php echo SITE_URI; ?>js/modernizr-2.6.2.min.js"></script>
    <script src="<?php echo SITE_URI; ?>js/respond.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

    <script>
        var filesContent = [];
    </script>

    <style>
        .timeline-centered:before {
            display: none;
            width: 0px;
            top: 0px;
            bottom: 0px;
            margin-left: 0px;
        }

        .item-container {
            padding: 3px;
            border-bottom: 1px gainsboro solid;
        }

        h3.item-container {
           text-align: center;
        }

        div.item-container {

        }

        p.item-container {

        }
    </style>

</head>
<body>
<div id="colorlib-page">
    <div class="container-wrap" style="max-width: 1400px;">
        <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle" data-toggle="collapse" data-target="#navbar"
           aria-expanded="false" aria-controls="navbar"><i></i></a>

        <aside id="colorlib-aside" role="complementary" class="border js-fullheight"
               style="height: 100%; width: 260px; overflow-y: auto; padding-top: 10px; border:1px blue solid">
            <div class="text-center" >

                <!--------------------------
                <div class="author-img" style="background-image: url(images/about.jpg);"></div>
                <h1 id="colorlib-logo"><a href="index.html">Jackson Ford</a></h1>
                <span class="position"><a href="#">UI/UX/Designer</a> in Philippines</span>
                --------------------------->

                <h1 id="colorlib-logo" style="padding: 0px; margin: 0px 0px 10px 0px;">
                    <a style="text-align: center">Паттерны программирования</a>
                </h1><hr/>

            </div>
            <nav id="colorlib-main-menu" role="navigation" class="navbar">
                <div id="navbar" class="collapse">
                    <ul>
                        <li class="active"><a href="#" data-nav-section="home">Home</a></li>
                        <li><a href="#" data-nav-section="adapter"   >Adapter</a></li>
                        <li><a href="#" data-nav-section="decorator" >Decorator</a></li>
                        <li><a href="#" data-nav-section="command"   >Command</a></li>
                        <li><a href="#" data-nav-section="strategy"  >strategy</a></li>
                        <li><a href="#" data-nav-section="builder"   >builder</a></li>

<!--                        <li><a href="#" data-nav-section="skills">Skills</a></li>-->
<!--                        <li><a href="#" data-nav-section="education">Education</a></li>-->
<!--                        <li><a href="#" data-nav-section="experience">Experience</a></li>-->
<!--                        <li><a href="#" data-nav-section="work">Work</a></li>-->
<!--                        <li><a href="#" data-nav-section="blog">Blog</a></li>-->
<!--                        <li><a href="#" data-nav-section="contact">Contact</a></li>-->
                    </ul>
                </div>
            </nav>

            <div class="colorlib-footer">
                <ul>
                    <li><a href="#"><i class="icon-facebook2"></i></a></li>
                    <li><a href="#"><i class="icon-twitter2"></i></a></li>
                    <li><a href="#"><i class="icon-instagram"></i></a></li>
                    <li><a href="#"><i class="icon-linkedin2"></i></a></li>
                </ul>
            </div>

        </aside>

        <div id="colorlib-main" style="border:1px gainsboro solid; width: 80%">

            <section class="colorlib-services" data-section="home">
                <div class="colorlib-narrow-content">
                    <div class="row" >
                        <div class="col-md-12" >
                            Паттерн (от англ. Pattern) — образец, шаблон.
                            Представьте, что вы хотите сделать новый автомобиль, но вы никогда этим не занимались. Сколько колес и почему вы спроектируете для него? Сейчас вы уже скорее всего скажете что 4, однако почему не 3, 5, 10, 20?
                            Потому-что практикой использования уже было выяснено, что обычные автомобили лучше всего делать на 4-х колесах — это шаблон проектирования сформированный временем.
                            Именно такому же подходу и служат паттерны в ООП и вы не столкнетесь с ними в разработке до тех пор, пока вам не потребуется «сделать автомобиль».
                            Однако иногда случается так, что вы создаете «трицикл», и только потом, набив несколько шишек с его устойчивость и неудачным вписыванием в колею на дороге,
                            узнаете что существует паттерн «автомобиль», который значительно упростил бы вам жизнь, знай вы про него ранее.
                        </div>
                    </div>
                </div>
            </section>


            <section class="colorlib-services" data-section="adapter">
                <div class="colorlib-narrow-content">
                    <div class="row" ><?php echo $designPatterns['adapter'];?></div>
                </div>
            </section>

            <section class="colorlib-services" data-section="decorator">
                <div class="colorlib-narrow-content">
                    <div class="row" ><?php echo $designPatterns['decorator'];?></div>
                </div>
            </section>

            <section class="colorlib-services" data-section="command">
                <div class="colorlib-narrow-content">
                    <div class="row" ><?php echo $designPatterns['command'];?></div>
                </div>
            </section>

            <section class="colorlib-services" data-section="strategy">
                <div class="colorlib-narrow-content">
                    <div class="row" ><?php echo $designPatterns['strategy'];?></div>
                </div>
            </section>

            <section class="colorlib-services" data-section="builder">
                <div class="colorlib-narrow-content">
                    <div class="row" ><?php echo $designPatterns['builder'];?></div>
                </div>
            </section>


        </div><!-- end:colorlib-main -->

    </div><!-- end:container-wrap -->
</div><!-- end:colorlib-page -->

<script src="<?php echo SITE_URI; ?>js/jquery.min.js"></script>
<script src="<?php echo SITE_URI; ?>js/bootstrap.min.js"></script>

<script src="<?php echo SITE_URI; ?>js/jquery.easing.1.3.js"></script>
<script src="<?php echo SITE_URI; ?>js/jquery.waypoints.min.js"></script>
<script src="<?php echo SITE_URI; ?>js/jquery.flexslider-min.js"></script>
<script src="<?php echo SITE_URI; ?>js/owl.carousel.min.js"></script>
<script src="<?php echo SITE_URI; ?>js/jquery.countTo.js"></script>

<script src="<?php echo SITE_URI; ?>js/main.js"></script>

<script>

    var app = new Vue({
        el: '#colorlib-page',
        data: {
            message: 'Привет, Vue!',
            filesCode : filesContent,
        }
    })

</script>

</body>
</html>

