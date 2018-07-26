<?php
function createLineOptions($title,$legend=array(),$xAxis=array(),$seriesName=array(),$seriesData=array(),$ymin=0)
{

    foreach($seriesName as $k=>$v)
    {
        $series[] = array(
            'name'=>$v,
            'type'=>'line',
            //'stack'=>'总量',
            'smooth'=>true,
            'data'=>$seriesData[$k],
        );
    }

    $result = array(
        'title'=>array(
            'show'=>true,
            'text'=>$title,
            'x'=>'center'
        ),
        'tooltip'=>array(
            'trigger'=> 'axis'
        ),
        'legend'=>array(
            'data'=>$legend,
            'y'=>'bottom',
            'show'=>false //不显示曲线图名称

        ),
        'toolbox'=>array(
            'show'=>false,
            'feature'=>array(
                'mark'=>array('show'=>true),
                'dataView'=>array('show'=>true,'readOnly'=>false),
                'magicType'=>array('show'=>true,'type'=>array('line','bar','stack','tiled')),
                'restore'=>array('show'=>true),
                'saveAsImage'=>array('show'=>true)
            )

        ),
        'calculable'=>true,
        'yAxis'=>
            array('type'=>'value','min'=>$ymin)
    ,
        'xAxis'=>array(
            array(
                'type'=>'category',
                'boundaryGap'=>false,
                'data'=>$xAxis
            )

        ),
        'series'=>$series,

    );
    return $result;
}
function test()
{
    echo '11';
}