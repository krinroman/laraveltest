document.getElementById("button_add").addEventListener('click', () => {
    let inputValue = document.getElementById("input_add").value;
    if(!inputValue){ 
        return alert("Поле для ввода пустое");
    }
    let user = {
        name: 'John',
        surname: 'Smith',
        value: inputValue
      };
      
    fetch('/entry', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json;charset=utf-8',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify(user)
    }).then((response) => {
        console.log(response);
        response.json().then((data) => {
            console.log(data);
        });
    }).catch(() => console.log('ошибка')); 

});