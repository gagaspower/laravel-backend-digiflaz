<?php

namespace App\Traits;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait CodeGenerate
{

    public function getCode()
    {
        $q = DB::table('code_generate')->select(DB::raw('MAX(RIGHT(code,9)) as kd_max'));
        $prx = 'INV-BL-' . date('y') . '-' . date('m') . '-';
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%09s", $tmp);
            }
        } else {
            $kd = $prx . "000000001";
        };

        DB::table('code_generate')->insert([
            'code'          => $kd,
            'date_generate' => Carbon::now()->format('Y-m-d'),
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);

        return $kd;
    }
}
