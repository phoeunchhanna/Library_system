@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Class')
@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div class="row">
    <div class="col-12  mb-15">
        <div class="card mb-2">
            <div class="card-header text-center bg-success text-white">Category Create Form</div>
        </div>
        <div class="d-flex align-items-center justify-content-between  mb-15">
            <div>
                <a href="/admin/categories" class="btn btn-sm btn-outline-primary">
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
        <form  action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Description</label>
                        <textarea maxlength="255" cols="30" rows="10" name="title" class="form-control" id="title" placeholder="Description" required></textarea>
                        </textarea>
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
        </form>
    </div>
</div>

@endsection













