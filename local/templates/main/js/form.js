const form = document.querySelector('.my_form');
const formContainer = document.querySelector('.js-form-container');
function postData (url = '', data = {}) {
    return fetch(url, {
        method: 'post',
        body: data
    }).then(response => response.text());
}

form.addEventListener('submit', (e) => {
    e.preventDefault();
    let formData = new FormData;
    const inputs = form.querySelectorAll('input');
    const textarea = form.querySelector('textarea');
    inputs.forEach((i) => {
        formData.append(i.name, i.value);
    });
    formData.append(textarea.name, textarea.value);

    postData('', formData).then((resp) => {
        formContainer.innerHTML = resp;
    });
});
