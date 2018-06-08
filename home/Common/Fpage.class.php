<?php
class Fpage{
	protected $db;
	protected $tab;
	protected $type;//类型
	public $currentPage;//当前页
	public $size;//每页2条记录
	protected $maxPage;//最大页数
	protected $prvPage;//上一页
	protected $nextPage;//下一页
	protected $nums;//数字页数
	public  function __construct($db,$tab,$size=1,$nums=5){//初始化时需传入db对象与要操作的数据表名
		$this->db=$db;
		$this->tab=$tab;
		$this->size=$size;
		$this->nums=$nums;
		/*echo "<pre>";
		print_r($_GET);
		echo "</pre>";*/
	}
	public function init(){
		$this->checkType();
		$this->countMaxPage();
		$this->checkPage();
	}
	//检测get传递过来的数据类型,并将类型返回
	protected function checkType(){
		$this->type='';
		if(!isset($_GET['type'])){
			$this->type="all";
		}else{
			$this->type=$_GET['type'];
		}
		$this->currentPage=1;//当前页,默认是第1页
		if(isset($_GET['page'])){
			$this->currentPage=$_GET['page'];
		}		
		//echo $type.'---'.$currentPage;
		return $this->type;
	}
	//处理当前页、上一页、下一页三者之间的关系
	protected function checkPage(){
		if($this->currentPage<=1){$this->currentPage=1;}
		if($this->currentPage>=$this->maxPage){$this->currentPage=$this->maxPage;}

		if($this->currentPage<=1){
			$this->prvPage=1;
		}else{
			$this->prvPage=$this->currentPage-1;
		}
		if($this->currentPage>=$this->maxPage){
			$this->nextPage=$this->maxPage;
		}else{
			$this->nextPage=$this->currentPage+1;
		}
		// echo $this->prvPage.'---'.$this->currentPage.'---'.$this->nextPage;
		// $sql="select * from articler limit  ($this->currentPage-1)*$this->size , $this->size";
	}
	//统计最大页数
	protected function countMaxPage(){
		$sql='';
		if($this->type=="all"){
			$sql="select id from {$this->tab} ";
		}else{
			$type=$_GET['type'];
			$sql="select id from {$this->tab}  where type='{$type}' ";
		}		
		$rows=$this->db->selectRows($sql);
		$allSize=count($rows);
		$this->maxPage=ceil($allSize/$this->size);
		//echo $allSize.'---'.$this->maxPage;
	}
	//根据当前类型与当前页取当前页面中的记录
	public function getCntByPage(){
		$start= ($this->currentPage-1)*$this->size;
		if($this->type=="all"){
			$sql="select * from {$this->tab}  order by id desc  limit  $start, $this->size ";
		}else{
			$sql="select * from {$this->tab}  where type='{$this->type}'  order by id desc   limit  $start, $this->size  ";
		}
		//echo $sql;
		$rows=$this->db->selectRows($sql);	
		/*echo "<pre>";
		print_r($rows);
		echo "</pre>";*/
		return $rows;
	}
	//根据当前类型与当前页生成链接(文字)
	public function makeTxtLinks(){
		$links='';
		$links.="<a href='?type={$this->type}&page=1' >第一页</a>";
		$links.="<a href='?type={$this->type}&page={$this->prvPage}' >上一页</a>";
		$links.="<a href='?type={$this->type}&page={$this->nextPage}' >下一页</a>";
		$links.="<a href='?type={$this->type}&page={$this->maxPage}'' >末尾页</a>";
		$links.="&nbsp;&nbsp;&nbsp;&nbsp;<font color='#f00'>$this->currentPage</font>/{$this->maxPage}";
	              if($this->type=="all"){
	              	$links=str_replace("type={$this->type}&",'',$links);
	              }
	              return $links;
	}
	//根据当前类型与当前页生成链接(文字)
	public function makeNumLinks(){
		$links='';
		$prvLink='';
		$nextLink='';
		$numLink='';
		if($this->currentPage==1){
			$prvLink="<a  id='uppage'  href='?type={$this->type}&page=1' >第一页</a>";
		}else{
			$prvLink="<a  id='uppage' href='?type={$this->type}&page={$this->prvPage}' >上一页</a>";
		}
		if($this->currentPage==$this->maxPage){
			$nextLink="<a  id='downpage' href='?type={$this->type}&page={$this->maxPage}'' >末尾页</a>";
		}else{
			$nextLink="<a  id='downpage'  href='?type={$this->type}&page={$this->nextPage}' >下一页</a>";
		}
		if($this->maxPage<$this->nums){//总页数小于数字页
			for($i=1;$i<=$this->maxPage;$i++){
				if($this->currentPage==$i){
					$numLink.="<a class='red' href='?type={$this->type}&page=".$i."'>".$i."</a>";
				}else{
					$numLink.="<a href='?type={$this->type}&page=".$i."'>".$i."</a>";
				}		
			}			
		}else{
			//4,  5,6,7,8,9
			//当前页是否最后一组当中的页面;
			//($this->maxPage-$this->nums+1)最后几个页面当中的第一个页面
			if($this->currentPage>$this->maxPage-$this->nums+1){//当前页是最后一组页面中的第2个之后的页面；第1个页面可以往后退
				$start=$this->maxPage-$this->nums+1;//开始页数
				$end=$this->maxPage;//结束页数
				for($i=$start;$i<=$end;$i++){
					if($this->currentPage==$i){
						$numLink.="<a class='red' href='?type={$this->type}&page=".$i."'>".$i."</a>";
					}else{
						$numLink.="<a href='?type={$this->type}&page=".$i."'>".$i."</a>";
					}	
				}
			}else{	
				if($this->currentPage==1){						
					for($i=1;$i<=$this->nums;$i++){
						if($this->currentPage==$i){
							$numLink.="<a class='red' href='?type={$this->type}&page=".$i."'>".$i."</a>";
						}else{
							$numLink.="<a href='?type={$this->type}&page=".$i."'>".$i."</a>";
						}			
					}				
				}else{
					$start=$this->currentPage-1;						
					$end=$this->currentPage+$this->nums-1;
					for($i=$start;$i<$end;$i++){
						if($this->currentPage==$i){
							$numLink.="<a class='red' href='?type={$this->type}&page=".$i."'>".$i."</a>";
						}else{
							$numLink.="<a href='?type={$this->type}&page=".$i."'>".$i."</a>";
						}			
					}				
				}
			}
		}
		$links=$prvLink.$numLink.$nextLink;		
		$links.="&nbsp;&nbsp;&nbsp;&nbsp;<font color='#f00'>$this->currentPage</font>/{$this->maxPage}";
	              if($this->type=="all"){
	              	$links=str_replace("type={$this->type}&",'',$links);
	              }
	              return $links;
	}
}//类结束