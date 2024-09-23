@extends('back.layout.pages-layout')
@section('pageTitle', @isset($pageTitle) ? $pageTitle : 'Borrow Books')
@section('content')
    <div class="container-fluid">

        <div class="row">

            
            <div class="col-12">
                <div class="card mb-2 ">
                    <div class="card-header text-center bg-success text-white">Students Borrowed Books Application </div>
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
                        <a href="/admin/borrowed/create" class="btn btn-success btn-sm ml-2 text-sm-center p-2">
                            Add New borrowed
                        </a>
                    </div>
                </div>
                
                
                <table class="data-table table stripe hover " id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                    <thead>
                        <tr role="row">
                            <th class="table-plus sorting_1" tabindex="0">
                                <input type="checkbox" name=""  id="select_all_ids"  value="">
                            </th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">ID</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Image</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Name</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Gender</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Address</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Phone</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Book</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Class</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Booking</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Borrow At</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Return At</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Status</th>
                            <th class="table-plus datatable-nosort sorting_asc" rowspan="1" colspan="1" aria-label="Name">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($borrowed as $item)
                  
                        <tr role="row" class="odd">
                            <td class="table-plus sorting_1" tabindex="0">
                                <input type="checkbox" name="ids"  class="checkbox_ids" id="" value="{{ $item->id  }}">
                            </td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->id }}</td> 
                                         
                            <td class="table-plus sorting_1" tabindex="0">
                                @if($item->image)
                                    <img src="{{ asset('photo/borrow/' . $item->image) }}" 
                                    style="width: 50px; height: 50px; border-radius:5px;">
                                @else
                                No Image
                           
                                @endif                    
                            </td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->name }}</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->gender }}</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->address }}</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->phone }}</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->book->name }}</td> 
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->class->name }}</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->booking }}៛</td>
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->borrowed_at }}</td> 
                            <td class="table-plus sorting_1" tabindex="0">{{ $item->returned_at }}</td>
                            <td class="table-plus sorting_1" tabindex="0">
                               {{-- @if($item->status == 1)
                                    <a href="javascript:void(0)" title="returned" id="status{{ $item->id }}"
                                    onclick="status('{{ $item->id }}', '{{ $item->status }}')"
                                        >Returned</a>
                               @else

                                <a href="javascript:void(0)" title="borrowed" id="status{{ $item->id }}"
                                onclick="status('{{ $item->id }}', '{{ $item->status }}')"
                                >Borrowed</a>
                                @endif --}}
                                <form action="{{ url('/admin/borrows/status-update/' . $item->id) }}" method="post">
                                    @csrf
                                    @method('PATCH')

                                @if($item->status == 1)
                                    <input  class="btn btn-sm bg-primary text-light"
                                    type="submit" value="Returned">
                                @else
                                    
                                    <input class="btn btn-sm bg-danger text-light"
                                     type="submit" value="Borrowed">
                                    
                                @endif
                                
                            </form>
                            </td>

                           
                
    
                            
                            
                                               
                           
                            <td class="text-center">
                               <div class="d-flex align-items-center justify-between p-0"> 
                                
                                
                                
                                  
                                  <a  href="{{ url('/admin/classes/edit-book-borrow-retrun/' 
                                  . $item->id . '/' . strtolower(str_replace(' ', '-', trim($item->name)))) }}"
                                  class="badge badge-pill" data-bgcolor="#e7ebf5" data-color="#265ed7"
                                   style="color: rgb(38, 94, 215); background-color: rgb(231, 235, 245);"
                                   >Set date</a>
                                &nbsp; &nbsp;
                            

                                <a href="{{ url('/admin/student/borrows/' . $item->id . '/' . $item->name) }}" 
                                    style="border-radius: 10%; border: 1px solid #0a3acb; 
                                   background-color: #0a3acb; color: white; padding: 3px 5px; 
                                   font-size: 8px; cursor: pointer; transition: all 0.3s ease;"
                                    >
                                    <i class='bx bxs-show' style="font-size: 18px;"></i>
                                </a>
                                
                                &nbsp; &nbsp;
                               
                                <a href="{{ url('/admin/borrows/edit/' . $item->id . '/' . strtolower(str_replace(' ', '-', trim($item->name)))) }}" 
                                    style="border-radius: 10%; border: 1px solid #21D192; 
                                   background-color: #21D192; color: white; padding: 3px 5px; 
                                   font-size: 8px; cursor: pointer; transition: all 0.3s ease;"
                                    
                                    >
                                    <i class='bx bx-edit'  style="font-size: 18px;"></i>
                                </a>
                                
                                &nbsp; &nbsp;

                                <form class="d-inline"  method="POST" action="{{ url('/admin/borrowed/delete/'. $item->id) }}"
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
                            <li class="page-item {{ $borrowed->previousPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $borrowed->previousPageUrl() ?? '#' }}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            @for($i = 1; $i <= $borrowed->lastPage(); $i++)
                                <li class="page-item {{ $i === $borrowed->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $borrowed->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $borrowed->nextPageUrl() ? '' : 'disabled' }}">
                                <a class="page-link" href="{{ $borrowed->nextPageUrl() ?? '#' }}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                
            </div>
            
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"  />
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
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




       function status(id, status){
        
        var stp = document.getElementById('status' + id).title;
        alert(stp)

        if(stp == 'returned'){
            st == 0;
        }
        if(stp == 'borrowed'){
            st == 1;
        }
        $.ajax({
            url: "/admin/borrowed/status-update/" + id + "/" + st,
            

            success: function(response){
                if(response.status == "1"){
                    alert(response.status);
                    document.getElementById('status' + id).title = "Returned";
                }
                if(response.status == "0"){
                    alert(response.status);
                    document.getElementById('status' + id).title = "Borrowed";
                }
            }
        })



        
       }

    </script>

@endsection
