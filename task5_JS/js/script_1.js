const forms = document.forms;
const myForm = forms.myForm;
const elements = myForm.elements;
const country = elements.country;
const submit = elements.submit;
const skils = myForm.querySelectorAll('input[type="checkbox"]');


//Функция для выбора города

function getListCities() {
    const city = elements.city;
    const countryValue = elements.country.value;
    let options;

    while (city.firstChild) {
        city.removeChild(city.firstChild);
    }
    
    if (countryValue == 'Russia') {

        cities = [
            {
                cityName: 'Москва',
                cityValue: 'Moscow'
            },
            {
                cityName: 'Воронеж',
                cityValue: 'Voronezh'
            },
            {
                cityName: 'Ростов на Дону',
                cityValue: 'Rostov on Don'
            }
        ]

    } else if (countryValue == 'Ukraine') {

        cities = [
            {
                cityName: 'Киев',
                cityValue: 'Kiev'
            },
            {
                cityName: 'Харьков',
                cityValue: 'Kharkov'
            },
            {
                cityName: 'Одесса',
                cityValue: 'Odessa'
            }
        ]

    } else if (countryValue == 'Poland') {

        cities = [
            {
                cityName: 'Варшава',
                cityValue: 'Warsaw'
            },
            {
                cityName: 'Краков',
                cityValue: 'Krakow'
            },
            {
                cityName: 'Вроцлав',
                cityValue: 'Wroclaw'
            }
        ]
    } 

    //Цикл добавление options с названиями городов
    for (let key of cities) {
        options = new Option(key.cityName, key.cityValue);
        city.append(options);
    };
}

city.addEventListener('focus', getListCities); 


// Функция сброса введеных данных в поля
function resetValue() {
    for (key of elements) {
        if (key.value == 'male' || key.value == 'female' || key.value == 'Save') {
            continue;
        }
        key.value = '';
    }

    for (key of skils) {
        if (key.checked) {
            key.checked = false;
        }
    }
}


// Функция получения и вывода информации

function showResult(event) {
    
    event.preventDefault();

    //Удаление предыдущего результата
    while (myForm.nextElementSibling.matches('div')) {
        myForm.nextElementSibling.remove();
    }

    const firstname = elements.firstname.value;
    const lastname = elements.lastname.value;

    //Получение даты
    const birthday = new Date(elements.birthday.value);
    const day = birthday.getDate();
    const month = birthday.getMonth();
    const year = birthday.getFullYear();

    const gender = elements.gender.value;
    const country = elements.country.value;
    const city = elements.city.value;

    //Получение выбранных навыков
    let mySkils = [];
    for (key of skils) {
        if (key.checked) {
            mySkils.push(' ' + key.name.toUpperCase());
        }
    }

    //Добавление элемента с результатами
    myForm.insertAdjacentHTML("afterend", `
    <div class="result">
        <h3>Result:</h3>
        <table>
            <tr>
                <td>Firstname</td>
                <td>${firstname}</td>
            </tr>
            <tr>
                <td>Lastname</td>
                <td>${lastname}</td>
            </tr>
            <tr>
                <td>Birthday</td>
                <td>${day}/${month + 1}/${year}</td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>${gender}</td>
            </tr>
            <tr>
                <td>Country</td>
                <td>${country}</td>
            </tr>
            <tr>
                <td>City</td>
                <td>${city}</td>
            </tr>
            <tr>
                <td>Skills</td>
                <td>${mySkils}</td>
            </tr>
        </table>
    </div>`);

    resetValue();
}

myForm.addEventListener('submit', showResult);
