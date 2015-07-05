<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$partial = $this->template->theme_locations();
include $partial[0].'admin/views/_partials/header.php';
include $partial[0].'admin/views/contents/'.$content.'.php';
include $partial[0].'admin/views/_partials/footer.php';