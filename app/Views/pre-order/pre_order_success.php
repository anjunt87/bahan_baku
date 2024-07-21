<!DOCTYPE html>
<html>

<head>
    <title>Pre-Order Success</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-container {
            text-align: center;
            padding: 50px;
        }

        .checkmark {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            position: relative;
            display: inline-block;
            border: 5px solid #4CAF50;
            border-radius: 50%;
            background: #fff;
            animation: scale 0.5s ease-in-out;
        }

        .checkmark::after {
            content: "";
            position: absolute;
            top: 10px;
            left: 35%;
            width: 50px;
            height: 100px;
            border: solid #4CAF50;
            border-width: 0 10px 10px 0;
            transform: rotate(45deg);
            animation: checkmark 0.5s ease-in-out;
        }

        @keyframes scale {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes checkmark {
            0% {
                transform: rotate(45deg) scale(0);
            }

            100% {
                transform: rotate(45deg) scale(1);
            }
        }

        .message {
            font-size: 24px;
            color: #4CAF50;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="success-container">
            <div class="checkmark"></div>
            <div class="message">
                Pre-Order Anda telah berhasil diproses!
            </div>
            <a href="<?= base_url('/items') ?>" class="btn btn-success mt-4">Back to Items</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>