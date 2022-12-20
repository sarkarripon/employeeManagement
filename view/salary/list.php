<?php
include "includes/database/DatabaseConnection.php";
$database = new DatabaseConnection();
$sql    = "SELECT SUM(amount) as totalAmount,emid,ems_users.fname,ems_users.lname FROM ems_salary LEFT JOIN ems_users ON ems_users.id=ems_salary.emid GROUP BY emid";
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
                      <th >Employee ID</th>
                      <th>Name</th>
                      <th>Amount</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($rows as $row):?>
                    <tr>
                        <td><?php echo $row['emid']?></td>
                        <td><?php echo $row['fname']." ". $row['lname'];?></td>
                        <td><?php echo $row['totalAmount'];?></td>
                        <td>
                            <a href="index.php?page=single-statement&id=<?php echo $row['emid']?>" >View</a>
                        </td>
                    <?php endforeach;?>
                    </tr>
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