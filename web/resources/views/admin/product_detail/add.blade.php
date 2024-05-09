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
              <h3 class="tile-title">Thêm chi tiết sản phẩm</h3>
                <div class="tile-body">
                    <div class="row element-button">
                        <div class="col-sm-8">
                            <span>Danh mục: {{$product->categories->name}}</span><br>
                            <span>Thương hiệu: {{$product->brands->name ?? ''}}</span>
                        </div>
                        <div class="col-sm-4">
                            <h3>Tên sản phẩm: {{$product->name}}</h3>
                        </div>
                    </div>
                    <form action="admin/product/{{ $product->id }}/detail" method="POST" class="row"
                        enctype="multipart/form-data">
                            @csrf
                        <div class="form-group col-md-3">
                            <label for="exampleSelect1" class="control-label">Kích cỡ</label>
                            <input name="size[]" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3 ">
                            <label for="exampleSelect1" class="control-label">Màu sắc</label>
                            <input name="color[]" class="form-control" type="text">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Số lượng</label>
                            <input name="quantity[]" class="form-control" type="number">
                        </div>
                        <!-- Start Add -->
                        <div class="form-group col-md-12" id="add_product_detail" style="padding:0"></div>
                        <!-- End Add -->
                        <div class="form-group col-md-12" style="display: flex; justify-content: center;">
                            <a
                            onclick="addProductDetail()"
                            name=""
                            id=""
                            class="btn btn-primary"
                            role="button"
                            > <i class="fas fa-folder-plus"> </i> Thêm chi tiết sản phẩm </a>
                        </div>
                    </div>
                    <button class="btn btn-save" type="submit">Lưu lại</button>
                    <a class="btn btn-cancel" href="admin/product/{{ $product->id }}/detail">Hủy bỏ</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
  function addProductDetail() {
    // Tạo một phần tử div mới
    var newDiv = document.createElement("div");
    newDiv.classList.add("form-group", "col-md-12");
    newDiv.style.display = "flex";
    newDiv.style.padding = "0";
    newDiv.style.marginTop = "15px"

    // Thêm nội dung HTML vào trong phần tử div mới
    newDiv.innerHTML = `
        <div class="form-group col-md-3">
            <label for="exampleSelect1" class="control-label">Kích cỡ</label>
            <input name="size[]" class="form-control" type="text">
        </div>
        <div class="form-group col-md-3 ">
            <label for="exampleSelect1" class="control-label">Màu sắc</label>
            <input name="color[]" class="form-control" type="text">
        </div>
        <div class="form-group col-md-3">
            <label class="control-label">Số lượng</label>
            <input name="quantity[]" class="form-control" type="number">
        </div>
        <div class="form-group col-md-3">
          <label class="control-label">Chức năng</label>
          <div id="myfileupload">
          <a
            onclick="deleteProductDetail(this)"
            name=""
            id=""
            class="btn btn-primary"
            style="background:#ff00009e;color:white"
            role="button"
            > <i style="padding:5px" class='bx bx-trash'></i> Xóa chi tiết sản phẩm </a></div>
        </div>
    `;

    // Thêm phần tử div mới vào cuối phần tử có id là "add_product_detail"
    var addProductDetailElement = document.getElementById("add_product_detail");
    addProductDetailElement.appendChild(newDiv);
  }

  function deleteProductDetail(element) {
    // Xác định div cha của liên kết được nhấp vào
    var parentRowDiv = element.closest('.form-group.col-md-12');

    // Xóa div cha đó
    parentRowDiv.parentNode.removeChild(parentRowDiv);
  }
</script>
@endsection