@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><a href="admin/product">Danh sách sản phẩm</a></li>
        <li class="breadcrumb-item"><a href="admin/product/{{ $product->id }}/edit">Sửa sản phẩm</a></li>
        <li class="breadcrumb-item"><a href="admin/product/{{ $product->id }}/image">Chi tiết ảnh</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Chi tiết ảnh</h3>
          <div class="tile-body">
            <div class="col-md-12">
                <label class="control-label">Ảnh sản phẩm</label>
                <div class="list-images" style="display:flex;flex-wrap: wrap">
                @foreach($product->images as $item)
                <form action="admin/product/{{ $product->id }}/image/{{ $item->id }}/" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                  <div class="box-image" style="position: relative; margin:4px">
                    <img style="width: 280px;" src="images/{{ $item->image }}" class="picture-box">
                    <button onclick="return confirm('Bạn có chắc chắn muốn hình ảnh sản phẩm này không?')" style="cursor: pointer; position: absolute;right: 0;top: 0;border-radius: 50%;background-color: #ff00009e;padding: 4px 11px;color: white;margin: 5px; border:0" type="submit">x</div>
                  </button>
                </form>
                @endforeach
                </div>
            </div>
            <form action="admin/product/{{ $product->id }}/image" method="POST" class="row" enctype="multipart/form-data">
              @csrf
              <div class="form-group col-md-12" >
                <label class="control-label">Thêm ảnh sản phẩm</label>
                <div class="list-input-hidden-upload">
                    <input style="display:none" type="file" name="images[]" id="file_upload" class="myfrm form-control hidden">
                </div>
                <div class="input-group-btn">
                    <button class="btn btn-success btn-add-image" type="button" style="cursor: pointer;"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</button>
                </div>
              </div>
          </div>
          <button class="btn btn-save" type="submit">Lưu lại</button>
          <a class="btn btn-cancel" href="admin/product/{{ $product->id }}/edit">Hủy bỏ</a>
        </form>
    </div>
</main>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $(".btn-add-image").click(function(){
        $('#file_upload').trigger('click');
    });

    $('.list-input-hidden-upload').on('change', '#file_upload', function(event){
        let today = new Date();
        let time = today.getTime();
        let image = event.target.files[0];
        let file_name = event.target.files[0].name;
        let box_image = $('<div class="box-image" style="position: relative; margin:4px"></div>');
        box_image.append('<img style="width: 280px;" src="' + URL.createObjectURL(image) + '" class="picture-box">');
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