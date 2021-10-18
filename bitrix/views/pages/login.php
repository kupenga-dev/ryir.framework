<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/auth.js"></script>
    <title>Авторизация</title>
</head>
<body>
    <!--Форма авторизации-->
    <div class="form">
        <div class="Autorization_form">
            <form action="/registration">
                <button type="submit" class="href_button">Регистрация</button>
            </form>
            <form id="auth__form" class="form_body">
                <h1 class="form_title">Вход</h1>
                <div class="form_item">
                    <label for="authorization_login" class="form_label">Введите логин*:</label>
                    <input type="text" id="authorization_login" name="username" class="form_input _req">
                    <p class="msg_login">Неверный логин</p>
                </div>
                <div class="form_item">
                    <label for="authorization_password" class="form_label">Введите пароль*:</label>
                    <input type="password" id="authorization_password" name="password" class="form_input _req">
                    <p class="msg_password">Неверный пароль</p>
                </div>
                <div class="form_item">
                    <button type="submit" id="authorization_button" class="form_button">Войти</button>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>