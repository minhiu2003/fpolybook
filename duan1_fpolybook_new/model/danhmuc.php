<?php 
    function load_all_danhmuc(){
        $sql = "select * from danhmuc where 1";
        $result = pdo_query($sql);
        return $result;
    }
   
    function issert_danhmuc($tenloai){
        $sql = "insert into danhmuc(ten) values('$tenloai')";
        pdo_execute($sql);
    }
    
    function delete_danhmuc($id){
        $sql = "delete from danhmuc where id=".$id;
                    pdo_execute($sql);
    }
    
    function checkdm($tenloai){
        $sql = "SELECT * FROM danhmuc WHERE ten= '" .$tenloai ."'";
        $tk = pdo_query_one($sql);
        return $tk;
    }
    
    // load toàn bộ list sản phẩm
    function loadall_danhmuc () {
        $sql = "select * from danhmuc order by id desc";
                $listdanhmuc = pdo_query($sql);
                return $listdanhmuc;
    }
    
    // sửa 1 danh mục
    function loadone_danhmuc($id) {
        $sql = "select * from danhmuc where id=".$id;
        $dm = pdo_query_one($sql);
        return $dm;
    }
    
    // cập nhật
    function update_danhmuc ($request){
        $sql = "update danhmuc set ten='".$request['tenloai']."' where id=".$request['id'];
                    pdo_execute($sql);
    }
?>