<?php
    $cQuestion = [
        "Выберете верные утверждения про Москву:" => [
            "Высотка МГУ – самое большое в мире здание университета",
            "Московский Кремль – самая большая в мире средневековая крепость",
            "Метро Москвы – самое глубокое в мире",
            "От Москвы до Чикаго ближе, чем от Чикаго до Рио-де-Жанейро"],
        "Выберете факты о Шишкине:" => [
            "Имя Шишкина носят улицы сразу двух столиц — Москвы и Минска",
            "Шишкин написал картину 'Богатыри'",
            "За свою жизнь великий художник написал более 800 картин",
            "Самая известная картина Шишкина, 'Утро в сосновом бору'"],
        "Выберете верные факты о природе:" => [
            "Удар молнии может достигать температуры 30000 градусов по Цельсию",
            "Муравьи способны уклониться от излучения микроволн",
            "На Земле в 12 раз меньше растений и деревьев, чем звёзд в Млечном Пути",
            "Один день на Венере равен 523 дням на Земле"],
        "Выберете верные утверждения о подводном мире:" => [
            "Морские звёзды умеют плавать",
            "Дельфины - люди подводного мира",
            "Акулы никогда не спят",
            "Кит может жить без воды"],
        "Выберете верные факты о кофе:" => [
            "В мире есть два основных сорта кофе",
            "Страна-родина кофе – древняя Эфиопия",
            "Традиционный способ приготовления придумали туркию",
            "В чашке черного кофе без сахара 0 калорий"],
        "Выберете верные утверждения из базовых знаний по географии:" => [
            "Берингов пролив находится между Россией и США",
            "Амазонка - самая длинная река в мире",
            "Примерная численность населения Земли составляет 11,7 млрд человек",
            "Россия граничит с 18 странами"],
        "Выберите верные суждения о культуре и её видах:" => [
            "Произведения массовой культуры предъявляют высокие требования к общекультурному уровню потребителя",
            "Культура – это все виды преобразовательной деятельности людей и её результаты",
            "Народная культура, как правило, создаётся коллективной творческой деятельностью народа, отражает его жизнь и традиции",
            "В развитии культуры отмечают такие тенденции, как преемственность и новаторство"],
        "Выберите верные утверждения. Информатика изучает:" => [
            "Как сохранить данные в компьютере",
            "Как собрать данные о состоянии здоровья человека",
            "Как ввести данные в компьютер",
            "Как измерить расстояние от человека до монитора"],
        "Буфер обмена служит для:" => [
            "Скрытия информации", 
            "Хранения информации об объектах, которые подлежат перемещению или копированию",
            "Просмотра информации",
            "Хранения информации, которая подлежит удалению"],
        "Выберите верное утверждение:" => [
            "HTML цвет может быть задан только в одном формате",
            "В HTML цвета задаются комбинацией значений восьмеричной системы исчисления: 0, 1, 2, 3, 4, 5, 6, 7",
            "В HTML цвета задаются комбинацией значений двоичной системы исчисления: 0 или 1",
            "В HTML цвета задаются комбинацией значений шестнадцатеричной системы исчисления: 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 0, A, B, C, D, E, F"]
    ];

    $cQuestion = randomQuestion($cQuestion);
?>


<form action="" method="post" class="m-3">
    <h1 class="mb-4 text-center"><u>Уровень 2</u></h1>
    <?
        foreach ($cQuestion as $question => $answers) {
    ?>
    <div class="mb-4">
        <p><strong><?=$question?></strong></p>
            <? 
                $questionNum = (array_search($question, array_keys($cQuestion))+1);
                foreach ($answers as $key => $value) { 
            ?>
        <div class="form-check d-inline-block me-3">
            <input class="form-check-input" type="checkbox" name="cQuestion<?=$questionNum?>[]" value="<?=$value?>">
            <label class="form-check-label" for="cQuestion<?=$questionNum?>[]"><?=$value?></label>
        </div>
            <?
                }
            ?>
    </div>
    <?
        }
    ?>
    <button type="submit" name="lvl2" class="btn btn-primary">Далее</button>   
</form>

<?
if (isset($_POST['lvl2'])) {
    if (verificationOfEmpty() == false) {
        echo '<h2 class="text-danger">Вы ответили не на все вопросы!</h2>';
    } else {
        level2();
        echo '<script>location.reload();</script>';
    }
}
