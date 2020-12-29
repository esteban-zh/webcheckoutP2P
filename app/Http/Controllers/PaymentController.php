<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\P2PService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
     public $p2p;

    public function __construct(P2PService $p2p)
    {
        $this->p2p = $p2p;
    }

    public function index()
    {
        $payment = Payment::latest()->first();
        $payment->status = $this->updateStatus($payment);
        return view('welcome', [
            'payment' => $payment
        ]);
    }

    public function updateStatus($payment)
    {
        $response = $this->p2p->getRequestInformation($payment->reference);
        if ($response) {
            return $response['status']['status'];
        }
        return Payment::STATUSES['in process'];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payment = Payment::create([
            'description' => $request->description,
            'amount' => $request->amount,
            ]);
        $response = $this->p2p->createRequest($payment);
        
         return redirect($response['processUrl']);
    
    }
}
