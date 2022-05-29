@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('Products') }}
                        <a class="btn btn-secondary" href="{{ route('product.create') }}">Create Product</a>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if ($message = Session::get('danger'))
                            <div class="alert alert-danger">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <form action="{{ route('product.index') }}" method="GET">
                            <label for="by_order">Show Products without Orders</label>
                            <input type="checkbox" name="by_order" value="no_orders">
                            <input type="submit" value="Show all products">
                        </form>

                        <table class="table table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Ordered</th>
                                <th colspan="2">Actions</th>

                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->price }}</td>
                                        <td>{{ $product->orders->count() }}</td>
                                        <td><a class="btn btn-warning"
                                                href="{{ route('product.edit', $product->id) }}">EDIT</a>
                                            <form class="d-inline-block" action="{{ route('product.delete', $product->id) }}" method="POST">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-danger" href="{{ route('product.delete', $product->id) }}">DELETE</button>
                                            </form>
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
