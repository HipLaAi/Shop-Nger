<?php

namespace App\Exports;

use App\Models\SaleBill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExports implements FromCollection, WithHeadings
{
    protected $selectedIds;

    public function __construct(array $selectedIds)
    {
        $this->selectedIds = $selectedIds;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (!empty($this->selectedIds)) {
            // return SaleBill::whereIn('id', $this->selectedIds)->get();
            $orders = SaleBill::whereIn('sale_bills.id', $this->selectedIds)
            ->join('users', 'sale_bills.userid', '=', 'users.id')
            ->select(
                'sale_bills.id', 
                'users.name',
                'sale_bills.fullname', 
                'sale_bills.address', 
                'sale_bills.email', 
                'sale_bills.phone', 
                'sale_bills.province', 
                'sale_bills.district', 
                'sale_bills.ward', 
                'sale_bills.street', 
                'sale_bills.zip', 
                'sale_bills.moneytotal', 
                'sale_bills.pay', 
                'sale_bills.status', 
                'sale_bills.created_at', 
                'sale_bills.updated_at'
            )
            ->get();


            // Chuyển đổi giá trị của cột 'pay' và 'status'
            $orders->transform(function ($order) {
                $order->pay = $order->pay == 0 ? 'thanh toán sau khi nhận hàng' : 'thanh toán online';
                
                switch ($order->status) {
                    case 1:
                        $order->status = 'Chờ xử lý';
                        break;
                    case 2:
                        $order->status = 'Đang vận chuyển';
                        break;
                    case 3:
                        $order->status = 'Đã hoàn thành';
                        break;
                    case 4:
                        $order->status = 'Đã hủy';
                        break;
                    default:
                        $order->status = 'Không xác định';
                        break;
                }
                
                return $order;
            });

            return $orders;
        }

        return collect(); // Trả về collection rỗng nếu không có id nào được chọn
    }

    public function headings(): array
    {
        return [
            'Mã HĐ',
            'Tên tài khoản',
            'Tên khách hàng',
            'Địa chỉ',
            'Email',
            'Số điện thoại',
            'Tỉnh/TP',
            'Huyện/Quận',
            'Xã/Phường',
            'Đường',
            'Mã zip',
            'Tổng tiền',
            'Phương thức thanh toán',
            'Trạng thái hóa đơn',
            'Ngày tạo',
            'Ngày cập nhật',
        ];
    }
    
}
