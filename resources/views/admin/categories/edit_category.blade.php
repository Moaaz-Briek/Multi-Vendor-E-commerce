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
                            <h3 class="font-weight-bold mb-2">Edit Category</h3>
                            <h6 class="font-weight-normal"><a href="{{url('admin/categories')}}">Back to Categories</a></h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12  grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{url('admin/categories/edit-category')}}" method="post" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <input type="hidden" name="id" value="{{$category['id']}}">
                                <div class="form-group">
                                    <label for="category_name">Category Name</label>
                                    <input type="text" class="form-control" value="{{$category['category_name']}}" id="category_name"
                                           name="category_name" required placeholder="Enter Category Name">
                                </div>
                                <div class="form-group">
                                    <label for="section_name">Select Section Name</label>
                                    <select class="form-control" id="section_name" name="section_id" required placeholder="Enter Section Name">
                                        @foreach($sections as $section)
                                            @if($category['section_id'] != $section['id'])
                                                <option value="{{$section['id']}}">{{$section['name']}}</option>
                                            @else
                                                <option selected value="{{$category['section_id']}}">{{$category['section']['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="parent_name">Select Category Parent Name</label>
                                    <select class="form-control SectionCategories" id="parent_name" name ="parent_id" required  placeholder="Enter Parent Category">
                                        @if($category['parent_id'] != 0)
                                            <option value="{{$category['parent_id']}}">{{$category['parent_category']['category_name']}}</option>
                                        @else
                                            <option value="0">Root</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="category_discount">Category Discount</label>
                                    <input type="text" class="form-control" value="{{$category['category_discount']}}" id="category_discount" name="category_discount" required placeholder="Enter Category Discount">
                                </div>

                                <div class="form-group">
                                    <label for="url">Category Url</label>
                                    <input type="text" class="form-control" value="{{$category['url']}}" id="url" name="url" required placeholder="Enter Category Url">
                                </div>

                                <div class="form-group">
                                    <label for="meta_title">Category Meta Title</label>
                                    <input type="text" class="form-control" value="{{$category['meta_title']}}" id="meta_title" name="meta_title" required placeholder="Enter Meta Category Title">
                                </div>

                                <div class="form-group">
                                    <label for="meta_description">Category Meta Description</label>
                                    <input type="text" class="form-control" value="{{$category['meta_description']}}" id="meta_description" name="meta_description" required placeholder="Enter Meta Category Description">
                                </div>

                                <div class="form-group">
                                    <label for="meta_keywords">Category Meta Keyword</label>
                                    <input type="text" class="form-control" value="{{$category['meta_keywords']}}" id="meta_keywords" name="meta_keywords" required placeholder="Enter Category Meta Keyword">
                                </div>

                                <div class="form-group">
                                    <label for="category_status">Category Status</label>
                                    <select name="status" class="form-control">
                                        @if($category['status'] == 1)
                                            <option selected value="1">Active</option>
                                            <option value="2">Inactive</option>
                                        @else
                                            <option selected value="2">Inactive</option>
                                            <option value="1">Active</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="description">Category Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                              required placeholder="Enter Category Description" rows="3">{{$category['description']}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="formFileLg" class="form-label">Category Image</label>
                                    <input type="file" class="form-control form-control-lg" id="category_image" name="category_image">
                                    @if(!empty($category['category_image']))
                                        <a target="_blank" href="{{url('front/images/category_images/'.$category['category_image'])}}">
                                            View Image
                                        </a>
                                    @endif
                                    <input type="hidden" name="current_category_image" value="{{$category['category_image']}}">
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
