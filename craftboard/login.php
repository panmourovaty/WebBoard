<!DOCTYPE html>
<html lang="en">

<head>
<?php
    include 'common.php';
?>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa-solid fa-cube me-2"></i>CraftBoard</h3>
                            </a>
                            <h3>Log in</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="username" class="form-control" id="floatingInput" placeholder="username" required>
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Log in</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
</body>

</html>