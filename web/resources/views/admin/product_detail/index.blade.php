@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="admin/product">Danh sách sản phẩm</a></li>
        <li class="breadcrumb-item"><a href="admin/product/{{ $product->id }}/edit">Sửa sản phẩm</a></li>
        <li class="breadcrumb-item"><a href="admin/product/{{ $product->id }}/detail">Chi tiết sản phẩm</a></li>
      </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Chi tiết sản phẩm</h3>
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-10">
                            <span>Danh mục: {{$product->categories->name}}</span><br>
                            <span>Thương hiệu: {{$product->brands->name ?? ''}}</span>
                        </div>
                        <div class="col-sm-2">
                          <a class="btn btn-add btn-sm" href="admin/product/{{ $product->id }}/detail/create" title="Thêm"><i class="fas fa-plus"></i>
                            Tạo mới chi tiết</a>
                        </div>
                      </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">Tên sản phẩm</th>
                                <th style="text-align: center">Color</th>
                                <th style="text-align: center">Size</th>
                                <th style="text-align: center">Số lượng</th>
                                <th style="text-align: center">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product->productDetails as $item)
                                <tr>
                                <td style="text-align: center">{{$product->name}}</td>
                                <td style="text-align: center">{{$item->color}}</td>
                                <td style="text-align: center">{{$item->size}}</td>
                                <td style="text-align: center">{{$item->quantity}}</td>
                                <td style="text-align: center">
                                    <form action="admin/product/{{ $product->id }}/detail/{{ $item->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" id="show-emp" data-toggle="modal" data-target="#ModalUP"
                                            onclick="window.location.href='{{ url('admin/product/'.$product->id.'/detail/'.$item->id.'/edit') }}'"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-primary btn-sm trash" type="submit" title="Xóa"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa chi tiết sản phẩm này không?')"><i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>   
                            @endforeach     
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection