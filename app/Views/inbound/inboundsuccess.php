<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .success-message {
            text-align: center;
        }

        .success-icon {
            font-size: 100px;
            color: #28a745;
            animation: success-animation 1s ease-in-out;
        }

        @keyframes success-animation {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        .btn-custom {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 success-message">
                    <div class="card-body">
                        <i class="fas fa-check-circle success-icon"></i>
                        <h1 class="mt-4">Transaction Successful</h1>
                        <p>Your transaction has been completed successfully.</p>
                        <?php
                        $session = session();
                        $role = $session->get('role_name');
                        $homeUrl = '#'; // Default URL jika role tidak dikenali

                        switch ($role) {
                            case 'admin':
                                $homeUrl = '/admin';
                                break;
                            case 'manager':
                                $homeUrl = '/manager';
                                break;
                            case 'user':
                                $homeUrl = '/staff';
                                break;
                        }
                        ?>
                        <a href="<?= $homeUrl ?>" class="btn btn-custom mt-3">Go to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>