@extends('back.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Students')
@section('content')
    <div class="container-fluid">

        <div class="row">

            
            <div class="col-12">
                <div class="card mb-2 ">
                    <div class="card-header text-center bg-success text-white">authors Application </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-6 mb-2">
                        <div class="col-6">
                            <form class="d-flex align-items-center">
                                <input name="search" type="search" class="form-control form-control-sm mr-2" placeholder="Search" aria-controls="DataTables_Table_0">
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="" id="deleteAllSelectRecord" class="btn btn-danger btn-sm ml-2 text-sm-center p-2">
                             Delete All Selected
                        </a>
                        <a href="/admin/authors/create" class="btn btn-success btn-sm ml-2 text-sm-center p-2">
                            Add New courses
                        </a>
                    </div>
                </div>
                
                
                <table class="data-table table stripe hover nowrap dataTable collapsed" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr role="row">
                            <th class="table-plus sorting_1" tabindex="0">
                                <input type="checkbox" name=""  id="select_all_ids"  value="">
                            </th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">ID</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Name</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Gender</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Nationality</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($authors as $item)
                        <tr role="row" class="odd">
                            <td class="table-plus sorting_1" tabindex="0">
                                <input type="checkbox" name="ids"  class="checkbox_ids" id="" value="{{ $item->id  }}">
                            </td>
                            <td class="table-plus sorting_1" tabindex="0">BBU0{{ $item->id }}</td>                        
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->name }}</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->gender }}</td>   
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->Nationality }}</td>                          

                            <td class="text-center">
                               <div class="d-flex align-items-center justify-between p-0">
                               
                                <a href="{{ url('/admin/books/auhtor-detail/' . $item->id . '/' . $item->name) }}" 
                                    style="border-radius: 10%; border: 1px solid #0a3acb; 
                                   background-color: #0a3acb; color: white; padding: 3px 5px; 
                                   font-size: 8px; cursor: pointer; transition: all 0.3s ease;"
                                    >
                                    <i class='bx bxs-show' style="font-size: 18px;"></i>
                                </a>
                                 &nbsp; &nbsp;
                                <a href="{{ url('/admin/authors/edit/' . $item->id . '/' . strtolower(str_replace(' ', '-', trim($item->name)))) }}" 
                                    style="border-radius: 10%; border: 1px solid #21D192; 
                                   background-color: #21D192; color: white; padding: 3px 5px; 
                                   font-size: 8px; cursor: pointer; transition: all 0.3s ease;"
                                    
                                    >
                                    <i class='bx bx-edit'  style="font-size: 18px;"></i>
                                </a>
                                
                                &nbsp; &nbsp;

                                <form class="d-inline"  method="POST" action="{{ url('/admin/authors/delete/'. $item->id) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this author? <{{ $item->name }}>')">
                                   @csrf
                                   @method('DELETE')
                                   <button style="border-radius: 10%; border: 1px solid #ff4d4d; 
                                   background-color: #ff4d4d; color: white; padding: 3px 5px; 
                                   font-size: 8px; cursor: pointer; transition: all 0.3s ease;" type="submit">
                                      <i class='bx bx-trash' style="font-size: 18px;"></i>
                                  </button>
                               </form>
                                                    


                                </form>
                                </div>                          
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center ">
                    <nav aria-label="Page navigation example ">
                        <ul class="pagination ">
                            <li class="page-item {{ $authors->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $authors->previousPageUrl() ?? '#' }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for($i = 1; $i <= $authors->lastPage(); $i++)
                                <li class="page-item {{ $i === $authors->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $authors->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $authors->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $authors->nextPageUrl() ?? '#' }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
            </div>
            
        </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <script>
        $(function() {
            $("#select_all_ids").click(function() {
                $('.checkbox_ids').prop('checked', $(this).prop('checked'));
            });
        });
    </script>
    
@endsection