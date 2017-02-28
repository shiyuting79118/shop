<?php
    
    /**
     * 专业查询三十年
     **/

    function query( $sql ){

        $result = mysql_query($sql);

        if( $result && mysql_num_rows( $result ) > 0 ){

            $list = array();        //声明一个空数组，将每条记录放到这个空数组中

            while( $row = mysql_fetch_assoc( $result ) ){
                $list[] = $row;
            }

            return $list;
        }

        // 能执行到这里，说明查询失败
        return false;

    }


    /**
     *  专业执行增、删除、改三十年
     **/

    function execute( $sql ){

        $result = mysql_query($sql);

        // 说明用户在执行添加
        if( $result && mysql_insert_id() > 0 ){
            return mysql_insert_id();       // 执行添加成功，返回自增id
        }

        // 执行编辑或删除
        if( $result && mysql_affected_rows() > 0 ){
            return true;
        }

        // 执行失败
        return false;
    }
