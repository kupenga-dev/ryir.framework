"use strict"


document.addEventListener('DOMContentLoaded', () => {
    const RegistrationForm = document.getElementById('registration__form');
    RegistrationForm.addEventListener('submit', RegistrationFormSend);
    
    

    async function RegistrationFormSend(event)
    {
        event.preventDefault();
        let data = {};
        let error = formValidate(RegistrationForm);
        let formData = new FormData(RegistrationForm);
        formData.forEach((value, key)=>data[key] = value);
        
        let jsonData = JSON.stringify(data);
        console.log(jsonData);
        if(error === 0)
        {   
            RegistrationForm.classList.add('_sending');
            let response = await fetch('/auth/register',{
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                dataType: 'JSON',
                body: jsonData

            });
            if (response.ok) {
                RegistrationForm.innerHTML = '';
                RegistrationForm.reset();
                RegistrationForm.classList.remove('_sending');
                location.replace('/');
                return alert("регистрация прошла успешно");
            }
            else
            {
                RegistrationForm.classList.remove('_sending');
                return alert('Поля заполнены некорректно');
                
            }
        }
        
    }

    function formValidate(RegistrationForm)
    {
        let error = 0;
        console.log(error);
        // let patternForPassword = !/^[a-zA-Z0-9]{6, 16}+$/;
        // let patternForName = /^[a-zA-Z]{1,2}$/ 
        // let patterForEmail = !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2, 8})+$/;

        let username = document.querySelector('#registration_login');
        let password = document.querySelector('#registration_Password');
        let confirm_password = document.querySelector('#confirm_Password');
        let email = document.querySelector('#e-mail');
        let name = document.querySelector('#name');
        console.log(email.value);
        console.log(email.value.length);
        console.log(!/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/.test(email.value));

        if(username.value === '' || username.value.length < 6)
        {
            formAddError(username);
            error++;
            
        } 
        if(password.value === '' || !(/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(password.value)))
        {
            formAddError(password);
            error++;
        }
        
        
        if(confirm_password.value === '' || confirm_password.value !== password.value)
        {
            formAddError(confirm_password);
            error++;
        }
        
        
        if(email.value === '' || !/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/.test(email.value))
        {
            formAddError(email);
            error++;
        }
        
        if(name.value === '' || !/^[a-zA-Z]{2,2}$/ .test(name.value))
        {
            formAddError(name);
            error++;
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
