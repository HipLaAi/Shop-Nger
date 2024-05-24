<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">
        <form action="{{ url('admin/order') }}">
          <div class="row">
            <div class="form-group  col-md-12">
              <span class="thong-tin-thanh-toan">
                <h5>Chọn định dạng lọc dữ liệu</h5>
              </span>
            </div>
            <div class="form-group col-md-12">
                <input type="radio" id="option1" name="filters" value="1" required>
                <label for="option1">Các đơn hàng đang chờ xác nhận</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option2" name="filters" value="2" required>
                <label for="option2">Các đơn hàng đang vận chuyển</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option3" name="filters" value="3" required>
                <label for="option3">Các đơn hàng đã hoàn thành</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option4" name="filters" value="4" required>
                <label for="option4">Các đơn hàng bị hủy</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option5" name="filters" value="5" required>
                <label for="option5">Các đơn hàng thanh toán sau</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option6" name="filters" value="6" required>
                <label for="option6">Các đơn hàng thanh toán online</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option7" name="filters" value="7" required>
                <label for="option7">Các đơn hàng trong tháng</label>
            </div>

            <div class="form-group col-md-12">
                <input type="radio" id="option8" name="filters" value="8" required>
                <label for="option8">Tất cả các đơn hàng</label>
            </div>
          </div>
          <BR>
          <button class="btn btn-save" type="submit">Lọc</button>
          <a class="btn btn-cancel" data-dismiss="modal" href="#">Hủy bỏ</a>
          <BR>
        </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>