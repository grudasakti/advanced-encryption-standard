<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Encryption Standard</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="card bg-light mt-5 w-50 mx-auto">
            <h5 class="card-header text-center">Advanced Encryption Standard</h5>
            <div class="card-body">
                <form method="POST">
                    <div class="form-group row">
                        <label for="text" class="col-sm-2 col-form-label">Text</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="text" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $data = isset($_POST['text']) ? $_POST['text'] : '';

    //Define cipher 
    $cipher = "aes-256-cbc";

    //Generate a 256-bit encryption key 
    $encryption_key = openssl_random_pseudo_bytes(32);

    // Generate an initialization vector 
    $iv_size = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($iv_size);

    //Data to encrypt 
    $encrypted_data = openssl_encrypt($data, $cipher, $encryption_key, 0, $iv);

    //Decrypt data 
    $decrypted_data = openssl_decrypt($encrypted_data, $cipher, $encryption_key, 0, $iv);

    echo '
        <div class="container mt-5">
            <table class="table table-bordered table-striped table-dark w-50 mx-auto">
                <tr>
                    <th colspan="2" class="text-center">Output</th>
                </tr>
                <tr>
                    <td>Plain Text</td>
                    <td>' . $data . '</td>
                </tr>
                <tr>
                    <td>Encrypted Text</td>
                    <td>' . $encrypted_data . '</td>
                </tr>
                <tr>
                    <td>Decrypted Text</td>
                    <td>' . $decrypted_data . '</td>
                </tr>
            </table>
        </div>
    ';
}
?>