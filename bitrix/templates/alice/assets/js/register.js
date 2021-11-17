"use strict"
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('register__form');
    form.addEventListener('submit', FormSend);
    async function FormSend(event) {
        event.preventDefault();
        let data = {};
        let error = formValidate(form);
        let formData = new FormData(form);
        formData.forEach((value, key) => data[key] = value);

        let jsonData = JSON.stringify(data);
        console.log(jsonData);
        if (error === 0) {
            form.classList.add('_sending');
            let response = await fetch('/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                dataType: 'JSON',
                body: jsonData

            });
            if (response.ok) {
                form.innerHTML = '';
                form.reset();
                form.classList.remove('_sending');
            }
            else {
                form.classList.remove('_sending');
            }
        }

    }

    function formValidate(form) {
        let error = 0;

        let username = document.querySelector('._username');
        let password = document.querySelector('._password');
        let confirm_password = document.querySelector('._confirn_password');
        let email = document.querySelector('._email');
        let name = document.querySelector('._name');

        if (username.value === '' || username.value.length < 6) {
            formAddError(username);
            error++;

        }
        if (password.value === '' || !(/(?=^.{6,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(password.value))) {
            formAddError(password);
            error++;
        }


        if (confirm_password.value === '' || confirm_password.value !== password.value) {
            formAddError(confirm_password);
            error++;
        }


        if (email.value === '' || !/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/.test(email.value)) {
            formAddError(email);
            error++;
        }

        if (name.value === '' || !/^[a-zA-Z]{2,2}$/.test(name.value)) {
            formAddError(name);
            error++;
        }
        return error;
    }
});

function formAddError(input) {
    input.parentElement.classList.add('_error');
    input.classList.add('_error');
}
function formRemoveError(input) {
    input.parentElement.classList.remove('_error');
    input.classList.remove('_error');
}
function emailTest(input) {
    return !/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2, 8})+$/.test(input.value);
}
