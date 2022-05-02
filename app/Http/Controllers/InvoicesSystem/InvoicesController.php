<?php

namespace App\Http\Controllers\InvoicesSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Invoice;
use App\Models\InvoiceProduct;

use Carbon\Carbon;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consecutivo=Invoice::all()
        ->limit(10);

        return $consecutivo;
    }

    public function pagination(Request $request)
    {
        $show   = $request->show;
        $filed  = $request->filed;
        $order  = $request->order;

        $invoices = Invoice::orderBy($filed, $order)
        ->where('name','like','%'.$request['search'].'%')
        ->orwhere('consecutive_invoice','like','%'.$request['search'].'%')
        ->paginate($show);

        return [
            'pagination' => [
                'total'         => $invoices->total(),
                'current_page'  => $invoices->currentPage(),
                'per_page'      => $invoices->perPage(),
                'last_page'     => $invoices->lastPage(),
                'from'          => $invoices->firstItem(),
                'to'            => $invoices->lastPage()
            ],
            'invoicess' => $invoices,
        ];
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

        $validator = Validator::make($request->all(), [
            //'email'     => 'required|string|email|max:255|unique:users',

            'client_id'             => 'required|int',
            'branch_office_id'      => 'required|int'
        ]);

        if($validator->fails())
        {

            return response()->json($validator->errors()->toJson(), 400);
        }

        $consecutive = $this->generateConsecutive();
        //$values_pays = $this->valuesOfPays();

        $date = Carbon::now();

        $invoice = Invoice::create([
            'consecutive_invoice'   => $consecutive,
            'client_id'             => $request->get('client_id'),
            'branch_office_id'      => $request->get('branch_office_id'),
            'value_without_iva'     => $request->get('value_without_iva'),
            'iva'                   => $request->get('iva'),
            'value_pay'             => $request->get('value_pay'),
            'date_invoice'          => $date->toDateTimeString()

            //'value_without_iva'     => $values_pays->value_without_iva,
            //'iva'                   => $values_pays->iva,
            //'value_pay'             => $values_pays->value_pay
        ]);

        foreach ($request->items_invoice as $key ) 
        {
            $items_invoice = InvoiceProduct::create([
                'invoices_id'   => $invoice->id,
                'products_id'   => $key['id'],
                'cant'          => $key['units'],
                'value_unitary' => $key['value_unitary'],
                'value_total'   => $key['value_total']
            ]);
        }

        return response()->json(compact('invoice','items_invoice'),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $validator = Validator::make($request->all(), [
            //'email'     => 'required|string|email|max:255|unique:users',

            'client_id'             => 'required|int',
            'branch_office_id'      => 'required|int'
        ]);

        if($validator->fails())
        {

            return response()->json($validator->errors()->toJson(), 400);
        }

        $consecutive = $this->generateConsecutive();
        //$values_pays = $this->valuesOfPays();

        $date = Carbon::now();

        $invoice = Invoice::create([
            'consecutive_invoice'   => $consecutive,
            'client_id'             => $request->get('client_id'),
            'branch_office_id'      => $request->get('branch_office_id'),
            'value_without_iva'     => $request->get('value_without_iva'),
            'iva'                   => $request->get('iva'),
            'value_pay'             => $request->get('value_pay'),
            'date_invoice'          => $date->toDateTimeString()

            //'value_without_iva'     => $values_pays->value_without_iva,
            //'iva'                   => $values_pays->iva,
            //'value_pay'             => $values_pays->value_pay
        ]);

        foreach ($request->items_invoice as $key ) 
        {
            $items_invoice = InvoiceProduct::create([
                'invoices_id'   => $invoice->id,
                'products_id'   => $key['id'],
                'cant'          => $key['units'],
                'value_unitary' => $key['value_unitary'],
                'value_total'   => $key['value_total']
            ]);
        }

        return response()->json(compact('invoice','items_invoice'),201);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $consecutivo=Invoice::all()
        ->limit(1);

        return $consecutivo;
    }







    /**
     * Generar consecutivo.
     * @return String
     */
    public function generateConsecutive()
    {
        //
        $consecutivo=Invoice::select('*')
        ->orderBy('id', 'desc')
        ->limit(5)
        ->get();

        if (count($consecutivo) >= 1 ) 
        {
            // code...
            $consecutivo=$consecutivo[0]->id + 1;
        }
        else
        {

            $consecutivo=1;
        }


        return $consecutivo;

    }



    public function test($value='')
    {

        $mytime = \Carbon\Carbon::now();
        echo $mytime->toDateTimeString();

        return response()->json(
            [
                'data' => $mytime
            ]
        , 400);
    }
    
}
