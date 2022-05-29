@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Orders') }}
                        <a class="btn btn-primary" href="{{ route('order.create') }}">Create new Order</a>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @auth
                            @if (auth()->user()->role_id == 1)
                                <form action="{{ route('order.index') }}" method="GET">
                                    <label for="all_products">Show all Orders</label>
                                    <input type="checkbox" name="all_orders" value="all">
                                    <input type="submit" value="Filter">
                                </form>
                            @endif
                        @endauth

                        <table class="table table-bordered">
                            <thead>
                                <th>Order Id</th>
                                <th>Products</th>
                                <th>Order Amount</th>
                                <th>Order Created</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>
                                            @foreach ($order->products as $product)
                                                {{ $product->name }};
                                            @endforeach
                                        </td>
                                        <td>{{ $order->order_amount }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>
                                            <a class="btn btn-warning"
                                                href="{{ route('order.edit', $order->id) }}">EDIT</a>
                                            @if (auth()->user()->role_id == 1)
                                                <form class="d-inline"
                                                    action="{{ route('order.delete', $order->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                                </form>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
