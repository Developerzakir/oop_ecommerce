<?php 


include_once '../lib/Database.php';
include_once '../helpers/Format.php';


class Category{
    private $db;
    private $fm;
    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName){
         $catName = $this->fm->validation($catName);
         $catName = mysqli_real_escape_string($this->db->link, $catName);

          if(empty($catName)){
            $msg = "<span class='error'>Category field Must not be empty</span>";
            return $msg;
          }else{
            $query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
            $catinsert = $this->db->insert($query);
            if($catinsert){
                $msg = "<span class='success'>Category inserted successfully!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Category not inserted</span>";
                return $msg;
            }
          }
   
    } //end method

    public function getAllCat(){
        $query = "SELECT * FROM tbl_category";
        $result = $this->db->select($query);
        return $result;
    }  //end method

    public function getCatById($id){
        $query = "SELECT * FROM tbl_category where  catId ='$id' ";
        $result = $this->db->select($query);
        return $result;
    } //end method

    public function catUpdate($catName,$id){

         $catName = $this->fm->validation($catName);
         $catName = mysqli_real_escape_string($this->db->link, $catName);
         $id      = mysqli_real_escape_string($this->db->link, $id);

          if(empty($catName)){
            $msg = "<span class='error'>Category field Must not be empty</span>";
            return $msg;
          }else{
            $query = "UPDATE  tbl_category SET catName='$catName' WHERE catId='$id' ";

            $updated_row = $this->db->update($query);
            if($updated_row){
                   $msg = "<span class='success'>Category updated successfully!</span>";
                   return $msg;
            }else{
                $msg = "<span class='error'>Category not updated</span>";
                return $msg;
            }
          }

    } //end method

    public function delCatById($id){
        $query = "DELETE FROM tbl_category WHERE catId='$id'";
        $delData = $this->db->delete($query);
        if($delData){
              $msg = "<span class='success'>Category deleted!</span>";
              return $msg;
        }else{
            $msg = "<span class='error'>Category not deleted</span>";
            return $msg;
        }

    } //end method
}



?>