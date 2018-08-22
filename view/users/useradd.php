<html>
    <head>
        <link rel="stylesheet" href="/public/css/companyadd2.css">   
    </head>
    <body>
        <form method="post" action="/usersave">

            <label for="Name">Username</label><br>
            <input type="text" name="username" value=""><br>

            <label for="adress">Password</label><br>
            <input type="password" name="password" value=""><br><br>

            <label for="active">Active</label><br>
            <select name="active">
                <option value="1">1</option>
                <option value="0">0</option>
            </select><br><br>
            
            <input type="submit" value="Submit">

        </form>

    </body>

</html>
