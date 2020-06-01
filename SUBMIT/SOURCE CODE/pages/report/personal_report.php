<?php
    $root =  $_SERVER['DOCUMENT_ROOT'];
    if (isset($_SESSION['no'])) {
        $userNo = $_SESSION['no'];
        $type = $_SESSION['type'];
    }else{
        include $root.'/pages/login/login.php';
        return;
    }
?>
<body>
    <div class="container-fluid mt-5">
    <table id="attendance_history" class="table text-center table-bordered">
        <thead class="thead-dark">
            <tr>
                <th scope="col" class="align-middle">Date</th>
                <th scope="col" class="align-middle">Time</th>
                <th scope="col" class="align-middle">Type</th>
                <th scope="col" class="align-middle">Location</th>
                <th scope="col" class="align-middle">Photo</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php
            $root =  $_SERVER['DOCUMENT_ROOT'];
            include $root.'/koneksi.php';
            $data = mysqli_query($koneksi,"CALL get_personal_attendance('$userNo')");
            while($d = mysqli_fetch_array($data)){
            ?>
            <tr>
                <td class="align-middle"><?php echo $d['date']; ?></td>
                <td class="align-middle"><?php echo $d['time']; ?></td>
                <td class="align-middle"><?php echo $d['type']; ?></td>
                <td class="align-middle"><?php echo $d['location']; ?></td>
                <td class="align-middle"><img style="height: 100px" src="uploads/<?php echo $d['file_name']; ?>" alt=""></td>
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
        $('#attendance_history').DataTable(
            {
                dom: 'Blfrtip',
                buttons:[
                            {
                                extend: 'pdf',
                                text: 'PDF',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3]
                                }
                            },
                            {
                                extend: 'print',
                                text: 'print',
                                exportOptions: {
                                    columns: [ 0, 1, 2, 3]
                                }
                            }
                        ],
                "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
                lengthMenu: [[10,50,100,-1],[10,50,100,"ALL"]]
            }
        );
        $('.dt-buttons').addClass("mb-3");
    } );
</script>