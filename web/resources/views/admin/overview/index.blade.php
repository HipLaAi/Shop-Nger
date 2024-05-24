@extends('admin.layout')
@section('content')
<main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="app-title">
          <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><a href="admin/overview"><b>Tổng quan</b></a></li>
          </ul>
          <div id="clock"></div>
        </div>
      </div>
    </div>
    <div class="row">
      <!--Left-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
       <!-- col-6 -->
       <div class="col-md-6">
        <div class="widget-small primary coloured-icon"><i class='icon bx bxs-user-account fa-3x'></i>
          <div class="info">
            <h4>Tổng khách hàng</h4>
            <p><b>{{ $user->count() }} khách hàng</b></p>
            <p class="info-tong">Tổng số khách hàng được quản lý.</p>
          </div>
        </div>
      </div>
       <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small info coloured-icon"><i class='icon bx bxs-data fa-3x'></i>
              <div class="info">
                <h4>Tổng sản phẩm</h4>
                <p><b>{{ $product->count() }} sản phẩm</b></p>
                <p class="info-tong">Tổng số sản phẩm được quản lý.</p>
              </div>
            </div>
          </div>
           <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small warning coloured-icon"><i class='icon bx bxs-shopping-bags fa-3x'></i>
              <div class="info">
                <h4>Tổng đơn hàng</h4>
                <p><b>{{ $saleBill->count() }} đơn hàng</b></p>
                <p class="info-tong">Tổng số hóa đơn bán hàng trong tháng.</p>
              </div>
            </div>
          </div>
           <!-- col-6 -->
          <div class="col-md-6">
            <div class="widget-small danger coloured-icon"><i class='icon bx bxs-error-alt fa-3x'></i>
              <div class="info">
                <h4>Sắp hết hàng</h4>
                <p><b>{{ $outOfStock }} sản phẩm</b></p>
                <p class="info-tong">Số sản phẩm cảnh báo hết cần nhập thêm.</p>
              </div>
            </div>
          </div>
           <!-- col-12 -->
           <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Đơn hàng tháng {{now()->month}}</h3>
              <div>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Tên khách hàng</th>
                      <th>Tổng tiền</th>
                      <th>Ngày tạo</th>
                      <th>Trạng thái</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($saleBillNowMonth as $item)
                    <tr>
                      <td>{{ $item->users->name }}</td>
                      <td>{{ number_format($item->moneytotal) }}</td>
                      <td>{{ $item->created_at }}</td>
                      <td>
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
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- / div trống-->
            </div>
           </div>
            <!-- / col-12 -->
             <!-- col-12 -->
            <div class="col-md-12">
                <div class="tile">
                  <h3 class="tile-title">Khách hàng mới trong tháng {{ now()->month }}</h3>
                <div>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Tên khách hàng</th>
                        <th>Ngày tạo</th>
                        <th>Email</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($userNew as $item)
                      <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td><span class="tag tag-success">{{ $item->email }}</span></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

              </div>
            </div>
             <!-- / col-12 -->
        </div>
      </div>
      <!--END left-->
      <!--Right-->
      <div class="col-md-12 col-lg-6">
        <div class="row">
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Top 5 sản phẩm bán chạy</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="tile">
              <h3 class="tile-title">Thống kê doanh thu theo tháng</h3>
              <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
              </div>
            </div>
          </div>
        </div>

      </div>
      <!--END right-->
    </div>
  </main>
@endsection

@section('script')
    <script type="text/javascript" src="admin/js/plugins/chart.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript">
      var data = {
        labels: [
          @foreach($data as $month=>$total)
              "Tháng {{ $month }}",
          @endforeach
        ],
        datasets: [{
          label: "Dữ liệu đầu tiên",
          fillColor: "rgba(255, 213, 59, 0.767), 212, 59)",
          strokeColor: "rgb(255, 212, 59)",
          pointColor: "rgb(255, 212, 59)",
          pointStrokeColor: "rgb(255, 212, 59)",
          pointHighlightFill: "rgb(255, 212, 59)",
          pointHighlightStroke: "rgb(255, 212, 59)",
          data: [
            @foreach($data as $month=>$total)
              {{ ($total) }},
            @endforeach
          ]
        },
        ]
      };

      var dataBestSelling = {
        labels: [
            @foreach($dataBestSelling as $item)
                "{{ $item->name }}",
            @endforeach
        ],
        datasets: [{
            label: "Dữ liệu kế tiếp",
            fillColor: "rgba(9, 109, 239, 0.651)",
            pointColor: "rgb(9, 109, 239)",
            strokeColor: "rgb(9, 109, 239)",
            pointStrokeColor: "rgb(9, 109, 239)",
            pointHighlightFill: "rgb(9, 109, 239)",
            pointHighlightStroke: "rgb(9, 109, 239)",
            data: [
                @foreach($dataBestSelling as $item)
                    {{ $item->quantity }},
                @endforeach
            ]
        }]
      };

      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(dataBestSelling);

      var ctxb = $("#barChartDemo").get(0).getContext("2d");
      var barChart = new Chart(ctxb).Bar(data);
    </script>
@endsection