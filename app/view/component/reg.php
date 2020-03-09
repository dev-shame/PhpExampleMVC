<?php
$unvalidate_email = false;
$unvalidate_pass = false;
?>

<html>

<div class="container" style="
    background-color: #e8e8e8;
    border-radius: 10px;
" >
    <form method="get">
        <div class="row">
                <?php
                //Визуальное предупреждение пользователя
                /*Если email неверный и пароль неверный*/   if($unvalidate_email == true  and $unvalidate_pass == true )
                {
                    echo "
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Логин</label>
                <p style=\"color: red;\">Вы неправильно ввели email
                <input class=\"u - full - width\" type=\"email\" placeholder=\"example@example . com\" id=\"exampleEmailInput\"></p>
            </div>
               
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Пароль</label>
                <p style=\"color: red;\">Вы ввели неподходящий пароль
                <input class=\"u - full - width\" type=\"password\" placeholder=\"AuihdjA ^ 12Gst\" id=\"exampleEmailInput\"></p>
            </div>        
                         ";
                }
                /*Если email верный и пароль верный*/       if($unvalidate_email == false and $unvalidate_pass == false)
                {
                    echo " 
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Логин</label>
                <input class=\"u - full - width\" type=\"email\" placeholder=\"example@example . com\" id=\"exampleEmailInput\"></p>
            </div>
               
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Пароль</label>
                <input class=\"u - full - width\" type=\"password\" placeholder=\"AuihdjA ^ 12Gst\" id=\"exampleEmailInput\"></p>
            </div>  
                         ";
                }
                /*Если email верный а пароль неверный*/     if($unvalidate_email == false and $unvalidate_pass == true )
                {
                    echo "
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Логин</label>
                <br>
                <input class=\"u - full - width\" type=\"email\" placeholder=\"example@example . com\" id=\"exampleEmailInput\"></p>
            </div>
               
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Пароль</label>
                <p style=\"color: red;\">Вы ввели неподходящий пароль
                <input class=\"u - full - width\" type=\"password\" placeholder=\"AuihdjA ^ 12Gst\" id=\"exampleEmailInput\"></p>
            </div>        
                         ";
                }
                /*Если email неверный а пароль верный*/     if($unvalidate_email == true  and $unvalidate_pass == false)
                {
                    echo "
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Логин</label>
                <p style=\"color: red;\">Вы неправильно ввели email
                <input class=\"u - full - width\" type=\"email\" placeholder=\"example@example . com\" id=\"exampleEmailInput\"></p>
            </div>
               
            <div class=\"six columns\">
                <label for=\"exampleEmailInput\">Пароль</label>
                <br>
                <input class=\"u - full - width\" type=\"password\" placeholder=\"AuihdjA ^ 12Gst\" id=\"exampleEmailInput\"></p>
            </div>        
                         ";
                }
                ?>

        </div>

        <input class="button-primary" type="submit" value="Зарегистрироваться">
    </form>
</div>

</html>
