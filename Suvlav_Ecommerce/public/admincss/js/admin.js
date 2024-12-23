function previewImage(e, selectedFiles, imagesArray) {
   // const elemContainer = document.createElement('div');
   // elemContainer.setAttribute('class', 'item-images');
    const elemContainer = document.querySelector('#photo-upload__preview');
    for (let i = 0; i < selectedFiles.length; i++) {
      imagesArray.push(selectedFiles[i]);
      const imageContainer = document.createElement('div');
      imageContainer.setAttribute('class', 'item-image');
      const elem = document.createElement('img');
      elem.setAttribute('src', URL.createObjectURL(selectedFiles[i]));
      elem.setAttribute('class', 'item-photo__preview')
      const removeButton = document.createElement('button');
      removeButton.setAttribute('type', 'button');
      removeButton.classList.add('btn-delete', 'delete', 'btn', 'btn-primary', 'btn-sm');
      removeButton.dataset.filename = selectedFiles[i].name;
      const hiddenBtn = document.createElement('input');
      hiddenBtn.setAttribute('type', 'hidden');
      hiddenBtn.setAttribute('name', 'actual_images[]');
      hiddenBtn.setAttribute('value', selectedFiles[i].name);
      removeButton.innerHTML = '<span>&times;</span>'
      imageContainer.appendChild(elem);
      imageContainer.appendChild(hiddenBtn);
      imageContainer.appendChild(removeButton);
      elemContainer.appendChild(imageContainer);
    }
    return elemContainer;
  }
  let item_images = [];
  document.getElementById('photo-upload').addEventListener('change', (e) => {
    let selectedFiles = e.target.files;
    const photoPreviewContainer = document.querySelector('#photo-upload__preview');
    const elemContainer = previewImage(e, selectedFiles, item_images);
    photoPreviewContainer.appendChild(elemContainer);
  });
  
  document.getElementById('photo-upload__preview').addEventListener('click', (e) => {
    const tgt = e.target.closest('button');
    setTimeout(function doDelete() {          
    if (tgt.classList.contains('delete')) {
        tgt.closest('div').remove();
        const fileName = tgt.dataset.filename
        item_images = item_images.filter(img => img.name != fileName)
      } else if(tgt.classList.contains('delete_image')){
          tgt.closest('div').remove();
      }

    }, 1000); 
 
    
  })