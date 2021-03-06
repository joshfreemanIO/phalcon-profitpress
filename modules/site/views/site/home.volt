<?php
use \ProfitPress\Components\Tag as Tag;
 ?>

<?php foreach ($posts_paginater->items as $post): ?>
	<article class='thumbnail'>
		<h3>{{post.get('title')}}</h3>
		{{post.getTruncated('content')}}
		<p><?php echo Tag::anchor(array('uri' => $post->get('permalink'), 'text' => 'Read Post &rarr;')); ?></p>
	</article>
<?php endforeach ?>

<?php if ($posts_paginater->total_pages > 1): ?>
<div class="nav">
<?php Tag::getPaginatedList($posts_paginater->current, $posts_paginater->last, 5, $posts_paginater->total_pages, 'page/'); ?>
</div>
<?php endif ?>