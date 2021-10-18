myForm = document.forms.myForm;

function styleText(event) {
    event.preventDefault();

    //Удаление предыдущего результата
    while (myForm.nextElementSibling.matches('div')) {
        myForm.nextElementSibling.remove();
    }

    //Получение значений
    const text = myForm.text.value;
    let textAlign = '';
    let fontStyle = '';
    let textDecoration = '';
    let fontWeight = '';

    for (key of myForm.textAlign.elements) {
        if (key.checked) {
            textAlign = key.value;
        }
    }

    if (myForm.elements.bold.checked) {
        fontWeight = 'bold';
    }

    if (myForm.elements.underline.checked) {
        textDecoration = 'underline';
    }

    if (myForm.elements.italics.checked) {
        fontStyle = 'italic';
    }

    //Вывод рузультата
    myForm.insertAdjacentHTML('afterend', 
    `<div class="result" style="text-align: ${textAlign}; font-weight: ${fontWeight}; text-decoration: ${textDecoration}; font-style: ${fontStyle};">${text}</div>`);

}

//myForm.submit.addEventListener('click', styleText);
myForm.addEventListener('submit', styleText);
