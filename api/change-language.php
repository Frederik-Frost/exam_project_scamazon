<?php
$_SESSION['application_language'] = $_POST['language'];
echo json_encode($_POST['language']);
exit();

