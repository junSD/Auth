<?php /* Smarty version Smarty-3.1.6, created on 2018-05-15 00:05:51
         compiled from "../views/default\user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:307505af8a3aa90c2c3-75063711%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63ee73149e09ac8b024db0d49e528d996d357c0d' => 
    array (
      0 => '../views/default\\user.tpl',
      1 => 1526330108,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '307505af8a3aa90c2c3-75063711',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_5af8a3aa96399',
  'variables' => 
  array (
    'arUser' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5af8a3aa96399')) {function content_5af8a3aa96399($_smarty_tpl) {?>


<div class="content">
    <div class="container">
        <div class="content__wrapper">
            <h2 class="main__title">Персональная страница <?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
</h2>
        </div>
        <h3>Ваши регистрационные данные</h3>
    <div class="user__form">
        <form class="form__user" name="form__user" action="" method="POST">
            <div class="form__user-row">
                <label class="form__user-label" for="form__user-email">Ваш email:</label>
                <input type="text" id="form__user-email" name='email' value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['email'];?>
" disabled>
            </div>
            <div class="form__user-row">
            <label class="form__user-label" for="form__user-name">Ваше имя:</label>
            <input type="text" id="form__user-name" name='name' value="<?php echo $_smarty_tpl->tpl_vars['arUser']->value['name'];?>
">
            </div>
            <div class="form__user-row">
            <label class="form__user-label" for="user__password-new">Ваш пароль:</label>
            <input class="form__input" type="password" id="user__password-new" name='pwd' value="">
            </div>
            <div class="form__user-row">
            <label class="form__user-label" for="user_password-repeat-new">Ваш пароль повторно:</label>
            <input class="form__input" type="password" id="user_password-repeat-new" name='pwd2' value="">
            </div>
                <div class="form__user-row">
            <label class="form__user-label" for="user_password-current">Введите текущий пароль (всегда):</label>
            <input class="form__input" type="password" id="user_password-current" name='curPwd' value="">
                </div>
                    <div class="form__user-row">
            <input id="updateData" type="submit" value="Сохранить изменения">
                    </div>
        </form>
    </div>

    </div>
</div>
</div>
</div><?php }} ?>