<?php

use Cake\Utility\Hash;

if (!isset($params['escape']) || $params['escape'] !== false) {
      $message = h($message);
  }

  $msgErrors = '';
  
  if (isset($params['errors'])) {
    $msgErrors = $this->Html->nestedList(Hash::flatten($params['errors']));
  }
?>

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= $message ?> <small><?= $msgErrors ?></small>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
