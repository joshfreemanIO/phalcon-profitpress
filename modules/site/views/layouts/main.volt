<!DOCTYPE html>
<?php echo \ProfitPress\Components\Tag::getHtmlTag(); ?>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ assets.outputCss() }}
        {{ stylesheet_link(css) }}
        {{ stylesheet_link('css/bootstrap.override.css') }}
        <?php $this->assets->outputJs('head'); ?>
        <!--[if lt IE 9]>
        {{ javascript_include('http://html5shiv.googlecode.com/svn/trunk/html5.js', false) }}
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Profit Press">
        <meta name="author" content="Help Yourself Today, Inc. Team">
    </head>
    <body>
        <div id="wrap">
            <?php $this->partial(__LAYOUTDIR__."header-admin"); ?>
            <div class='container push-down'>
                <?php $this->flash->output(); ?>

                {{ content() }}
            </div>
        <div id="push"></div>
        </div>

        <footer id="footer">

        </footer>
        <!-- {{ javascript_include('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false) }} -->
        <script type="text/javascript">if (typeof jQuery == 'undefined') {document.write(unescape("%3Cscript src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' type='text/javascript'%3E%3C/script%3E"));}</script>
        {{ javascript_include('bootstrap/js/bootstrap.min.js') }}
        <?php $this->assets->outputJs('footer') ?>
    <?php $this->partial(__LAYOUTDIR__."piwik"); ?>
    <script type="text/javascript"></script>
    </body>
</html>