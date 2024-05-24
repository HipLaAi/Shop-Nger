@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách sản phẩm</li>
        <li class="breadcrumb-item"><a>Thêm sản phẩm</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Tạo mới sản phẩm</h3>
          <div class="tile-body">
          <div class="row element-button">
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="admin/category/create"><i
                    class="fas fa-folder-plus"></i> Thêm danh mục</a>
              </div>
              <div class="col-sm-2">
                <a class="btn btn-add btn-sm" href="admin/brand/create"><i
                    class="fas fa-folder-plus"></i> Thêm thương hiệu</a>
              </div>
            </div>
          <form action="{{route('product.store')}}" method="POST" class="row"
            enctype="multipart/form-data">
                @csrf
              <div class="form-group col-md-4">
              <label for="exampleSelect1" class="control-label">Danh mục</label>
              <select name="catid" class="form-control" id="exampleSelect1">
                  <option value="0">-- Chọn danh mục --</option>
                  @foreach($category as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
              </select>
              </div>
              <div class="form-group col-md-4">
              <label for="exampleSelect1" class="control-label">Thương hiệu</label>
              <select name="brandid" class="form-control" id="exampleSelect1">
                  <option value="0">-- Chọn thương hiệu --</option>
                  @foreach($brand as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
              </select>
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Tên sản phẩm</label>
                <input name="name" class="form-control" type="text">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Giá</label>
                <input name="price" class="form-control" type="number">
              </div>
              <div class="form-group col-md-4">
                <label class="control-label">Giá khuyến mại</label>
                <input name="discount" class="form-control" type="number">
              </div>
              <div class="form-group col-md-4">
              <label for="exampleSelect2" class="control-label">Trạng thái sản phẩm</label>
              <select name="status" class="form-control" id="exampleSelect2">
                    <option value="1">Không</option>
                    <option value="0">Áp dụng ưu đãi</option>
              </select>
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

              <div class="form-group col-md-12" >
                <label class="control-label">Ảnh sản phẩm</label>
                <div class="list-input-hidden-upload">
                    <input style="display:none" type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">
                </div>
                <div class="input-group-btn">
                    <button class="btn btn-success btn-add-image" type="button" style="cursor: pointer;"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</button>
                </div>
                <div class="list-images" style="display:flex;flex-wrap: wrap">
                </div>
              </div>

              <div class="form-group col-md-12">
                <label class="control-label">Mô tả sản phẩm</label>
                <textarea name="description" class="form-control" id="description"></textarea>
              </div>
          </div>
          <button class="btn btn-save" type="submit">Lưu lại</button>
          <a class="btn btn-cancel" href="admin/product">Hủy bỏ</a>
        </form>
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

  $(document).ready(function() {
    $(".btn-add-image").click(function(){
        $('#file_upload').trigger('click');
    });

    $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let file_name = event.target.files[0].name;
        let box_image = $('<div class="box-image" style="position: relative; margin:6px"></div>');
        box_image.append('<img style="width: 285px;" src="' + URL.createObjectURL(image) + '" class="picture-box">');
        box_image.append('<div style="cursor: pointer; position: absolute;right: 0;top: 0;border-radius: 50%;background-color: #ff00009e;padding: 4px 11px;color: white;margin: 5px;" data-id='+time+' class="btn-delete-image">x</div>');
        $(".list-images").append(box_image);

        $(this).removeAttr('id');
        $(this).attr( 'id', time);
        let input_type_file = '<input style="display:none" type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">';
        $('.list-input-hidden-upload').append(input_type_file);
    });

    $(".list-images").on('click', '.btn-delete-image', function(){
        let id = $(this).data('id');
        $('#'+id).remove();
        $(this).parents('.box-image').remove();
    });
  });
</script>
@endsection