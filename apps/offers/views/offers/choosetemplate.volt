<h1>Choose Your Template!</h1>

{% for templates in offer_templates %}
<a href="">

	<article class='offer-templates'>

	</article>
</a>
{% endfor %}
<?php

foreach ($offer_templates as $offer) {
	echo $this->tag->linkTo('offers/create/' . $offer->getOfferTemplateId(), $offer->getOfferTemplateName());
	echo "<br>";
}

