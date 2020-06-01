<!DOCTYPE html>
<html lang="en">
<body>
    <div class="container mt-5">
        <div class="row mx-2">
            <div class="col col-lg-4 col-sm-7 mx-auto p-3 rounded border">
                <h3 class="text-center">LOGIN</h3>
                <form class="p-1" onsubmit="login()">
                    <div class="form-group">
                        <label for="empNo">Employee Number</label>
                        <input type="text" class="form-control" id="empNo" aria-describedby="empNo" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Log In</button>
                    <p id="failText" class="text-danger mb-0 mt-2 d-none">Your login info is incorrect<br>Please try again</p>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    function login() {
        event.preventDefault();
        let empNo = $('#empNo').val();
        let pass = $('#password').val();
        $.ajax({
                type: "POST",
                url: '/pages/login/login_script.php',
                data: "empNo="+empNo+"&pass="+pass,
                success: function(msg) {
                    if (msg==1) {
                        location.reload();
                    }else{
                        $('#failText').removeClass("d-none");
                    }
                }
        })
    }
</script>
</html>