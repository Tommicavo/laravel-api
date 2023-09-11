const placeholder = 'http://127.0.0.1:8000/storage/noFile.png';
const chooseUrlField = document.getElementById('image');
const imgField = document.getElementById('imagePreview');

chooseUrlField.addEventListener('change', () => {
    if (chooseUrlField.files[0])
    {
        const file = chooseUrlField.files[0];
        const blobUrl = URL.createObjectURL(file);
        imgField.src = blobUrl;
    } else {
        imgField.src = placeholder;
    }
});

window.addEventListener('beforeunload', () => {
    if (blobUrl) URL.revokeObjectURL(blobUrl);
});

// const fakeImageField = document.getElementById('fakeImageField');
// const chooseFileBtn = document.getElementById('chooseFileBtn');

// chooseFileBtn.addEventListener('click', () => {
//     fakeImageField.classList.add('d-none');
//     chooseUrlField.classList.remove('d-none');
// });