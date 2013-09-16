<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2013 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Addons\Editor\Controller;
use Home\Controller\AddonsController;
use COM\Upload;

class UploadController extends AddonsController{

	/* 上传图片 */
	public function upload(){
		/* 上传配置 */
		$setting = C('EDITOR_UPLOAD');

		/* 调用文件上传组件上传文件 */
		$Upload = new Upload($setting, 'Local');
		$info   = $Upload->upload($_FILES);
		$url = C('EDITOR_UPLOAD.rootPath').$info['imgFile']['savepath'].$info['imgFile']['savename'];
		$url = str_replace('./', '/', $url);
		$info['fullpath'] = $url;
		return $info;
	}

	//keditor编辑器上传图片处理
	public function ke_upimg(){
		/* 返回标准数据 */
		$return  = array('error' => 0, 'info' => '上传成功', 'data' => '');
		$img = $this->upload();
		/* 记录附件信息 */
		if($img){
			$return['url'] = $url;
			unset($return['info'],$return['data']);
		} else {
			$return['error'] = 0;
			$return['message']   = $Upload->getError();
		}

		/* 返回JSON数据 */
		$this->ajaxReturn($return);
		exit();
	}

	//ueditor编辑器上传图片处理
	public function ue_upimg(){
		$img = $this->upload();
	}

}
