@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Class')
@section('content')

<div class="row">
    <div class="col-12  mb-15">
        <div class="card mb-2">
            <div class="card-header text-center bg-success text-white">Classes Form</div>
        </div>
        <div class="d-flex align-items-center justify-content-between  mb-15">
            <div>
                <a href="/admin/classes" class="btn btn-sm btn-outline-primary">
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
                <div class="text-light card p-2"
                    style="background: red"
                    >
                    {{ session('duplicate') }}
                </div>
                @elseif (session('error'))
                    <div class="text-light card p-2"
                    style="background: red"
                    >
                        session('error')
                    </div>
                @else
                    <div class="text-white card p-2 "
                    style="background: #4444cc"
                    >
                        Please update your recond data.
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-12">
        <form  action="{{ url('/admin/classes/update/' .$classes->id .'/' .$classes->name) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PATCH")

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $classes->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Description</label>
                        <textarea cols="30" rows="10" name="title" class="form-control" id="title" required>{{ $classes->title }}</textarea>
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
                            <button type="submit" class="btn btn-primary"
                                   >Submit</button>
                        </div>
                    </div>
                </div>
               
            </div>
        </form>
    </div>
</div>

@endsection














