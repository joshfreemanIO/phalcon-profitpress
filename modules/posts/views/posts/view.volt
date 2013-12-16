<?php use Phalcon\Tag as Tag; ?>
<article class="well">
	<header>
		<h1>{{post.get('title')}}</h1>
		<p>Created on {{post.get('date_created')}}</p>
	</header>

	{{post.get('content')}}
</div>
</article>