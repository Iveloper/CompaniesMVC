<link rel="stylesheet" href="/public/css/companyadd2.css">   

<form method="post" action="/companysave">

    <input type="hidden" value="<?php echo $data['company']['id']; ?>" name="id" />
    <label for="Name">Name</label><br>
    <input type="text" name="name" value="<?php echo $data['company']['name']; ?>"><br>
    <label for="Adress">Adress</label><br>
    <input type="text" name="adress" value="<?php echo $data['company']['adress']; ?>"><br><br>
    <label for="Bulstat">Bulstat</label><br>
    <input type="text" name="bulstat" value="<?php echo $data['company']['bulstat']; ?>"><br><br>
    <label for="contragentType">Type Of Contragent</label><br>
    <select name="contragent_type">
        <?php
        foreach ($data['contragentType'] as $contragentType) {
            if ($data['company']['contragent_type'] == $contragentType['id']) {
                echo "<option selected='selected' value=" . $contragentType['id'] . ">" . $contragentType['name'] . "</option>";
            } else {
                echo "<option value=" . $contragentType['id'] . ">" . $contragentType['name'] . "</option>";
            }
        }
        ?>
    </select><br><br>
    <label for="Phone">Phone</label><br>
    <input type="text" name="phone" value="<?php echo $data['company']['phone']; ?>"><br><br>
    <label for="Email">Email</label><br>
    <input type="text" name="email" value="<?php echo $data['company']['email']; ?>"><br><br>
    <label for="Note">Note</label><br>
    <input type="text" name="note" value="<?php echo $data['company']['note']; ?>"><br><br>

    <input type="submit" value="Submit">

</form>