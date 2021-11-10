"use strict"
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form');
    form.addEventListener('submit', FormSend);
    async function FormSend(event)
    {
        event.preventDefault();
        let data = {};
        let error = formValidate(form);
        let formData = new FormData(form);
        formData.forEach((value, key)=>data[key] = value);
        let jsonData = JSON.stringify(data);
        if (error === 0)
        {   
            form.classList.add('_sending');
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
                form.innerHTML = '';
                form.reset();
                // location.replace('/profile');
                form.classList.remove('_sending');
            }
            else {
                alert("Ошибка авторизации");
                form.classList.remove('_sending');
            }
        }
        else
        {
            alert('Поля заполнены некорректно');
        }
    }

    function formValidate(form)
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
