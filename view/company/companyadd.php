
<form method="post" action="/companysave">
    <label for="Name">Name</label><br>
    <input type="text" name="name" value="<?php echo App\FlashMessage::getData('name') ?>"><br>
    <label for="adress">Adress</label><br>
    <input type="text" name="adress" value=""><br><br>
    <label for="bulstat">Bulstat</label><br>
    <input type="text" name="bulstat" value=""><br><br>
    <label for="contragentType">Type Of Contragent</label><br>
    <select name="contragent_type">
        <?php
        foreach ($data as $contragentType) {
            echo "<option value=" . $contragentType['id'] . ">" . $contragentType['name'] . "</option>";
        }
        ?>
    </select><br><br>
    <label for="phone">Phone</label><br>
    <input type="text" name="phone" value=""><br><br>
    <label for="email">Email</label><br>
    <input type="text" name="email" value=""><br><br>
    <label for="note">Note</label><br>
    <input type="text" name="note" value=""><br><br>

    <input type="submit" value="Submit">

</form>