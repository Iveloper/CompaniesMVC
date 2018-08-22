<?php
use App\Auth;
?>
<table class="table table-striped">
    <thead>
    <th>ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>Bulstat</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Note</th>
    <th>Avatar</th>
</thead>

<tbody>
    <?php foreach ($data as $company) { ?>

        <tr>
            <td><?php echo $company['id']; ?></td>
            <td><?php echo $company['name']; ?></td>
            <td><?php echo $company['adress']; ?></td>
            <td><?php echo $company['bulstat']; ?></td>
            <td><?php echo $company['phone']; ?></td>
            <td><?php echo $company['email']; ?></td>
            <td><?php echo $company['note']; ?></td>
            <td><img src="/public/uploads/avatars/ <?php echo Auth::getUserAvatar(); ?>" style="max-width: 60px; border-radius: 89%;"></td>
        </tr>
    <?php } ?>
</tbody>
</table>
