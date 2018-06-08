<?php 
	header("content-type:text/html;charset=utf-8;");
	class Category{
		protected $db;
		protected $tab;
		public function __construct($db,$tab='goods_category'){
			$this->db=$db;
			$this->tab=$tab;
		}
		//取全部的一级分类，返回json格式的数据
		public function getAllCategory(){
			$sql="select id,name from {$this->tab} where pid=1";
			return $this->db->selectRows($sql);
		}
		//根据父类的id，取其子分类，返回json格式的数据
		public function getCategory(){
			$id=$_GET['id'];
			$sql="select * from {$this->tab} where pid={$id}";
			return $this->db->selectRows($sql);
		}
		//获取详情页面文章内容
		public function getContent(){
			$id=$_GET['id'];
			$sql="select * from {$this->tab} where id='{$id}'";
			$res=$this->db->selectRow ($sql);
			if ($res) {
				if($res['content']!=''){
					return $res;
				}else{
					$newid=$res['pid'];
					$new_sql="select * from {$this->tab} where id='{$newid}'";
					$ret=$this->db->selectRow ($new_sql);
					return $ret;
				}
			}
		}
		//获取详情当前位置
		public function getGoodsLocation(){
			$rows=array();
			$row=array();
			$id=$_GET['id'];
			$sql="select * from goods_list where id='{$id}'";
			$res=$this->db->selectRow($sql);
			if (isset($res)&&($res['name']!='')) {
				array_push($row,$res['id'],$res['name']);
				array_push($rows,$row);
				//$rows=$res['name'];
				$rot=$res['cid'];
			}
			while($rot!="0"){
				$pid=$rot;
				$sql="select * from {$this->tab} where id='{$pid}'";
				$res=$this->db->selectRow($sql);
				if (isset($res)&&($res['name']!='')) {
					$row=array();
					array_push($row,$res['id'],$res['name']);
					array_push($rows,$row);
					//array_push($rows,$res['name']);
				}
				$rot=$res['pid'];
			}
			return $rows;
		}
		
	}
 ?>