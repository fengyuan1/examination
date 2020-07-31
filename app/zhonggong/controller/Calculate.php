<?php
namespace app\zhonggong\controller;
use think\admin\Controller;
use think\facade\Db;

//事业单位
class Calculate extends Controller
{

    /**
     * 当前操作数据库
     * @var string
     */
    protected $table = 'institution';

    public function index(){
      $data=Db::name('institution')->order('data desc')->where('area_code','=',null)->select()->toArray();

      foreach ($data as $k=>$v ){
          $area=Db::name('wy_area')->select()->toArray();
           foreach ($area as $kk=>$vo){
               if(strpos($v['title'],$vo['name'])!==false){
                   Db::name('institution')->where('id',$v['id'])->update([
                       'area_code'=>$vo['code'],
                       'area_name'=>$vo['name'],
                   ]);
                   echo '匹配成功';
               }
           }
      }

      $this->replenish();
    }

    /**
     * 补充
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function replenish(){
        $data=Db::name('institution')->order('data desc')->where('area_code','=',null)->select()->toArray();

        foreach ($data as $k=>$v ){
            $area=Db::name('wy_area')->select()->toArray();
            foreach ($area as $kk=>$vo){
            $name_len=strlen($vo['name'])-3<0?3:strlen($vo['name']);

                if(strpos($v['title'],substr($vo['name'],0,$name_len))!==false){
                    Db::name('institution')->where('id',$v['id'])->update([
                        'area_code'=>$vo['code'],
                        'area_name'=>$vo['name'],
                    ]);
                    echo '匹配成功';
                }
            }
        }
    }

}