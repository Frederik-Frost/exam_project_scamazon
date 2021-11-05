<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index

//views
get('/', 'views/index.php');
get('/login', 'views/login.php');
get('/signup', 'views/signup.php');
get('/products', 'views/items.php');
get('/reset-password', 'views/reset-password.php');

//bridges
get('/logout', 'bridges/logout.php');
get('/validate-user', 'bridges/validate-user.php');

//api's
// post('/getit', 'api/get-items.php');
post('/userlogin', 'api/login-user.php');
post('/signup', 'api/signup.php');
post('/reset-password-request', 'api/reset-password-request.php');
post('/new-password', 'api/new-password.php');

//404
any('/404','views/404.php');