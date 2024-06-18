<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Divs with Transition</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .large-holder {
            border-radius: 8px;
            padding: 15px;
            background-color: var(--bs-white);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .large-holder:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .large-icon {
            font-size: 2em;
            color: var(--bs-pink);
        }

        .large-text {
            font-size: 1.25em;
            font-weight: bold;
            color: var(--bs-black);
        }

        .row {
            align-items: center;
        }
    </style>
</head>
<body>

<div class="col-12 py-3 bg-light d-sm-block d-none">
    <div class="row">
        <div class="col-lg-3 col ms-auto large-holder">
            <div class="row">
                <div class="col-auto ms-auto large-icon mt-2">
                    <i class="fas fa-money-bill"></i>
                </div>
                <div class="col-auto me-auto large-text">
                    Harga terbaik
                </div>
            </div>
        </div>
        <div class="col-lg-3 col large-holder">
            <div class="row">
                <div class="col-auto ms-auto large-icon mt-2">
                    <i class="fas fa-truck-moving"></i>
                </div>
                <div class="col-auto me-auto large-text">
                    Pengiriman cepat
                </div>
            </div>
        </div>
        <div class="col-lg-3 col me-auto large-holder">
            <div class="row">
                <div class="col-auto ms-auto large-icon mt-2">
                    <i class="fas fa-check"></i>
                </div>
                <div class="col-auto me-auto large-text">
                    Produk Asli
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
