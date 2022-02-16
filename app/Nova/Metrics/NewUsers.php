<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;

class NewUsers extends Value
{
    /**
     * 计算 metric 的值。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($request, User::class);
    }

    /**
     * 获取 metric 的时间范围。
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => '30 Days',
            60 => '60 Days',
            365 => '365 Days',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',
        ];
    }

    /**
     * 获取 metric 的 URI 键。
     *
     * @return string
     */
    public function uriKey()
    {
        return 'new-users';
    }
}
