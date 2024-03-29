@extends('admin.layout')
@section("title","Product listing")
@section("before_css")
    <link rel="stylesheet" href="/admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endsection
@section("content-header")
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit product</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>
@endsection
@section
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit product</h1>
        </div>]
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
        </div>
    </div>
@endsection
@section("main-content")
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Product Information</h3>
                </div>
                <form role="form" method="post" action="{{route("product_edit",["product"=>$product->id])}}" enctype="multipart/form-data">
                    @method("PUT")
                    @csrf
                    <div class="card-body">
                        <div class="form-group">        {{--name--}}
                            <label>Product name</label>
                            <input type="text" value="{{$product->name}}" name="name" class="form-control @error("name") is-invalid @enderror" required/>
                            @error("name")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">        {{--thumbnail--}}
                            <label for="imgInputFile">Thumbnail
                                <a href="{{$product->thumbnail}}" target="_blank">
                                    <img src="{{$product->thumbnail}}" class="img-bordered-sm" width="50"/>
                                </a>
                            </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="thumbnail" class="custom-file-input" id="imgInputFile">
                                    <label class="input-group-text" for="imgInputFile">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" value="{{$product->price}}" name="price" class="form-control @error("price") is-invalid @enderror" required/>
                            @error("price")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Qty</label>
                            <input type="number" value="{{$product->qty}}" name="qty" class="form-control @error("qty") is-invalid @enderror" required/>
                            @error("qty")
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Unit</label>
                            <select class="form-control" name="unit">
                                <option @if($product->unit=="Item") selected @endif value="Item">Item</option>
                                <option @if($product->unit=="Box") selected @endif value="Box">Item</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control select2bs4">
                            @foreach($categories as $item)
                                <option @if($product->category_id==$item->id) selected @endif value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option @if($product->status) selected @endif value="1">Active</option>
                                <option @if(!$product->status) selected @endif value="1">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <buttton type="submit" class="btn btn-primary">Submit</buttton>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section("after_js")
    <script src="/admin/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript">
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
