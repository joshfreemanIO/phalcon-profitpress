<?php if ($this->session->get('role') !== 'Guest'): ?>
<?php
  $site_brand = array('class' => 'navbar-brand', 'uri' => '', 'text' => 'CRMcake');

  $navigation_links[] = array('class' => 'navigation-button', 'uri' => 'dashboard', 'text' => 'Dashboard');

  $navigation_links[] = array('class' => 'navigation-button', 'uri' => 'logout', 'text' => 'Logout');

?>

<nav id='site-navigation' class='navbar navbar-default' role='navigation'>
  <div class="navbar-header">
    <?php echo \ProfitPress\Components\Tag::anchor($site_brand); ?>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav navbar-right">
    <?php foreach ($navigation_links as $link_array): ?>
      <li><?php echo \ProfitPress\Components\Tag::anchor($link_array); ?></li>
    <?php endforeach ?>
    </ul>
  </div>
</nav>
<?php endif ?>