<?php
namespace app\zhonggong\controller;
use think\admin\Controller;
use think\facade\Db;

//事业单位
class Exercise extends Controller
{

    /**
     * 当前操作数据库
     * @var string
     */
    protected $table = 'institution';

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

    //查看详情
    public function edit()
    {
        $this->_applyFormToken();
        $id=input('id');
        $result=Db::name('institution')->where('id',$id)->find();


            $v['link']=[];
            if(isset($result['link_address'])){
                $link_address=explode(';',$result['link_address']);
                $result['link']=$link_address;
            }

        $this->assign('detail',$result);
        $this->_form($this->table, 'form');
    }

    //删除数据
    public function remove(){
        $this->_applyFormToken();
        $id=input('id');
        $result=Db::name('institution')->where('id',$id)->delete();
        if($result){
            return $this->success('删除成功','');
        }else{
            return $this->error('删除失败','');
        }
    }


}