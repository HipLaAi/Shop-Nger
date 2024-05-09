@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
      <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item">Danh sách danh mục</li>
        <li class="breadcrumb-item"><a href="">Sửa danh mục</a></li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h3 class="tile-title">Sửa danh mục</h3>
          <div class="tile-body">
            <form action="{{ route('category.update', $category->id) }}" method="POST" class="row" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group col-md-12">
              <label for="exampleSelect1" class="control-label">Tên danh mục</label>
                <input name="name" class="form-control" type="text" value="{{ $category->name }}">
              </div>
              <div class="form-group col-md-12" >
                <label class="control-label">Ảnh danh mục</label>
                <div class="list-input-hidden-upload">
                    <input style="display:none" type="file" name="image" id="file_upload" class="myfrm form-control hidden">
                </div>
                <div class="input-group-btn">
                    <button class="btn btn-success btn-add-image" type="button" style="cursor: pointer;"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</button>
                </div>
                <div class="list-images" style="display:flex;flex-wrap: wrap">
                  <div class="box-image" style="position: relative; margin:6px">
                    <img style="width: 285px;" src="images/{{ $category->image }}" class="picture-box">
                    <!-- <div style="cursor: pointer; position: absolute;right: 0;top: 0;border-radius: 50%;background-color: #ff00009e;padding: 4px 11px;color: white;margin: 5px;" data-id='1' class="btn-delete-image">x</div> -->
                  </div>
                </div>
              </div>
              <div class="form-group col-md-12">
                <label class="control-label" for="description">Mô tả danh mục</label>
                <textarea name="description" class="form-control" id="description">{{ $category->description }}</textarea>
              </div>
          </div>
          <button class="btn btn-save" type="submit">Lưu lại</button>
          <a class="btn btn-cancel" href="admin/category">Hủy bỏ</a>
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
        $('.list-images').empty(); // Xóa các hình ảnh trước đó
        let box_image = $('<div class="box-image" style="position: relative; margin:6px"></div>');
        box_image.append('<img style="width: 285px;" src="' + URL.createObjectURL(image) + '" class="picture-box">');
        // box_image.append('<div style="cursor: pointer; position: absolute;right: 0;top: 0;border-radius: 50%;background-color: #ff00009e;padding: 4px 11px;color: white;margin: 5px;" data-id='+time+' class="btn-delete-image">x</div>');
        $(".list-images").append(box_image);
    });

    // $(".list-images").on('click', '.btn-delete-image', function(){
    //     let id = $(this).data('id');
    //     $('#'+id).remove();
    //     $(this).parents('.box-image').remove();
    // });
});
</script>
@endsection