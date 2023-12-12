<?php
require_once('helper.php');
// Redirect to welcome page
header("Location: ".BASE_URL, true, 403); // Forbidden
exit;