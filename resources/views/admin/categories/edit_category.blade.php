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
                            <h3 class="font-weight-bold mb-3"></h3>
                            <h6 class="font-weight-normal mb-0">Update Section Name</h6>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
{{--                                <h4 class="card-title">Update Section Name</h4>--}}
                                <form class="forms-sample" action="{{url('admin/sections/edit-section')}}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Section Name</label>
                                        <input type="text" class="form-control" name="section_name" value="{{$section['name']}}">
                                        <input type="hidden" name="section_id" value="{{$section['id']}}">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div >
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layout.footer')
        <!-- partial -->
    </div>
@endsection
