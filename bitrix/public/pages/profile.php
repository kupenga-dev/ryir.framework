<?php
if (!$_SESSION["user"]) {
    \Ryir\Core\Router::redirect('/');
}
?>
<?php
$appItem = \Ryir\Core\Application::getInstance();
$appItem->header();
?>

<div>
    <h1 class="profile">Hello, <?= $_SESSION['user']['name'] ?></h1>
</div>
<form action="/auth/logout" method="post">
    <button class="href_button _profile" type="submit">Logout</button>
</form>

<? $appItem->footer(); ?>