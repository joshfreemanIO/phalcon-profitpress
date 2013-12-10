<?php $this->getContent(); ?>

<table width="100%">
	<tr>
		<td align="left">
			<?php echo \Phalcon\Tag::linkTo(array("categories/index", "Go Back", "class" => "btn")); ?>
		</td>
		<td align="right">
			<?php echo \Phalcon\Tag::linkTo(array("categories/new", "Create a Category", "class" => "btn")); ?>
		</td>
	<tr>
</table>

<table class="browse table" align="center" width="60%">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Slug</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(isset($page->items)){
			foreach($page->items as $categories){ ?>
		<tr>
			<td><?php echo $categories->id ?></td>
			<td><?php echo $categories->name ?></td>
			<td><?php echo $categories->slug ?></td>
			<td><?php echo \Phalcon\Tag::linkTo(array("categories/edit/".$categories->id, "Edit")); ?></td>
			<td><?php echo \Phalcon\Tag::linkTo(array("categories/delete/".$categories->id, "Delete")); ?></td>
		</tr>
		<?php }
		} ?>
	</tbody>
</table>

<div class="pagination" align="center">
	<ul>
		<li><?php echo \Phalcon\Tag::linkTo("categories/search", "First") ?></li>
		<li><?php echo \Phalcon\Tag::linkTo("categories/search?page=".$page->before, "Previous") ?></li>
		<li><?php echo \Phalcon\Tag::linkTo("categories/search?page=".$page->next, "Next") ?></li>
		<li><?php echo \Phalcon\Tag::linkTo("categories/search?page=".$page->last, "Last") ?></li>
	</ul>
</div>
