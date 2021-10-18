const addColorForm = document.forms["add-color"];
const colorName = addColorForm.color;
const colorCode = addColorForm.code;
const colorType = addColorForm.type;
const colorList = addColorForm.nextElementSibling.nextElementSibling.lastElementChild;
const getSaveColors = document.getElementById('get-colors');
const deleteSaveColors = document.getElementById('delete-colors');
let massageColorName = colorName.previousElementSibling.lastElementChild;
let massageColorCode = colorCode.previousElementSibling.lastElementChild;
let arrColors = [];
let backgroundColor;

// РВ для названия цвета
const regexpColorName = /^[a-z]+$/i;


// На паре рассмативали другие РВ, а у меня получилось по другому, работает вроде корректно
// РВ для RGB
const regexpRGB = /^((([0-9]{1,2})|(1[0-9]{2})|(2(([0-4][0-9])|(5[0-5]))))([-., ] ?)){2}(([0-9]{1,2})|(1[0-9]{2})|(2(([0-4][0-9])|(5[0-5]))))$/;

// РВ для RGBA
const regexpRGBA = /^((([0-9]{1,2})|(1[0-9]{2})|(2(([0-4][0-9])|(5[0-5]))))([\.])){2}(([0-9]{1,2})|(1[0-9]{2})|(2(([0-4][0-9])|(5[0-5])))) ((0\.[0-9])|1)$/;

// РВ для HEX
const regexpHEX = /^#((\p{Hex_Digit}){3}|(\p{Hex_Digit}){6})\b/ui;


addColorForm.addEventListener('submit', function(event) {

    let flag = true;

    event.preventDefault();

    // Проверка корректности названия
    if (!regexpColorName.test(colorName.value)) {
        massageColorName.textContent = 'Color can only contain letters';
        flag = false;
    } else {
        massageColorName.textContent = '';
    }

    // Проверка введенного кода дря RGB
    if (colorType.value == 'RGB') {
        if (!regexpRGB.test(colorCode.value)) {
            massageColorCode.textContent = 'RGB code must match the pattern [0-255],[0-255],[0-255]';
            flag = false;
        } else {
            // Замена резделительных символов 
            colorCode.value = colorCode.value.replace(/[-\.]|(\b )/g, ', ');

            // Преобразование для style
            backgroundColor = `rgb(${colorCode.value})`;
            massageColorCode.textContent = '';
        }
    }

    // Проверка введенного кода дря RGBA
    if (colorType.value == 'RGBA') {
        if (!regexpRGBA.test(colorCode.value)) {
            massageColorCode.textContent = 'RGBA code must match the pattern [0-255].[0-255].[0-255] 0-1';
            flag = false;
        } else {
            backgroundColor = `rgba(${colorCode.value})`;
            massageColorCode.textContent = '';
        }
    }

    // Проверка введенного кода дря HEX
    if (colorType.value == 'HEX') {
        if (!regexpHEX.test(colorCode.value)) {
            //event.preventDefault();
            massageColorCode.textContent = 'HEX code must match the pattern # and 3 or 6 digits or letters from A to F';
            flag = false;
        } else {
            backgroundColor = colorCode.value;
            massageColorCode.textContent = '';
        }
    }

    //Проверка на уникальное название
    for (key of arrColors) {
        if (key.toLowerCase() == colorName.value.toLowerCase()) {
            alert('The color name you entered already exists. Enter a different name.');
            flag = false;
        }
    }

    //Если все проверки прошли успешно, то добавляем элемент
    if (flag) {
        colorList.insertAdjacentHTML('beforeend', `
        <div class='new-color' style='background-color: ${backgroundColor}'>
        <div>
        <p>${colorName.value}</p>
        <p>${colorType.value}</p>
        <p>${colorCode.value}</p>
        </div>
        </div>`);

        // Добавление названия цвета в массив
        arrColors.push(colorName.value);

        // Создание объекта для сохранения в localStorage
        let objColor = {
            name: colorName.value,
            type: colorType.value,
            value: colorCode.value
        }

        // Сохранение в localStorage с переводом в JSON
        localStorage.setItem(colorName.value, JSON.stringify(objColor));

        // Очищение полей ввода
        colorName.value = '';
        colorCode.value = '';
    }

});

// Получение сохраненных значений из localStorage
getSaveColors.addEventListener('click', function() {
    let colorName;
    let colorType;
    let colorValue;

    if (localStorage.length == 0) {
        alert('No saved colors');
    } else {

        for (let key in localStorage) {
            if (!localStorage.hasOwnProperty(key)) {
                continue;
            }
    
            // Получение данных
            colorName = (JSON.parse(localStorage.getItem(key))).name;
            colorType = (JSON.parse(localStorage.getItem(key))).type;
            colorValue = (JSON.parse(localStorage.getItem(key))).value;
    
            // Преобразование значений для background
            if (colorType == 'RGB') {
                backgroundColor = `rgb(${colorValue})`;
            } else if (colorType == 'RGBA') {
                backgroundColor = `rgba(${colorValue})`;
            } else {
                backgroundColor = colorValue;
            }
    
            //Вывод сохраненных результатов
            colorList.insertAdjacentHTML('beforeend', `
            <div class='new-color' style='background-color: ${backgroundColor}'>
            <div>
            <p>${colorName}</p>
            <p>${colorType}</p>
            <p>${colorValue}</p>
            </div>
            </div>`);
        }   
    }


})

// Удаление сохраненных цветов
deleteSaveColors.addEventListener('click', function() {

    localStorage.clear();

    // Удаление элементов цветов
    let node = document.getElementById('list-colors');
    let length = document.getElementById('list-colors').childNodes.length;
    for (let i = 0; i < length; i++) {
        node.removeChild(node.firstChild);
    }
})
