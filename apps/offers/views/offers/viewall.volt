<h1>View All Offers</h1>

<p>Page {{offers_paginater.current}}/{{offers_paginater.total_pages}}</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Permalink</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
{% for offer in offers_paginater.items %}
<tr>
	<td>{{offer.getOfferLink()}}</td>
	<td>{{offer.getOfferLink('offer_title')}}</td>
	<td>{{offer.getOfferLink('offer_title')}}</td>
	<td>{{offer.getDateCreated()}}<br/>{{offer.getDateModifiedDiff()}}</td>
</tr>
{% endfor %}
	</tbody>
</table>
<div class="nav">
<?php \ProfitPress\Components\Tag::getPaginatedList($offers_paginater->current, $offers_paginater->last, 5, $offers_paginater->total_pages, 'offers/viewall/'); ?>
</div>