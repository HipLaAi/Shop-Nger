<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SaleBill;

use App\Exports\OrderExports;
use Excel;
use PDF;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = SaleBill::latest()->get();

        if($request->input('filters')){
            switch($request->input('filters')){
                case 1:{
                    $order = SaleBill::where('status',1)->latest()->get();
                    break;
                }
                case 2:{
                    $order = SaleBill::where('status',2)->latest()->get();
                    break;
                }
                case 3:{
                    $order = SaleBill::where('status',3)->latest()->get();
                    break;
                }
                case 4:{
                    $order = SaleBill::where('status',4)->latest()->get();
                    break;
                }
                case 5:{
                    $order = SaleBill::where('pay',0)->latest()->get();
                    break;
                }
                case 6:{
                    $order = SaleBill::where('pay',1)->latest()->get();
                    break;
                }
                case 7:{
                    $order = SaleBill::whereMonth('created_at',now()->month)->latest()->get();
                    break;
                }
                case 8:{
                    $order = $order;
                    break;
                }
            } 
        }

        return view('admin.order.index',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = SaleBill::find($id);
        $orderDetail = \App\Models\SaleBillDetail::where('saleid', $order->id)->get();
        return view('admin.order.show',compact('order','orderDetail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->check){
            foreach ($request->check as $key => $id) {
                $order = SaleBill::find($id);
                //Check value 'action'
                if ($request->action === 'confirm') {
                    $order->update([
                        'status' => 2,
                    ]);
                }
                elseif ($request->action === 'cancel') {
                    $order->update([
                        'status' => 4,
                    ]);
                }
                elseif ($request->action === 'print') {
                    // Lấy danh sách các ID đã chọn
                    $selectedIds = $request->check;
                            
                    // Lấy thông tin các đơn hàng từ cơ sở dữ liệu
                    $orders = SaleBill::whereIn('id', $selectedIds)->get();
                    $orderDetails = \App\Models\SaleBillDetail::whereIn('saleid', $selectedIds)->get();

                    // Tạo HTML từ thông tin đơn hàng
                    $html = $this->generateHtmlForPdf($orders, $orderDetails);

                    // Tạo Dompdf instance và load HTML
                    $pdf = \App::make('dompdf.wrapper');
                    $pdf->loadHTML($html);

                    // Stream PDF tới trình duyệt
                    return $pdf->stream();
                }
                elseif ($request->action === 'export') {
                    // Lấy danh sách các ID đã chọn
                    $selectedIds = $request->check;

                    return Excel::download(new OrderExports($selectedIds), 'order.xlsx');
                }
                elseif ($request->action === 'delete'){
                    // Lấy danh sách các ID đã chọn
                    $selectedIds = $request->check;

                    // Xóa thông tin hóa đơn
                    $orders = SaleBill::whereIn('id', $selectedIds)->get();
                    $order->delete();
                }
            }
        }
        
        else if($request->input('status')){
            $order = SaleBill::find($id);
            $order->update([
                'status'=> $request->input('status'),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function generateHtmlForPdf($orders, $orderDetails) {
        $html = '<html><head><style>
                    body { font-family: DejaVu Sans; }
                    table { border-collapse: collapse; width: 100%; }
                    th, td { border: 1px solid black; padding: 5px; }
                    th { background-color: #f2f2f2; }
                    .page-break { page-break-before: always; }
                </style></head><body>';
    
        foreach ($orders as $order) {
            $status = $this->getStatusText($order->status);
            $pay = $this->getPayText($order->pay);
            $html .= '<div class="page-break">';
            $html .= '<h4> Tên khách hàng:'. htmlspecialchars($order->fullname) .'</h4>';
            $html .= '<h4> Email:'. htmlspecialchars($order->email) .'</h4>';
            $html .= '<h4> Số điện thoại:'. htmlspecialchars($order->phone) .'</h4>';
            $html .= '<h4> Địa điểm:'. htmlspecialchars($order->ward . ' - ' . $order->district . ' - ' . $order->province) .'</h4>';
            $html .= '<h4> Ghi chú:'. htmlspecialchars($order->address) .'</h4>';
            $html .= '<h4> Tổng tiền:'. htmlspecialchars(number_format($order->moneytotal) . 'VNĐ') .'</h4>';
            $html .= '<h4> Thanh toán:'. htmlspecialchars($pay) .'</h4>';  
            $html .= '<table>';
            $html .= '<thead><tr>
                        <th>Tên sản phẩm</th>
                        <th>Kích cỡ</th>
                        <th>Màu sắc</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng tiền</th>
                    </tr></thead>';
            $html .= '<tbody>';
            foreach ($orderDetails as $detail) {
                if($detail->saleid == $order->id){
                    $html .= '<tr>
                                <td>' . htmlspecialchars($detail->name_product) . '</td>
                                <td>' . htmlspecialchars($detail->size) . '</td>
                                <td>' . htmlspecialchars($detail->color) . '</td>
                                <td>' . htmlspecialchars($detail->quantity) . '</td>
                                <td>' . htmlspecialchars(number_format($detail->price) . ' VNĐ') . '</td>
                                <td>' . htmlspecialchars(number_format($detail->total) . ' VNĐ') . '</td>';
                    }
                }
            $html .= '</tr></tbody></table></div>';
        }
    
        $html .= '</body></html>';
        return $html;
    }
       
    private function getStatusText($status) {
        switch ($status) {
            case 1:
                return 'Chờ xử lý';
            case 2:
                return 'Đang vận chuyển';
            case 3:
                return 'Đã hoàn thành';
            case 4:
                return 'Đã hủy';
            default:
                return 'Không xác định';
        }
    }

    private function getPayText($pay) {
        switch ($pay) {
            case 0:
                return 'Thanh toán sau khi nhận hàng';
            case 1:
                return 'Thanh toán online';
            default:
                return 'Không xác định';
        }
    }
}
