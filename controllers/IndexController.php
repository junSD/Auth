<?php

/**
 *  Контроллер главной страницы
 * 
 */

/**
 * подключаем модели
 */
function testAction(){
	echo 'IndexController.php > testAction';
}

/**
 * Формирование главной страницы сайта
 * 
 * @param object $smarty шаблонизатор
 */ 
function indexAction($smarty, $db){

    loadTemplate($smarty, 'default');
	loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'content');
    loadTemplate($smarty, 'footer');
}
