<?php if ($this->session->get('authenticated') === true): ?>
<header class='admin'>

</header>
<?php else: ?>
<header class='non-admin'>

</header>
<?php endif; ?>