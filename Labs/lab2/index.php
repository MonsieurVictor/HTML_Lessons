<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Лаба 2</title>
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
.error {
    color: red;
}
.error:before {
    margin: 0 1em;
    content: '⚠'; /* &#9888 */
}
label {
    display: inline-block;
    width: 150px;
}
fieldset label {
    width: auto;
}
.manage_buttons {
    padding: 0.5em 1.5em;
    width: 7em;
    border: 1px solid #dedede;
    background-color: #fefefe;
    text-decoration: none;
    font-size: 12pt;
    font-family: 'Times New Roman', sans-serif;
    color: black;
    cursor: pointer;
}
        </style>
    </head>
    <body>
        <h1>Форма регистрации с js валидацией</h1>
        <form class="register" method="get">
            <div><label for="surname">Фамилия:</label> <input type="text" name="surname" id="surname" placeholder="Иванов"></div>
            <div><label for="name">Имя:</label> <input type="text" name="name" id="name" placeholder="Иван"></div>
            <div><label for="email">Адрес Email:</label> <input type="email" name="email" id="email" placeholder="mail@example.com"></div>

            <fieldset> <legend><b>Какой кофе вы любите?</b></legend>
                <div><label><input type="radio" name="coffee" value="without"> просто кофе (без всего)</label></div>
                <div><label><input type="radio" name="coffee" value="milk"> с молоком</label></div>
                <div><label><input type="radio" name="coffee" value="dont"> не люблю кофе</label></div>
            </fieldset>

            <div>
                <a class="manage_buttons" src="javascript:void(0);" onclick="reset();">Очистить</a>
                <a class="manage_buttons" src="javascript:void(0);" onclick="submit();">Отправить</a>
            </div>
        </form>

        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script type="text/javascript">
function reset() {
    event.preventDefault();
    if (confirm("Вы действительно хотите очистить все поля формы?"))
        $('.register')[0].reset();
}

function submit() {
    event.preventDefault();

    var validators = {
        'empty': function(element, err_msg) {
            var $element = $(element);
            var $warning = $element.parent().find('.error');
            if($element.val().length == 0) {
                if( $warning.length )
                    $warning.text(err_msg);
                else
                    $element.after('<span class="error">'+err_msg+'<span>');

                return false;
            }
            else if( $warning.length )
                $warning.remove();
            
            return true;
        },
        'empty_radio': function(elements, err_msg) {
            var $elements = $(elements);
            var $checked  = $elements.filter(":checked");
            var $fieldset = $elements.filter(":eq(0)").parent().parent().parent();
            var $warning  = $fieldset.find('.error');
            if($checked.length !== 1) {
                if( $warning.length )
                    $warning.text(err_msg);
                else
                    $fieldset.append('<span class="error">'+err_msg+'<span>');

                return false;
            }
            else if( $warning.length )
                $warning.remove();
            
            return true;
        },
        'email': function(element, err_msg) {
            var $element = $(element);
            var $warning = $element.parent().find('.error');

            if( $element.val().length == 0 ) {
                return false;
            }
            else {
                if( !/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test( $element.val() ) ) {
                    if( $warning.length )
                        $warning.text(err_msg);
                    else
                        $element.after('<span class="error">'+err_msg+'<span>');

                    return false;
                }
                else if( $warning.length )
                    $warning.remove();
            }
            
            return true;
        }
    };
    var valid_params = [
        {
            'element'  : '#surname',
            'err_msg'  : 'Вы не указали фамилию!',
            'validator': validators.empty
        },
        {
            'element'  : '#name',
            'err_msg'  : 'Вы не указали имя!',
            'validator': validators.empty
        },
        {
            'element'  : '#email',
            'err_msg'  : 'Вы не указали email!',
            'validator': validators.empty
        },
        {
            'element'  : '#email',
            'err_msg'  : 'Вы указали неправильный email!',
            'validator': validators.email
        },
        {
            'element'  : 'input[name=coffee]',
            'err_msg'  : 'Вы не выбрали не один из пунктов!',
            'validator': validators.empty_radio
        },
    ];

    var result = true;
    for(var i=0; i < valid_params.length; i++) {
        if( !valid_params[i].validator(valid_params[i].element, valid_params[i].err_msg) )
            result = false;
    }

    //console.log('Итог:', result);
    if( result )
        $('.register')[0].submit();
}
        </script>
    </body>
</html>