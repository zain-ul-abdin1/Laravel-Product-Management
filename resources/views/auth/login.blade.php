@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class = "alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email"class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Login</button>
                            <a href="/products" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>

                    <div class="mt-3">
                        <p>Don't have an account? <a href="/register">Register here</a></p>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
