<?php
/*
@作用:生成分类树
@$array:数组
@$pid：父id 
@$level:等级
@$html:填充字符
@返回：数组
*/
function getTree($array,$pid=0,$level=0,$html='--------'){
    $tree=array();
    foreach($array as $row){
        if($row['pid']==$pid){
            $row['level']=$level+1;//等级
            $row['html']=str_repeat($html,$level);
            $tree[]=$row;
            $tree=array_merge($tree,getTree($array,$row['id'],$level+1,$html));

        }
    }
    return $tree;
}

//根据level等级确认不同的大类,用于前台生成导航
function oneTree($array,$level=1){//$array是被生成树getTree()处理过的数组
	$oneTree=array();
	$temp=array();
	for($i=count($array)-1;$i>=0;$i--){//倒序
		$row=$array[$i];			
		if($row['level']>$level){	//			
			$temp[]=$row;
		}else if($row['level']==$level){//
			$temp[]=$row;
			$oneTree[]=$temp;
			$temp=array();				
		}
	}
	return $oneTree;
}
/*
@作用：输出分类树
*/
function showTree($array){
	$tab='';
	$tab.="<ul>";
	foreach($array as $row){
		$tab.= "<li><a href='?id=".$row['id']."'>".$row['html'].$row['name']."</a></li>";
	}
	$tab.= "</ul>";
	return $tab;
}

//获取子孙类
function getSons($array,$pid=0,$level=0,$html='--'){
		$sons=array();		
		foreach($array as $row){
			if($row['pid']==$pid){
				$row['level']=$level+1;//等级
				$row['html']=str_repeat($html,$level);
				$sons[]=$row;
				$sons=array_merge($sons,getTree($array,$row['id'],$level+1,$html));
			}

		}
		return $sons;
	}
/*
@作用：根据指定id查找其祖先
*/
function getParents($array,$id){//3
	$parent=array();
	foreach($array as $row){
		if($row['id']==$id){//查找的开始位置
			//$row['html']='';
			$parent[]=$row;
			if($row['pid']>0){//查找的终止位置
				$parent=array_merge($parent,getParents($array,$row['pid']));//传递的是父id
			}
		}
	}
	return $parent;
}
/*
@作用：按顺序输出元素     家用电器>>电视>>超薄电视
*/
function showParent($array){
	$res='';
	for($i=count($array)-1;$i>=0;$i--){		
		if($i!=0){
			$res.="<a href='?id=".$array[$i]['id']."'>".$array[$i]['name']."</a>>>";
		}else{
			$res.="<a href='?id=".$array[$i]['id']."'>".$array[$i]['name']."</a>";
		}
	}
	return $res;
}

/*
@作用：根据指定id查找其子类
*/
function getSon($array,$id){
	$sons=array();
	foreach($array as $row){
		if($row['pid']==$id){
			$sons[]=$row;
		}
	}
	return $sons;
}
