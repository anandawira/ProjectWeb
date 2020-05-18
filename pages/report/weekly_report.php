<body>
    <div class="container mt-5">
        <table class="table text-center table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">18-May</th>
                    <th scope="col">19-May</th>
                    <th scope="col">20-May</th>
                    <th scope="col">21-May</th>
                    <th scope="col">22-May</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row" class="align-middle">Ananda</th>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-warning h2 m-0"></i><br>Late</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-times-circle text-danger h2 m-0"></i><br>Absent</td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle">Wira</th>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-times-circle text-danger h2 m-0"></i><br>Absent</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                </tr>
                <tr>
                    <th scope="row" class="align-middle">Dharma</th>
                    <td class="align-middle"><i class="fas fa-times-circle text-danger h2 m-0"></i><br>Absent</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                    <td class="align-middle"><i class="fas fa-check-circle text-success h2 m-0"></i><br>Present</td>
                </tr>
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
                        ]
            }
        );
    } );
</script>