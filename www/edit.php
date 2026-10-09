<?php
include "db_conn.php";

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];

// Handle update form submit
if (isset($_POST['update'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name  = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email      = mysqli_real_escape_string($conn, $_POST['email']);
    $gender     = mysqli_real_escape_string($conn, $_POST['gender']);

    $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name',
            email='$email', gender='$gender' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location: edit.php?id=$id&success=updated");
        exit();
    } else {
        $error_msg = "Update failed: " . mysqli_error($conn);
    }
}

// Fetch user by ID
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User – PHP CRUD Application</title>
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

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa fa-circle-check me-2"></i>
                <?php if ($_GET['success'] === 'added'): ?>
                    <strong>สำเร็จ!</strong> เพิ่มผู้ใช้ใหม่เรียบร้อยแล้ว
                <?php else: ?>
                    <strong>สำเร็จ!</strong> อัปเดตข้อมูลเรียบร้อยแล้ว
                <?php endif; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_msg)): ?>
            <div class="alert alert-danger"><?= $error_msg ?></div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa fa-pen-to-square me-2"></i>Edit User</h5>
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
                                   value="<?= htmlspecialchars($user['first_name']) ?>"
                                   placeholder="Enter first name" required>
                        </div>
                        <div class="col">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input type="text" class="form-control" name="last_name"
                                   value="<?= htmlspecialchars($user['last_name']) ?>"
                                   placeholder="Enter last name" required>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" name="email"
                               value="<?= htmlspecialchars($user['email']) ?>"
                               placeholder="Enter email address" required>
                    </div>

                    <!-- Gender -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block">Gender</label>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                                   <?= $user['gender'] === 'male' ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                                   <?= $user['gender'] === 'female' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="other" value="other"
                                   <?= $user['gender'] === 'other' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="other">Other</label>
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fa fa-floppy-disk me-1"></i> Save Changes
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