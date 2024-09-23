<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Students</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
</head>

<body>
    <div class="container mt-5">
        <div class="row align-items-center">
            <div class="col">
                <h1>Students</h1>
            </div>
            <div class="col text-right">
                <a href="index.php?action=create" class="btn btn-success">Add Student</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td>
                            <?php if (!empty($student['image_path'])) : ?>
                                <img src="<?= $student['image_path'] ?>" alt="Student Image" class="img-thumbnail" style="max-width: 100px;">
                            <?php else : ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td><?= $student['name'] ?></td>
                        <td><?= $student['email'] ?></td>
                        <td>
                            <a href="index.php?action=update&id=<?= $student['id'] ?>" class="btn btn-primary btn-sm">Update</a>
                            <a href="index.php?action=delete&id=<?= $student['id'] ?>" class="btn btn-danger btn-sm btn-delete">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    // JavaScript code here
    document.addEventListener('DOMContentLoaded', function() {
        // Get all delete buttons
        var deleteButtons = document.querySelectorAll('.btn-delete');

        // Attach click event listener to each delete button
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Show SweetAlert confirmation modal
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this student record!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms deletion, proceed with deletion
                        window.location.href = button.getAttribute('href');
                    }
                });
            });
        });
    });
</script>


</html>