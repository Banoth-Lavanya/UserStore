@extends('layouts/main')
@section('page_title')All Customers @endsection

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    @if ($customers->isEmpty())
        <p class="errors error">No customers found.</p>
    @else
    <div class="products-container">
        <h1>All Customers</h1>
        <table class="table dataTable display table table-striped table-bordered dt-responsive" id="customersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Products</th>
                    <th>Price</th> <!-- New Price Column -->
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    @php
                        $totalPrice = $customer->products->sum('price'); // Calculate total price of products
                    @endphp
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->role }}</td>
                        <td>
                            @if ($customer->products->isEmpty())
                                No products
                            @else
                                <ul>
                                    @foreach ($customer->products as $product)
                                        <li>{{ $product->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>${{ number_format($totalPrice, 2) }}</td> <!-- Display total price -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <!-- Back Button -->
    <!-- <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to Products</a> -->
</div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {
        $('#customersTable').DataTable({
            // Optional: Customize DataTables options here
            paging: true,
            searching: true,
            ordering: true,
            pageLength: 10, // Number of records per page
            lengthMenu: [5, 10, 25, 50, 100] // Dropdown menu for page length
        });
    });
</script>
@endsection
