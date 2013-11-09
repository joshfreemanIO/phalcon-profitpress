<?php
$navigation_links[] = array('class' => 'navigation-button', 'uri' => '', 'text' => 'Home');
$navigation_links[] = array('class' => 'navigation-button', 'uri' => 'blog/view', 'text' => 'Blog');

if ($this->session->get('authenticated') === true) {
	$navigation_links[] = array('class' => 'navigation-button', 'uri' => 'dashboard', 'text' => 'Dashboard');
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
    <a class="navbar-brand" href="#">Site Name</a>
  </div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
      <li><?php echo \ProfitPress\Components\Tag::anchor(array('class' => 'navigation-button', 'uri' => 'dashboard', 'text' => 'Dashboard')); ?></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li class="divider"></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
</nav>
