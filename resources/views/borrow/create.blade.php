@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Class')
@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div class="row">
    <div class="col-12 mb-15">
        <div class="card mb-2">
            <div class="card-header text-center bg-success text-white">Student Borrow Books Create Form</div>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-15">
            <div>
                <a href="/admin/borrows" class="btn btn-sm btn-outline-primary">
                    Back
                </a>
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
        <form action="{{ route('borrows.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="card mb-10">
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select id="gender" name="gender" class="form-control" aria-label="Default select example" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Choose Image</label>
                                <div class="input-group">
                                    <input id="image" name="image" class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Phone" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" style="width: 100%; height: 100px; padding: 10px;
                                    font-family: Arial, sans-serif; font-size: 16px; border: 1px solid #ccc;
                                    border-radius: 8px; box-shadow: 1px 1px 5px rgba(59, 59, 59, 0.1); resize: none;"
                                    placeholder="Address..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-20 mt-10">
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="book_id" class="form-label">Book Name</label>
                                <select id="book_id" name="book_id" class="form-control" aria-label="Default select example" required>
                                    <option value="">Select Book Name</option>
                                    @foreach ($books as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="class_id" class="form-label">Class Name</label>
                                <select id="class_id" name="class_id" class="form-control" aria-label="Default select example" required>
                                    <option value="">Select Class name</option>
                                    @foreach ($classes as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-20 mt-10">
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="borrowed_at" class="form-label">Borrowed Date</label>
                                <input type="datetime-local" name="borrowed_at" id="borrowed_at" class="form-control" value="" required>
                            </div>
                            <div class="mb-3">
                                <label for="booking" class="form-label">Booking</label>
                                <input type="number" name="booking" class="form-control" id="booking" value="" required>
                                <input type="hidden" name="status" class="form-control" id="booking" value="0" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label hidden for="returned_at" class="form-label">Returned Date</label>
                                <input hidden type="datetime-local" name="returned_at" class="form-control" value="">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-end">
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
