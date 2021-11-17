<?php return array (
  'db' => 
  array (
    'login' => 'gregreg',
    'password' => 'ihgjoref',
  ),
  'routes' => 
  array (
    0 => 
    array (
      'pattern' => '~^/$~',
      'params' => 
      array (
        'path' => 'home.php',
        'method' => 'GET',
        'controller' => '\\App\\Controllers\\PublicPageController',
      ),
    ),
    1 => 
    array (
      'pattern' => '~login~',
      'params' => 
      array (
        'path' => 'login.php',
        'method' => 'GET',
        'controller' => '\\App\\Controllers\\PublicPageController',
      ),
    ),
    2 => 
    array (
      'pattern' => '~^/registration$~',
      'params' => 
      array (
        'path' => 'register.php',
        'method' => 'GET',
        'controller' => '\\App\\Controllers\\PublicPageController',
      ),
    ),
    3 => 
    array (
      'pattern' => '#/profile/(?P<id>\\d+)$#i',
      'params' => 
      array (
        'path' => 'profile.php',
        'method' => 'GET',
        'controller' => '\\App\\Controllers\\PublicPageController',
      ),
    ),
    4 => 
    array (
      'pattern' => '#/profile#i',
      'params' => 
      array (
        'path' => 'profile.php',
        'method' => 'GET',
        'controller' => '\\App\\Controllers\\PublicPageController',
      ),
    ),
    5 => 
    array (
      'pattern' => '~^/auth/register$~',
      'params' => 
      array (
        'method' => 'POST',
        'controller' => '\\App\\Controllers\\AuthController',
        'class' => '\\App\\Services\\Auth',
        'action' => 'register',
      ),
    ),
    6 => 
    array (
      'pattern' => '~^/auth/auth$~',
      'params' => 
      array (
        'method' => 'POST',
        'controller' => '\\App\\Controllers\\AuthController',
        'class' => '\\App\\Services\\Auth',
        'action' => 'auth',
      ),
    ),
    7 => 
    array (
      'pattern' => '~^/auth/logout$~',
      'params' => 
      array (
        'method' => 'POST',
        'controller' => '\\App\\Controllers\\AuthController',
        'class' => '\\App\\Services\\Auth',
        'action' => 'logout',
      ),
    ),
  ),
  'template_id' => 'alice',
  'saults' => 
  array (
    'test23' => 'eac28471b78c2c8b0efbabce1d461961',
    'test33' => '8ba2c912f6012aa579e84bc918573434',
  ),
);