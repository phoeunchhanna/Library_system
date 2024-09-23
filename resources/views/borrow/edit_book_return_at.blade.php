@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Class')
@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div class="row">
    <div class="col-12  mb-15">
        <div class="card mb-2">
            <div class="card-header text-center bg-success text-white">Set Return Date Satatus Form</div>
        </div>
        <div class="d-flex align-items-center justify-content-between  mb-15">
            <div>
                <a href="/admin/borrows" class="btn btn-sm btn-outline-primary">
                   </i>Back</a>
            </div>
      
            
            <div>
                @if(session('success'))
                <div class="text-success text-light card p-2"
                style="background: #089616"
                >
                    {{ session('success') }}
                </div>
                @elseif (session('duplicate'))
                <div class="text-white card p-2"
                    style="background: red"
                    >
                    {{ session('duplicate') }}
                </div>
                @elseif (session('error'))
                    <div class="text-white card p-2"
                    style="background: red"
                    >
                        session('error')
                    </div>
                
                @else
                    <div class="text-white card p-2 "
                    style="background: #4444cc"
                    >
                        Please insert your recond data.
                    </div>
                @endif

 
            </div>

        </div>
    </div>
    <div class="col-12">
        <form  action="{{ url('/admin/classes/update-book-borrow-retrun/' . $borrows->id . '/' .$borrows->name) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <div class="card mb-20 mt-10">
                <div class="col-12 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label for="borrowed_at" class="form-label">Borrowed Date</label>
                                    <input type="datetime-local" name="borrowed_at" id="borrowed_at" class="form-control"  value="{{ $borrows->borrowed_at }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="returned_at" class="form-label">Return Date</label>
                                    <input type="datetime-local"  name="returned_at" class="form-control" id="returned_at"  value="{{ $borrows->returned_at }}" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">                            
                        </div>
                        <div class="col-12 bg-body-secondary  d-flex align-items-end justify-content-end">
                            <div class="mb-12  d-flex align-items-end justify-content-end mt-5">
                                <div style="padding-right: 50px">
                                    <button type="reset" class="btn btn-danger btn-lg me-2">Cancel</button>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
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














