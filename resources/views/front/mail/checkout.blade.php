<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .section {
            border-bottom: 1px solid #e0e0e0;
        }

        .section:last-child {
            border-bottom: none;
        }

        .section-header {
            background: #838385;
            color: #ffffff;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
        }

        .section-content {
            padding: 20px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 15px;
        }

        .myrow {
            display: flex;
            gap: 30px;
            margin-bottom: 15px;
        }

        .row label {
            font-weight: bold;
            color: #555;
        }

        .row span {
            color: #333;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #e0e0e0;
            padding: 12px;
            text-align: left;
        }

        .table th {
            background: #838385;
            color: #ffffff;
        }

        .table td {
            background: #f9fafb;
        }

        .text-right {
            text-align: right;
        }

        .highlight {
            background: #fef3c7;
            font-weight: bold;
        }

        .section-content img {
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 600px) {
            .row {
                flex-direction: column;
                align-items: flex-start;
            }

            .myrow {
                flex-direction: column;
                gap: 15px;
            }

            .row label {
                margin-bottom: 5px;
            }

            .table th,
            .table td {
                font-size: 0.9em;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Customer Details -->
        <div class="section">
            <div class="section-header">Customer Detail</div>
            <div class="section-content myrow">
                <div>
                    <div class="row">
                        <label>Full Name:</label>
                        <span>{{ $maildata[1]->name ?? $maildata[2]->fullname }}</span>
                    </div>
                    <div class="row">
                        <label>Email:</label>
                        <span>{{ $maildata[1]->email ?? $maildata[2]->email }}</span>
                    </div>
                    <div class="row">
                        <label>Mobile No.:</label>
                        <span>{{ $maildata[1]->mobileno ?? $maildata[2]->mobile }}</span>
                    </div>
                </div>
                <div style="">
                    <div class="row">
                        <label>State:</label>
                        <span> {{ $maildata[1]->statename ?? $maildata[2]->statename }}</span>
                    </div>
                    <div class="row">
                        <label>District:</label>
                        <span>{{ $maildata[1]->district ?? $maildata[2]->district }}</span>
                    </div>
                    <div class="row">
                        <label>Gender:</label>
                        <span>{{ $maildata[1]->gender ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details -->
        <div class="section">
            <div class="section-header">Order Detail</div>
            <div class="section-content">
                <div class="row">
                    <label>Order ID:</label>
                    <span>{{ $maildata[0][0]->order_id }}</span>
                </div>
                <div class="row">
                    <label>Order Date:</label>
                    <span>{{ $maildata[0][0]->created_at }}</span>
                </div>
                <div class="row">
                    <label>Order Status:</label>
                    <span>{{ $maildata[0][0]->status }}</span>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sn =1;
                            $tamunt = 0;
                            foreach($maildata[0] as $order) {
                            $cdate = explode(' ',$order->created_at);
                            ?>
                        <tr>
                            <td class="image" data-title="No"><img width="50" height="50"
                                    src="{{ asset($order->product_image) }}">
                            </td>
                            <td class="product-des" data-title="Description">{{ $order->product_name }}</td>
                            <td class="price"><span>{{ moneyFormat($order->price) }} </span></td>
                            <td class="text-center qty">{{ $order->total_no_qnty }}</td>
                            <td class="total-amount" data-title="Total">
                                <span>{{ moneyFormat($order->total_amt) }}</span>
                            </td>

                        </tr>
                        <?php 
                        $tamunt = $tamunt + $order->total_amt;
                        $sn++; } ?>

                        <tr>
                            <td colspan="3">&nbsp; </td>
                            <td>&nbsp;Total @if (!$order->use_point)
                                    Amount
                                @endif :</td>
                            <td class="total-amount" data-title="Total"><b>{{ moneyFormat($tamunt) }}</b></td>
                        </tr>
                        @if ($order->use_point)
                            <tr>
                                <td colspan="3">&nbsp; </td>
                                <td>&nbsp;Point Use :</td>
                                <td class="total-amount" data-title="Total">
                                    <b>{{ moneyFormat($order->use_point ?? 0) }}</b>
                                </td>
                            </tr>

                            <tr class="highlight">
                                <td colspan="3">&nbsp; </td>
                                <td>&nbsp;Total Amount :</td>
                                <td class="total-amount" data-title="Total">
                                    <b>{{ moneyFormat($tamunt - $order->use_point ?? 0) }}</b>
                                </td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Delivery Address -->
        <div class="section">
            <div class="section-header">Delivery Address</div>
            <div class="section-content">
                <div class="row">
                    <label>Full Name:</label>
                    <span>{{ $maildata[2]->fullname }}</span>
                </div>
                <div class="row">
                    <label>Email:</label>
                    <span>{{ $maildata[2]->email }}</span>
                </div>
                <div class="row">
                    <label>Mobile No.:</label>
                    <span>{{ $maildata[2]->mobile }}</span>
                </div>
                <div class="row">
                    <label>State:</label>
                    <span>{{ $maildata[2]->statename }}</span>
                </div>
                <div class="row">
                    <label>District:</label>
                    <span>{{ $maildata[2]->district }}</span>
                </div>
                <div class="row">
                    <label>Tole:</label>
                    <span> {{ $maildata[2]->tole }}</span>
                </div>
                <div class="row">
                    <label>Gaupalika:</label>
                    <span>{{ $maildata[2]->gaupalika }}</span>
                </div>
                <div class="row">
                    <label>Nagarpalika :</label>
                    <span>{{ $maildata[2]->nagarpalika }}</span>
                </div>
                <div class="row">
                    <label>Ward no :</label>
                    <span>{{ $maildata[2]->wardno }} </span>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
