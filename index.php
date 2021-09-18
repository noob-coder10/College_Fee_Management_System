<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GCECT</title>
    <style>
        .navbar{
            border-radius: 40px;
            margin: 3px;
        }
        .navbar li{
            float: left;
            list-style: none;
            margin: 1px 10px;
        }
        .navbar li a{
            padding: 3px 3px;
            text-decoration: none;
        }
        .navbar li a:hover{
            color: violet;
        }
        .search{
            float: right;
            padding: 1px;
            margin: 16px 26px;
            font-size: 30px;
        }
        .navbar input{
            border: 2px solid red;
            border-radius: 3px;
            padding: 0px;
            border-radius: 30px;
            width: 150px;
        }
        .logo-image{
            width: 70px;
            height: 70px;
            overflow: hidden;
            margin-top: -6px;
        }
        
    </style>
</head>
<body class="body">
    <header>
        <nav class="navbar">
            <ul>
                <li><a class="navbar-brand">
                <div class="logo-image">
                    <img src="logo.png" width="70" height="70" class="img-fluid">
                </div>
                </a></li>
                <div> 
                    <li><h1> Government College of Engineering & Ceramic Technology </h1></li>
                </div>
                <div class="search"> 
                    <li><a href="login.php">Login</a></li>
                </div>
            </ul>
        </nav>
    </header>
</body>
</html>