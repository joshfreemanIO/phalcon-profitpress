<?php

$form->post->renderFormStart();

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
                        <?php $form->post->renderFormGroup('title'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12"  data-height-source="tiny-mce">
                        <?php
                            echo $form->post->renderFormGroup('markdown');
                            echo $form->post->render('content');
                         ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12 content-viewer" data-markdown-target="content" data-copy-source='rendered-markdown'></div>
                    </div>
                </div>
                <div id="previews" class="dropzone-previews"></div>
                <button type="button" id="clickable">Click me to select files</button>
        </section>
        <section id="excerpt-container" class="tab-pane fade in">
            <h3>Summarize your Post</h3>
            <p>This excerpt will display with each post where a short description is required.</p>
            <?php
                $form->post->renderFormGroup('excerpt');
            ?>
        </section>
        <section id="category" class="tab-pane fade in">
            <h3>Help people find your post</h3>
            <div class="row">
                <h4>Permanent Url</h4>
                <div class="col-md-10">
                    <div class="input-group">
                        <label class="input-group-addon"><?php echo $this->getDi()->getShared('site')->base_url . '/';; ?></label>
                    <?php
                        echo $form->post->render('permalink');
                          // $form->post->renderFormGroup('permalink');
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
                            echo $form->post_category->renderCheckboxList();
                            // var_dump($form->post_category);
                        ?>
                </div>
                <div class="col-md-4">
                    <h5>Create new category</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <?php echo $form->category->render('name') ?>
                            </div>
                            <div class="row">
                                <?php echo $form->category->render('Create New Category') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="general-options" class="tab-pane fade in">
            <h3>Comment Options for Post</h3>
         <?php
             $form->post->renderFormGroup('allow_comments');
             $form->post->renderFormGroup('authorize_comments');
          ?>
        </section>
        <section id="metadata" class="tab-pane fade in">
            <h3>Metadata Editor</h3>
            <?php
            $form->post->renderFormGroup("head-title");
             ?>
             <div class="col-md-4">
                <p>&lt;title&gt;<span id="head-title-viewer" data-copy-target="head-title"></span>&lt;/title&gt;</p>
             </div>
            <?php
            $form->post->renderFormGroup("head-description");
             ?>
             <div class="col-md-4">
                <p>&lt;meta name="description" value="<span id="head-description-viewer" data-copy-target="head-description"></span>" /&gt;</p>
             </div>
        </section>
        <section id="twitter-cards" class="tab-pane fade in">
            <h3>Twitter Card</h3>
        </section>
        <section id="facebook-og" class="tab-pane fade in">
            <h3>Facebook Open Graph</h3>
        </section>
        <section id="google-plus" class="tab-pane fade in">
            <h3>Google+ Graph</h3>
        </section>
        <section id="publishing-options" class="tab-pane fade in">
            <h3>Publishing Options</h3>
            <p>You can choose to publish your post at a specific time and you can let your post expire so that it is no longer visible after a certain period.</p>
            <?php $form->post->renderFormGroup('publish_date'); ?>
        </section>
        </div>
     </div>
</div>
<footer class="editor navbar navbar-default">
    <ul id="nav-tab" class="nav navbar-nav">
        <li class="active"><a data-toggle-section="true" href="#content-holder" >Content</a></li>
        <li><a data-toggle-section="true" href="#excerpt-container">Summary</a></li>
        <li><a data-toggle-section="true" href="#category">Discovery</a></li>
        <li><a data-toggle-section="true" href="#general-options">Comment Options</a></li>
        <li><a data-toggle-section="true" href="#metadata">Metadata</a></li>
        <li class="dropdown dropup">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social Graphs</a>
            <ul class="dropdown-menu">
                <li><a data-toggle-section="true" href="#twitter-cards">Twitter Cards</a></li>
                <li><a data-toggle-section="true" href="#facebook-og">Facebook Open Graph</a></li>
                <li><a data-toggle-section="true" href="#google-plus">Google+ Graph</a></li>
            </ul>
        </li>
    </ul>
    <div class="nav navbar-nav navbar-right">
        <button type="button" class="btn btn-default dropdown-toggle dropup pseudo-navbar-button" data-toggle="dropdown">Publishing&nbsp;<span class="caret"></span></button>
        <div class="dropdown-menu dropup-menu publishing-menu">
            <a data-toggle-section="true" class="btn btn-block btn-block-no-margin btn-danger" href="#publishing-options">Advanced Options</a>
            <?php echo $form->post->render('save_draft'); ?>
            <?php echo $form->post->render('publish_immediately'); ?>
        </div>
    </div>
</footer>
<?php
$form->post->renderFormEnd();
 ?>
