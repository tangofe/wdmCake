<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 8:54
 */
class Articles {
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function saveArticle() {
        $title = $_POST['article_title'];
        $content = htmlspecialchars($_POST['content']);
        $sql = "select * from article where art_name='{$title}'";
        $res = $this->db->selectRow($sql);
       // print_r($res); 在sql中字符串的zhi要加单引号；
        if ($res) {
            return array( 'code'=>400,'msg'=> '存在文章标题');
        }else {
            $sql = "insert into article(art_name,art_content) values('{$title}','{$content}')";
            $res = $this->db->otherData($sql);
            if ($res) {
                return array( 'code'=>200,'msg'=> '插入文章成功');
            }
        }
    }
    public function upArticle() {
        $id = $_GET['id'];
        $title = $_POST['article_title'];
        $content = htmlspecialchars($_POST['content']);
        $sql = "update article set art_name='{$title}',art_content='{$content}' where id={$id}";
        $res = $this->db->otherData($sql);
        if ($res) {
            return array( 'code'=>200,'msg'=> '修改文章成功');
        }else{
            return array( 'code'=>400,'msg'=> '修改文章失败');
        }
    }
    public function selectAllArticle() {
        $sql = "select * from article";
        $res = $this->db->selectRows($sql);
        return $res;
    }
    public function selectArticle() {
        $id = $_GET['id'];
        $sql = "select * from article where id={$id}";
        $res = $this->db->selectRow($sql);
        return $res;
    }
    public function deleteArticle() {
        $id = $_GET['id'];
        $sql = "delete from article where id={$id}";
        $res = $this->db->otherData($sql);
        if ($res) {
            return array( 'code'=>200,'msg'=> '删除文章成功');
        }else{
            return array( 'code'=>400,'msg'=> '删除文章失败');
        }
    }
}