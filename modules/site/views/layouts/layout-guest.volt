<div class="row">
    <div class='col-md-4 col-md-push-8 bottom-buffer'>
    <?php $this->partial(__LAYOUTDIR__."side-banner"); ?>
    </div>
    <div id="main-article" class='col-md-8 col-md-pull-4'>
        {{ content() }}
    </div>
</div>