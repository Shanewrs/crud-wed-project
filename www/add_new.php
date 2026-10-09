<?php
include "db_conn.php";

// Handle form submit
if (isset($_POST['submit'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name  = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);

    $sql = "INSERT INTO users (first_name, last_name, email, gender)
            VALUES ('$first_name', '$last_name', '$email', '$gender')";

    if (mysqli_query($conn, $sql)) {
        $new_id = mysqli_insert_id($conn);
        header("Location: edit.php?id=$new_id&success=added");
        exit();
    } else {
        $error_msg = "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User – PHP CRUD Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { background-color: #f0f4f8; }
    </style>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: aliceblue;">
        PHP CRUD Application
    </nav>

    <div class="container" style="max-width: 640px;">

        <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa fa-user-plus me-2"></i>Add New User</h5>
                <a href="index.php" class="btn btn-sm btn-outline-light">
                    <i class="fa fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body">
                <form action="" method="post">

                    <!-- First Name + Last Name -->
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label fw-semibold">First Name</label>
                            <input type="text" class="form-control" name="first_name"
                                   placeholder="กรอกชื่อจริง" required>
                        </div>
                        <div class="col">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input type="text" class="form-control" name="last_name"
                                   placeholder="กรอกนามสกุล" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email"
                               placeholder="กรอกอีเมล" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fa fa-save me-1"></i> Submit
                        </button>
                        <a href="index.php" class="btn btn-outline-secondary">
                            <i class="fa fa-xmark me-1"></i> Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>