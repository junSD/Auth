<?php
/**
 * Контроллер функций пользователя
 *
 */

//подключаем модели
include_once '../models/UsersModel.php';

/**
 * AJAX регистрация пользователя
 * Инициализация сессионной переменной ($_SESSION['user])
 *
 * @return json массив данных новго пользователя
 */
function registerAction($smarty, $db) {

    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
    $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;

    $resData = null;
    $resData = checkRegisterParams($email, $pwd, $pwd2);

    if (!$resData && checkUserEmail($email, $db)) {
        $resData['success'] = false;
        $resData['message'] = "Пользователь с таким email ({$email}) уже зарегестрирован";
    }

    if (! $resData ) {
        $pwdMD5 = md5($pwd);
        $userData = registerNewUser($email, $pwdMD5, $db);

        if ($userData['success']) {
            $resData['message'] = "Пользователь успешно зарегестрирован";
            $resData['success'] = 1;

            $userData = $userData[0];
            $resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
            $resData['userEmail'] = $email;

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Ошибка регистрации';
        }
    }

    echo json_encode($resData);
//        echo  print_r($resData);
}

/**
 * Выход пользователя
 */
function logoutAction() {
    if (isset($_SESSION['user'])){
        unset($_SESSION['user']);
    }
    redirect('/');
}

/**
 * AJAX авторизация пользователя
 *
 * @return json массив данных пользователя
 *
 */
function loginAction($smarty, $db) {
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
    $email = trim($email);

    $pwd = isset($_REQUEST['pwd']) ? $_REQUEST['pwd'] : null;
    $pwd = trim($pwd);

    $userData = loginUser($email, $pwd, $db);

    if ($userData['success']) {
        $userData = $userData[0];

        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];


        $resData = $_SESSION['user'];
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Неверный логин или пароль';
    }

    echo json_encode($resData);
//            echo  print_r($resData);
}

/**
 * Формирование главной страницы пользователя
 *
 * @link /user/
 * @param $db
 * @param object $smarty шаблонизатор
 */
function indexAction($smarty,$db) {
    //если пользователь не залогинен, то редирект на главную страницу
    if(! isset($_SESSION['user'])) {
        redirect ('/');
    }
    loadTemplate($smarty, 'default');
    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'user');
    loadTemplate($smarty, 'footer');
}

/**
 * Обновление данных пользователя
 *
 * @return json результаты выполнения функции
 *
 */
function updateAction($smarty,$db) {
    //> если пользователь не залогинен, то редирект на главную страницу
    if(! isset($_SESSION['user'])) {
        redirect ('/');
    }
    //<

    //> инициализация переменных
    $resData = array();
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
    $pwd = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd'] : null;
    $pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;
    $curPwd = isset($_REQUEST['curPwd']) ? $_REQUEST['curPwd'] : null;
    //<

    // проверка правильности пароля (введенный и тот под которым залогинились)
    $curPwdMD5 = md5($curPwd);
    if (! $curPwd || ($_SESSION['user']['pwd'] != $curPwdMD5)) {
        $resData['success'] = 0;
        $resData['message'] = 'Текущий пароль не верный';
        echo json_encode($resData);
        return false;
    }

    // обновление данных пользователя
    $res = updateUserData($name, $pwd, $pwd2, $curPwdMD5, $db);
    if($res) {
        $resData['success'] = 1;
        $resData['message'] = "Данные сохранены";
        $resData['userName'] = $name;

        $_SESSION['user']['name'] = $name;

        $newPwd = $_SESSION['user']['pwd'];
        if ($pwd && ($pwd == $pwd2)) {
            $newPwd = md5(trim($pwd));
        }
        $_SESSION['user']['pwd'] = $pwd;
        $_SESSION['user']['displayName'] = $name ? $name : $_SESSION['user']['email'];
    } else {
        $resData['success'] = 0;
        $resData['message'] = "Ошибка сохранения данных";
    }

    echo json_encode($resData);
}