<link rel="stylesheet" href="/public/css/companyadd2.css">   
<form method="post" action="/personsave">

    <input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
    <label for="Name">Name</label><br>
    <input type="text" name="name" value="<?php echo $data['name']; ?>"><br>
    <label for="Adress">Adress</label><br>
    <input type="text" name="adress" value="<?php echo $data['adress']; ?>"><br><br>
    <label for="Phone">Phone</label><br>
    <input type="text" name="phone" value="<?php echo $data['phone']; ?>"><br><br>
    <label for="Email">Email</label><br>
    <input type="text" name="email" value="<?php echo $data['email']; ?>"><br><br>

    <input type="submit" value="Submit">

</form>

