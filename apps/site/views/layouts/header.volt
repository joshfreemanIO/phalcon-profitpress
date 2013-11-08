<?php
$navigation_links[] = array('class' => 'navigation-button', 'uri' => '', 'text' => 'Home');
$navigation_links[] = array('class' => 'navigation-button', 'uri' => 'blog/view', 'text' => 'Blog');

if ($this->session->get('authenticated') === true) {
	$navigation_links[] = array('class' => 'navigation-button', 'uri' => 'dashboard', 'text' => 'Dashboard');
}

?>
<header id='main-header'>

	{% if navigation_links is defined %}
    <nav id='site-navigation'>
	    <ul id="main-navigation">
	    {% for link, data in navigation_links %}
	        <li class="navigation-button-container"><?php echo \ProfitPress\Components\Tag::anchor($data); ?></li>
	    {% endfor %}
	    </ul>
    </nav>
{% endif %}

</header>