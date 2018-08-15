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
/**
 * curl 函数封装
 * @param $url 请求网址
 * @param bool $params 请求参数
 * @param int $ispost 请求方式
 * @param int $https https协议
 * @return bool|mixed
 */
function httpRequest($url, $params = false, $ispost = 0, $https = 0)
{
    $httpInfo = array();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if ($https) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
    }
    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if ($params) {
            if (is_array($params)) {
                $params = http_build_query($params);
            }
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }

    $response = curl_exec($ch);

    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
    curl_close($ch);
    return $response;
}