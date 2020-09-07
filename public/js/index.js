//Register
const formElem = document.querySelector('#formElem');
const outReg = document.querySelector('#outAlert');
const inputValue = document.querySelectorAll('.reset');
const checkInput = document.querySelector('#exampleCheckRegister');

formElem.addEventListener('submit', function (e) {
    e.preventDefault();
    let form = new FormData(this)
    promisePostRegister(form, outReg, 'register')
});

function redirect() {
    location.href = '/'
}

function reset() {
    if (checkInput != null || checkInput != undefined) checkInput.checked = false;
    inputValue.forEach(element => {
        element.value = '';
    });
}


//Login
const formSignIn = document.querySelector('#formSignIn');
const outSignIn = document.querySelector('#outAlertSignIn');

if (formSignIn != null) {
    formSignIn.addEventListener('submit', function (e) {
        e.preventDefault();
        let formSign = new FormData(this)
        promisePostSignIn(formSign, outSignIn, 'login')
    });
}


//Login Full Window 
const formSignInFull = document.querySelector('#formSignInFull');
const outSignInFull = document.querySelector('#outAlertFull');

if (formSignInFull != null) {
    formSignInFull.addEventListener('submit', function (e) {
        e.preventDefault();
        let formFull = new FormData(this)
        promisePostSignIn(formFull, outSignInFull, 'login')
    });
}

//Update Password 
const formUpdPass = document.querySelector('#formUpdatePass');
const outUpdPass = document.querySelector('#outAlertUpdatePassword');

if (formUpdPass != null) {
    formUpdPass.addEventListener('submit', function (e) {
        e.preventDefault();
        let formFull = new FormData(this)
        promisePostUpdPass(formFull, outUpdPass, 'password-uploads')
    });
}

// Modal alert delete

if (document.querySelector('[data-btn]')) {
    document.addEventListener('click', e => {
        const btnType = e.target.dataset.btn;
        if (btnType === 'delete') {
            const href = e.target.dataset.href;
            e.preventDefault();
            $.confirm({
                title: "Внимание!",
                content: `<p>Вы уверены что хотите удалить?</p>`
            }).then(() => {
                location.href = href;
            }).catch(() => {
            })
        }
    })
}




