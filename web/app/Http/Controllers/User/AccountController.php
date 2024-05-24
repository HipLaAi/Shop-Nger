<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function index(){
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        $account = \App\Models\User::find(auth()->id());
        $orderWait = \App\Models\SaleBill::where('userid',auth()->id())->where('status',1)->get();
        $orderTransport = \App\Models\SaleBill::where('userid',auth()->id())->where('status',2)->get();
        $orderFinish = \App\Models\SaleBill::where('userid',auth()->id())->where('status',3)->get();
        $orderClose = \App\Models\SaleBill::where('userid',auth()->id())->where('status',4)->get();
        $orderWaitDetail = \App\Models\SaleBillDetail::all();

        return view('user.account.index',compact('account','cartDetail','loveDetail','orderWait','orderTransport','orderFinish','orderClose','orderWaitDetail'));
    }

    public function update(Request $request){
        $account = \App\Models\User::find(auth()->id());

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $name = time().rand(1,100) . '.' . $image->extension();
            $image->move(public_path('images'), $name); 
        }

        else
        {
            $name = $account->avatar;
        }
    
        $account->update([
            'name' => $request->input('name'),
            'avatar' => $name,
            'updated_at' => now(),
        ]);

        if($request->action === 'cancel' && $request->input('saleid')){
            $order = \App\Models\SaleBill::find($request->input('saleid'));
            $order->update([
                'status'=>4,
            ]);
        }
    
        return redirect('account');
    }

    public function show(){
        $cart = \App\Models\Cart::where('userid', auth()->id())->first();
        $cartDetail = \App\Models\CartDetail::where('cartid', $cart->id)->get();
        $love = \App\Models\LoveList::where('userid', auth()->id())->first();
        $loveDetail = \App\Models\LoveListDetail::where('loveid', $love->id)->get();
        $account = \App\Models\User::find(auth()->id());
        $email = $this->email_format($account->email);
        return view('user.account.show',compact('account','cartDetail','loveDetail','email'));
    }

    public function email_format($email){
        $parts = explode('@', $email);
        $username = $parts[0];
        $formattedUsername = Str::substr($username, 0, 2) . str_repeat('*', strlen($username) - 2);
        return $formattedUsername . '@' . $parts[1];
    }

    public function update_password(Request $request){
        $account = \App\Models\User::find(auth()->id());
    
        $data = [
            'email' => $account->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($data)){
            if($request->input('newpassword') === $request->input('authpassword')){
                $account->update([
                    'password' => bcrypt($request->input('authpassword')),
                ]);
                Auth::logout();
                return redirect('sign in')->with('success', 'Mật khẩu đã được cập nhật. Vui lòng đăng nhập lại!');
            }
            else{
                return redirect()->back()->with('error', 'Mật khẩu xác thực không khớp');
            }
        }
        else{
            return redirect()->back()->with('error', 'Mật khẩu cũ không đúng');
        }  
    }
}
