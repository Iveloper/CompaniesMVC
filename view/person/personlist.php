
<a href="/personadd"><button type="button" class="btn btn-primary">Add</button></button></a>
<form method='GET' class="form-horizontal" action='/personlist?search'>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchPerson[name]" placeholder="Search by Name.." value="<?php
        setFilterValue('name');
        ?>">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchPerson[adress]" placeholder="Search by Adress.." value="<?php
        setFilterValue('adress');
        ?>">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchPerson[phone]" placeholder="Search by Phone.." value="<?php
        setFilterValue('phone');
        ?>">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchPerson[email]" placeholder="Search by Email.." value="<?php
        setFilterValue('email');
        ?>">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchPerson[companyname]" placeholder="Search by Company.." value="<?php
        setFilterValue('companyname');
        ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-info">Search</button>
    </div>
</form>

<table class="table table-striped">
    <thead>
    <th><a href="/personlist?sort=id&order=<?php echo $orderPerson; ?>">ID</a></th>
    <th><a href="/personlist?sort=name&order=<?php echo $orderPerson; ?>">Name</a></th>
    <th><a href="/personlist?sort=adress&order=<?php echo $orderPerson; ?>">Adress</a></th>
    <th><a href="/personlist?sort=phone&order=<?php echo $orderPerson; ?>">Phone</a></th>
    <th><a href="/personlist?sort=email&order=<?php echo $orderPerson; ?>">Email</a></th>
    <th><a href="/personlist?sort=company_name&order=<?php echo $orderPerson; ?>">Company</a></th>
    <th></th>
    <th></th>
</thead>

<tbody>
    <?php foreach ($sort as $person) { ?>

        <tr style="background-color: lightgrey">
            <td><?php echo $person['id']; ?></td>
            <td><a href="/personrecord?id=<?php echo $person['id'] ?>"><?php echo $person['name']; ?></a></td>
            <td><?php echo $person['adress']; ?></td>
            <td><?php echo $person['phone']; ?></td>
            <td><?php echo $person['email']; ?></td>
            <td><?php echo $person['company']; ?></td>

            <td><a href="/personedit?id=<?php echo $person['id'] ?>"><button type="submit"  class="btn btn-warning">Edit</button></a></td>
            <td><button type="submit" onclick="deleteCompany(event)" class="btn btn-danger"><a href="/persondelete?id=<?php echo $person['id'] ?>">Delete</a></button></td>
        </tr>
    <?php } ?>
</tbody>
</table>
<div class="flexItems">
<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php
        $totalR = $total[0]['total'];
        $count = ceil(($totalR - $perPage) / $perPage) + 1;
        for ($i = 1; $i <= $count; $i++) {
            ?>
            <li>
                <a href="/personlist?page=<?php
                echo $i;
                if (isset($_GET['searchPerson']) && $_GET['searchPerson']) {
                        foreach ($_GET['searchPerson'] as $column => $filterValue) {
                            echo "&searchPerson[$column]=" . $filterValue . "";
                        }
                    }
                ?>">
                       <?php echo $i; ?>
                </a>
            </li>


        <?php }
        ?>
    </ul>
    <form method="GET" action="/personlist">
        <select name="option">
            <?php
            $perPageOptions = [5, 10, 15, 20];
            foreach ($perPageOptions as $perPageOption) {
                if ($perPageOption == $perPage) {
                    echo '<option selected="selected" value="' . $perPageOption . '" >' . $perPageOption . '</option>';
                } else {
                    echo '<option value="' . $perPageOption . '" >' . $perPageOption . '</option>';
                }
            }
            ?>
        </select>
        <input type="submit"class="btn btn-info"></button>
    </form>
    <div><h4>Total Rows: <?php echo $totalR; ?></h4></div>
</div>
</nav>