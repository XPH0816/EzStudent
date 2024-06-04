@extends('adminHeader')

@section('content')
    <table id="ordersTable" class="custom-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->orderDate }}</td>
                    <td>{{ $order->totalAmount }}</td>
                    <td>{{ $order->address }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <style>
        /* Custom table style */
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            font-family: Arial, sans-serif;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        .custom-table thead {
            background-color: #f2f2f2;
        }

        .custom-table th {
            background-color: #ddd;
        }

        .custom-table tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>
@endsection
