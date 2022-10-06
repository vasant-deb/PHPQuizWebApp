<?php
/**
* Routes configuration
*
* In this file, you set up routes to your controllers and their actions.
* Routes are very important mechanism that allows you to freely connect
* different urls to chosen controllers and their actions (functions).
*
* PHP 5
*
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @package       app.Config
* @since         CakePHP(tm) v 0.2.9
* @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
*/
Router::connect('/', ['controller' => 'pages', 'action' => 'index']);

Router::connect('/reward.html', ['controller' => 'rewards', 'action' => 'index']);
Router::connect('/quiz.html', ['controller' => 'pages', 'action' => 'quiz']);
Router::connect('/tutorials/:slug', ['controller' => 'blogs', 'action' => 'view'], ['pass' => ['slug']]);
Router::connect('/quiz/:slug', ['controller' => 'quizes', 'action' => 'view'], ['pass' => ['slug']]);

Router::connect('/quiz-results.html', ['controller' => 'quizes', 'action' => 'index']);

Router::connect('/tutorials.html', ['controller' => 'pages', 'action' => 'tutorial']);
Router::connect('/category/:slug.html', ['controller' => 'categories', 'action' => 'categorypage'], ['pass' => ['slug']]);

Router::connect('/category/:category/:slug.html', ['controller' => 'categories', 'action' => 'view'], ['pass' => ['category','slug']]);


Router::connect('/career.html', ['controller' => 'pages', 'action' => 'career']);
Router::connect('/about.html', ['controller' => 'pages', 'action' => 'about']);

Router::connect('/terms', ['controller' => 'pages', 'action' => 'terms']); 
Router::connect('/order-success.html', ['controller' => 'orders', 'action' => 'OrderSuccess']);
Router::connect('/thankyou.html', ['controller' => 'orders', 'action' => 'thankyou']);

Router::connect('/company-profile.html', ['controller' => 'pages', 'action' => 'CompanyProfile']);
Router::connect('/our-team.html', ['controller' => 'pages', 'action' => 'OurTeam']);

Router::connect('/blog.html', ['controller' => 'blogs', 'action' => 'index']);
Router::connect('/faq.html', ['controller' => 'pages', 'action' => 'faq']);

Router::connect('/privacy-policy.html', ['controller' => 'pages', 'action' => 'policy']);
Router::connect('/refund-and-cancellation.html', ['controller' => 'pages', 'action' => 'refund']);
Router::connect('/tournament-rules.html', ['controller' => 'pages', 'action' => 'rules']);
Router::connect('/sitemap.html', ['controller' => 'pages', 'action' => 'sitemap']); 
Router::connect('/about', ['controller' => 'pages', 'action' => 'about']);
Router::connect('/contact-us.html', ['controller' => 'pages', 'action' => 'contact']);		

Router::connect('/products/search', ['controller' => 'products', 'action' => 'search']);
Router::connect('/products/add', ['controller' => 'products', 'action' => 'add', 'admin' => true]);
Router::connect('/sitepages/index', ['controller' => 'sitepages', 'action' => 'index', 'admin' => true]);
Router::connect('/compare/compareadd/:slug', ['controller' => 'products', 'action' => 'compareadd'], ['pass' => ['slug']]);
Router::connect('/compare/compareremove/:slug', ['controller' => 'products', 'action' => 'compareremove'], ['pass' => ['slug']]);
Router::connect('/compare/compareremoveall', ['controller' => 'products', 'action' => 'compareremoveall']);
Router::connect('/compareproducts', ['controller' => 'categories', 'action' => 'compareproducts']);
Router::connect('/shop/add', ['controller' => 'shop', 'action' => 'add']);


Router::connect('/:slug.html', ['controller' => 'products', 'action' => 'view'], ['pass' => ['slug']]);
Router::connect('/products/:category/:slug', ['controller' => 'products', 'action' => 'view'], ['pass' => ['category','slug']]);
Router::connect('/admin', ['controller' => 'users', 'action' => 'dashboard', 'admin' => true]);
Router::connect('/customer/login', ['controller' => 'users', 'action' => 'login','customer' => true]);
Router::connect('/customer/forgot-password', ['controller' => 'users', 'action' => 'forgot_password','customer' => true]);
Router::connect('/customer/register', ['controller' => 'users', 'action' => 'register','customer' => true]);
Router::connect('/customer/logout', ['controller' => 'users', 'action' => 'logout','customer' => true]);
Router::connect('/customer/myaccount', ['controller' => 'users', 'action' => 'myaccount','customer' => true]);
Router::connect('/customer/addressbook', ['controller' => 'users', 'action' => 'addressbook','customer' => true]);
Router::connect('/customer/changepassword', ['controller' => 'users', 'action' => 'changepassword','customer' => true]);
Router::connect('/customer/orderhistory', ['controller' => 'users', 'action' => 'orderhistory','customer' => true]);
Router::connect('/', ['controller' => 'users', 'action' => 'dashboard', 'admin' => true]); 
Router::connect('/customer/orderdetails/:slug', array('controller' => 'users', 'action' => 'orderdetails','customer' => true), array('pass' => array('slug')));
Router::connect('/:slug', ['controller' => 'locations', 'action' => 'view'], ['pass' => ['slug']]);

/**
* ...and connect the rest of 'Pages' controller's urls.
*/
// Router::connect('/pages/*', ['controller' => 'pages', 'action' => 'display']);
/**
* Load all plugin routes.  See the CakePlugin documentation on
* how to customize the loading of plugin routes.
*/
CakePlugin::routes();
/**
* Load the CakePHP default routes. Remove this if you do not want to use
* the built-in default routes.
*/
require CAKE . 'Config' . DS . 'routes.php';