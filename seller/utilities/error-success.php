<!-- alert -->
<?php
if ($error) {
    echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        $error
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
} else if ($success) {
    echo "<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
        $success
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
}
?>