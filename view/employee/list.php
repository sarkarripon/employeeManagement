<?php

include "includes/database/DatabaseConnection.php";
$database = new DatabaseConnection();
$sql    = "SELECT * FROM $database->table_employinfo where role='member'";
$result = $database->conn->query($sql);
$rows   = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Employee ID</th>
                                    <th>Name</th>
                                    <th>Team</th>
                                    <th>Basic Salary</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($rows as $row):?>
                                <tr>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['fname']." ". $row['lname'];?></td>
                                    <td><?php echo $row['team'];?></td>
                                    <td><?php echo $row['basicSalary'];?></td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>