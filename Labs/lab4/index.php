<?php
$error_fields = Array();
$submit = !empty($_POST['status']) ? $_POST['status'] : false;

$surname = !empty($_POST['surname']) ? $_POST['surname'] : '';
if( empty($surname) )
    $error_fields['surname'] = 'Вы не указали фамилию!';

$name = !empty($_POST['name']) ? $_POST['name'] : '';
if( empty($name) )
    $error_fields['name'] = 'Вы не указали имя!';

$patronymic = !empty($_POST['patronymic']) ? $_POST['patronymic'] : '';
if( empty($patronymic) )
    $error_fields['patronymic'] = 'Вы не указали Отчество!';

$email = !empty($_POST['email']) ? $_POST['email'] : '';
if( !empty($email) ) {
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) )
        $error_fields['email'] = 'Вы указали неправильный email!';
}
else
    $error_fields['email'] = 'Вы не указали email!';

$sex = !empty($_POST['sex']) ? $_POST['sex'] : '';
if( empty($sex) || $sex === 'not' )
    $error_fields['sex'] = 'Вы не указали свой пол!';

$course = !empty($_POST['course']) ? $_POST['course'] : '';
if( empty($course) )
    $error_fields['course'] = 'Вы не выбрали курс!';

$about = !empty($_POST['about']) ? $_POST['about'] : '';
/* if( !empty($_POST['about']) )
    $about = $_POST['about'];
else
    $error_fields['about'] = 'Вы не указали ни чего о себе'; */

$confirmation = !empty($_POST['confirmation']) ? $_POST['confirmation'] : '';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Лаба 4</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style type="text/css">
html {
    background-color: #f0f0f0;
}
body {
    margin: 2em auto;
    padding: 3em 20px 5em 20px;
    width: 750px;
    background-color: white;
    border-radius: 1em;
    box-shadow: 1px 2px 5px #ccc;
}
@media (max-width: 825px) {
    html {
        background-color: white;
    }
    body {
        margin: auto auto;
        padding: 2em 1em;
        width: auto;
        background-color: white;
        border-radius: 0;
        box-shadow: 0 0 0 white;
    }
}

form div {
    margin: 1em 0.5em;
}
.block {
    margin-top: 3em;
    margin-bottom: 3em;
}
.error {
    color: red;
}
.error:before {
    margin: 0 1em;
    content: '⚠'; /* &#9888 */
}
label[for] {
    display: inline-block;
    width: 150px;
}
label,
select,
input[type="checkbox"],
input[type="radio"] {
    cursor: pointer;
}
fieldset label {
    width: auto;
}
textarea[name="about"] {
    min-width: 70%;
    width: 100%;
    max-width: 100%;
    min-height: 7.5em;
    height: 10em;
}
.buttons input {
    padding: 0.5em 1.5em;
    width: 8.5em;
    border: 1px solid #dedede;
    background-color: #fefefe;
    text-decoration: none;
    font-size: 12pt;
    font-family: 'Times New Roman', sans-serif;
    color: black;
    cursor: pointer;
}

table.result_data {
    width: 100%;
    background-color: #eaeaea;
    border-collapse: collapse;
}
table.result_data th,
table.result_data td {
    border: 1px solid white;
    padding: 0.25em 0.5em;
}
table.result_data tr:hover {
    background-color: #dfdfdf;
}
        </style>
    </head>
    <body>
        <?php if( !$submit || ($submit && !empty($error_fields)) ): ?>
        <h1>Форма для регистрации участников</h1>
        <form class="register" method="post">
            <div>
                <label for="surname">Фамилия:</label>      <input type="text" name="surname" id="surname" placeholder="Иванов" <?= $surname ? 'value="'.$surname.'"' : '' ?>>
                <?= ($submit && !empty($error_fields['surname'])) ? '<span class="error">'.$error_fields['surname'].'</span>': '' ?>
            </div>
            <div>
                <label for="name">Имя:</label>             <input type="text" name="name" id="name" placeholder="Иван" <?= $name ? 'value="'.$name.'"' : '' ?>>
                <?= ($submit && !empty($error_fields['name'])) ? '<span class="error">'.$error_fields['name'].'</span>' : '' ?>
            </div>
            <div>
                <label for="patronymic">Отчество:</label>  <input type="text" name="patronymic" id="patronymic" placeholder="Иванович" <?= $patronymic ? 'value="'.$patronymic.'"' : '' ?>>
                <?= ($submit && !empty($error_fields['patronymic'])) ? '<span class="error">'.$error_fields['patronymic'].'</span>' : '' ?>
            </div>
            <div>
                <label for="email">Адрес Email:</label>    <input type="email" name="email" id="email" placeholder="mail@example.com" <?= $email ? 'value="'.$email.'"' : '' ?>>
                <?= ($submit && !empty($error_fields['email'])) ? '<span class="error">'.$error_fields['email'].'</span>' : '' ?>
            </div>

            <div ><label for="sex">Пол</label>
                <select name="sex" id="sex">
                    <?php
                        foreach(Array('not' => '', 'male' => 'Мужской', 'female' => 'Женский') as $key => $val)
                            echo '<option value="'.$key.'"'.($sex===$key ? ' selected="selected"' : '').'>'.$val.'</option>'."\n";
                    ?>
                </select>
                <?= ($submit && !empty($error_fields['sex'])) ? '<span class="error">'.$error_fields['sex'].'</span>' : '' ?>
            <div>

            <fieldset class="block"> <legend><b>Выберите курс, который вы бы хотели посещать</b></legend>
                <?php
                    foreach(Array('php' => 'PHP', 'lisp' => 'Lisp', 'perl' => 'Perl', 'unix' => 'Unix') as $key => $val)
                        echo '<div><label><input type="radio" name="course" value="'.$key.'"'.($course===$key ? ' checked="checked"' : '').'> '.$val.'</label></div>'."\n";
                ?>
                <?= ($submit && !empty($error_fields['course'])) ? '<span class="error">'.$error_fields['course'].'</span>' : '' ?>
            </fieldset>

            <div class="block">
                <p>Что вы хотите, чтобы мы знали о вас?</p>
                <textarea name="about"><?= $about ? $about : '' ?></textarea>
            </div>

            <div>
                <label>
                    <input type="checkbox" name="confirmation">
                    Подтвердить получение
                </label>
            </div>

            <div class="buttons">
                <input type="reset"> <input type="submit" name="status" value="Отправить"<?= $confirmation === 'on' ? ' checked="checked"' : '' ?>>
            </div>
        </form>
        <?php else: ?>
            <h1>Введенные данные</h1>
            <table class="result_data">
                <thead>
                    <tr>
                        <th>Поле</th>
                        <th>Значение</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($_POST as $field => $value)
                            echo '<tr><td>'.$field.'</td> <td><i>'.htmlspecialchars($value).'</i></td></tr>';
                    ?>
                </tbody>
            </table>
            <?php 
                /*************************************************
                ************   Подключаемся к БД  ****************
                **************************************************/
                // Подключаемся к БД.
                // http://php.net/manual/ru/mysqli.quickstart.prepared-statements.php
                $db = new mysqli('localhost', 'root', '', 'bgtu_web');
                if ($db->connect_errno)
                    echo "Не удалось подключиться к MySQL: (" . $db->connect_errno . ") " . $db->connect_error;

                /* изменение набора символов на utf8 */
                if (!$db->set_charset("utf8")) { // http://php.net/manual/ru/mysqli.set-charset.php
                    printf("Ошибка при загрузке набора символов utf8: %s\n", $db->error);
                    exit();
                }

                /* подготавливаемый запрос, первая стадия: подготовка */
                $query = 'INSERT INTO `bgtu_web_data`
                               (`surname`, `name`, `patronymic`, `email`, `sex`, `course`, `about`, `confirmation`, `date`)
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())';

                if (!($stmt = $db->prepare($query)))
                    echo "Не удалось подготовить запрос: (" . $db->errno . ") " . $db->error;

                /* подготавливаемый запрос, вторая стадия: привязка и выполнение */
                $confirmation = (empty($confirmation) ? 0 : 1);
                if (!$stmt->bind_param("sssssssi", 
                        $surname,
                        $name,
                        $patronymic,
                        $email,
                        $sex,
                        $course,
                        $about,
                        $confirmation
                    )
                ) // http://php.net/manual/ru/mysqli-stmt.bind-param.php
                    echo "Не удалось привязать параметры: (" . $stmt->errno . ") " . $stmt->error;

                if (!$stmt->execute())
                    echo "Не удалось выполнить запрос: (" . $stmt->errno . ") " . $stmt->error;
                /*************************************************/
            ?>
        <?php endif; ?>
    </body>
</html>