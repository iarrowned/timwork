const form = document.querySelector('.my_form');
const formContainer = document.querySelector('.js-form-container');
function postData (url = '', data = {}) {
    return fetch(url, {
        method: 'post',
        body: data
    }).then(response => response.text());
}

if (form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        let formData = new FormData;
        const inputs = form.querySelectorAll('input');
        const select = form.querySelectorAll('select');
        select.forEach((i) => {
            formData.append(i.name, i.value);
        });
        const textarea = form.querySelector('textarea');
        inputs.forEach((i) => {
            formData.append(i.name, i.value);
        });
        formData.append(textarea.name, textarea.value);
        formData.append("action", "new");

        postData('/ajax/actions.php', formData).then((resp) => {
            const successBlock = document.querySelector('.success-from p');
            if (JSON.parse(resp).success === true) {
                form.style.display = "none";
                successBlock.innerHTML = "Ваша заявка успешно отправлена.";
                successBlock.parentNode.style.display = "block";
            } else {
                successBlock.innerHTML = "Во время исполнения запроса возникла ошибка.";
                successBlock.parentNode.style.display = "block";
                successBlock.parentNode.style.color = "red";
            }
        });
    });
}


const closeBtn = document.querySelectorAll('.close-task__btn');

if (closeBtn) {
    closeBtn.forEach((i) => {
        i.addEventListener('click', (e) => {

            const taskId = e.target.dataset.id;
            postData('', {
                action: 'close',
                id: taskId
            }).then((r) => {
                console.log(r);
                document.querySelector('.task-list').innerHTML = r;
            });
        });
    });
}

const saveTaskBtn = document.querySelectorAll('.save-task__btn');

if (saveTaskBtn) {
    saveTaskBtn.forEach((i) => {
        i.addEventListener('click', (e) => {
            e.preventDefault();
            const currentRow = e.target.parentNode.parentNode.parentNode;
            const taskId = currentRow.querySelector('.task-id').innerHTML;
            const workerId = currentRow.querySelector('select[name="worker"]').value;
            const statusId = currentRow.querySelector('select[name="status"]').value;
            const action = 'update';
            let data = new FormData;
            data.append('task_id', taskId);
            data.append('worker_id', workerId);
            data.append('status_id', statusId);
            data.append('action', action);
            postData('/ajax/actions.php', data).then((response) => {
                location.reload();
            });
        });
    });
}


const registerForm = document.querySelector('.form-register');

if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        let formData = new FormData(e.target);
        postData('/ajax/actions.php', formData)
            .then((resp) => {
                const successBlock = document.querySelector('.success-from p');
                if (JSON.parse(resp).success === true) {
                    registerForm.style.display = "none";
                    successBlock.innerHTML = "Ваша заявка успешно отправлена.";
                    successBlock.parentNode.style.display = "block";
                } else {
                    successBlock.innerHTML = "Во время исполнения запроса возникла ошибка.";
                    successBlock.parentNode.style.display = "block";
                    successBlock.parentNode.style.color = "red";
                }
        });
    });
}

const form1 = document.querySelector('.comment-form');
if (form1) {
    form1.addEventListener('submit', (e) => {
        e.preventDefault();
        let formData = new FormData;
        formData.append('USER_ID', form1.querySelector('input[name="USER_ID"]').value);
        formData.append('TASK_ID', form1.querySelector('input[name="TASK_ID"]').value);
        formData.append('MESSAGE', form1.querySelector('textarea[name="UF_MESSAGE"]').value);
        formData.append("action", "add_comment");

        postData('/ajax/actions.php', formData).then((resp) => {
            window.location.reload();
        });
    });
}
const dels = document.querySelectorAll('.delete-comment');
if (dels.length) {
    dels.forEach(i => {
        i.addEventListener('click', (e) => {
            e.preventDefault();
            let formData = new FormData;
            formData.append('ID', e.target.dataset.id);
            formData.append("action", "delete_comment");

            postData('/ajax/actions.php', formData).then((resp) => {
                window.location.reload();
            });
        });
    });
}
