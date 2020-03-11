document.getElementById("download_image_button").addEventListener("click",function() {
    document.getElementById("switch_image").click();
});

document.getElementById("switch_image").addEventListener("change",function(event) {
    if(!this.files || this.files.length < 1){
        alert("Вы не выбрали файл для отправки");
        return;
    }

    var formData = new FormData();
    formData.append('image', this.files[0]);
      
    fetch('/image/upload', {
    method: 'POST',
    body: new FormData(document.getElementById("upload_form"))
    }).then((response) => {
        if(response.status !== 200){
            alert("Не Загрузить изображение.\nПроизошла ошибка (Код:" + response.status + ").");
            throw new Error();
        }
        response.text().then((data) => {
            console.log(data);
            if(data !== "ok"){  
                return alert("Не удалось загрузить изображение." + data);
            }
            location.reload();
        });
    }).catch(() => console.log('ошибка'));
});