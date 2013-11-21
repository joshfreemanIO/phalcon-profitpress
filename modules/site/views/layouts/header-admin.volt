<?php
$site_brand = array('class' => 'navbar-brand', 'uri' => '', 'text' => 'ProfitPress');

if ($this->session->get('role') !== 'Guest') {
  $navigation_links[] = array('class' => 'navigation-button', 'uri' => 'dashboard', 'text' => 'Dashboard');
	$navigation_links[] = array('class' => 'navigation-button', 'uri' => 'logout', 'text' => 'Logout');
} else {
  $navigation_links[] = array('class' => 'navigation-button', 'uri' => 'dashboard', 'text' => 'Login');
}

?>
<nav id='site-navigation' class='navbar navbar-default' role='navigation'>
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <?php echo \ProfitPress\Components\Tag::anchor($site_brand); ?>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
    <?php foreach ($navigation_links as $link_array): ?>
      <li><?php echo \ProfitPress\Components\Tag::anchor($link_array); ?></li>
    <?php endforeach ?>
    </ul>
  </div>
</nav>