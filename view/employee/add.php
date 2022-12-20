

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
                            <h3 class="card-title">Add employee</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="controller/employee/EmployeeController.php" method="POST">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fname">First Name*</label>
                                    <input type="text" class="form-control" name="fname" value="" placeholder="John">
                                </div>
                                <?php if (isset($_SESSION['error_message']['fnameErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['fnameErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="lname">Last Name*</label>
                                    <input type="text" class="form-control" name="lname" value="" placeholder="doe">
                                </div>
                                <?php if (isset($_SESSION['error_message']['lnameErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['lnameErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control" name="email" value="" placeholder="mail@mail.com">
                                </div>
                                <?php if (isset($_SESSION['error_message']['emailErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['emailErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="email">Mobile*</label>
                                    <input type="tel" class="form-control" name="mobile" value="" placeholder="01912346789">
                                </div>
                                <?php if (isset($_SESSION['error_message']['mobileErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['mobileErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="email">Address*</label>
                                    <input type="text" class="form-control" name="address" value="" placeholder="Sylhet,BD">
                                </div>
                                <?php if (isset($_SESSION['error_message']['addressErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['addressErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="email">Blood Group*</label>
                                    <input type="text" class="form-control" name="bgroup" value="" placeholder="O+">
                                </div>
                                <?php if (isset($_SESSION['error_message']['bgroupErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['bgroupErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="height">Height* <i style="font-size:10px">in cm</i></label>
                                    <input type="number" class="form-control" name="height" value="" placeholder="56">
                                </div>
                                <?php if (isset($_SESSION['error_message']['heightErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['heightErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="email">Designation*</label>
                                    <input type="text" class="form-control" name="designation" value="" placeholder="Support Engineer">
                                </div>
                                <?php if (isset($_SESSION['error_message']['designationErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['designationErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="team">Team*</label>
                                    <input type="text" class="form-control" name="team" value="" placeholder="Support">
                                </div>
                                <?php if (isset($_SESSION['error_message']['teamErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['teamErr']; ?><br></span>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label for="basicSalary">Basic Salary*</label>
                                    <input type="number" class="form-control" name="basicSalary" value="" placeholder="30000">
                                </div>
                                <?php if (isset($_SESSION['error_message']['basicSalaryErr'])): ?>
                                    <span style="color:red"><?php echo $_SESSION['error_message']['basicSalaryErr']; ?><br></span>
                                <?php endif; ?>

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