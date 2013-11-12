<?php use Phalcon\Tag as Tag; ?>
<article class="well">
	<header>
		<h1>{{post.title}}</h1>
		<p>Created on {{post.created}} by {{post.getUsers().login}}</p>
	</header>
	{{post.content}}
</div>
</article>