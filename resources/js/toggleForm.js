const toggleForms = document.querySelectorAll('.toggleForm');

toggleForms.forEach(form => {
    form.addEventListener('click', () => {
        form.submit();
    });
});
