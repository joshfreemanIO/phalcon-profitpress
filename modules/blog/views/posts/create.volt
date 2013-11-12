<?php
	$this->getDi()->getAssets()
		 ->addCss('bootstrap-wysihtml5/src/bootstrap-wysihtml5.css')
		 ->addCss('bootstrap-wysihtml5/lib/css/bootstrap.min.css');
    //and some local javascript resources
    $this->getDi()->getAssets()
         ->addJs('bootstrap-wysihtml5/lib/js/wysihtml5-0.3.0.min.js')
         ->addJs('/js/permalink.js')
         ->addJs('bootstrap-wysihtml5/lib/js/bootstrap.min.js')
         ->addJs('bootstrap-wysihtml5/src/bootstrap-wysihtml5.js');
?>
<script type="text/javascript"></script>
<?php $form->renderFullForm(); ?>
