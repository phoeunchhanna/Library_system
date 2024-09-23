@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create User')

@section('content')
<div class="row">
    <div class="col-12 mb-15">
        <div class="card mb-2">
            <div class="card-header text-center bg-success text-white">Create Users</div>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-15">
            <div>
                <a href="{{ url('/admin/users') }}" class="btn btn-sm btn-outline-primary">Back</a>
            </div>
            

            <div>
                @if(session('success'))
                    <div class="text-success text-light card p-2" style="background: #089616">
                        {{ session('success') }}
                    </div>
                @elseif (session('duplicate'))
                    <div class="text-white card p-2" style="background: red">
                        {{ session('duplicate') }}
                    </div>
                @elseif (session('error'))
                    <div class="text-white card p-2" style="background: red">
                        {{ session('error') }}
                    </div>
                @else
                    <div class="text-white card p-2" style="background: #4444cc">
                        Please insert your record data.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Name" name="name" value="" required>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Email" name="email" value="" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-lg" placeholder="Password" name="password" value="" required>
                    </div>
                    <div class="mb-3">
                        <select id="usertype" name="usertype" class="form-control" aria-label="Default select example" required>
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <div class="input-group">
                            <input name="image" class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                <div class="col-12 bg-body-secondary d-flex align-items-end justify-content-end">
                    <div class="mb-12 d-flex align-items-end justify-content-end mt-5">
                        <div style="padding-right: 50px">
                            <button type="reset" class="btn btn-danger btn-lg me-2">Cancel</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
