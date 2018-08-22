<table class="table table-striped">
    <thead>
    <th>Name</th>
    <th>Address</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Company Name</th>
    <th>Company Adress</th>
    <th>Company Phone</th>
    <th>Company Email</th>
</thead>

<tbody>
    <?php foreach ($data as $personRecord)  { ?>

        <tr>
            <td><?php echo $personRecord['name']; ?></td>
            <td><?php echo $personRecord['adress']; ?></td>
            <td><?php echo $personRecord['phone']; ?></td>
            <td><?php echo $personRecord['email']; ?></td>
            <td><?php echo $personRecord['company_name']; ?></td>
            <td><?php echo $personRecord['company_adress']; ?></td>
            <td><?php echo $personRecord['company_phone']; ?></td>
            <td><?php echo $personRecord['company_email']; ?></td>
        </tr>
        
    <?php } ?>
</tbody>
</table>
