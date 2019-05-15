<?php
    class Tools{
        private $link = null;
        function __construct(){
            $this->connectDB();
        }
        function connectDB(){
            $this->link = mysqli_connect("127.0.0.1","root","","php")
            or die($this -> link = null);
            mysqli_set_charset($this->link, 'utf8');
        }

        /**
         * 查询数据库
         * @param [char] $tablename 查询表的名称
         * @param [array] $col  默认为* 列名 类型为array
         * @param [array] $where 查询条件 类型为array
         */
        function selectDB($tablename,$col,$wherename,$where){
            //如果数据库连接表识符为空就尝试连接数据库
            if($this->link == null){
                $this -> connectDB();
            }
            //根据传递的array拼接查询的字段
            $cols = "";
            if($col == "*"){
                $cols = "*";
            }else{
                for($i=0,$ilen = count($col);$i<$ilen;$i++){
                    //最后一个元素不拼接逗号
                    if($i<$ilen-1){
                        $cols = $cols.$col[$i].",";
                        continue;
                    }
                    $cols = $cols.$col[$i];
                }
            }
            //根据传递的数组元素拼接查询的条件
            $whereTemp = "";
            if($where == ""){
                $whereTemp = "";
            }else{
                for($i=0,$ilen = count($where);$i<$ilen;$i++){
                    if($i < $ilen-1){
                        $whereTemp = "'".$whereTemp.$where[$i]."',";
                        continue;
                    }
                    $whereTemp = "'".$whereTemp.$where[$i]."'";
                }
            }
            //构建查询语句
            $sql = "";
            if($whereTemp == ""){
                $sql = "select ".$cols." from ".$tablename;
            }else{
                $sql = "select ".$cols." from ".$tablename." where ".$wherename."=".$whereTemp;
            }
            //echo $sql;
            //执行查询语句返回结果
            $result = mysqli_query($this->link,$sql);
            //echo $result;
            //如果查询语句执行错误就返回error,否则就返回查询结果
            if(mysqli_affected_rows($this->link) < 0){
                mysqli_close($this->link);
                return "error";
            }else{
                $arr = array();
                //将查询的结果放入$row数组中，再将$row添加到$arr数组中在返回
                while($row = mysqli_fetch_assoc($result)){
                    //$arr = array_merge($arr,$row);
                    $arr[] = $row;
                }
                mysqli_close($this->link);
                return $arr;
            }
        }

        /**
         * 将数据插入到数据库中
         * @param [char] $tablename 表的名称
         * @param [array] $arrCols 字段名
         * @param [array] $arrValues 字段值
         * @return boolean
         */
        function insertDB($tablename,$arrCols,$arrValues){
            if($this -> link == null){
                $this -> connectDB();
            }
            print_r($arrValues);
            //根据数组元素拼接要插入的字段名
            $tempCols = "(";
            for($i = 0,$ilen = count($arrCols);$i<$ilen;$i++){
                if($i < $ilen -1){
                    $tempCols = $tempCols.$arrCols[$i].",";
                }else{
                    $tempCols = $tempCols.$arrCols[$i].")";
                }
            }
            //根据数组元素拼接要插入的字段值
            $tempValues = "(";
            for($i=0,$lien=count($arrValues);$i<$lien;$i++){
                if($i<$lien-1){
                    //如果插入的字段值是字符串,就直接插入对应的字段,否则就转化为字符串在插入最后一个不拼接逗号
                    if(is_array($arrValues[$i])){
                        $tempValues = $tempValues."'".$arrValues[$i]."'".",";
                    }else{
                        $tempValues = $tempValues."'".$arrValues[$i]."',";
                    }
                }
            }
            $tempValues = $tempValues."'".$arrValues[count($arrValues)-1]."'".")";
            $sql = "insert into ".$tablename. $tempCols." values".$tempValues;
            echo $sql;
            mysqli_query($this->link,$sql);
            //如果插入的语句影响行数大于0，说明插入成功。关闭数据库返回true，否则返回false
            if(mysqli_affected_rows($this->link) >= 0){
                mysqli_close($this->link);
                return true;
            }else{
                mysqli_close($this->link);
                return false;
            }
        }

        /**
         * 更新数据
         * @param [char] $tablename
         * @param [char] $whereVal
         */

        function updateDB($tablename,$whereVal){
            if($this->link == null){
                $this -> connectDB();
            }
            $sql = "update ".$tablename." set state = '3' where id = '".$whereVal."'";
            mysqli_query($this->link,$sql);
            //如果插入的语句影响行数大于0，说明插入成功。关闭数据库返回true，否则返回false
            if(mysqli_affected_rows($this->link) >= 0){
                mysqli_close($this->link);
                return true;
            }else{
                mysqli_close($this->link);
                return false;
            }
        }

        /**
         * 删除数据
         * @param [char] $tablename
         * @param [char] $where
         * @return boolean
         */
        function deleteDB($tablename,$where){
            if($this->link = null){
                $this -> connectDB();
            }
            //根据给定的字段的键值组合删除表中的相关内容,成功返回true,失败返回false
            $sql = "delete from ".$tablename." where ".$where;
            mysqli_query($this->link,$sql);
            if(mysqli_affected_rows($this->link) >= 0){
                mysql_close($this->link);
                return true;
            }else{
                mysql_close($this->link);
                return false;
            }
        }

        //获取客户端通过ajax提交form表单的数据，返回数组
        function getClientData($arr){
            $arrTemp = array();
            for($i=0,$ilen=count($arr);$i<$ilen;$i++){
                array_push($arrTemp,$_REQUEST[$arr[$i]]);
            }
            return $arrTemp;
        }
    }
?>