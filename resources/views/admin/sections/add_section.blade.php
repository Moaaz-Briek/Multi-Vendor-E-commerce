@extends('admin.layout.layout')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin">
                    @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                    @if(Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong> {{Session::get('error_message')}}
                        </div>
                    @endif
                    @if(Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{Session::get('success_message')}} </strong>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                            <h3 class="font-weight-bold mb-2">Add New Section</h3>
                            <h6 class="font-weight-normal"><a href="{{url('admin/sections')}}">Back to Sections</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{url('admin/sections/add-section')}}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="section_name">Section Name</label>
                                        <input type="text" class="form-control" id="section_name" name="section_name" required placeholder="Enter Section Name">

                                    </div>
                                    <div class="form-group">
                                        <label for="section_status">Section Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>

@endsection
