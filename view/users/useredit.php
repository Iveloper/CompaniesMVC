<link rel="stylesheet" href="/public/css/companyadd2.css">   
<form method="post" action="/usersave">

    <input type="hidden" value="<?php echo $data['id']; ?>" name="id" />
    <label for="Name">Username</label><br>
    <input type="text" name="username" value="<?php echo $data['username']; ?>"><br>
    <label for="active">Active</label><br>
    <select name="active">
        <?php if($data['active'] == 1){?>
            <option selected = 'selected 'value="1">1</option>
            <option value='0'>0</option>
       <?php }
       else{?>
            <option selected="selected" value="0">0</option>
            <option value='1'>1</option>
      <?php }
?>
    </select><br><br>
    <input type="submit" value="Submit">

</form>

