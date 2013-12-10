<?php use Phalcon\Tag as Tag; ?>

<h1>View All Blog Posts</h1>

<p>Page {{posts_paginater.current}}/{{posts_paginater.total_pages}}</p>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Permalink</th>
			<th></th>
			<th></th>
			<th>Date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
{% for post in posts_paginater.items %}
<tr>
	<td>{{post.get('title')}}</td>
	<td>{{post.get('permalink')}}</td>
	<td>{{post.countComments()}}</td>
	<td>{{post.getNotices()}}</td>
	<td>{{post.get('date_created')}}<br/>{{post.getDateModifiedDiff()}}</td>
	<td>
		<div class="btn-group">
		  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Actions&nbsp;<span class="caret"></span></button>
		  <ul class="dropdown-menu" role="menu">
		    <li>{{link_to('posts/edit/'~post.get('post_id'),'Edit')}}</li>
		    <li>{{link_to('posts/view/'~post.get('post_id'),'View')}}</li>
		    <li class="divider"></li>
		    <?php if ($post->isPublished()): ?>
		    	<li><a href="#">Unpublish</a></li>
			<?php else: ?>
		    	<li><a href="#">Publish</a></li>
		    <?php endif ?>
		    <li class="divider"></li>
		    <li><a href="#">Delete</a></li>
		  </ul>
		</div>
	</td>
</tr>
{% endfor %}
	</tbody>
</table>
<div class="nav">
<?php \ProfitPress\Components\Tag::getPaginatedList($posts_paginater->current, $posts_paginater->last, 5, $posts_paginater->total_pages, 'blog/posts/viewall/'); ?>
</div>

<?php echo $this->getContent() ?>