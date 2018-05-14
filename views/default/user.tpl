{*страница пользователя*}


<div class="content">
    <div class="container">
        <div class="content__wrapper">
            <h2 class="main__title">Персональная страница {$arUser['name']}</h2>
        </div>
        <h3>Ваши регистрационные данные</h3>
    <div class="user__form">
        <form class="form__user" name="form__user" action="" method="POST">
            <div class="form__user-row">
                <label class="form__user-label" for="form__user-email">Ваш email:</label>
                <input type="text" id="form__user-email" name='email' value="{$arUser['email']}" disabled>
            </div>
            <div class="form__user-row">
            <label class="form__user-label" for="form__user-name">Ваше имя:</label>
            <input type="text" id="form__user-name" name='name' value="{$arUser['name']}">
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
</div>