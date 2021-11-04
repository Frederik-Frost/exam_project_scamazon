<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');

get('/login', 'views/login.php');

get('/signup', 'views/signup.php');

get('/products', 'views/items.php');
get('/logout', 'bridges/logout.php');


post('/getit', 'api/get-items.php');
post('/userlogin', 'api/login-user.php');


any('/404','views/404.php');