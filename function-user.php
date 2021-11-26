<?php
include_once("config.php"); 

class Db_Class{
    private $table_name = 'user';
        function createUser(){
            $hashPasswd = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $query = "INSERT INTO PUBLIC.".$this->table_name."(name,username,email,password,role,contact,kota,alamat) ".
            "VALUES('".$this->cleanData($_POST['name'])."',
            '".$this->cleanData($_POST['username'])."',
            '".$this->cleanData($_POST['email'])."',
            '".$this->cleanData($hashPasswd)."',
            '".$this->cleanData($_POST['role'])."',
            '".$this->cleanData($_POST['contact'])."',
            '".$this->cleanData($_POST['kota'])."',
            '".$this->cleanData($_POST['alamat'])."')";

            $user = $_POST['username'];
            
            return pg_affected_rows(pg_query($query));
            
        }
        function tambahPeternak(){
            $user = $_POST['username'];
            $query = "INSERT into peternak (id_peternak, nama_peternakan, alamat_peternakan, deskripsi_usaha) VALUES ('$user', NULL, NULL, NULL)";
            return pg_affected_rows(pg_query($query));
        }
        function tambahMitra(){
            $user = $_POST['username'];
            $query = "INSERT into mitra (id_pemilik, nama_usaha, alamat_usaha) VALUES ('$user', NULL, NULL)";
            return pg_affected_rows(pg_query($query));
            
        }

        // function createPeternak(){
        //     $user = $_POST['username'];
        //     if($_POST['role']="2"){
        //         $query = pg_query("INSERT into peternak (id_peternak, nama_peternakan, alamat_peternakan, deskripsi_usaha) VALUES ('$user', NULL, NULL, NULL)");                return $query;
        //     }            
        // }

        // function createMitra(){
        //     $user = $_POST['username'];
        //     if($_POST['role']="1"){
        //         $query = pg_query("INSERT into mitra (id_pemilik) VALUES ('$user')");
        //         return $query;
        //     }
        // }
        
    
    function getUsers(){             
        $query ="select *from public." . $this->table_name . " WHERE role='1' ORDER BY name DESC";
        return pg_query($query);
    } 

    function getPartners(){             
        $query ="select *from public." . $this->table_name . " WHERE role='2' ORDER BY name DESC";
        return pg_query($query);
    } 

    function getUserById(){    
  
        $sql ="select *from public." . $this->table_name . "  where username='".$this->cleanData($_POST['id'])."'";
        return pg_query($sql);
    } 

    // function getAllUsers(){             
    //     $query ="select *from public." . $this->table_name . " ";
    //     return pg_affected_rows(pg_query($query));
    // } 

    function deleteuser(){    
  
         $sql ="delete from public." . $this->table_name . "  where username='".$this->cleanData($_POST['id'])."'";
        return pg_query($sql);
    } 

    function updateUser($data=array()){       
     
        $sql = "update public.user set name='".$this->cleanData($_POST['name'])."'
        ,email='".$this->cleanData($_POST['email'])."'
        ,role='".$this->cleanData($_POST['role'])."'
        ,contact='".$this->cleanData($_POST['contact'])."'
        ,kota='".$this->cleanData($_POST['kota'])."'
        ,alamat='".$this->cleanData($_POST['alamat'])."' where username = '".$this->cleanData($_POST['id'])."' ";
        return pg_affected_rows(pg_query($sql));        
    }
    function cleanData($val){
         return pg_escape_string($val);
    }

}



?>