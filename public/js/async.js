function promisePostRegister(form, out, url) {
    fetch(`/${url}`, {
        method: "POST",
        body: form,
    })
        .then(response => response.text())
        .then(response => {
            if (response == 'OK') {
                console.log(response);
                out.innerHTML = '<div class="alert alert-success" role="alert"><p>На вашу почту был отправлен код с подтверждением.<br>После подтверждения войдите в аккаунт.</p></div>';
                reset();
            } else {
                console.log(response);
                out.innerHTML = response;
            }
        })
}


function promisePostSignIn(form, out, url) {
    fetch(`/${url}`, {
        method: "POST",
        body: form,
    })
        .then(response => response.text())
        .then(response => {
            if (response == 'OK') {
                console.log(response);
                location.href = '/';
            } else {
                console.log(response);
                out.innerHTML = response;
            }
        })
}


function promisePostUpdPass(form, out, url) {
    fetch(`/${url}`, {
        method: "POST",
        body: form,
    })
        .then(response => response.text())
        .then(response => {

            out.innerHTML = response;
            reset();

        })
}
