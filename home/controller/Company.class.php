    <?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/10
 * Time: 20:20
 */
class Company {
    protected $db;
    public function __construct($db){
        $this->db = $db;
    }
    public function saveCompanyService() {
        //print_r($_POST);
       // print_r($_GET);
        $name = $_POST['companyName'];
        $companySrc = $_POST['companySrc1'].$_POST['companySrc2'].$_POST['companySrc3'].$_POST['companySrc4'];
        $detailSrc = $_POST['detailSrc'];
        $peopleNum = $_POST['peopleNum'];
        $peopleName = $_POST['peopleName'];
        $peoplePhone = $_POST['peoplePhone'];
        $companyPhone = $_POST['companyPhone'];
        $callContent = $_POST['callContent'];
        $time = time();
        $sql = "insert into company(company_name,company_src,detail_src,people_num,people_name,people_phone,company_phone,call_content,time ) 
values( '{$name}','{$companySrc}','{$detailSrc}','{$peopleNum}','{$peopleName}','{$peoplePhone}','{$companyPhone}','{$callContent}','{$time}')";
        $res = $this->db->otherData($sql);
        if ($res) {
            return array( 'msg'=>'提交成功','code'=>'200');
        } else {
            return array( 'msg'=>'提交成功','code'=>'200');
        }
    }


}