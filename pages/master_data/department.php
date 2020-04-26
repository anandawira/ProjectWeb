<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department</title>
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
      crossorigin="anonymous"
    />
    <script
      src="https://kit.fontawesome.com/5fd5318cab.js"
      crossorigin="anonymous"
    ></script>
</head>
<body>
    <h2 class="text-center mt-5 mb-0">DEPARTMENT MASTER DATA</h2>
    <div class="container-sm p-0 mb-5">
    <button type="button" class="btn btn-primary btn-sm mb-2 float-right"><i class="fas fa-plus"></i>  Add</button>
        <div class="table-responsive">
            <table class="table table-hover mx-auto m-0  text-center">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="align-middle">No</th>
                    <th scope="col" class="align-middle">Department ID</th>
                    <th scope="col" class="align-middle">Department Name</th>
                    <th scope="col" class="align-middle">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $koneksi = mysqli_connect("localhost","root","","absensikaryawan");
                        $no = 1;
                        $data = mysqli_query($koneksi,"select * from department");
                        while($d = mysqli_fetch_array($data)){
                    ?>
                        <tr>
                            <th class="align-middle" scope="row"><?php echo $no++; ?></th>
                            <td class="align-middle"><?php echo $d['id']; ?></td>
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
</body>
</html>