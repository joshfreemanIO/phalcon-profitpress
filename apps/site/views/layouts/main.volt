<!DOCTYPE html>
<?php echo \ProfitPress\Components\Tag::getHtmlTag(); ?>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('css/style.css') }}
        <!--[if lt IE 9]>
        {{ stylesheet_link('css/oldIE.css') }}
        {{ javascript_include('http://html5shiv.googlecode.com/svn/trunk/html5.js', false) }}
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Profit Press">
        <meta name="author" content="Help Yourself Today, Inc. Team">
    </head>
    <body>
        <div id="faux-body-for-sticky-footer">
            <?php $this->partial(__LAYOUTDIR__."header"); ?>
            <article id="main-article">
                {{ content() }}
            </article>
            <div id="footer-clear"></div>
        </div>
        <footer id="main-footer">

        </footer>
<!--         {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('bootstrap/js/bootstrap.js') }}
        {{ javascript_include('js/utils.js') }} -->

    <?php $this->partial(__LAYOUTDIR__."piwik"); ?>

    </body>
</html>
