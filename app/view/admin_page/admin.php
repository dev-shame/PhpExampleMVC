<?php
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("/",$uri);
$domain = $uri[2];

if($_root_login == false)
{
    echo '<script language="javascript">';
    echo 'alert("У вас недостаточно прав на использование данной страницы")';
    echo '</script>';
}
if($_login == false)
{
    echo '<script language="javascript">';
    echo 'alert("Вы не авторизированы")';
    echo '</script>';
}
?>

<html>
<style>
    <?php include_once 'component/style/skeleton.css'; ?>
</style>
<div class="container" style="
    background-color: #e8e8e8;
    border-radius: 10px;
" >
    <h4 style="margin-left: 10px">Администрирование блога</h4>
    <hr style="width: 90%; margin: 0 auto;">
    <div style="text-align: right;  width: auto;">

    </div>
    <div style="display: flex;">
        <div style=" left: 0; width: 70%; height: 50%;">
            <?php
            //Dynamic DIV
            //Отображает элементы, в зависимости от url
            if($domain == "find_user"){
                include 'component/find_user.php';
            }
            if($domain == 'home'){
                include 'component/home.php';
            }
            if($domain == "find_articles"){
                include 'component/find_articles.php';
            }
            if($domain == "find_comment"){
                include 'component/find_comment.php';
            }
            ?>
        </div>
        <div style=" right:0;  width: 30%; height: 50%;">
                <a class="button" style="width: 100%;" href='find_user'>Поиск по пользователям</a>
                <a class="button" style="width: 100%;" href="find_articles">Поиск по статьям</a>
                <a class="button" style="width: 100%;" href="find_comment">Поиск по комментариям</a>
                <a class="button" style="width: 100%;" href="../main/home">Вернуться на сайт</a>
        </div>
    </div>


</div>
</html>
