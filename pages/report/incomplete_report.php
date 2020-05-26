<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    if (isset($_SESSION['no'])) {
        $userNo = $_SESSION['no'];
        $type = $_SESSION['type'];
        if ($type!='Admin') {
            include $root.'/pages/login/need_admin.php';
            return;
        }
    }else{
        include $root.'/pages/login/login.php';
        return;
    }
?>
<body>
    <div class="container-fluid mt-5">
        <?php
            if (isset($_GET['startdate']) && isset($_GET['enddate'])) {
                ?>
                <table class="table text-center table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" class="align-middle">Employee<br>No</th>
                            <th scope="col" class="align-middle">Employee<br>Name</th>
                            <th scope="col" class="align-middle">Shift<br>Schedule</th>
                            <th scope="col" class="align-middle">Attendance<br>Date</th>
                            <th scope="col" class="align-middle">In</th>
                            <th scope="col" class="align-middle">Out</th>
                            <th scope="col" class="align-middle">Attendance<br>Status</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $root =  $_SERVER['DOCUMENT_ROOT'];
                        include $root.'/koneksi.php';   
                        $startdate = $_GET['startdate'];
                        $enddate = $_GET['enddate'];
                        $data = mysqli_query($koneksi,"CALL get_attendance('$startdate', '$enddate')");
                        while($d = mysqli_fetch_array($data)){
                            if ($d['in_time']=="No Record" xor $d['out_time']=="No Record") {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $d['employee_no']; ?></td>
                            <td class="text-left align-middle"><?php echo $d['employee_name']; ?></td>
                            <td class="align-middle"><?php echo $d['shift_in']; ?> - <?php echo $d['shift_out']; ?></td>
                            <td class="align-middle"><?php echo $d['full_date']; ?></td>
                            <td class="align-middle"><?php echo $d['in_time']; ?></td>
                            <td class="align-middle"><?php echo $d['out_time']; ?></td>
                            <?php
                                if ($d['in_time']=="No Record" and $d['out_time']=="No Record") {
                                    echo '<td class="align-middle"><div class="bg-danger text-white rounded">Absent</div></td>';
                                }elseif ($d['in_time']=="No Record" or $d['out_time']=="No Record") {
                                    echo '<td class="align-middle"><div class="bg-dark text-white rounded">Incomplete Record</div></td>';
                                }elseif($d['in_time']<$d['shift_in']){
                                    echo '<td class="align-middle"><div class="bg-success text-white rounded">Present</div></td>';
                                }else{
                                    echo '<td class="align-middle"><div class="bg-warning text-white rounded">Late</div></td>';
                                }
                            ?>
                        </tr>
                        <?php
                        }
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            }else{
                ?>
                <div class="row justify-content-center">
                    <form class="p-2 mb-3 col col-lg-4" onsubmit="saveDate()">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="name">Start Date</label>
                                    <input type="text" class="form-control datepicker" id="start-date"required>
                                </div>
                            </div>
                                <div class="col">
                                    <div class="form-group">
                                    <label for="name">End Date</label>
                                    <input type="text" class="form-control datepicker" id="end-date"required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="submit" name="datepick-submit" id="datepick-submit" value="Show" class="btn btn-success btn-sm">
                            </div>
                        </div>
                    </form>
                </div>
                <?php
            }
        ?>
        
        
    </div>
</body>
<script>
    function saveDate() {
        event.preventDefault();
        const start = $('#start-date').val();
        const end = $('#end-date').val();
        if (end>start) {
            window.location = '?page=incomplete_report&startdate='+start+'&enddate='+end;
        }else{
            alert("end date must be after start date!")
        }
        
        // alert($('#start-date').val());
        // window.location.href = "/?start=haha";
    }
    $(document).ready(function() {
        $('table').DataTable(
            {
                dom: 'Blfrtip',
                buttons:[
                            {
                                extend: 'pdf',
                                text: 'PDF',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                                }
                            },
                            {
                                extend: 'print',
                                text: 'print',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3, 4, 5, 7 ]
                                }
                            }
                        ],
                "order": [[ 3, 'asc' ], [ 2, 'asc' ], [ 0, 'asc' ]],
                lengthMenu: [[10,50,100,-1],[10,50,100,"ALL"]]
            }
        );
        $('.dt-buttons').addClass("mb-3");
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );
</script>