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
    <?php
        include '../../koneksi.php';
    ?>
        <div class="table-responsive mt-2">
            <table class="table table-hover mx-auto m-0 w-auto text-center">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="text-center">No</th>
                    <th scope="col">Department ID</th>
                    <th scope="col">Department Name</th>
                    <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>101</td>
                        <td>Finance</td>
                        <td class="py-0 align-middle">
                            <button type="button" class="btn btn-secondary btn-sm mx-1">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm mx-1">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>102</td>
                        <td>Marketing</td>
                        <td class="py-0 align-middle">
                        <button type="button" class="btn btn-secondary btn-sm mx-1">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm mx-1">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>103</td>
                        <td>Production</td>
                        <td class="py-0 align-middle">
                        <button type="button" class="btn btn-secondary btn-sm mx-1">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm mx-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
</body>
</html>