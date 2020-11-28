<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use App\Model\Expense;
use App\Model\Collection;

class AccountBalancesController extends BackendController
{


    ## Account Balance ##
    public function index()
    {
        if (auth()->user()->can('account_balance', Expense::class)){     
            $result = $this->balance_calculation();
            return view('backend.pages.account_balances.index', $result);          
        }else{
            return redirect()->route('admin.403');
        }
    }

    ## Account Balance Calculation ##

    public function balance_calculation(){
    	$result['total_expense'] = Expense::where(['status' => 1, 'type' => 1])->sum('amount');
    	$result['total_collection'] = Collection::sum('amount');
    	$result['account_balance'] = $result['total_collection'] - $result['total_expense'];
    	// $result['expense'] = Expense::sum('amount')->where(['status' => 1, 'type' => 1])->get();
    	return $result;

    }



    

}
