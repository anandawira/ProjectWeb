<body>
    <div class="container mt-4 text-center">
        <h1 class="display-1"><i class="fas fa-times-circle text-danger"></i></h1>
        <h2 class="font-weight-normal">You need to use admin account to access this page.</h2>
        <button type="button" onclick="logout()" class="btn btn-success mt-4">Log In with Admin Account</button>
    </div>
</body>
<script>
    function logout() {
      event.preventDefault();
      $.ajax({
              type: "GET",
              url: '/pages/login/logout_script.php',
              success: function(msg) {
                location.reload();
              }
      })
    }
  </script>
</html>