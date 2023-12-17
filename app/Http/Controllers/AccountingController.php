<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class AccountingController extends Controller
{
    public function index(){
        if(!Auth::check()){
            return redirect('login');
        }

        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        $lastMonthsTransactions = Transaction::select('created_at', 'amount')->whereMonth('created_at', date('m'))->get();

        $totalProfitThisMonth = 0;

        foreach ($lastMonthsTransactions as $lastMonthsTransaction) {
            $totalProfitThisMonth += $lastMonthsTransaction->amount;
        }

        // Altı ay önceki tarih
        $sixMonthsAgo = Carbon::now()->subMonths(6)->startOfMonth();

        // Altı ay öncesinden şu anki tarihe kadar olan işlemleri getir
        $sixMonthsTransactions = Transaction::select('created_at', 'amount')
            ->where('created_at', '>=', $sixMonthsAgo)
            ->get();

        $totalProfitLastSixMonths = 0;

        foreach ($sixMonthsTransactions as $transaction) {
            $totalProfitLastSixMonths += $transaction->amount;
        }

        return view('accounting')->with('transactions', $transactions)->with('totalProfitThisMonth', $totalProfitThisMonth)->with('totalProfitLastSixMonths', $totalProfitLastSixMonths);
    }
}
