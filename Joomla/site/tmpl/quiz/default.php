<?php defined('_JEXEC') or die; ?>
<div class="com-helloworld-hello">
  <h1>Hello (Site)</h1>
  <p><?php echo htmlspecialchars($this->message ?? ''); ?></p>
</div>