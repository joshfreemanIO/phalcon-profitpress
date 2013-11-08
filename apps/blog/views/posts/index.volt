<?php use Phalcon\Tag as Tag; ?>

<?php echo $this->getContent() ?>

<p>
	<table class="table">
		<tr>
			<th>Title</th>
			<th>Created</th>
		</tr>
	<?php foreach($posts as $post){ ?>
		<tr>
			<td><?php echo $post->title ?></td>
			<td><?php echo $post->created ?></td>
			<td><?php echo Tag::linkTo('posts/show/'.$post->slug, 'Details') ?></td>
		</tr>
	<?php } ?>
	</table>
</p>