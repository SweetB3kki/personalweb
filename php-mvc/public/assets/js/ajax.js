'use strict';

const loginInput = document.querySelector('#registration-form input[name="login"]');
let loginScript;
window.loginChecked = function (xmlText) {
    const xml = new DOMParser().parseFromString(xmlText, 'application/xml');
    if (!loginInput || xml.querySelector('value').textContent !== loginInput.value.trim()) return;
    document.getElementById('login-status').textContent = xml.querySelector('available').textContent === 'true' ? 'Логин свободен.' : 'Логин занят или не заполнен.';
};
function checkLogin() {
    loginScript?.remove();
    loginScript = document.createElement('script');
    loginScript.src = '/auth/check?login=' + encodeURIComponent(loginInput.value.trim());
    loginScript.onerror = () => { document.getElementById('login-status').textContent = 'Не удалось проверить логин.'; };
    document.head.appendChild(loginScript);
}
loginInput?.addEventListener('blur', checkLogin);
document.getElementById('check-login')?.addEventListener('click', checkLogin);

document.querySelectorAll('.close-modal').forEach(button => button.addEventListener('click', () => button.closest('dialog').close()));
document.querySelectorAll('.add-comment').forEach(button => button.addEventListener('click', () => {
    const form = document.getElementById('comment-form');
    form.reset();
    form.elements.post_id.value = button.closest('[data-post-id]').dataset.postId;
    form.querySelector('.form-error').textContent = '';
    document.getElementById('comment-modal').showModal();
}));
document.getElementById('comment-form')?.addEventListener('submit', event => {
    event.preventDefault();
    const form = event.currentTarget;
    const request = new XMLHttpRequest();
    request.open('POST', '/comment/save');
    request.onload = () => {
        if (request.status !== 200) { form.querySelector('.form-error').textContent = request.responseText; return; }
        const comments = document.querySelector('[data-post-id="' + form.elements.post_id.value + '"] .comments');
        comments.insertAdjacentHTML('beforeend', request.responseText);
        document.getElementById('comment-modal').close();
    };
    request.onerror = () => { form.querySelector('.form-error').textContent = 'Ошибка соединения.'; };
    request.send(new FormData(form));
});

document.querySelectorAll('.edit-post').forEach(button => button.addEventListener('click', () => {
    const article = button.closest('[data-post-id]');
    const form = document.getElementById('edit-form');
    form.elements.id.value = article.dataset.postId;
    form.elements.title.value = article.querySelector('.post-title').textContent;
    form.elements.message.value = article.querySelector('.post-message').innerText;
    form.querySelector('.form-error').textContent = '';
    document.getElementById('edit-modal').showModal();
}));
document.getElementById('edit-form')?.addEventListener('submit', async event => {
    event.preventDefault();
    const form = event.currentTarget;
    try {
        const response = await fetch('/admin/blog/update', { method: 'POST', body: new FormData(form) });
        if (!response.headers.get('content-type')?.includes('application/json')) throw new Error('Сессия истекла. Войдите заново.');
        const result = await response.json();
        if (!response.ok) throw new Error(result.error);
        const article = document.querySelector('[data-post-id="' + result.id + '"]');
        article.querySelector('.post-title').textContent = result.title;
        article.querySelector('.post-message').textContent = result.message;
        article.querySelector('.post-message').style.whiteSpace = 'pre-wrap';
        document.getElementById('edit-modal').close();
    } catch (error) { form.querySelector('.form-error').textContent = error.message; }
});
