<?php 
    $tQuestion=[
        "В Свазиленде считается неприличным мешать парламентариям, когда те совещаются со своими предками. Каким образом они это делают?",
        "Какой очень важный научный прибор ученые эпохи Возрождения и средних веков делали из небольшого количества воды и меда?",
        "Космические корабли отправляются в полет с:",
        "Самая короткая в мире река находится в США и имеет в длину 134 м и необычное короткое название, начинающееся на букву «Д». Приведите это название.",
        "Где текут реки без воды?", "Какая страна получила свое название, будучи ничейной землей между Россией и Турцией?",
        "Какого цвета зеркало?",
        "Весит ли солнечный свет что-нибудь?",
        "Где находится центр Вселенной?",
        "Что произойдет, если все на Земле прыгнут одновременно?"
    ];
    $tQuestion = randomQuestion($tQuestion);
?>

<form action="" method="post" class="m-3"> 
    <h1 class="mb-4 text-center"><u>Уровень 3</u></h1>
    <?
        foreach ($tQuestion as $key => $question) {
            $questionNum = (array_search($key, array_keys($tQuestion))+1);
    ?>
    <div class="mb-4">
        <p><strong><?=$question?></strong></p>
        <textarea name="tQuestion<?=$questionNum?>" cols="40" rows="2"></textarea>
    </div>
        <?
        }
        ?>
    <button class="d-block mt-2 btn btn-primary" type="submit" name="finishbtn">Завершить тест</button>   
</form>

<?php
if (isset($_POST['finishbtn'])) {
    if (verificationOfEmpty() == false) {
        echo '<h2 class="text-danger">Вы ответили не на все вопросы!</h2>';
    } else {
        level3();
        echo '<script>location.reload();</script>';
    }
}
