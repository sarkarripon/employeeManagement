<?php
include "includes/database/DatabaseConnection.php";
$base_url = "http://localhost/sarkar/php/Exercise/oopems/";
$database = new DatabaseConnection();

//for emid query
$sql    = "SELECT emid,ems_users.fname,ems_users.lname FROM ems_salary LEFT JOIN ems_users ON ems_users.id=ems_salary.emid group by emid";
$result = $database->conn->query($sql);
$rows   = $result->fetch_all(MYSQLI_ASSOC);

// for year query
$sqlYaer    = "SELECT year FROM ems_salary GROUP by year";
$resultYaer = $database->conn->query($sqlYaer);
$rowsYaer   = $resultYaer->fetch_all(MYSQLI_ASSOC);

// for month query
$sqlMonth    = "SELECT month FROM ems_salary GROUP by month";
$resultMonth = $database->conn->query($sqlMonth);
$rowsMonth   = $resultMonth->fetch_all(MYSQLI_ASSOC);

// for month query
$sqlDue    = "SELECT due FROM ems_salary GROUP by due";
$resultDue = $database->conn->query($sqlDue);
$rowsDue   = $resultDue->fetch_all(MYSQLI_ASSOC);

$emidQuery  = '';
$yearQuery  = '';
$monthQuery = '';
$dueQuery = '';
$bonusQuery = '';
$where = '';
$and = '';

if(isset($_POST['has_filters'])) {
    if (isset($_POST['emid']) && $_POST['emid'] != 'all' ||
        isset($_POST['byYear']) && $_POST['byYear'] != 'all' ||
        isset($_POST['byMonth']) && $_POST['byMonth'] != 'all' ||
        isset($_POST['byStatus']) && $_POST['byStatus'] != 'all') {
        $where = 'WHERE';
    }
    if (isset($_POST['emid'])) {
        if ($_POST['emid'] != 'all') {
            if (isset($_POST['byYear']) || isset($_POST['byMonth'])) {
                $and       = 'AND';
                $emidQuery = 'emid=' . $_POST['emid'];
            }
            $emidQuery = 'emid=' . $_POST['emid'];
        }
    }
    if (isset($_POST['byYear'])) {
        if ($_POST['byYear'] != 'all' && !isset($_POST['byMonth'])) {
            if (isset($_POST['emid']) || isset($_POST['byMonth'])) {
                $and       = 'AND';
                $yearQuery = $and . ' year=' . $_POST['byYear'];
            }
        }
        if ($_POST['byYear'] == 'all') {
            $yearQuery = '';
        } else {
            $yearQuery = $and . ' year=' . $_POST['byYear'];
        }
    }
    if (isset($_POST['byMonth'])) {

        if (isset($_POST['byMonth']) && empty($_POST['byYear'])) {

            $_SESSION['yearRequired']= "Select YEAR to check MONTH for specific year.";
        }

        if ($_POST['byMonth'] != 'all') {
            if (isset($_POST['emid']) || isset($_POST['byYear'])) {
                $and = 'AND';
            }
        }
        if ($_POST['byMonth'] == 'all') {
            $monthQuery = '';
        } else {
            $monthQuery = $and . " month='" . $_POST['byMonth'] . "'";
        }
    }
    if (isset($_POST['byStatus'])) {
        if ($_POST['byStatus'] != 'all') {
            if (isset($_POST['byYear']) || isset($_POST['byMonth']) || isset($_POST['emid'])) {
                $and       = 'AND';
            }
            if ($_POST['byStatus'] == 'due'){
                $dueQuery = $and.' due';
            }
            if( $_POST['byStatus'] == 'bonus'){
                $bonusQuery = $and.' bonus';
            }
        }
    }
}
//all filter query
$sqlFilter = "SELECT ems_salary.*,ems_users.fname,ems_users.lname,ems_users.basicSalary FROM ems_salary LEFT JOIN ems_users ON ems_users.id=ems_salary.emid $where $emidQuery $yearQuery $monthQuery $dueQuery $bonusQuery";
//echo "<p style='text-align:center'>".$sqlFilter."</p>";
$resultFilter = $database->conn->query($sqlFilter);
$rowsFilter   = $resultFilter->fetch_all(MYSQLI_ASSOC);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <form action="" method="POST">
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Statement Filter</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>By Name</label>
                                    <select name="emid" class="form-control select2" style="width: 100%;">
                                        <option disabled selected>Select name</option>
                                        <option value="all">All</option>
                                        <?php foreach ($rows as $row): ?>
                                            <option value="<?php echo $row['emid']; ?>"><?php echo $row['fname'] . " " . $row['lname']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>By Year</label>
                                    <select name="byYear" class="form-control select2" style="width: 100%;">
                                        <option disabled selected>Select year</option>
                                        <option value="all" >All</option>
                                        <?php foreach ($rowsYaer as $year): ?>
                                            <option value="<?php echo $year['year']; ?>"><?php echo $year['year']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>By Month</label>
                                    <select name="byMonth" class="form-control select2" style="width: 100%;">
                                        <option disabled selected>Select month</option>
                                        <option value="all">All</option>
                                        <?php foreach ($rowsMonth as $month): ?>
                                            <option value="<?php echo $month['month']; ?>"><?php echo $month['month']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>By Payment status</label>
                                    <select name="byStatus" class="form-control select2" style="width: 100%;">
                                        <option selected disabled>Select status</option>
                                        <option value="all">All</option>
                                        <option value="due">Due</option>
                                        <option value="bonus">Bonus</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-tools float-lg-right">
                            <div class="input-group-append">
                                <button type="submit" name="has_filters" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-tools float-lg-left">
                            <div class="input-group-append">
                                <button type="submit" name="" class="btn btn-default">
                                    <i>Reset filter</i>
                                </button>
                            </div>
                        </div>
                        <p class="text-center" style="color: red"><?php echo isset($_SESSION['yearRequired']) ? $_SESSION['yearRequired'] : "";?></p>
                        <?php unset($_SESSION['yearRequired']);?>
                    </div>
                </div>
    </form>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Statement</h3>
                    <br>
                    <p>
                        <?php
                        if (isset($_POST['emid'])){
                            echo "Filtered by ID: ".$_POST['emid'];
                            unset($_POST['emid']);
                        } if (isset($_POST['byYear'])){
                            echo "  By year = ". $_POST['byYear'];
                            unset($_POST['byYear']);
                        }
                        if (isset($_POST['byMonth'])){
                            echo "  By month = ". $_POST['byMonth'];
                        }
                        if (isset($_POST['byStatus'])){
                            echo "  By status = ". $_POST['byStatus'];
                        }
                        ?>
                    </p>
                </div>

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Year</th>
                            <th>Month</th>
                            <th>Basic Salary</th>
                            <th>Bonus</th>
                            <th>Due</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rowsFilter as $filter):?>
                        <tr>
                            <td><?php echo $filter['fname'] . " " . $filter['lname']; ?></td>
                            <td><?php echo $filter['year']; ?></td>
                            <td><?php echo $filter['month']; ?></td>
                            <td><?php echo $filter['basicSalary']; ?></td>
                            <td><?php echo $filter['bonus']; ?></td>
                            <td><?php echo $filter['due']; ?></td>
                            <td><?php echo $filter['amount']; ?></td>

                        </tr>
                        <?php endforeach;?>

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>


</div>

</section>


</div>

