<h1>Choose Your Template!</h1>
<section>
    <div class="flex-container">
        <div class="flex-element-20 flex-element">
            <button class="btn btn-lg btn-block btn-default">Use Predfined Template</button>
        </div>
        <div class="flex-element-60 flex-element">
            <div class="well">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <?php foreach ($offer_templates as $offer): ?>
                    <p><?php echo $this->tag->linkTo('offers/create/' . $offer->getOfferTemplateId(), $offer->getOfferTemplateName()); ?></p>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-element-20 flex-element">
            <button class="btn btn-lg btn-block btn-default">Create Your Own</button>
        </div>
        <div class="flex-element-60 flex-element">
            <div class="well">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
    </div>
</section>

