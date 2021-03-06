<?php
$uri = $_SERVER['REQUEST_URI'];
$uri = explode("/",$uri);
$domain = $uri[2];
$_login = false;
$_root_login = true;
if ($domain == "login"){
    $_login = true;
    $domain ="home";
}
if($domain == "exit"){
    $_login = false;
    $domain ="home";
}
?>


<!DOCTYPE html>
<html lang="en">
<style>
    <?php include 'component/style/skeleton.css'; ?>
</style>

<head>
    <meta charset="UTF-8">
    <title >app</title>
</head>
<body style="background-color: #D1D1D1">

<div class="container" style="
    background-color: #e8e8e8;
    border-radius: 10px;
" >
    <h2 style="margin-left: 10px">Мой Блог</h2>
    <hr style="width: 90%; margin: 0 auto;">
    <div style="text-align: right;  width: auto;">
        <?php
        if($_login == true)
        {

            echo "<h5 style=\"margin-right: 10px;\">login</h5>
            <a class=\"button\" style=\"width: auto; border: none;\" href=\"exit\">Выйти</a>";
            if($_root_login == true)
            {
                echo "
            <a class=\"button\" style=\"width: auto; border: none;\" href=\"../admin/home\">Панель администратора</a>";
            }
        }
        else
            {
                echo "<a class='button' style='border: none' href='login'>Войти</a>
                      <a class='button' style='border: none' href='reg'>Регистрация</a>
                      <hr style=\"width: 90%; margin: 0 auto;\">
                      ";
            }
        ?>
    </div>
    <div style="display: flex;">
        <div style=" left: 0; width: 70%; height: 50%;">
            <?php
            //DYMANIC DIV
            //Отображает элементы, в зависимости от url
            if($domain == 'home'){
                include 'component/header.html';
            }
            if($domain == "reg"){
                include 'component/reg.php';
            }
            if($domain == "new_articles"){
                include 'component/add.html';
            }
            if($domain == "login"){
                include 'component/enter.php';
            }
            ?>
        </div>
        <div style=" right:0;  width: 30%; height: 50%;">
            <h5 style="text-align: center">Меню</h5>
            <a class="button" style="width: 100%;" href="home">Главная</a>

            <?php //user authorize?
            //if true, user get more function
            if($_login == true){
                echo
                "
                <a class=\"button\" style=\"width: 100%;\" href=\"new_articles\">Новая статья</a>
                <a class=\"button\" style=\"width: 100%;\" href=\"articles\">Статьи</a>
                ";
            }
            ?>
        </div>
    </div>


</div>
<script>
    window.onload = function (){
        async function load () {
            let res = await fetch("/comment/find?user=myUser").then(r=>r.json());

            for (let i in res) {
                let node = document.createElement("div");
                node.className              = ".container";
                node.style.height           = "200px";
                node.style.marginTop        = "80px";
                node.style.marginBottom     = "80px";
                node.style.backgroundColor  = "#e8e8e8";
                node.style.borderRadius     = "10px";
                let fromUser    = document.createTextNode(res[i]['fromUser']);
                let content     = document.createTextNode(res[i]['content']);
                let likes       = document.createTextNode(res[i]['likes']);
                let node_text   = document.createElement("strong");
                node_text.marginTop       = "200px";


                node_text.appendChild(fromUser);
                node.appendChild(node_text);
                document.getElementById("stream").appendChild(node);
            }


        }
        load();
    };


</script>

</body>
</html>