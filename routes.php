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

//views with $lang params

// get('/$lang', 'views/index.php');
// // get('/login/$lang', 'views/login.php');
// get('/signup/$lang', 'views/signup.php');
// get('/products/$lang', 'views/items.php');
// get('/reset-password/$lang', 'views/reset-password.php');

//bridges
get('/logout', 'bridges/logout.php');
get('/validate-user', 'bridges/validate-user.php');

//api's
get('/delete-product', 'api/delete-item.php');
post('/get-affiliate-products', 'api/tsv-parser.php');
post('/getproducts', 'api/get-items.php');
post('/userlogin', 'api/login-user.php');
post('/signup', 'api/signup.php');
post('/reset-password-request', 'api/reset-password-request.php');
post('/new-password', 'api/new-password.php');
post('/uploadproduct', 'api/upload-item.php');

//404
any('/404','views/404.php');