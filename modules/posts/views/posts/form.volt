<?php
$form->renderFormStart();
// $form->renderFormStart(array('class' => 'dropzone'));
var_dump($form);
die();

?>
<div class="row">
</div>
<div class="col-md-12">

     <div data-role='advanced-options'>
     <!-- <div data-role='advanced-options' class="hidden"> -->
        <div class="tab-content">
        <section id="content-holder" class="tab-pane fade in active">
          <div class="row"></div>
                <div class="row">
                    <div class="col-md-12">
                        <?php $form->renderFormGroup('title'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12"  data-height-source="tiny-mce">
                        <?php
                          $form->renderFormGroup('prerendered_content');
                         ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 content-viewer" data-markdown-target="content" data-copy-iframe-target="tinymce-content" data-copy-html="true"  data-height-target="tiny-mce"></div>
                    </div>
                </div>
                <div id="previews" class="dropzone-previews"></div>
                <button type="button" id="clickable">Click me to select files</button>
        </section>
        <section id="excerpt-container" class="tab-pane fade in">
            <h3>Summarize your Post</h3>
            <p>This excerpt will display with each post where a short description is required.</p>
            <?php
                $form->renderFormGroup('excerpt');
            ?>
        </section>
        <section id="category" class="tab-pane fade in">
            <h3>Help people find your post</h3>
            <div class="row">
                <h4>Permanent Url</h4>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo $this->getDi()->getShared('site')->base_url . '/';; ?></span>
                    <?php
                        echo $form->render('permalink');
                          // $form->renderFormGroup('permalink');
                     ?>
                    </div>
                </div>
                <div class="col-md-2">
                    <button data-copy-input="title" class="btn btn-info" type='button'>Copy From Title</button>
                </div>
            </div>
            <div class="row">
                <h4>Categories</h4>
                <div class="col-md-4">
                    <h5>Select the applicable categories</h5>
                        <?php
                            $form->renderCheckboxList('category');
                        ?>
                </div>
                <div class="col-md-4">
                    <h5>Create new category</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <?php echo $form->render('category_name') ?>
                        </div>
                        <div class="col-md-4">
                          <button type="button" data-ajax-route="/posts/createcategory" data-ajax-input="category_name" class="btn btn-info">Add Category</button>
                            <?php //echo $form->render('Add Category') ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="general-options" class="tab-pane fade in">
            <h3>Comment Options for Post</h3>
         <?php
             $form->renderFormGroup('allow_comments');
             $form->renderFormGroup('authorize_comments');
          ?>
        </section>
        <section id="metadata" class="tab-pane fade">
            <h3>Metadata Editor</h3>
            <?php
            $form->renderFormGroup("head-title");
             ?>
             <div class="col-md-4">
                <p>&lt;title&gt;<span id="head-title-viewer" data-copy-target="head-title"></span>&lt;/title&gt;</p>
             </div>
            <?php
            $form->renderFormGroup("head-description");
             ?>
             <div class="col-md-4">
                <p>&lt;meta name="description" value="<span id="head-description-viewer" data-copy-target="head-description"></span>" /&gt;</p>
             </div>s
        </section>
        <section id="twitter-cards" class="tab-pane fade">
            <h3>Twitter Card</h3>
        </section>
        <section id="facebook-og" class="tab-pane fade">
            <h3>Facebook Open Graph</h3>
        </section>
        <section id="google+" class="tab-pane fade">
            <h3>Google+ Graph</h3>
        </section>
        </div>
     </div>
</div>
<footer class="editor navbar navbar-default">
    <ul id="nav-tab" class="nav navbar-nav">
        <li class="active"><a href="#content-holder" >Content</a></li>
        <li><a href="#excerpt-container">Summary</a></li>
        <li><a href="#category">Discovery</a></li>
        <li><a href="#general-options">Comment Options</a></li>
        <li><a href="#metadata">Metadata</a></li>
        <li class="dropdown dropup">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social Graphs</a>
            <ul class="dropdown-menu">
                <li><a href="#twitter-cards">Twitter Cards</a></li>
                <li><a href="#facebook-og">Facebook Open Graph</a></li>
                <li><a href="#google+">Google+ Graph</a></li>
            </ul>
        </li>
    </ul>
    <div class="nav navbar-nav navbar-right">
        <button type="button" class="btn btn-default dropdown-toggle dropup pseudo-navbar-button" data-toggle="dropdown">Publishing&nbsp;<span class="caret"></span></button>
        <div class="dropdown-menu dropup-menu publishing-menu">
        <button type="button" class="btn btn-block btn-block-no-margin btn-danger">Advanced Options</button>
            <?php echo $form->render('Save in Drafts'); ?>
            <?php echo $form->render('Publish New Post'); ?>
        </div>
    </div>
</footer>
<?php
$form->renderFormEnd();
 ?>
