<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductPasca;
use App\Models\ProductPrepaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DigiflazController extends Controller
{

    protected $header = null;
    protected $url = null;
    protected $user = null;
    protected $key = null;
    protected $model = null;
    protected $model_pasca = null;


    public function __construct()
    {
        $this->header = array(
            'Content-Type:application/json'
        );

        $this->url = env('DIGIFLAZ_URL');
        $this->user = env('DIGIFLAZ_USER');
        $this->key = env('DIGIFLAZ_DEV_KEY');

        $this->model = new ProductPrepaid();
        $this->model_pasca = new ProductPasca();
    }

    public function get_product_prepaid()
    {
        $response = Http::withHeaders($this->header)->post($this->url . '/price-list', [
            "cmd" => "prepaid",
            "username" => $this->user,
            "sign" => md5($this->user . $this->key . "pricelist")
        ]);
        $data = json_decode($response->getBody(), true);
        $this->model->insert_data($data['data']);
    }

    public function get_product_pasca()
    {
        $response = Http::withHeaders($this->header)->post($this->url . '/price-list', [
            "cmd" => "pasca",
            "username" => $this->user,
            "sign" => md5($this->user . $this->key . "pricelist")
        ]);
        $data = json_decode($response->getBody(), true);
        // return response()->json($data['data']);
        $this->model_pasca->insert_data($data['data']);
    }
}
