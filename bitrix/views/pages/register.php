<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/assets/js/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/script.js"></script>  
    <title>Регистрация</title>
</head>
<body>
    <!--Форма регистрации-->
    <div class="form">
        <div class="Autorization_form">
            <form action="/">
                <button type="submit" class="href_button">Авторизация</button>
            </form>
            <form action="#" id="registration__form" class="form_body">
                <h1 class="form_title">Регистрация</h1>
                <div class="form_item">
                    <label for="registration_login" class="form_label">Введите логин*:</label>
                    <input type="text" id="registration_login" name="username" class="form_input _req _username">
                    <small class="form-control"></small>
                </div>
                <div class="form_item">
                    <label for="registration_password" class="form_label">Введите пароль*:</label>
                    <input type="password" id="registration_Password" name="password" class="form_input _req _password">
                    <small class="form-control"></small>
                </div>
                <div class="form_item">
                    <label for="Confirm_Password" class="form_label">Подтвердите пароль*:</label>
                    <input type="password" id="confirm_Password" name="confirm_password" class="form_input _req _confirm_password">
                    <small class="form-control"></small>
                </div>
                <div class="form_item">
                    <label for="e-mail" class="form_label">Введите E-mail*:</label>
                    <input type="email" id="e-mail" name="email" class="form_input _req _email">
                    <small class="form-control"></small>
                </div>
                <div class="form_item">
                    <label for="name" class="form_label">Ваше Имя*:</label>
                    <input type="text" id="name" name="name" class="form_input _req _name">
                    <small class="form-control"></small>
                </div>
                <div class="form_item">
                    <button type="submit" id="registration_button" class="form_button">Зарегестрироваться</button>
                </div>
                
            </form> 
        </div>
    </div>
      
</body>
</html>