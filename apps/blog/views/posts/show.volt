<?php use Phalcon\Tag as Tag; ?>

<ul class="pager">
	<li class="previous pull-left">
		<?php echo Tag::linkTo('posts/index', '← Go back ') ?>
	</li>
</ul>

<div align="center">

	<h1>
		<?php echo $post->title ?>
		<small>
			created <?php echo $post->created ?> by <?php echo $post->getUsers()->login ?>
		</small>
	</h1>

	<p>
		<?php echo $post->content ?>
	</p>

</div>