"use strict"
document.addEventListener('DOMContentLoaded', () => {
    const AuthForm = document.getElementById('auth__form');
    AuthForm.addEventListener('submit', AuthFormSend);
    async function AuthFormSend(event)
    {
        event.preventDefault();
        let data = {};
        let error = formValidate(AuthForm);
        let formData = new FormData(AuthForm);
        formData.forEach((value, key)=>data[key] = value);
        let jsonData = JSON.stringify(data);
        if (error === 0)
        {   
            AuthForm.classList.add('_sending');
            let response = await fetch('/auth/auth',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                dataType: 'JSON',
                body: jsonData
            });
            if (response.ok) {
                console.log(response.text);
                AuthForm.innerHTML = '';
                AuthForm.reset();
                location.replace('/profile');
                AuthForm.classList.remove('_sending');
            }
            else {
                alert("Ошибка авторизации");
                AuthForm.classList.remove('_sending');
            }
        }
        else
        {
            alert('Поля заполнены некорректно');
        }
    }

    function formValidate(AuthForm)
    {
        let error = 0;
        let formReq = document.querySelectorAll('._req');
        for (let index = 0; index < formReq.length; index++) 
        {
            const input = formReq[index];
            formRemoveError(input);
            if (input.value === '') 
            {
                formAddError(input);
                error++; 
            }
        }
        return error;
    }
    
});

function formAddError(input)
{
    input.parentElement.classList.add('_error');
    input.classList.add('_error');
}
function formRemoveError(input)
{
    input.parentElement.classList.remove('_error');
    input.classList.remove('_error');
}
function emailTest(input)
{
    return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2, 8})+$/.test(input.value);
}