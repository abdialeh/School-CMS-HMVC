<?php
$partial = $this->template->theme_locations();
include $partial[0].'smaihbatam/views/_partials/header.php';
include $partial[0].'smaihbatam/views/contents/'.$contents.'.php';
include $partial[0].'smaihbatam/views/_partials/footer.php';
?>