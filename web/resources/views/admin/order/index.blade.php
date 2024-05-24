@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="app-title">
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item active"><a href="#"><b>Danh sách đơn đặt hàng</b></a></li>
        </ul>
        <div id="clock"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                <form action="{{ route('order.update', 0) }}" method="POST">
                @csrf
                @method('PUT')
                    <div class="row element-button">
                        <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm print-file" title="Xuất execl" data-toggle="modal" data-target="#filter">
                            <i class="fas fa-filter"></i> 
                                Lọc dữ liệu</a>
                        </div>

                        <div class="col-sm-2">
                          <button class="btn btn-add btn-sm" title="Xác nhận" type="submit" name="action" value="confirm">
                            <i class="fas fa-check"></i>
                            Xác nhận đơn hàng</button>
                        </div>

                        <div class="col-sm-2">
                          <button class="btn btn-delete btn-sm pdf-file" type="submit" title="Hủy" name="action" value="cancel">
                            <i class="fas fa-times"></i> 
                            Hủy đơn hàng</button>
                        </div>
            
                        <div class="col-sm-2">
                            <button class="btn btn-excel btn-sm" type="submit" title="Xuất excel" name="action" value="export">
                            <i class="fas fa-file-excel"></i> 
                                Xuất Excel</button>
                        </div>

                        <div class="col-sm-2">
                            <button class="btn btn-delete btn-sm pdf-file" type="submit" title="In" name="action" value="print">
                                <i class="fas fa-file-pdf"></i> 
                                Xuất PDF</button>
                        </div>

                        <div class="col-sm-2">
                            <button class="btn btn-delete btn-sm" type="submit" title="Xóa" name="action" value="delete" style="color: black">
                                <i class="fas fa-trash-alt"></i> 
                                Xóa tất cả </button>
                        </div>

                        <!-- <div class="col-sm-2">
                            <a class="btn btn-delete btn-sm nhap-tu-file" type="button" title="Nhập">
                            <i class="fas fa-file-upload"></i> 
                                Tải từ file</a>
                        </div> -->

                    </div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead>
                            <tr>
                                <th style="text-align: center">
                                    <input type="checkbox" id="all">
                                </th>
                                <th style="text-align: center">Tên khách hàng</th>
                                <th style="text-align: center">Địa chỉ</th>
                                <th style="text-align: center">Tổng tiền</th>
                                <th style="text-align: center">Trạng thái</th>
                                <th style="text-align: center">Ngày tạo</th>
                                <th style="text-align: center; background: #eee">Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order as $item)
                                <tr>
                                <td style="text-align: center">
                                    <input type="checkbox" name="check[]" value="{{ $item->id }}">
                                </td>
                                <td style="text-align: center">{{ $item->fullname }}</td>
                                <td style="text-align: center">{{$item->ward}} - {{$item->district}} - {{$item->province}}</td>
                                <td style="text-align: center">{{ number_format($item->moneytotal) }} VNĐ</td>
                                <td style="text-align: center">
                                    @if($item->status == 1)
                                    <span class="badge bg-info">Chờ xử lý</span>
                                    @elseif($item->status == 2)
                                    <span class="badge bg-warning">Đang vận chuyển</span>
                                    @elseif($item->status == 3)
                                    <span class="badge bg-success">Đã hoàn thành</span>
                                    @elseif($item->status == 4)
                                    <span class="badge bg-danger">Đã hủy</span>
                                    @endif
                                </td>
                                <td style="text-align: center">{{ $item->created_at }}</td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary btn-sm edit" type="button" title="Chi tiết" id="show-emp" data-toggle="modal" data-target="#ModalUP"
                                        onclick="window.location.href='{{ url('admin/order/'.$item->id) }}'"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>   
                            @endforeach     
                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</main>

@include('admin.modal.export')

@endsection

@section('script')
<script>
    oTable = $('#sampleTable').dataTable();
        $('#all').click(function (e) {
            $('#sampleTable tbody :checkbox').prop('checked', $(this).is(':checked'));
            e.stopImmediatePropagation();
        });
</script>
@endsection