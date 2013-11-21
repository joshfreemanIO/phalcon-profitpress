<?php use Phalcon\Tag as Tag; ?>

<h1>View All Blog Posts</h1>

<p>Page {{posts_paginater.current}}/{{posts_paginater.total_pages}}</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Permalink</th>
			<th>Date</th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
{% for post in posts_paginater.items %}
<tr>
	<td>{{post.getPostLink()}}</td>
	<td>{{post.getPostLink('title')}}</td>
	<td>{{post.getPostLink('slug')}}</td>
	<td>{{post.get('created')}}<br/>{{post.getDateModifiedDiff()}}</td>
	<td>{{post.countComments()}}</td>
	<td>{{post.getNotices()}}</td>
</tr>
{% endfor %}
	</tbody>
</table>
<div class="nav">
<?php \ProfitPress\Components\Tag::getPaginatedList($posts_paginater->current, $posts_paginater->last, 5, $posts_paginater->total_pages, 'blog/posts/viewall/'); ?>
</div>

<?php echo $this->getContent() ?>