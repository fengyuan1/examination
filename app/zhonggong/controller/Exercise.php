<?php
namespace app\zhonggong\controller;
use think\admin\Controller;
use think\facade\Db;

//事业单位
class Exercise extends Controller
{

    public function index(){
      $data=Db::name('institution')->order('data desc');
//      halt($data->select());
      return $this->_page($data);
    }

    /**
     * 列表数据处理
     * @auth true
     * @param array $data
     * @throws \Exception
     */

   public function _index_page_filter(&$data){
       foreach ($data as $k=>&$v){
           $v['link']=[];
           if(isset($v['link_address'])){
               $link_address=explode(';',$v['link_address']);
               $v['link']=$link_address;
           }
       }
//       halt($data);
   }

}