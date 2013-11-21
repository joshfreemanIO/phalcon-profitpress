<?php $form->renderFullForm(); ?>
<script type="text/javascript">
tinymce.init({
    selector: "#editor",
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