<?php
/**
 * Модель для таблицы пользователей (users)
 *
 */

/**
 * Регистрация нового пользователя
 * @param string $email почта
 * @param string $pwdMD5 пароль зашифрованный в MD5
 * @return array массив данных нового пользователя
 */
function registerNewUser($email, $pwdMD5, $db)
{

    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    $verification_code = generateString(30);
    $verification = 0;

    $query = "INSERT INTO users (`email`, `pwd`, `verification`, `verification_code`) 
              VALUES ('{$email}','{$pwdMD5}', '{$verification}', '{$verification_code}')";

    $rs = mysqli_query($db, $query);

    if ($rs) {
        $query = "SELECT*FROM users WHERE (`email` = '{$email}' and `pwd` = '{$pwdMD5}') LIMIT 1";

        $rs = mysqli_query($db, $query);

        $rs = createSmartyRsArray($rs);

        if (isset($rs[0])) {
            $rs['success'] = 1;
            $rs['verify'] = 0;
        } else {
            $rs['success'] = 0;
        }
    } else {
        $rs['success'] = 0;
    }

    return $rs;
}

/**
 * Проверка параметров для регистрации пользователя
 * @param string $email email
 * @param string $pwd1 пароль
 * @param string $pwd2 повтор пароля
 * @return array результат
 */
function checkRegisterParams($email, $pwd, $pwd2)
{
    $res = null;

    if (!$email) {
        $res['success'] = false;
        $res['message'] = 'Введите email';
    }

    if (!$pwd) {
        $res['success'] = false;
        $res['message'] = 'Введите пароль';
    }

    if (!$pwd2) {
        $res['success'] = false;
        $res['message'] = 'Введите повтор пароля';
    }

    if ($pwd != $pwd2) {
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
    }

    return $res;

}

/**
 * Проверка почты (есть ли email адресс в БД)
 * @param string $email
 * @return array массив - строка из таблицы users, либо пустой массив
 */
function checkUserEmail($email, $db)
{
    $email = mysqli_real_escape_string($db, $email);
    $query = "SELECT id FROM users WHERE email = {$email}";

    $rs = mysqli_query($db, $query);
    $rs = createSmartyRsArray($rs);

    return $rs;
}

/**
 * Авторизация пользователя
 *
 * @param string $email почта (логин)
 * @param string $pwd пароль
 * @param $db - доступ к БД
 *
 * @return array массив данных пользователя
 */
function loginUser($email, $pwd, $db) {
    $email = htmlspecialchars(mysqli_real_escape_string($db, $email));
    $pwd = md5($pwd);


    $query = "SELECT*FROM users WHERE (`email` = '{$email}' and `pwd` = '{$pwd}') LIMIT 1";

    $rs = mysqli_query($db, $query);

    $rs = createSmartyRsArray($rs);
    if(isset($rs[0])) {
        $rs['success'] = 1;
    } else {
        $rs['success'] = 0;
    }

    return $rs;
}

/**
 * Изменение данных пользователя
 *
 * @param string $name имя пользователя
 * @param string $pwd1 новый пароль
 * @param string $pwd2 повтор нового пароля
 * @param string $curPwd текущий пароль
 * @param $bd
 * @return boolean TRUE в случае успеха
 */
function updateUserData($name, $pwd, $pwd2, $curPwd, $db) {
    $email = htmlspecialchars(mysqli_real_escape_string($db, $_SESSION['user']['email']));
    $name = htmlspecialchars(mysqli_real_escape_string($db, $name));

    $pwd = trim($pwd);
    $pwd2 = trim($pwd2);

    $newPwd = null;
    if ($pwd && ($pwd == $pwd2)) {
        $newPwd = $pwd;
    }

    $query = "UPDATE users SET ";
    if ($newPwd) {
        $query .= "`pwd` = '{$newPwd}', ";
    }
    $query .= "`name` = '{$name}'
                WHERE `email` = '{$email}' and `pwd` = '{$curPwd}' LIMIT 1";

    $rs = mysqli_query($db, $query);

    return $rs;
}
function generateString($length = 30){
    $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $numChars = strlen($chars);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string .= substr($chars, rand(1, $numChars) - 1, 1);
    }
    return $string;
}
function sendMail($verification_code) {

        $to = 'sergiidovgal@gmail.com';
        $subject = "Подтверждение регистрации \r\n
        auth-test/user/verify/?verifycode=$verification_code";

        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: Отправитель <from@example.com>\r\n";
        mail($to, $subject, $headers);
}