@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Class')
@section('content')
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<div class="row">
    <div class="col-12  mb-15">
        <div class="card mb-2">
            <div class="card-header text-center bg-success text-white">Book Create Form</div>
        </div>
        <div class="d-flex align-items-center justify-content-between  mb-15">
            <div>
                <a href="/admin/books" class="btn btn-sm btn-outline-primary">
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
                       {{  session('error') }}
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
        <form  action="{{ url('/admin/books/update/'. $books->id . '/' . $books->name) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ $books->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select id="category_id"  name="category_id" class="form-control" aria-label="Default select example" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $books->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                             @endforeach                      
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Choose Image</label>
                        <div class="input-group"> 
                            <input id="image" name="image" " class="form-control" type="file" id="formFile">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="author_id" class="form-label">Author</label>
                        <select id="author_id"  name="author_id" class="form-control" aria-label="Default select example" required>
                            @foreach($authors as $item)
                                <option value="{{ $item->id }}" {{ $item->id == $books->author_id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                             @endforeach      
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="personalize" class="form-label">Personalize</label>
                        <select id="personalize"  name="personalize" class="form-control" aria-label="Default select example" required>
                            <option value="New" {{ $books->personalize == 'New' ? 'selected' : '' }}>New</option>
                            <option value="Old" {{ $books->personalize == 'Old' ? 'selected' : '' }}>Old</option>
                        </select>
                    </div>
                    <div class="me-3 mt-4">
                        <img src="{{ asset('photo/book/' . $books->image) }}" 
                            style="width: 80px; height: 80px; border-radius: 5px;" 
                            alt="Current Image">
                    </div>
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














