<?php

namespace common\models;

use Yii;

class DemoData extends MasterModel
{
    public function getFitAndFastEmployee()
    {
        return [
            'id' => 'ff-id-1',
            'title' => 'NPR',
            'percent' => '55.55',
            'grades' => [
                'SS' => 1,
                'S' => 2,
                's' => 3,
                'F' => 4,
            ],
        ];
    }

    public function getFitAndFastDivision()
    {
        return [
            'id' => 'ff-id-2',
            'title' => 'IT',
            'percent' => '85.55',
            'grades' => [
                'SS' => 1,
                'S' => 2,
                's' => 3,
                'F' => 4,
            ],
        ];
    }

    public function getFitAndFastSummary()
    {
        return [
            'id' => 'ff-id-3',
            'title' => 'Over All',
            'percent' => '35.55',
            'grades' => [
                'SS' => 1,
                'S' => 2,
                's' => 3,
                'F' => 4,
            ]
        ];
    }

    public function getStatData()
    {
        return [
            ['xkey'=>'2015-01-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-02-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-03-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-04-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-05-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-06-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-07-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-08-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-08-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-09-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-10-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-11-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
            ['xkey'=>'2015-12-01', 'ykey'=>number_format(((float)rand()/(float)getrandmax())*100, 2)],
        ];
    }
}
