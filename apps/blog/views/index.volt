<?php use Phalcon\Tag as Tag; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Blog Tutorial</title>
        <link rel="stylesheet" type="text/css" href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Phalcon Blog</a>
                    <div class="nav-collapse">
                        <ul class="nav pull-left">
                            <li>
                                <?php echo Phalcon\Tag::linkTo('index', 'Home Page') ?>
                            </li>
                            <?php if ($this->session->has('auth')) { ?>
                                <li>
                                    <?php echo Phalcon\Tag::linkTo('posts/index', '+Posts') ?>
                                </li>
                                <li>
                                    <?php echo Phalcon\Tag::linkTo('categories/index', '+Categories') ?>
                                </li>
                                <li>
                                    <?php echo Phalcon\Tag::linkTo('users/logout', 'Log out') ?>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <?php echo Phalcon\Tag::linkTo('users/index', 'Log in') ?>
                                </li>
                            <?php } ?>
                        </ul>
                </div>
            </div>
        </div>

        <?php echo $this->getContent() ?>

        <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
    </body>
</html>