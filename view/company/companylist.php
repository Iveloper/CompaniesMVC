<a href="/companyadd"><button type="button" class="btn btn-primary">Add</button></a>


<form method='GET' class="form-horizontal" action='/companylist?search'>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchCompany[name]" placeholder="Search by Name.." value="<?php
        setFilterValue('name');
        ?>">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchCompany[adress]" placeholder="Search by Adress.." value="<?php
        setFilterValue('adress');
        ?>">
    </div>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchCompany[bulstat]" placeholder="Search by Bulstat.." value="<?php
        setFilterValue('bulstat');
        ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-info">Search</button>
    </div>
</form>

<table class="table table-striped">
    <thead>
    <th><a href="/companylist?sort=id&order=<?php $order; ?>">ID</a></th>
    <th><a href="/companylist?sort=name&order=<?php echo $order; ?>">Name</a></th>
    <th><a href="/companylist?sort=adress&order=<?php echo $order; ?>">Adress</a></th>
    <th><a href="/companylist?sort=bulstat&order=<?php echo $order; ?>">Bulstat</a></th>
    <th></th>
    <th></th>
    <th></th>
</thead>

<tbody>
    <?php foreach ($companies as $company) { ?>

        <tr style="background-color: lightgrey">
            <td><?php echo $company['id']; ?></td>
            <td><a href="/displayperson?id=<?php echo $company['id'] ?>"><?php echo $company['name']; ?></a></td>
            <td><?php echo $company['adress']; ?></td>
            <td><?php echo $company['bulstat']; ?></td>
            <td><a href="/companyrecord?id=<?php echo $company['id'] ?>"><button type="submit" class="btn btn-info">Info</button></a></td>
            <td><a href="/companyedit?id=<?php echo $company['id'] ?>"><button type="submit" class="btn btn-warning">Edit</button></a></td>
            <td><button type="submit" onclick="deleteCompany(event)" class="btn btn-danger"><a href="/companydelete?id=<?php echo $company['id'] ?>">Delete</a></button></td>
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
                    <a href="/companylist?page=<?php
                    echo $i;

                    if (isset($_GET['searchCompany']) && $_GET['searchCompany']) {
                        foreach ($_GET['searchCompany'] as $column => $filterValue) {
                            echo "&searchCompany[$column]=" . $filterValue . "";
                        }
                    }
                    ?>">
                           <?php echo $i; ?>
                    </a>
                </li>


            <?php }
            ?>
        </ul>
        <form method="GET" action="/companylist">
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