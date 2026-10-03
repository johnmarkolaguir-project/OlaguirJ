const flashMessages = document.querySelectorAll('[data-flash]');

flashMessages.forEach((message) => {
    window.setTimeout(() => {
        message.classList.add('opacity-0');

        window.setTimeout(() => message.remove(), 700);
    }, 5000);
});