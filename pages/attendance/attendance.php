<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script
      src="https://kit.fontawesome.com/5fd5318cab.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <h2 class="mt-4 text-center">ATTENDANCE</h2>
    <div class="container-lg">
        <div class="row">
            <div class="col-lg pr-2 p-3">
                <div class="table-responsive border rounded p-2">
                <table class="table table-borderless h5 font-weight-normal m-0">
                    <?php
                        $root =  $_SERVER['DOCUMENT_ROOT'];
                        include $root.'/koneksi.php';    
                        $data = mysqli_query($koneksi,"CALL get_employee('100010')");
                        $koneksi->next_result();
                        $d = mysqli_fetch_assoc($data)
                    ?>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $d['full_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Employee Number</td>
                            <td>:</td>
                            <td><?php echo $d['no']; ?></td>
                        </tr>
                        <tr>
                            <td>Department</td>
                            <td>:</td>
                            <td><?php echo $d['department']; ?></td>
                        </tr>
                        <tr>
                            <td>Position</td>
                            <td>:</td>
                            <td><?php echo $d['position']; ?></td>
                        </tr>
                        <tr>
                            <td>Shift</td>
                            <td>:</td>
                            <td><?php echo $d['in_time']; ?> WIB - <?php echo $d['out_time']; ?> WIB</td>
                        </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-lg p-3">
                <form>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="uploadPhoto">Upload photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="uploadPhoto" name="photo" required>
                                    <label class="custom-file-label" for="uploadPhoto">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <select class="form-control" id="location">
                                <?php
                                    $data1 = mysqli_query($koneksi,"CALL get_locations");
                                    while($locations = mysqli_fetch_assoc($data1)){
                                ?>
                                    <option value="<?php echo $locations['id']; ?>"><?php echo $locations['name']; ?></option>
                                <?php
                                    }
                                    $koneksi->next_result();
                                ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" maxlength="200" id="notes"></textarea>
                    </div>
                    <div class="d-sm-flex flex-row justify-content-around">
                        <button type="button" class="btn btn-primary btn-lg p-3" onclick="insertData(<?php echo $d['no']; ?>, 'in')"><i class="fas fa-sign-in-alt"></i>   Check In </button>
                        <button type="button" class="btn btn-danger btn-lg p-3" onclick="insertData(<?php echo $d['no']; ?>, 'out')"><i class="fas fa-sign-out-alt"></i>   Check Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function insertData(int, str) {
        const fileExt = $('#uploadPhoto').val().split('.').pop();
        if (fileExt!="") {
            const empId = int;
            const locId = $('#location').val();
            const notes = $('#notes').val();
            const fileName = int+"_"+Date.now();
            const type = str;

            var formData = new FormData($('form')[0]);
            formData.append('uniqName', fileName);
            $.ajax({
                type: "POST",
                url: '/pages/attendance/script/upload_file_script.php',
                data: formData,
                success: function(data) {
                    if (data!="") {
                        alert(data)
                    }else{
                        $.ajax({
                            type: "POST",
                            url: '/pages/attendance/script/attendance_script.php',
                            data: "empId="+empId+"&locId="+locId+"&notes="+notes+"&fileName="+fileName+"."+fileExt+"&type="+type,
                            success: function(data) {
                                $('main').load('pages/attendance/success.php');
                            }
                        })
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            })
        }else{
            alert("Please upload a photo");
        }
    }
    $('#uploadPhoto').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName.replace('C:\\fakepath\\', " "));
            })
    </script>
</body>
</html>