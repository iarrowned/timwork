function postData (url = '', data = {}) {
    return fetch(url, {
        method: 'post',
        body: data
    })
        .then(response => response);
}
const formService = document.querySelector('#main-form');
setTimeout(() => {
    const forms = document.querySelectorAll('.my_form');
    forms.forEach((form) => {
        if (form) {
            const formInputs = form.querySelectorAll('input');
            const textarea = form.querySelector('textarea');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const $form = e.target;
                const $submitButton = $form.querySelector('button[type=submit]');

                if (true) {
                    const postUrl = $form.getAttribute('action');

                    const data = new FormData($form);

                    function ajaxSend () {
                        postData(postUrl, data).then(data => {
                            if (data.ok === false) {
                                console.log('error');
                                // error
                                if ($submitButton) {
                                    $submitButton.classList.remove('is-loading');
                                }
                                $form.classList.add('is-success');


                            } else {
                                // success
                                console.log('success');
                                if ($submitButton) {
                                    $submitButton.classList.remove('is-loading');
                                }
                                $form.classList.add('is-success');


                                [...formInputs].forEach(input => {
                                    if (input.type !== 'submit') {
                                        input.value = '';
                                    } else {
                                        input.value = 'Отправлено';
                                        input.style.backgroundColor = 'green';
                                    }
                                });
                                if (textarea) {
                                    textarea.value = '';
                                }

                            }


                        });
                    }
                    ajaxSend();

                } else {
                    // error
                }

                return false;
            });
        }
    })
}, 2000);