<?php


namespace App\Service;

use Coroowicaksono\ChartJsIntegration\LineChart;
use Illuminate\Support\Facades\DB;

class NovaServiceProvider
{

    public function getUserWeekData()
    {
        $lineOne        = '2022-02-10 2022-02-12';
        $lineTwo        = '2022-02-13 2022-02-15';
        $dataOne        = DB::select("select substring(created_at, 1, 10) as dates,count(*) as num from users where created_at between '2022-02-10' and '2022-02-13' group by substring(created_at, 1, 10)");
        $dateList       = [];
        $dataOneNumList = [];

        foreach ($dataOne as $date) {
            $dateList[]       = $date->dates;
            $dataOneNumList[] = $date->num;
        }

        $dataTwo        = DB::select("select substring(created_at, 1, 10) as dates,count(*) as num from users where created_at between '2022-02-13' and '2022-02-16' group by substring(created_at, 1, 10)");
        $dataTwoNumList = [];

        foreach ($dataTwo as $date) {
            $dataTwoNumList[] = $date->num;
        }

        return (new LineChart())
            ->title('用户增长趋势')
            ->animations([
                'enabled' => true,
                'easing'  => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label'         => $lineOne,
                'borderColor'   => '#f7a35c',
                'data'          => $dataOneNumList,
            ], [
                'barPercentage' => 0.5,
                'label'         => $lineTwo,
                'borderColor'   => '#90ed7d',
                'data'          => $dataTwoNumList,
            ]))
            ->options([
                'xaxis' => [
                    'categories' => $dateList
                ],
            ])
            ->width('2/3');
    }


    public function getTopicsWeekData()
    {

        $lineOne = '2022-02-10 2022-02-12';
        $lineTwo = '2022-02-13 2022-02-15';

        $listDates      = $this->groupData();
        $dataOneNumList = $listDates['dataList'];

        $listDateTwo    = $this->groupData('2022-02-13', '2022-02-16');
        $dataTwoNumList = $listDateTwo['dataList'];

        return (new LineChart())
            ->title('话题增长趋势')
            ->animations([
                'enabled' => true,
                'easing'  => 'easeinout',
            ])
            ->series(array([
                'barPercentage' => 0.5,
                'label'         => $lineOne,
                'borderColor'   => '#f7a35c',
                'data'          => $dataOneNumList,
            ], [
                'barPercentage' => 0.5,
                'label'         => $lineTwo,
                'borderColor'   => '#90ed7d',
                'data'          => $dataTwoNumList,
            ]))
            ->options([
                'xaxis' => [
                    'categories' => ['2022-02-10', '2022-02-11', '2022-02-12']
                ],
            ])
            ->width('2/3');
    }


    private function groupData($dateFirst = '2022-02-10', $dateLast = '2022-02-13')
    {
        $dataOne        = DB::select("select substring(created_at, 1, 10) as dates,count(*) as num from topics where created_at between '{$dateFirst}' and '{$dateLast}' group by substring(created_at, 1, 10)");
        $dateList       = [];
        $dataOneNumList = [];

        foreach ($dataOne as $date) {
            $dateList[]       = $date->dates;
            $dataOneNumList[] = $date->num;
        }

        return [
            'dateList' => $dateList,
            'dataList' => $dataOneNumList
        ];
    }
}
