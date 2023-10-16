<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrefixNumber;
use App\Models\ProductPrepaid;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $nomor = substr($request->customer_no, 0, 4);
        $getPrevix = PrefixNumber::findProviderByNumber($nomor)->first();
        $pulsa = ProductPrepaid::findProductByProvider($getPrevix->provider, 'Pulsa')->get();
        $paket_data = ProductPrepaid::findProductByProvider($getPrevix->provider, 'Data')->get();

        $data = array(
            'pulsas' => $pulsa,
            'paket_data' => $paket_data
        );
        return response()->json([
            'message' => 'Success',
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
