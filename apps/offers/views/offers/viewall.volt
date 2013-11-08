<h1>View All Offers</h1>

{% for offer in offers %}
<?php
	$link = array('uri' => "offers/view/".$offer->getOfferId(), 'text' => $offer->getOfferId());
	echo \ProfitPress\Components\Tag::anchor($link);
?>
{% endfor %}