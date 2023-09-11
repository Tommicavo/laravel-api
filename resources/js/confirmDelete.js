const formDelete = document.querySelectorAll('.formDelete');
const modal = document.getElementById('modalContent');
const confirmDeleteBtn = document.getElementById('confirmBtn');

let activeForm = null;

formDelete.forEach(form => {
    form.addEventListener('submit', event => {
        event.preventDefault();
        const title = form.dataset.name;
        console.log(title);

        let question;

        if (form.classList.contains('trashProject'))
        {
            question = `Do you want to move '${title}' project into Trash Can?`;
        } else if (form.classList.contains('eraseProject'))
        {
            question = `Do you really want to erase '${title}' project?\nThis action will be irreversible!`;
        } else if (form.classList.contains('eraseAllProjects'))
        {
            question = 'Do you really want to erase all these projects?\nThis action will be irreversible!';
        } else if (form.classList.contains('trashType'))
        {
            question = `Do you really want to delete ${title} type?\nThis action will be irreversible!`;
        } else if (form.classList.contains('trashTechnology'))
        {
            question = `Do you really want to delete ${title} technology?\nThis action will be irreversible!`;
        }

        modal.innerText = question;

        activeForm = form;
    });
});

confirmDeleteBtn.addEventListener('click', () => {
    if (activeForm) activeForm.submit();
});

modal.addEventListener('hidden-bs-modal', () => {
    activeForm = null;
});
