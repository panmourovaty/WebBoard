<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include 'common.php';
    ?>
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa-solid fa-cube me-2"></i>WebBoard</h3>
                            </a>
                            <h3>Log in</h3>
                        </div>
                        <form action="login-verify.php" method="post">
                            <h6 class="mb-4">User Name:</h6>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <br>
                            <h6 class="mb-4">Password:</h6>
                            <input type="password" class="form-control" id="password" name="password" required><br>
                            <select style="width: 150px; display: inline;" class="form-select mb-3" name="lang" id="lang">
                                <option value="en_US" selected>English</option>
                                <?php
                                if ($handle = opendir('./lang')) {
                                    while (false !== ($entry = readdir($handle))) {
                                        if ($entry != "." && $entry != ".." && $entry != "en_US.php") {
                                            include 'lang/' . $entry;
                                            echo '<option value="' . $lang['langcode'] . '">' . $lang['langname'] . '</option>';
                                        }
                                    }

                                    closedir($handle);
                                }
                                ?>
                            </select>
                            <button style="float: right;" type="submit" class="btn btn-primary">Log in</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>