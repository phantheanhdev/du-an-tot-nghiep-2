<!DOCTYPE html>
<html>

<head>
    <title>Order Bill</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;

            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1 class="text-center">PHIEU DAT HANG</h1>
                <h4>Ban so: {{ $order->table->name }}</h4>
                <h5>Thoi gian dat: {{ $order->created_at }} </h5>
            </div>
            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Ten mon</th>
                            <th scope="col">So luong</th>
                            <th scope="col">Don gia</th>
                        </tr>
                        <tr>
                            @foreach ($bill as $key => $orderDetail)
                        <tr>
                            <td>
                                @if ($orderDetail->product == null)
                                    <p style="padding: 5px;color:#910400;text-align:left;">
                                        @php
                                            $name = 'Không xác định';
                                        @endphp
                                        {{ convertVietnameseToEnglish($name) }}
                                    </p>
                                @else
                                    {{ convertVietnameseToEnglish($orderDetail->product->name) }} <br>
                                    @if (!empty($orderDetail->item))
                                        @php
                                            $items = json_decode($orderDetail->item, true);
                                            $item1 = json_decode($items);
                                        @endphp
                                        @if ($item1 != null)
                                            @foreach ($item1 as $item)
                                                - {{ convertVietnameseToEnglish($item->name) }} <br>
                                            @endforeach
                                        @endif
                                    @endif
                                @endif

                            </td>
                            <td>
                                {{ $orderDetail->quantity }}
                            </td>
                            <td>
                                {{ number_format($orderDetail->product_price) }}
                            </td>
                        </tr>
                        @endforeach
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
