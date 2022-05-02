<?php

namespace App\Http\Controllers\InvoicesSystem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\InvoiceSale;
use App\Models\InvoiceSaleProduct;

use Carbon\Carbon;

class InvoicesSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consecutivo=InvoiceSale::all()
        ->limit(10);

        return $consecutivo;
    }

    public function pagination(Request $request)
    {
        $show   = $request->show;
        $field  = $request->field;
        $order  = $request->order;



        $invoices = InvoiceSale::orderBy($field, $order)
        ->where('number_invoice','like','%'.$request['search'].'%')
        ->orwhere('number_invoice','like','%'.$request['search'].'%')
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
            'invoices' => $invoices,
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
        $validator = Validator::make($request->all(), [
            'provider_id'               => 'required|int',
            'number_invoice'            => 'required|int'
        ]);

        if($validator->fails())
        {

            return response()->json($validator->errors()->toJson(), 400);
        }
        //$values_pays = $this->valuesOfPays();

        $date = Carbon::now();

        $invoice = InvoiceSale::create([
            'number_invoice'        => $request->number_invoice,
            'provider_id'           => $request->provider_id,
            'branch_office_id'      => 1,
            'value_without_iva'     => $request->value_without_iva,
            'iva'                   => $request->iva,
            'value_pay'             => $request->value_pay,
            'date_invoice'          => $request->date_invoice

            //'value_without_iva'     => $values_pays->value_without_iva,
            //'iva'                   => $values_pays->iva,
            //'value_pay'             => $values_pays->value_pay
        ]);

        foreach ($request->items_invoice as $key ) 
        {
            $items_invoice = InvoiceSaleProduct::create([
                'invoices_id'   => $invoice->id,
                'products_id'   => $key['code'],
                'cant'          => $key['cant'],
                'value_unitary' => $key['val_uni'],
                'value_total'   => $key['total']
            ]);
        }

        return response()->json(compact('invoice','items_invoice'),201);

    }
}
