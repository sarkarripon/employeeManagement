<?php

include "includes/database/DatabaseConnection.php";

$id       = $_GET['id'];
$database = new DatabaseConnection();
$sql      = "SELECT * FROM ems_users WHERE id=$id";
$result   = $database->conn->query($sql);
$rows     = mysqli_fetch_assoc($result);


$SalarySql    = "SELECT * FROM ems_salary WHERE emid=$id";
$SalaryResult = $database->conn->query($SalarySql);
$SalaryRows   = $SalaryResult->fetch_all(MYSQLI_ASSOC);
$year         = sprintf($SalaryRows[0]['year']);

$filteredQuery = '';
if (isset($_POST['statementYear'])) {

    if ($_POST['statementYear'] != 'all') {
        $filteredQuery = 'and year=' . $_POST['statementYear'];
    }

}

$totalAmount       = "SELECT SUM(amount) as totalAmount,year FROM ems_salary WHERE emid=$id $filteredQuery GROUP BY year ORDER BY year DESC";
$totalAmountResult = $database->conn->query($totalAmount);
$totalAmountRows   = $totalAmountResult->fetch_all(MYSQLI_ASSOC);

$SalaryPerMonth       = "SELECT month,amount,due,bonus,year FROM ems_salary WHERE emid=$id $filteredQuery GROUP BY year,month ORDER BY year DESC";
$SalaryPerMonthResult = $database->conn->query($SalaryPerMonth);
$SalaryPerMonthRows   = $SalaryPerMonthResult->fetch_all(MYSQLI_ASSOC);

//Net pay query
$netPay           = "SELECT SUM(amount) as netPay FROM ems_salary WHERE emid=$id $filteredQuery";
$netPayResult     = $database->conn->query($netPay);
$netPayResultRows = $netPayResult->fetch_all(MYSQLI_ASSOC);

//Net pay query
$salaryYears       = "SELECT year FROM ems_salary GROUP BY year;";
$salaryYearsResult = $database->conn->query($salaryYears);
$salaryYearsRows   = $salaryYearsResult->fetch_all(MYSQLI_ASSOC);


$myCustomArray = array();
foreach ($SalaryPerMonthRows as $result) {

    $year = $result['year'];
    if (array_key_exists($year, $myCustomArray)) {
        array_push($myCustomArray[$year], (array)$result);
    } else {
        $myCustomArray[$year] = array();
        array_push($myCustomArray[$year], (array)$result);
    }
}
$data = json_decode(json_encode($myCustomArray));

?>

<div class="content-wrapper">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center lh-1 mb-2">
                    <span class="fw-normal">Employee information</span>
                </div>
                <div class="d-flex justify-content-end"><span>Working Team: <?php echo $rows['team']; ?></span></div>
                <div class="d-flex justify-content-end"><span>Address: <?php echo $rows['address']; ?></span></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="fw-bolder">Employee ID:</span> <small
                                            class="ms-3"><?php echo $rows['id']; ?></small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="fw-bolder">Employee Name: </span> <small
                                            class="ms-3"><?php echo $rows['fname'] . " " . $rows['lname']; ?></small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="fw-bolder">NID No: </span> <small class="ms-3">000000000</small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="fw-bolder">Blood group:</span> <small
                                            class="ms-3"><?php echo $rows['bgroup']; ?></small></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div><span class="fw-bolder">Designation:</span> <small
                                            class="ms-3"><?php echo $rows['designation']; ?></small></div>
                            </div>
                            <div class="col-md-6">
                                <div><span class="fw-bolder">Bank Ac No:</span> <small class="ms-3">*******0701</small>
                                </div>
                            </div>
                        </div>

                        <div class=" row d-flex justify-content-end">
                            <form action="" method="POST">
                                <select name="statementYear" id="statementYear">
                                    <option value="" selected disabled>Select year</option>
                                    <option value="all">All</option>
                                    <?php foreach ($salaryYearsRows as $row): ?>
                                        <option value="<?php echo $row['year']; ?>"><?php echo $row['year']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit">✔</button>
                            </form>
                        </div>
                        <br>
                    </div>
                    <div class="row border col-md-12">
                        <div class="row justify-content-center col-md-12">

                            <h6 class="justify-content-center ">Total salary by year:</h6>
                        </div>
                        <br>
                        <ul>
                            <?php foreach ($totalAmountRows as $row): ?>
                                <li><span>Year <?php echo $row['year']; ?>: <?php echo $row['totalAmount']; ?> </span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <br><br>
                    <hr>

                    <?php foreach ($data as $year => $rows): ?>
                        <table class="mt-4 table table-bordered">
                            <thead class="bg-dark text-white">
                            <h6 class="row justify-content-start col-md-12">Year: <?php echo $year; ?></h6>
                            <tr>
                                <th class="text-center" scope="col">Month</th>
                                <th class="text-center" scope="col">Paid amount</th>
                                <th class="text-center" scope="col">Bonus</th>
                                <th class="text-center" scope="col">Due</th>
                                <th class="text-center" scope="col">Net amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $yearEndTotal = 0; ?>
                            <?php $yearEndTotalAmount = 0; ?>
                            <?php $yearEndTotalBonus = 0; ?>
                            <?php $yearEndTotalDue = 0; ?>

                            <?php foreach ($rows as $row): ?>
                                <?php $yearEndTotal = $yearEndTotal + $row->amount; ?>
                                <?php $yearEndTotalBonus = $yearEndTotalBonus + $row->bonus; ?>
                                <?php $yearEndTotalDue = $yearEndTotalDue + $row->due; ?>

                                <tr>
                                    <th scope="row"><?php echo $row->month; ?></th>
                                    <td class="text-center"><?php echo $row->amount; ?></td>
                                    <td class="text-center"><?php echo $row->bonus; ?></td>
                                    <td class="text-center"><?php echo $row->due; ?></td>
                                    <td class="text-center"><?php echo $row->amount; ?></td>
                                </tr
                            <?php endforeach; ?>
                            <tr scope="row">
                                <th scope="row">Year end Total</th>
                                <td class="text-center justify-content-end"><?php echo $yearEndTotal; ?></td>
                                <td class=" text-center justify-content-end"><?php echo $yearEndTotalBonus; ?></td>
                                <td class="text-center"><?php echo $yearEndTotalDue; ?></td>
                                <td class="text-center"><?php echo $yearEndTotal; ?></td>
                            </tr>

                            </tbody>
                        </table>
                    <?php endforeach; ?>

                </div>
                <div class="row">
                    <div class="col-md-4"><br> <span
                                class="fw-bold">Net Pay : <?php echo $netPayResultRows[0]['netPay']; ?>/=</span></div>
                    <div class="border col-md-8">
                        <div class="d-flex flex-column"><span>In Words:</span>
                            <span> <?php echo convertNumberToWords($netPayResultRows[0]['netPay']); ?></span></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex flex-column mt-4"><span class="mt-4">Authorised Signatory</span></div>
                </div>
            </div>
        </div>
    </div>

</div>
</section>


<?php
// number to words converter
function convertNumberToWords($number)
{
    //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
    $words = array(
        '0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five',
        '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten',
        '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fouteen', '15' => 'fifteen',
        '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'fourty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninty');

    //First find the length of the number
    $number_length = strlen($number);
    //Initialize an empty array
    $number_array          = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
    $received_number_array = array();

    //Store all received numbers into an array
    for ($i = 0; $i < $number_length; $i++) {
        $received_number_array[$i] = substr($number, $i, 1);
    }

    //Populate the empty array with the numbers received - most critical operation
    for ($i = 9 - $number_length, $j = 0; $i < 9; $i++, $j++) {
        $number_array[$i] = $received_number_array[$j];
    }

    $number_to_words_string = "";
    //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
    for ($i = 0, $j = 1; $i < 9; $i++, $j++) {
        //"01,23,45,6,78"
        //"00,10,06,7,42"
        //"00,01,90,0,00"
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            if ($number_array[$j] == 0 || $number_array[$i] == "1") {
                $number_array[$j] = intval($number_array[$i]) * 10 + $number_array[$j];
                $number_array[$i] = 0;
            }

        }
    }

    $value = "";
    for ($i = 0; $i < 9; $i++) {
        if ($i == 0 || $i == 2 || $i == 4 || $i == 7) {
            $value = $number_array[$i] * 10;
        } else {
            $value = $number_array[$i];
        }
        if ($value != 0) {
            $number_to_words_string .= $words["$value"] . " ";
        }
        if ($i == 1 && $value != 0) {
            $number_to_words_string .= "Crores ";
        }
        if ($i == 3 && $value != 0) {
            $number_to_words_string .= "Lakhs ";
        }
        if ($i == 5 && $value != 0) {
            $number_to_words_string .= "Thousand ";
        }
        if ($i == 6 && $value != 0) {
            $number_to_words_string .= "Hundred &amp; ";
        }

    }
    if ($number_length > 9) {
        $number_to_words_string = "Sorry This does not support more than 99 Crores";
    }
    return ucwords(strtolower($number_to_words_string) . " Bangladeshi taka only.");
}

