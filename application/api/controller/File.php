<?php
/**
 * Created by mumu.
 * Date: 2016/12/28
 * Time: 15:42
 */
namespace app\api\controller;
use think\Controller;
use think\Request;

class File extends Controller
{
    protected $res;
    protected $path;

    public function _initalize()
    {

    }

    public function upload($path='', $size=[])
    {
        $size = $size?$size:request()->param('thumbsize');
        if($size && !is_array($size)){
            $size = [
                ['width'=>100, 'height'=>100],
                ['width'=>300, 'height'=>300],
                ['width'=>960, 'height'=>960],
            ];
        }
        $this->path = $path?$path:request()->param('path');
        $path = trim($this->path, '/').'/';
        $rootPath = trim(ROOT_PATH.'/public', '/');
        $savePath = '/uploads/'.$path;

        $file = request()->file('image');
        $info = $file->rule('uniqid')->move($rootPath.$savePath);
        if($info){
            // 输出 jpg
//            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
            if($size){
                $this->thumbPic($rootPath.$savePath ,$info->getFilename(), $size);
            }
            $this->res = $savePath.$info->getSaveName();
            return toJson(true,$this->res);
        }else{
            // 上传失败获取错误信息
            return toJson($file->getError());
        }
    }

    public function thumbPic($dir, $filename, $size){
        $image = \think\Image::open($dir.$filename);
        $key = array('l_', 'm_', 's_', 'a_');
        if(!$size){
            $size[0] = ['width'=>100, 'height'=> 100];
        }
        usort($size, function($a,$b){
            $al = $a['width'];
            $bl = $b['width'];
            if($al == $bl) return 0;
            return $al >$bl ? -1 : 1;
        });/*按从大到小排序*/
        foreach ($size as $k=>$v){
            $ext = $key[$k]?$key[$k]:str_repeat('_',$k);
            $image->thumb($v['width'],$v['height'])->save($dir.$ext.$filename);
        }
    }
}