<?php
function dateFormat($date)
{
    $date = date_create($date);
    return date_format($date, 'm-d-Y');
}

function getTotal($item)
{
    $total = $item['unit_price'] * $item['quantity'];

    return '₱ ' . number_format((float) $total, 2, '.', '');
}

$index = 0;

?>

<!DOCTYPE html>
<html>

<head>
    <title>Export PDF TEST</title>
    <style>
        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif
        }

        .logo__container {
            display: flex;
            justify-content: center;
            vertical-align: middle;
            align-items: center;
        }

        .report__title {
            text-align: center;
        }

        .report__container {
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
        }

        .report__table {
            width: 100%;
        }

        .report__table th {
            text-align: left;
        }

        .report__table td {
            padding: 0 6px;
        }
    </style>
</head>

<body class="bg-red">
    <div class="logo__container">
        <x-logo> </x-logo>
        <h1 class="logo__text">
            JML Printing Press
        </h1>
    </div>
    <h2 class="report__title">Supply Report</h2>
    <div class="report__container">
        <div class="report__heading-container">
            <h4>{{ $supply['supplier']['name'] }}</h4>
            <p>{{ $supply['number'] }}</p>
        </div>
        <table class="report__table">
            <tbody>
                <tr>
                    <td>Supplier:</td>
                    <td>{{  $supply['supplier']['name'] }}</td>
                    <td>Total Items:</td>
                    <td>{{ $supply['total_items'] }}</td>
                    <td>Total Cost:</td>
                    <td>{{ $supply['total'] }}</td>
                </tr>
                <tr>
                    <td>Supply #:</td>
                    <td>{{ $supply['number'] }}</td>
                    <td>Date Received:</td>
                    <td>{{ dateFormat($supply['created_at']) }}</td>
                    <td>Date Last Updated:</td>
                    <td>{{ dateFormat($supply['updated_at']) }}</td>
                </tr>
                <tr>
                    <td>Notes:</td>
                    <td colspan="4">{{ $supply['notes'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="report__container">
        <table class="report__table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>BRAND</th>
                    <th>ITEM</th>
                    <th>UNIT COST</th>
                    <th>QUANTITY</th>
                    <th>SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supply['supply_items'] as $item)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $item['inventory_item']['number'] }}</td>
                        <td>{{ $item['inventory_item']['brand']['name'] }}</td>
                        <td>{{ $item['inventory_item']['name'] }}</td>
                        <td> ₱ {{ $item['unit_price'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ getTotal($item) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
