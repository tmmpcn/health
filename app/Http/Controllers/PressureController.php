<?php
/**
 * @SWG\Info(
 *     version="1.0.0",
 *     title="血压监控Api",
 *     description="血压监控Api 文档"
 * )
 */
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="wx.test",
 *     basePath="/v1"
 * )
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PressureController extends Controller
{



    /**
     * @SWG\Post(
     *     path="/segment",
     *     summary="获取区间段血压变化",
     *     description="跟据Echart要求生成json",
     *     operationId="segment",
     *     produces={"application/json"},
     *     tags={"segment"},
     *     @SWG\Parameter(
     *         name="uid",
     *         in="formData",
     *         description="用户id",
     *         required=true,
     *         type="integer",
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="成功返回",
     *         @SWG\Schema(
     *              type="array",
     *              @SWG\Items(
     *                      @SWG\Property(
     *                          property="firstName",
     *                          type="string",
     *                          description="firstName"
     *                      ),
     *                      @SWG\Property(
     *                           property="lastName",
     *                           type="string",
     *                          description="lastName"
     *                      )
     *              )
     *         )
     *     ),
     *     @SWG\Response(
     *     response="500",
     *     description="错误返回",
     *     @SWG\schema(ref="#/definitions/Error")
     *     )
     * )
     */
    public function segment(Request $request)
    {
        $result = DB::table('eh')->select('1eh as eh1','2eh as eh2','id','times','food','work','weather')
                                        ->where("uid",$request->uid)
                                        ->orderBy("id",'desc')
                                        ->get()
                                        ->toArray();




        $series_lang = array(
            'gy'=>'高压',
            //'dy'=>'低压'

        );

        $data = array();


        $m = 0;
        $n = 0;
        $re = array();
        $step = 10;
        foreach($result as $v)
        {

            if($m>$step)
            {
                $m = 0;
                $n++;
            }
            $m++;
            $re[$n][] = $v;

        }
        $count = count($re);
        unset($re[$count-1]);

        $x = $y = array();

        krsort($re);

        foreach($re as $o)
        {
            $eh_sum_1 = 0;
            $eh_sum2_2 = 0;
            $m = 0;

            foreach($o as $s)
            {


                $eh1 = explode(",",$s->eh1);
                $eh2 = explode(",",$s->eh2);
                $eh_sum = intval($eh1[0])+intval($eh2[0]);

                $eh_sum2 = intval($eh1[1])+intval($eh2[1]);
                $eh_sum_1+=$eh_sum;
                $eh_sum2_2+=$eh_sum2;

                if($m==0)
                {
                    $times = $s->times;
                }
                $m++;

            }





            $y['gy'][] = $eh_sum_1;
            //$y['dy'][] = $eh_sum2_2;


            $x[] = date("Y-m-d",strtotime($times));;

        }

        $this->apiResponse['data'] = createLineOptions('血压变化情况',array_values($series_lang),$x,$series_lang,$y,2000);
        return response()->json($this->apiResponse);
    }

}


/**
 * @SWG\Definition(
 *     definition="Error",
 *     @SWG\Property(
 *         property="code",
 *         type="string"
 *     ),
 *     @SWG\Property(
 *         property="message",
 *         type="string"
 *     )
 * )
 */