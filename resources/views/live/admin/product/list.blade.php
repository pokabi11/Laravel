@extends("admin.layout")
@section("title","Product listing")
@section("content-header")
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text dark">Product listing</h1>
        </div>
        <div class="col-sm-6">
            <ul class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url("/admin/product/create")}}">Create new product</a></li>
            </ul>
        </div>
    </div>
@endsection
@section("main-content")
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">bordered Table</h3>
            <div class="card">
                <form action="{{url("/admin/product")}}"
            </div>
        </div>
    </div>
@endsection
