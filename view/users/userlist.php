<a href="/useradd"><button type="button" class="btn btn-primary">Add</button></button></a>
<form method='GET' class="form-horizontal" action='/userlist?search'>
    <div class="col-md-2">
        <input type="text" class="form-control" name="searchUser[username]" placeholder="Search by Name.." value="<?php
        setFilterValue('username');
        ?>">
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-info">Search</button>
    </div>
</form>
<table class="table table-striped">
    <thead>
    <th>Avatar</th>
    <th><a href="/userlist?sort=id&order=<?php echo $orderUser; ?>">ID</a></th>
    <th><a href="/userlist?sort=username&order=<?php echo $orderUser; ?>">Name</a></th>
    <th><a href="/userlist?sort=active&order=<?php echo $orderUser; ?>">Active</a></th>
    <th></th>
    <th></th>
</thead>

<tbody>
    <?php foreach ($sort as $user) { ?>

        <tr style="background-color: lightgrey">
            <td><img src="/public/uploads/avatars/ <?php echo $user['avatar']; ?>" style="width: 45px; max-height: 40px; border-radius: 89%;"></td>
            <td><?php echo $user['id']; ?></td>
            <td><a href="/userrecord?id=<?php echo $user['id'] ?>"><?php echo $user['username']; ?></a></td>
            <td>
                <?php if ($user['active'] == 1) { ?>
                    <div id="active">
                        <a href="/userdelete?id=<?php echo $user['id'] ?>"><i class="fa fa-check-circle"></i></a>
                    </div>
                <?php } else {
                    ?>
                <a href="/useractivate?id=<?php echo $user['id'] ?>"<i id = "not-active" class="fa fa-circle"></i></a>
                <?php }
                ?>
            </td>

            <td><a href="/useredit?id=<?php echo $user['id'] ?>"><button type="submit"  class="btn btn-warning">Edit</button></a></td>
            <td><a href="/avatarupload?id=<?php echo $user['id'] ?>"><button type="submit"  class="btn btn-info">Upload Avatar</button></a></td>
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
                    <a href="/userlist?page=<?php
                    echo $i;
                    if (isset($_GET['searchUser']) && $_GET['searchUser']) {
                        foreach ($_GET['searchUser'] as $column => $filterValue) {
                            echo "&searchUser[$column]=" . $filterValue . "";
                        }
                    }
                    ?>">
                           <?php echo $i; ?>
                    </a>
                </li>


            <?php }
            ?>
        </ul>
        <form method="GET" action="/userlist">
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