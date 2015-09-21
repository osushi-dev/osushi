<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>
    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php echo $this->Html->charset(); ?>
            <title>
                OSUSHI |
                <?php echo $page_title ?>
            </title>

            <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
            <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
            <?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('flexslider.css');

	?>
                <script src="/js/jquery.rateyo.min.js"></script>
                <style src="/css/jquery.rateyo.min.css"></style>

                <script src="/js/jquery.flexslider.js"></script>

                <style async src="/css/cake.generic"></style>

                <script src="/js/bootstrap.min.js"></script>

                <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
                <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

                <script async src="/js/jquery.easing.compatibility.js"></script>
                <!-- <script async src="/js/jquery.vgrid.min.js"></script> -->

                <script async src="/js/bootstrap-transition.js"></script>

                <!-- Material Design for bootstrap -->
                <link href="/css/material-css/roboto.min.css" rel="stylesheet">
                <link href="/css/material-css/material.min.css" rel="stylesheet">
                <link href="/css/material-css/ripples.min.css" rel="stylesheet">
                <script src="/js/ripples.min.js"></script>
                <script src="/js/material.min.js"></script>

                <style>
                    #map-canvas {
                        height: 100%;
                        margin: 0px;
                        padding: 0px
                    }
                </style>

                <script>
                    $(document).ready(function() {
                        // This command is used to initialize some elements and make them work properly
                        $.material.init();
                    });
                </script>
    </head>

    <body>
        <header class="container-fluid">
            <h4><a href="/">OSUSHI</a></h4>
        </header>
        <div>
            <?php echo $this->Flash->render(); ?>
                <?php echo $this->fetch('content'); ?>
        </div>
        <footer>
            <div style="text-align:center">
                <p class="muted credit">&copy; 2015
                    <?php if(date("Y")!=2015) echo date("-Y"); ?>
                        All rights reserved, Acht Geld＠NRI Hackathon 2015.10
                </p>
            </div>
            <?php echo $this->element('sql_dump'); ?>
        </footer>
    </body>

    </html>
