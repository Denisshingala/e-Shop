<?php
if ($error) { ?>
    <center>
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Error!</strong> <?php echo $error; ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </center>
<?php } else if ($success) { ?>
    <center>
    <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Successfully!</strong> <?php echo $success; ?>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
    </center>
<?php } ?>