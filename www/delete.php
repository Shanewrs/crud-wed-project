<?php
include "db_conn.php";

// Validate ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = (int)$_GET['id'];

// Handle confirmed delete
if (isset($_POST['confirm_delete'])) {
    mysqli_query($conn, "DELETE FROM users WHERE id=$id");
    header("Location: index.php?deleted=1");
    exit();
}

// Fetch user info to show on confirmation page
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
    <title>Delete User – PHP CRUD Application</title>
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
        <div class="card shadow-sm">
            <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa fa-trash me-2"></i>Delete User</h5>
                <a href="index.php" class="btn btn-sm btn-outline-light">
                    <i class="fa fa-arrow-left me-1"></i> Back to List
                </a>
            </div>
            <div class="card-body">

                <p class="text-muted mb-4">Are you sure you want to delete this user? This action <strong>cannot be undone</strong>.</p>

                <!-- User summary -->
                <ul class="list-group mb-4">
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="text-muted">Name</span>
                        <strong><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="text-muted">Email</span>
                        <strong><?= htmlspecialchars($user['email']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="text-muted">Gender</span>
                        <strong><?= htmlspecialchars($user['gender']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span class="text-muted">Added on</span>
                        <strong><?= $user['created_at'] ?></strong>
                    </li>
                </ul>

                <form action="" method="post" class="d-flex gap-2">
                    <button type="submit" name="confirm_delete" class="btn btn-danger">
                        <i class="fa fa-trash me-1"></i> Yes, Delete
                    </button>
                    <a href="index.php" class="btn btn-outline-secondary">
                        <i class="fa fa-xmark me-1"></i> Cancel
                    </a>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
