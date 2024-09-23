<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Student</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Update Student</h5>
                        <?php if (isset($error)) : ?>
                            <p><?= $error ?></p>
                        <?php endif; ?>

                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $student['id'] ?>">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" class="form-control" value="<?= $student['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" value="<?= $student['email'] ?>">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="image_path" value="<?= $student['image_path'] ?>" />

                                <?php if (!empty($student['image_path'])) : ?>
                                    <img name="image_path" id="currentImage" src="<?= $student['image_path'] ?>" alt="Student Image" class="img-thumbnail" style="max-width: 100px;">
                                <?php else : ?>
                                    No Image
                                <?php endif; ?>
                            </div>
                            <div class="form-group">


                                <input type="file" name="new_image" id="new_image" accept="image/*" onchange="previewImage(event)"><br><br>


                            </div>


                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var currentImage = document.getElementById('currentImage');
                currentImage.src = reader.result; // Replace the current image with the new one
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>