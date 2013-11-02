<h1>Choose Your Might!<h1>
<h2>Eh?</h2>
<?php

foreach ($offer_templates as $offer) {
	echo $this->tag->linkTo('offers/create/' . $offer->getOfferTemplateId(), $offer->getOfferTemplateName());
	echo "<br>";
}

