<?php /* Smarty version Smarty-3.1.6, created on 2018-05-14 23:49:51
         compiled from "../views/default\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:95724f68d95829a6e4-54800566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9797888b337e03f99b06385b60a372bbb52d5e02' => 
    array (
      0 => '../views/default\\header.tpl',
      1 => 1526330085,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '95724f68d95829a6e4-54800566',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_4f68d95849501',
  'variables' => 
  array (
    'templateWebPath' => 0,
    'arUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_4f68d95849501')) {function content_4f68d95849501($_smarty_tpl) {?><header class="header">
    <div class="container">
        <div class="header__wrap">
        	<div class="header__left">
        	    <div class="logo">
        	        <a href="/" class="logo__link"><img class="logo__img" src="<?php echo $_smarty_tpl->tpl_vars['templateWebPath']->value;?>
/img/logo.png" alt="logo"></a>
        	    </div>
        	</div>
        	<div class="header__right">
        	    <nav class="nav">
        	        <ul class="nav__menu">
        	            <li class="nav__menu-item"><a class="nav__menu-link" href="">Главная</a></li>
        	            <li class="nav__menu-item"><a class="nav__menu-link" href="">О компании</a></li>
        	            <li class="nav__menu-item"><a class="nav__menu-link" href="">Продукты</a></li>
        	            <li class="nav__menu-item"><a class="nav__menu-link" href="">Информация</a></li>
        	            <li class="nav__menu-item"><a class="nav__menu-link" href="">Как доехать</a></li>
        	        </ul>
        	    </nav>
        	    <?php if (isset($_smarty_tpl->tpl_vars['arUser']->value)){?>
        	    <div class="user__auth">
        	    	<a href="/user/" id="user__auth-link"><?php echo $_smarty_tpl->tpl_vars['arUser']->value['displayName'];?>
</a><br>
        	    	<a href="/user/logout" id="user__auth-logout">Выйти</a>
        	    </div>
        	    <?php }else{ ?>
        	    <div class="auth__button">
        	    	<input type="button" id="showAuthPopup" value="Авторизация">
        	    </div>
        	    <div class="overlay js-overlay-campaign">
        	        <div class="popup js-popup-campaign">
        	        	<div class="popup__auth">
        	        		<div class="popup__title">Авторизация</div>
        	        		    <form class="form__auth" name="form__auth" action="" method="POST">
        	        		        <label class="form__label" for="form__auth-email">Ваш email:</label>
        	        		        <input class="form__input" type="text" id="form__auth-email" name='email' value="" placeholder="Введите email"
										   data-val="\b[a-z0-9._]+@[a-z0-9.-]+\.[a-z]&#123;2,4&#125;\b"
										   data-val-msg="Вы ввели не правильный email"
										   data-val-msg-id="emailMsg_auth">
									<span id="emailMsg_auth"></span>
        	        		        <label class="form__label" for="form__auth-password">Ваш пароль:</label>
        	        		        <input type="password" class="form__input" id="form__auth-password" name='pwd' value="" placeholder="Введите пароль" required="required">
									<input class="form__input" id="auth" type="submit" value="Войти">
        	        		    </form>
        	        		    <span class="popup__or">или</span>
        	        		    <div class="popup__title-link">Зарегестрируйтесь</div>
        	        	</div>
        	            <div class="popup__reg">
        	            	<div class="popup__title">Регистрация</div>
        	            	<form class="form__reg" name="form__reg" action="" method="POST">
        	            	    <label class="form__label" for="form__reg-email">Ваш email:</label>
        	            	    <input type="text" id="form__reg-email" name='email' value="" placeholder="Введите email"
									   data-val="\b[a-z0-9._]+@[a-z0-9.-]+\.[a-z]&#123;2,4&#125;\b"
									   data-val-msg="Вы ввели не правильный email"
									   data-val-msg-id="emailMsg_reg">
								<span id="emailMsg_reg"></span>
        	            	    <label class="form__label" for="form__reg-password">Ваш пароль:</label>
        	            	    <input class="form__input" type="password" id="form__reg-password" name='pwd' value="" placeholder="Введите пароль" required="required">
        	            	    <label class="form__label" for="form__reg-password-repeat">Ваш пароль повторно:</label>
        	            	    <input class="form__input" type="password" id="form__reg-password-repeat" name='pwd2' value="" placeholder="Введите пароль" required="required">
        	            	    <input id="register" type="submit" value="Зарегистрироваться">
        	            	</form>
        	            </div>
        	            <div class="close-popup js-close-campaign"></div>
        	        </div>
        	    </div>
        	    <?php }?>
        	</div>
        </div>
    </div>
</header>
<?php }} ?>