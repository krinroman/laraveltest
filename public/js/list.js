document.getElementById("button_add").addEventListener('click', () => {
    let inputValue = document.getElementById("input_add").value;
    if(!inputValue){ 
        return alert("Поле для ввода пустое");
    }
    let data = {
        value: inputValue
    };
      
    fetch('/entry', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json;charset=utf-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(data)
    }).then((response) => {
        if(response.status !== 200){
            alert("Не удалось добавить запись.\nПроизошла ошибка (Код:" + response.status + ").");
            throw new Error();
        }
        response.text().then((data) => {
            console.log(data);
            if(data !== "ok"){
                return alert("Не удалось добавить запись" + data);
            }
            location.reload();
        });
    }).catch(() => console.log('ошибка')); 

});

document.getElementById("list").addEventListener('click', (event) => {
    let element = event.target;
    if(!element.name) return;

    if(element.name === "edit_button"){
        let id = element.getAttribute("data-id");
        let editElement = document.getElementById("entry_"+id);
        editElement.classList.remove("show-entry");
        editElement.classList.add("edit-entry");
    }

    if(element.name === "close_button"){
        let id = element.getAttribute("data-id");
        let editElement = document.getElementById("entry_"+id);
        editElement.classList.remove("edit-entry");
        editElement.classList.add("show-entry");
        editElement.querySelector("input").value = editElement.querySelector("span[name=value]").textContent;
    }

    if(element.name === "save_button"){
        let id = element.getAttribute("data-id");
        let editElement = document.getElementById("entry_"+id);
        let value = editElement.querySelector("input").value;
        if(value.length < 1){
            return alert("Значение не может быть пустым");
        }
        let data = {
            id: id,
            value: value
        };
          
        fetch('/entry', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
        }).then((response) => {
            if(response.status !== 200){
                alert("Не удалось изменить запись.\nПроизошла ошибка (Код:" + response.status + ").");
                throw new Error();
            }
            response.text().then((data) => {
                console.log(data);
                if(data !== "ok"){
                    return alert("Не удалось изменить запись" + data);
                }
                location.reload();
            });
        }).catch(() => console.log('ошибка')); 
    }

    if(element.name === "del_button"){
        let id = element.getAttribute("data-id");
        let data = {
            id: id
        };
          
        fetch('/entry', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json;charset=utf-8',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
        }).then((response) => {
            if(response.status !== 200){
                alert("Не удалось удалить запись.\nПроизошла ошибка (Код:" + response.status + ").");
                throw new Error();
            }
            response.text().then((data) => {
                console.log(data);
                if(data !== "ok"){
                    return alert("Не удалось удалить запись" + data);
                }
                document.getElementById("entry_"+id).remove();
            });
        }).catch(() => console.log('ошибка')); 
    }
});

function getIndexCheckedRadioButton(){
    let rad=document.getElementsByName('sort');
    for (let i=0;i<rad.length; i++) {
        if (rad[i].checked) {
            return i;
        }
    }
}

document.getElementById("radio_box_block").addEventListener("click", function(event){
    if(event.target.type == "radio"){
        let querySort;
        let indexSort = getIndexCheckedRadioButton();
        if(indexSort >= 2) querySort="sortField=value";
        else querySort="sortField=id";
        if(indexSort % 2 == 0) querySort += "&sortOrder=asc";
        else querySort += "&sortOrder=desc"
        location.replace("http://localhost:8000/list?"+querySort);
    }
});