<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Student</title>
</head>

<body>
    <h1>Delete Student</h1>
    <?php if (isset($error)) : ?>
        <p><?= $error ?></p>
    <?php else : ?>
        <p>Student deleted successfully.</p>
    <?php endif; ?>
    <a href="index.php">Back to Students</a>
</body>

</html>