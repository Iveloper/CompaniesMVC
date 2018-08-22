<form method="post" action="/personsave">
    
    <label for="Name">Name</label><br>
    <input type="text" name="name" value=""><br>
    <label for="adress">Adress</label><br>
    <input type="text" name="adress" value=""><br><br>
    <label for="phone">Phone</label><br>
    <input type="text" name="phone" value=""><br><br>
    <label for="email">Email</label><br>
    <input type="text" name="email" value=""><br><br>
    <label for="contragentType">Company</label><br>
    <select name="company_id">
        <?php
            foreach ($companies as $company){
                
                echo "<option value=" . $company['id'] . ">". $company['name'] ."</option>";
            }
        ?>
    </select><br><br>

    <input type="submit" value="Submit">

</form>

<?php
echo App\FlashMessage::getMessage();
?>