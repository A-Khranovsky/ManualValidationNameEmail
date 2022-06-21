<?php
    $error = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        if ($key != 'email') {
            if (
                false === filter_var($value, FILTER_CALLBACK, ['options' =>
                function ($value) {
                    if (
                        !filter_var(
                            $value,
                            FILTER_VALIDATE_REGEXP,
                            [
                            'options' =>
                                [
                                    'regexp' => "/[А-Я]{1}[а-яё]{2,20}\Z/u"
                                ]
                            ]
                        )
                    ) {
                            return false;
                    } else {
                        return $value;
                    }
                }
                ])
            ) {
                $error[] = 'Неправильный формат ' . (($key == 'firstName') ? 'first name' : 'last name');
            }
        }
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error[] = 'Не правильный формат e-mail';
    }

    if (empty($error)) {
        $content = file_get_contents(__DIR__ . '/data.txt');

        if ($content) {
            $content = explode(PHP_EOL, $content);

            if (!in_array(implode(' ', $_POST), $content)) {
                file_put_contents(__DIR__ . '/data.txt', $_POST['firstName'] . ' '
                    . $_POST['lastName'] . ' ' . $_POST['email'] . PHP_EOL, FILE_APPEND);
            } else {
                $error[] = 'Такой пользователь уже существует!';
            }
        } else {
            file_put_contents(__DIR__ . '/data.txt', implode(' ', $_POST) . PHP_EOL);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title></title>
    <meta charset="utf-8">
</head>
<body>
    
    <form method='post'>        
        <?php if (!empty($error)) {
            foreach ($error as $er) {
                echo  $er . "<br />";
            }
        }
        ?>
        first name: <br />
        <input type='text' name='firstName' <?php echo isset($_POST['firstName']) ? 'value=\'' . $_POST['firstName'] . '\'' : ''?> /><br />
        last name: <br />
        <input type='text' name='lastName' <?php echo isset($_POST['lastName']) ? 'value=\'' . $_POST['lastName'] . '\'' : ''?> /><br />
        e-mail: <br />
        <input type='text' name='email' <?php echo isset($_POST['email']) ? 'value=\'' . $_POST['email'] . '\'' : ''?> /><br /><br />
        <input type='submit' value='Send' />
    </form>
</body>
</html>
