<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>

<body>
    <div class="container_qr_code">
        <div class="">


            <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://127.0.0.1:8000/foodie?tableId={{ $id }}%26tableNo={{ $name }}"
                class="card-img-top p-0 qr-image" alt="qr code">

        </div>
    </div>
    

</body>

</html>
