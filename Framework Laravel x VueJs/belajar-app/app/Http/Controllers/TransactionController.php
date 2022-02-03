<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\Member;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
        
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        // $transactions = Transaction::with('yasin')->get();
        $transactions = Member::select('members.*', 'books.*', 'transactions.*', 'transaction_details.*')
                        ->join('transactions', 'transactions.member_id', '=', 'members.id')
                        ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
                        ->join('books', 'books.id', '=', 'transaction_details.book_id')
                        ->get();

        $status = Transaction::select('status')->get();
        
        return view('admin.transaction.index', compact('transactions'));
        // return view('yasin.transaction.index');
    }

    // public function api(Request $request)
    // {
    //     if ($request->gender) {
    //         $datas = Member::where('gender', $request->gender)->get();
    //     } else {
    //         $datas = Member::all();
    //     }

    //     $datatables = datatables()->of($datas)->addIndexColumn();

    //     return $datatables->make(true);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transactions = Transaction::all();
        $books = Book::all();
        $members = Member::all();
        $transaction_details = TransactionDetail::all();

        return view('admin.transaction.transactiondata', compact('transactions', 'members', 'books', 'transaction_details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $transaction = Transaction::create($request->all());
        $transaction = new Transaction;
        $transaction->member_id = $request->member_id;
        $transaction->date_start = Carbon::parse($request->get('date_start'));
        $transaction->date_end = Carbon::parse($request->get('date_end'));
        $transaction->status = $request->status;
        $transaction->save();

        $transaction_details = new TransactionDetail;
        $transaction_details->transaction_id = $transaction->id;
        $transaction_details->book_id = $request->book_id;
        $transaction_details->qty = 1;
        $transaction_details->save();

        return redirect('transactions');
        // return $request;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        $transactions = Transaction::all();
        $books = Book::all();
        $members = Member::all();
        $transaction_details = TransactionDetail::all();

        return view('admin.transaction.transactiondata', compact('transactions', 'members', 'books', 'transaction_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
