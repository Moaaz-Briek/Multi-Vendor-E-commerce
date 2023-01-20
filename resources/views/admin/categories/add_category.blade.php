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
                            <h3 class="font-weight-bold mb-2">Add New Category</h3>
                            <h6 class="font-weight-normal"><a href="{{url('admin/categories')}}">Back to Categories</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-12  grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" action="{{url('admin/categories/add-category')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                    @csrf
                                    <div class="form-group">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" required placeholder="Enter Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="section_name">Select Section Name</label>
                                        <select class="form-control" id="section_name" name="section_id" required placeholder="Enter Section Name">
                                            <option disabled selected value="">Select Section</option>
                                            @foreach($sections as $section)
                                            <option value="{{$section['id']}}">{{$section['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="parent_name">Select Category Parent Name</label>
                                        <select class="form-control SectionCategories" id="parent_name" name ="parent_id" required  placeholder="Enter Parent Category">
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="category_discount">Category Discount</label>
                                        <input type="text" class="form-control" id="category_discount" name="category_discount" required placeholder="Enter Category Discount">
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Category Url</label>
                                        <input type="text" class="form-control" id="url" name="url" required placeholder="Enter Category Url">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_title">Category Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" required placeholder="Enter Meta Category Title">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Category Meta Description</label>
                                        <input type="text" class="form-control" id="meta_description" name="meta_description" required placeholder="Enter Meta Category Description">
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keywords">Category Meta Keyword</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" required placeholder="Enter Category Meta Keyword">
                                    </div>

                                    <div class="form-group">
                                        <label for="category_status">Category Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Category Description</label>
                                        <textarea  class="form-control" id="description" name="description" required placeholder="Enter Category Description" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label  for="category_image" class="form-label">Upload Category Images</label>
                                        <input class="form-control form-control-lg" id="category_image" type="file" name="category_image">
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
