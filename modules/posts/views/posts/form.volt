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
          <li><a href="#general-options">Comment Options</a></li>
          <li><a href="#category">Categories</a></li>
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
        <div class="tab-content">
        <section id="content-holder" class="tab-pane fade in active">
            <h3>Content</h3>
              <div class="row">
                <div class="col-md-6">
                <?php
                $form->renderFormGroup('title');
                $form->renderFormGroup('permalink');
                $form->renderFormGroup('content');
                 ?>
                </div>
                <div class="col-md-6 jumbotron" data-copy-iframe-target="tinymce-content" data-copy-html="true"></div>
              </div>

        </section>
        <section id="excerpt" class="tab-pane fade in">
            <h3>Summarize your Post</h3>
            <p>This excerpt will display with each post where a short description is preferred.</p>
            <?php
                $form->renderFormGroup('excerpt');
            ?>
        </section>
        <section id="category" class="tab-pane fade in">
            <h3>Categorize your Post</h3>
            <p>Place your post into existing categories or create new categories.</p>
            <?php
                $form->renderFormGroup('excerpt');
            ?>
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
             </div>
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
tinymce.init({
    selector: "#content",
    menu:{},
    theme_advanced_buttons3_add: 'code',
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager"
	],
  setup: function (ed) {
        ed.on('init', function(args) {
        tinyMCE.activeEditor.dom.select('body')[0].setAttribute('data-copy-iframe-source','tinymce-content');

        $('#content_ifr').contents().find('[data-copy-iframe-source]').each(
            function(index, element) {
              copyTargetToSource(index, element);
            }
          );
        });
    },
	image_advtab: true ,
	external_filemanager_path:"/lib/ResponsiveFilemanager/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
    toolbar2: "| filemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   	external_plugins: { "filemanager" : "/lib/ResponsiveFilemanager/filemanager/plugin.min.js"},
   	image_advtab: true ,
 });
</script>