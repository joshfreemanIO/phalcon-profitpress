<?php
$form->renderFormStart();
?>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <button data-role="advanced-options-toggle" class='btn btn-block btn-warning' type="button">Advanced Options</button>
        </div>
    </div>
    <div class="col-md-4">
        <?php $form->renderFormGroup('Save in Drafts');  ?>
    </div>
    <div class="col-md-4">
        <?php $form->renderFormGroup('Publish New Post');  ?>
    </div>
</div>
<div class="col-md-12">

     <div data-role='advanced-options'>
     <!-- <div data-role='advanced-options' class="hidden"> -->
        <ul id="nav-tab" class="nav nav-tabs">
          <li class="active"><a href="#content-holder" >Content</a></li>
          <li><a href="#excerpt">Summary</a></li>
          <li><a href="#category">Discovery</a></li>
          <li><a href="#general-options">Comment Options</a></li>
          <li><a href="#metadata">Metadata</a></li>
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Social Graphs</a>
              <ul class="dropdown-menu">
                <li><a href="#twitter-cards">Twitter Cards</a></li>
                <li><a href="#facebook-og">Facebook Open Graph</a></li>
                <li><a href="#google+">Google+ Graph</a></li>
              </ul>
          </li>
        </ul>
        <br>
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
        </section>
        <section id="excerpt" class="tab-pane fade in">
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

<?php
$form->renderFormEnd();
 ?>

<script type="text/javascript">
// tinymce.init({
//     selector: "#content",
//     menu:{},
//     theme_advanced_buttons3_add: 'code',
//     height: 300,
//     plugins: [
//          "advlist autolink link image lists charmap print preview hr anchor pagebreak",
//          "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
//          "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
// 	],
//   setup: function (ed) {
//         ed.on('postRender', function(args) {

//         tinyMCE.activeEditor.dom.select('body')[0].setAttribute('data-copy-iframe-source','tinymce-content');

//         $('#content_ifr').contents().find('[data-copy-iframe-source]').each(
//             function(index, element) {
//               copyTargetToSource(index, element);
//             }
//           );

//         tinyMCEinit();

//         });
//     },
// 	image_advtab: true ,
// 	external_filemanager_path:"/lib/ResponsiveFilemanager/filemanager/",
// 	filemanager_title:"Responsive Filemanager" ,
//     toolbar2: "| filemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
//    	external_plugins: { "filemanager" : "/lib/ResponsiveFilemanager/filemanager/plugin.min.js"},
//    	image_advtab: true ,
//  });
</script>