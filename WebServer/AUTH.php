<!DOCTYPE HTML>
<HTML>
    <HEAD>
    <meta http-equiv="Content-Type" content="text/html: charset=utf-8">
        <title>BrigadaSBKKCorporation</title>
        <style type = "text/css">
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}
        <link rel ="stylesheet" href="style.css">
        .HeadText{text-align: center;}

        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            opacity: 0.8;
        }

        .imgcontainer {
            text-align: center;
            margin: 24px 0 12px 0;

        }
        img.avatar {
            width: 20%;
            border-radius: 60%;
        }
        .container {
            padding: 10% 35% 35% 35%;
        }

        .auth_success{
            padding: 10% 40% 10% 40%;
            text-align: center;
            font-size: 20px;


        }
        .HeadText{text-align: center;}

        span.psw {
            float: right;
            padding-top: 16px;
        }

        @media screen and (max-width: 300px) {
            span.psw {
            display: block;
            float: none;
            }
            .cancelbtn {
            width: 100%;
            }
        }        
        </style>

    </HEAD>
    <BODY>
        <h2 class="HeadText">Добро пожаловать на страницу авторизации</h2>
            <div class="imgcontainer">
                <img src="PhotoAuth/avatar.webp " alt = "Avatar" class="avatar">
            </div>
        <?php
            if($_COOKIE['user'] == ''):
        ?>
            <div class="container">
                <form action="check.php" method="post">
                    <label for="uname"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="login" id="login" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>

                    <button type="submit">Login</button>
                </form>
            </div>
        <?php else: ?>
            <p class="auth_success">Вы успешно авторизовались <?=$_COOKIE['user']?></p>
            <form action="main.php">
                <button>Перейти на основной сайт</button>
            </form>
        <?php endif; ?>
    </BODY>
</HTML>