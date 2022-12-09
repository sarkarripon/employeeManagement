<?php
require_once("../../controller/e");
$EmployeeReadFromDatabase = new EmployeeController();
$rows = $EmployeeReadFromDatabase->EmployeeReadFromDatabase();
//echo "<pre>"; print_r($rows);
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <?php if (isset($_SESSION['success_msg'])): ?>
                <span style="color:green"><?php echo $_SESSION['success_msg']; unset($_SESSION['success_msg']); ?><br></span>
            <?php endif; ?>
            <div class="row mb-2">
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Salary input field</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="controller/salary/SalaryController.php" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="emid">Employee</label>
                                    <select id="month" class="form-control" name="emid">
                                        <option value="" selected readonly>Select employee</option>
                                        <?php foreach ($rows as $row):?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['fname']. " ". $row['lname'];?></option>
                                        <?php endforeach;?>

                                    </select>
                                </div>
                                <?php if (isset($_SESSION['error_message']['emErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['emErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" name="amount" value="" placeholder="30000">
                                </div>
                                <?php if (isset($_SESSION['error_message']['amountErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['amountErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="year">Year</label>
                                    <input type="number" class="form-control" name="year" value="<?php echo date("Y");?>" placeholder="2022">
                                </div>
                                <?php if (isset($_SESSION['error_message']['yearErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['yearErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="month">Month</label>
                                    <select id="month" class="form-control" name="month">
                                        <option value="" selected readonly>Select month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                </div>
                                <?php if (isset($_SESSION['error_message']['monthErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['monthErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea type="" class="form-control" name="note"> </textarea>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row -->
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
