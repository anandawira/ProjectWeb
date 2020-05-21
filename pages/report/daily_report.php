<body>
    <div class="container mt-5">
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
                $data = mysqli_query($koneksi,"CALL get_attendance('2020-05-01', '2020-05-20')");
                while($d = mysqli_fetch_array($data)){
                ?>
                <tr>
                    <td class="align-middle"><?php echo $d['employee_no']; ?></td>
                    <td class="text-left align-middle"><?php echo $d['employee_name']; ?></td>
                    <td class="align-middle"><?php echo $d['shift_in']; ?> - <?php echo $d['shift_out']; ?></td>
                    <td class="align-middle"><?php echo $d['full_date']; ?></td>
                    <td class="align-middle"><?php echo $d['in_time']; ?></td>
                    <td class="align-middle"><?php echo $d['out_time']; ?></td>
                    <?php
                        if ($d['in_time']=="No Record") {
                            echo '<td class="align-middle"><div class="bg-danger text-white rounded">Absent</div></td>';
                        }elseif($d['in_time']<$d['shift_in']){
                            echo '<td class="align-middle"><div class="bg-success text-white rounded">Present</div></td>';
                        }else{
                            echo '<td class="align-middle"><div class="bg-warning text-white rounded">Late</div></td>';
                        }
                    ?>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('table').DataTable(
            {
                dom: 'Bfrtip',
                buttons:[
                            'pdf', 'print'
                        ],
                "order": [[ 3, 'asc' ], [ 2, 'asc' ], [ 0, 'asc' ]]
            }
        );
    } );
</script>