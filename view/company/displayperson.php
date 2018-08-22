<table class="table table-striped">
    <thead>
    <th>Name</th>
    <th>Adress</th>
    <th>Email</th>
    <th>Phone</th>
</thead>

<tbody>
    <?php foreach ($data as $company) { ?>

        <tr>

            <td><?php echo $company['name']; ?></td>
            <td><?php echo $company['adress']; ?></td>
            <td><?php echo $company['email']; ?></td>
            <td><?php echo $company['phone']; ?></td>
            
            
        </tr>
    <?php } ?>
</tbody>
</table>
