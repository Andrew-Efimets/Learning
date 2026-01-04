let selectedFiles = new DataTransfer();

document.addEventListener('change', function(e) {
    if (e.target && e.target.id === 'input_photo') {
        const inputPhoto = e.target;
        const newPreviewContainer = document.getElementById('new-preview-container');
        const files = Array.from(inputPhoto.files);

        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;

            selectedFiles.items.add(file);

            const reader = new FileReader();
            reader.onload = function(event) {
                const div = document.createElement('div');
                div.className = 'preview__item';
                div.innerHTML = `
                    <img src="${event.target.result}" class="preview__img" alt="Картинка">
                    <span class="preview__remove new-remove" data-name="${file.name}">&times;</span>
                `;
                if (newPreviewContainer) newPreviewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        });

        inputPhoto.files = selectedFiles.files;
    }
});

document.addEventListener('click', function(e) {
    if (e.target.classList.contains('new-remove')) {
        const fileName = e.target.dataset.name;
        const div = e.target.closest('.preview__item');
        const inputPhoto = document.getElementById('input_photo');

        const newDataTransfer = new DataTransfer();
        Array.from(selectedFiles.files)
            .filter(file => file.name !== fileName)
            .forEach(file => newDataTransfer.items.add(file));

        selectedFiles = newDataTransfer;
        if (inputPhoto) inputPhoto.files = selectedFiles.files;
        div.remove();
    }

    if (e.target.classList.contains('old-remove')) {
        const imageId = e.target.dataset.id;
        const div = e.target.closest('.preview__item');
        const checkbox = document.getElementById('delete_photo_' + imageId);

        if (checkbox) checkbox.checked = true;
        div.style.display = 'none';
    }
});
