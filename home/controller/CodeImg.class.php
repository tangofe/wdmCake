<?php
session_start();
header("content-type:image/gif");
class CodeImg{
	protected $img;
	protected $len;
	public function __construct($len){
		$this->len=$len;
		$this->init();
		$this->rectangle();
		$this->addText();
		$this->pixel();
		$this->showImg();

	}
	//初始化
	protected function init(){
		$this->img=imagecreate(80,24);//创建画布
		$color=imagecolorallocate($this->img,248,96,7);//画布色彩
		imagefill($this->img,0,0,$color);//填充画布
	}
	//像素点
	protected function pixel(){
		for($i=0;$i<100;$i++){			
			$color=imagecolorallocate($this->img,rand(129,255),rand(129,255),rand(129,255));
			imageSetPixel($this->img,rand(2,78),rand(2,22),$color);
		}
		
	}
	//矩形边框（空心矩形）
	protected function rectangle(){
		$color=imagecolorallocate($this->img,211,211,211);
		$rec=imagerectangle($this->img,0,0,79,23,$color);//矩形边框（空心矩形）
	}
	//生成文字
	protected function addText(){
		// imagettftext("图像名","字体大小","倾斜角度","X,"Y"，"色彩名","字体样式","文字")
		$file=__DIR__.'/SIMHEI.TTF';
		$text=$this->randStr();
		$_SESSION['code']=$text;//将验证码保存到session中
		$k=ceil((80-strlen($text)*12)/(strlen($text)+1));
		for($i=0;$i<strlen($text);$i++){
			$color=imagecolorallocate($this->img,rand(1,128),rand(1,128),rand(1,128));
			//字符个数*字体大小+（字符个数+1）*间距=图像宽度
			//间距=ceil (图像宽度-字符个数*字体大小)/（字符个数+1）
			imagettftext($this->img,12,rand(-15,15),$k+$i*(12+$k)+rand(-$k,1.5*$k),rand(12,22),$color,$file,$text[$i]);
		}
		
	}
	//生成随机数
	protected function randStr(){
		$str='abcdefghjkmnpqrstuvwxyz123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
		$text='';
		for($i=0;$i<$this->len;$i++){
			$index=rand(0,strlen($str)-1);
			$text.=$str[$index];
		}
		return $text;
	}

	protected function showImg(){
		imagegif($this->img);//输出图像
		imagedestroy($this->img);//销毁图像，回收资源
	}

}//类结束
//$img=new CodeImg(4);
