@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
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
                        {{-- filter for name --}}
                        @auth
                        @if (auth()->user()->role_id == 1)
                            <form action="{{ route('user.index') }}" method="GET">
                                <label for="all_products">Filter by Orders</label>
                                <input type="checkbox" name="names" value="all_names">
                                <input type="submit" value="Filter">
                            </form>
                        @endif
                    @endauth

                        <table class="table table-bordered">
                            <thead>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Total orders</th>
                                <th>User created</th>
                                <th colspan="2">Actions</th>

                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->orders->count() }}</td>
                                        <td>{{ $user->created_at }}</td>

                                        <td>
                                            {{-- <a class="btn btn-warning" href="{{ route('product.edit', $product->id) }}">EDIT</a> --}}
                                            <form class="d-inline-block" action="{{ route('user.delete', $user->id) }}" method="POST">
                                               @csrf
                                               @method('DELETE')
                                                <button type="submit" class="btn btn-danger" href="{{ route('user.delete', $user->id) }}">DELETE</button>
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
