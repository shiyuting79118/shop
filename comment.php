<?php
	include'header.php';

    if(empty($_SESSION['home']))
    {
        header("location:index.php");
        exit;

    }


    $id=$_SESSION['home']['id'];

    $ordernumber=$_GET['ordernumber'];

    $sql="select `id`,`ordernumber`,`userid`,`is_shou`,`if_fu`,`addtime` from ".PRE."order where `ordernumber`='$ordernumber'" ;

    $order=query($sql);




?>

<div class="main">

    <table class="table table-striped table-hover">
        <!-- <tr align="center"> -->
        <tr class="bziti">
            <td><b>ID</b></td>
            <td><b>订单号</b></td>
            <td><b>用户名</b></td>
            <td><b>状态</b></td>
            <td><b>付款</b></td>
            <td><b>添加时间</b></td>
 
        </tr>
    <?php if(!empty($order)):?>
    <?php foreach ($order as $val):?>

        <tr align="center">
            <td><?php echo $val['id'] ?></td>
            <td><?php echo $val['ordernumber']?></td>
            <td>

                <?php 
                $uid = $val['userid'];
                $username = query("select name from ".PRE."user where `id`='$uid'");
                echo $username[0]['name'];
                ?>

            </td>
            <td>
            <?php
                switch ($val['is_shou']) {
                    case '0':
                        echo '未发货';
                        break;
                    
                    case '1':
                        echo '已发货';
                        break;

                    case '2':
                        echo '未收货';
                        break;


                    case '3':
                        echo '已收货';
                        break;
                }

            ?>
            </td>
            <td><?php echo $val['if_fu']? '已付款':'未付款';?></td>
            <td><?php echo date('Y-m-d',$val['addtime'])?></td>
        </tr>


    <?php endforeach;?>
    <?php endif;?>  
    </table>
        <?php  
            /*echo $sql="select `is_ping` from ".PRE."comment where `ordernum`='$ordernumber'";
            $is_ping=query($sql);*/
            // $is_ping=$is_ping[0];
           /* echo'<pre>';
            var_dump ($is_ping);
            echo'</pre>';*/

            $id = $_SESSION['home']['id'];
            $sql = "select `comment` from ".PRE."comment where `userid`='$id' and `ordernum`='$ordernumber'";
            $is_ping = query($sql);
        ?>


        <?php if(empty( $is_ping )): ?>

             <div class="pinglun">
                <form action="./admin/comment_action.php?a=ping&id=<?php echo $val['id']?>&ordernumber=<?php echo $ordernumber ?>" method="post" enctype="multipart/form-data">

                    <div class="pinglun"><textarea class="form-control" name="comment" rows="10">期待您500字好评哦！^_^</textarea></div>
                    <div class="form_list">
                            <div class="form_list_title"></div>
                            <div class="form_list_content">
                                    <span class="glyphicon glyphicon-thumbs-up"></span>
                                    <input  type="radio" name="ping" id="optionsRadios1" value="good" checked>
                                    好评&nbsp;
                                    <span class="glyphicon glyphicon-hand-right"></span>
                                    <input type="radio"  name="ping" id="optionsRadios2" value="middle">   
                                    中评&nbsp;
                                    <span class="glyphicon glyphicon-thumbs-down"></span>
                                    <input type="radio"  name="ping" id="optionsRadios1" value="bed">
                                    差评&nbsp;&nbsp;
                                    <input class="btn btn-primary" type="submit" value="点击添加"/>
                            </div>
                    </div>
                </form>
            </div>

        <?php else: ?>
        <?php 

                $sql="select *from ".PRE."comment";

                $comment=query($sql);
        ?>
        <table class="table table-striped table-hover">
        <tr class="bziti">
            <td><b>ID</b></td>
            <td><b>评论内容 </b></td>
            <td><b>订单号</b></td>
            <td><b>状态</b></td>
 
        </tr>
            <?php if(!empty($comment)):?>
            <?php foreach ($comment as $val):?>

                <tr align="center">
                    <td><?php echo $val['id'] ?></td>
                    <td><?php echo $val['comment']?></td>
                    <td><?php echo $val['ordernum']?></td>
                    <td>
                    <?php
                        switch ($val['is_ping']) {
                            case 'good':
                                echo '好评';
                                break;
                            
                            case 'middle':
                                echo '一般';
                                break;

                            case 'bed':
                                echo '差评';
                                break;
                        }

                    ?>
                    </td>
                </tr>


            <?php endforeach;?>
            <?php endif;?>  
        <?php endif;?>
    </table>




</div><!-- main的结束 -->

 
<?php include 'footer.php'?>

