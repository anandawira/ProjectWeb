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
    <?php
        $root = dirname(dirname(dirname(__FILE__)));
    ?>
    <h2 class="text-center mt-5 mb-0">DEPARTMENT MASTER DATA</h2>
    <div class="container-sm p-0 mb-5">
    <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm mb-2 float-right"><i class="fas fa-plus"></i>  Add</button>
        <div class="table-responsive">
            <table class="table table-hover mx-auto m-0  text-center">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="align-middle">No</th>
                    <th scope="col" class="align-middle">Department Name</th>
                    <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include $root.'/koneksi.php';    
                        $no = 1;
                        $data = mysqli_query($koneksi,"CALL get_departments");
                        while($d = mysqli_fetch_array($data)){
                    ?>
                        <tr>
                            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
                            <td class="align-middle"><?php echo $d['name']; ?></td>
                            <td class="py-1 align-middle">
                                <button type="button" class="btn btn-secondary btn-sm mx-1"><i class="fas fa-edit"></i>  Edit</button>
                                <button type="button" class="btn btn-danger btn-sm mx-1"><i class="fas fa-trash-alt"></i>  Delete</button>
                            </td>
                        </tr>

                    <?php 
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="insert_form">
                    <label for="departmentName">Department Name</label>
                    <input type="text" required name="departmentName" id="departmentName" class="form-control">
                    <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-success mt-2 btn-sm">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#insert_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: 'crud_department/insert_department.php',
                method: "POST",
                data: $('#insert_form').serialize()
            })
        })
    })
    </script>
</body>
</html>