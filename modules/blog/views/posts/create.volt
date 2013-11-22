<?php
$form->renderFormStart();
?>
<div class="col-md-9">
    <?php
    $form->renderFormGroup('title');
    $form->renderFormGroup('permalink');
    $form->renderFormGroup('content');
     ?>

     <div data-role='advanced-options' class="hidden">
        <ul id="nav-tab" class="nav nav-tabs">
          <li class="active"><a href="#general-options" >General Options</a></li>
          <li><a href="#metadata" >Metadata</a></li>
          <li><a href="#metadata">Social Graphs</a></li>
        </ul>
        <div class="tab-content">
        <section id="general-options" class="tab-pane fade in active">
            <h3>General Options for Post</h3>
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
                <p>&lt;title&gt;<span data-meta-copy="head-title"></span>&lt;/title&gt;</p>
             </div>
        </section>
        </div>

     </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <button data-role="advanced-options-toggle" class='btn btn-block btn-warning' type="button">Advanced Options</button>
    </div>
    <?php
    $form->renderFormGroup('Save in Drafts');
    $form->renderFormGroup('Publish New Post');
     ?>
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
	image_advtab: true ,
	external_filemanager_path:"/lib/ResponsiveFilemanager/filemanager/",
	filemanager_title:"Responsive Filemanager" ,
    toolbar2: "| filemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   	external_plugins: { "filemanager" : "/lib/ResponsiveFilemanager/filemanager/plugin.min.js"},
   	image_advtab: true ,
 });
</script>