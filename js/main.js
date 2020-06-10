var form = document.querySelector('#register-form');
var imageUploaded = document.getElementById('image');

form.addEventListener('submit', function (event) {
    checkFormValid(form, event);
});

imageUploaded.onchange = function () {
    let filename = imageUploaded;
    let dest = document.getElementById('image-uploaded');

    dest.textContent = filename.files[0].name;
}


function checkFormValid(form, event) {
    let nick = form.querySelector('#nick');
    let mail = form.querySelector("#mail");
    let phone = form.querySelector('#phone');
    let firstname = form.querySelector('#firstname');
    let lastname = form.querySelector('#lastname');
    let image = form.querySelector('#image');

    let nickCondition = form.querySelector('#valid-nick');
    let nickForbidden = ['admin', 'root', 'moderator'];

    let mailCondition = form.querySelector('#valid-mail');
    let phoneCondition = form.querySelector('#valid-phone');
    let firstnameCondition = form.querySelector('#valid-firstname');
    let lastnameCondition = form.querySelector('#valid-lastname');
    let imageTypeCondition = form.querySelector('#valid-image-type');
    let imageSizeCondition = form.querySelector('#valid-image-size');


    if (!(nick.value.match('[a-zA-Z0-9]')) || nickForbidden.includes(nick.value)
        || nick.value.match('[!@#$%^&*()]')) {
        nickCondition.style.display = 'block';
        event.preventDefault();
    }
    else {
        nickCondition.style.display = 'none';
    }

    if (!(mail.value.match('(.+)\@[a-z]\.[a-z]'))){
        mailCondition.style.display = 'block';
        event.preventDefault();
    }
    else {
        mailCondition.style.display = 'none';
    }

    if (!(phone.value.match('[\+\d\(\)\-]'))){
        phoneCondition.style.display = 'block';
        event.preventDefault();
    }
    else {
        phoneCondition.style.display = 'none';
    }

    if (firstname.value == '') {
        firstnameCondition.style.display = 'none';
    }
    else if (!(firstname.value.match('[а-яА-Яa-zA-Z]')) || firstname.value.match('[!@#$%^&*()]')){
        firstnameCondition.style.display = 'block';
        event.preventDefault();
    }
    else {
        firstnameCondition.style.display = 'none';
    }

    if (lastname.value == '') {
        lastnameCondition.style.display = 'none';
    }
    else if (!(lastname.value.match('[а-яА-Яa-zA-Z]')) || lastname.value.match('[!@#$%^&*()]')){
        lastnameCondition.style.display = 'block';
        event.preventDefault();
    }
    else {
        lastnameCondition.style.display = 'none';
    }

    if (image.files.length != 0){
        if (image.files.length > 5242880){  // 5MB file size
            imageSizeCondition.style.display = 'block';
        }
        else {
            imageSizeCondition.style.display = 'none';
        }

        if (image.files[0].name.match('[\d\S\-\_]+\.[egjnp]+')) { // jpg, jpeg, png concurrency
            imageTypeCondition.style.display = 'block';
            event.preventDefault();
        }
        else {
            imageTypeCondition.style.display = 'none';
        }
    }
}