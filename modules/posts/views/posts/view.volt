<?php 
	
	/**
	 * To get information about a post, use
	 * {{ post.get($attribute) }}, eg
	 *
	 * {{ post.get('title') }}
	 *
	 * This corresponds to an echo $model->$attribute
	 *
	 * http://docs.phalconphp.com/en/latest/reference/volt.html
	 */
	
	use Phalcon\Tag as Tag; 

?>
<article class="well">
	<header>
		<h1>{{ post.get('title') }}</h1>
		<p>Created on {{ post.get('date_created') }}</p>
	</header>

	{{ post.get('content') }}
</div>
</article>