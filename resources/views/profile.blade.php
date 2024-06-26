@extends('layouts.main-layout-user')
@section('title', 'Profile | Dashboard Sales Performance & Racing Doors SKU')

@section('content')
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
                <div class="card w-100">
                    <div class="card-header m-0 font-weight-bold text-primary text-center">
                        USER PROFILE
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control" id="password" value="{{ $user->password }}" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
