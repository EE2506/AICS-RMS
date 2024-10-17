import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.alert .btn-close').forEach(function (button) {
        button.addEventListener('click', function () {
            let alert = button.closest('.alert');
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 150); // Optionally remove the alert from DOM after fade-out
        });
    });
});