<!doctype html>
<html lang="en">
<head>
    <title>Welcome to the homepage</title>
    <style>
        h1 {
            text-align: center;
            padding-top: 20%;
        }
        
        h2 {
            text-align: center;
            
        }

        .link {
            text-align: center;
            margin-top: 60px;
        }
        .link a {
            text-decoration: none;
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .link a:hover {
            background-color: #218838;
        }

        

    </style>
</head>
<body>
    <h1>Welcome to Online Art Museum</h1>
    <h2>You can enjoy the  different beatiful art from all over the world!</h2>
    <h2>Please enjoy by yourself!</h2>

    <div class="link">
     <a href="/museum">I am a Tourist</a>
   

    <a href="{{ route('login') }}">Login</a>
    <a href="{{ route('register') }}">Register</a>

    </div>


</body>
</html>
