const myForm = document.forms.myForm;
const userName = myForm.elements.name;
const message = myForm.elements.message;
const submit = myForm.submit;

function addMessage(event) {
    event.preventDefault();
    
    const date = new Date();
    
    //Добавление сообщения
    myForm.insertAdjacentHTML('beforebegin', `
    <div class = 'container'>
        <div>
            <div>${userName.value}</div>
            <div id='date'>${date.toLocaleString('ru-RU')}</div>
        </div>
        <div id='user-message'>${message.value}</div>
    </div>`);

    userName.value = '';
    message.value = '';
}

myForm.addEventListener('submit', addMessage);
