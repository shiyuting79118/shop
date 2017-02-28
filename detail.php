<?php
    include 'header.php';

    if(empty($_SESSION['home']))
    {
        header("location:index.php");
        exit;

    }

    //接收商品ID
   $gid=$_GET['gid'];
   
   $sql=" select g.name gname, g.price, g.describe, g.store, i.name iname
        from ".PRE."goods g, ".PRE."img i
        where i.goods_id=g.id and i.is_face=1 and g.id='$gid'
        ";

   $goods=query($sql);
   $goods=$goods[0];


   // 把当前商品分类的所以图片 ，全部查询出来 
   $sql= "select `name` from ".PRE."img where `goods_id`='$gid' and `is_face`='0'";
   
   $img_list=query($sql);
   /*$img_list=$img_list[0];*/
   $a = $_SESSION['cart'];
   
  

 ?>


<div class="main"> 
 
 	<div class="img fleft"><!-- 左边 -->

 		<div class="bg_img" class="img-thumbnail">
            <img id="big_img" src="<?php echo getImgUrl('uploads', $goods['iname'], 400 ) ?>"  />
        

 		<div>
 		<!-- sm img list start -->
                <li class="sm_img_list fleft">
                
                   <img onmouseover="changeImg(this)" src="<?php echo getImgUrl('uploads', $goods['iname'], 80) ?>" width="100" height="100" />
                </li>
                
                <?php if(!empty($img_list)): ?>
                <?php foreach($img_list as $val): ?>
                <li class="sm_img_list fleft">
                    <img onmouseover="changeImg(this)" src="<?php echo getImgUrl('uploads', $val['name'], 80 ) ?>" width="100" height="100" />
                </li>

                <!-- sm img list end -->

                <?php endforeach; ?>
                <?php endif; ?> 
           
 		</div>
        </div>

 	</div>



      <!-- 右边 -->

 	 <div class="info  fleft">

			<div class="detail_list beijingse">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>详情信息:</b></div>
 	 		<div class="detail_list ">商品价格:&yen;<?php echo $goods['price'] ?></div>


            <div class="detail_list">商品名称:<?php echo $goods['gname'] ?></div>

            <div class="detail_list">商品信息:<?php echo $goods['describe'] ?></div>

            

            <div class="detail_list">商品库存:<span id="store"><?php echo $goods['store'] ?></span>件</div>

            <form action="docart.php" method="get">

                <!-- 隐藏域将商品id传递到docart.php -->
                <input type="hidden" name="gid" value="<?php echo $gid ?>" />
                
                <input type="hidden" name="a" value="add" />


            <div class="detail_list">购买数量: 

                <a onclick="minus()" class="btn btn-default">-</a>

                <input id="qty" onkeyup="num()" type="text" name="qty" value="1"  />

                <!-- <form >
				    
				    <div class="input-group">
				      <div class="input-group-addon"><a onclick="minus">-</a></div>
				      <input type="text" class="form-control" onkeyup="num()" id="qty" placeholder="1">
				      <div class="input-group-addon"><a onclick="plus()">+</a></div>
				    </div>
				 
				</form> -->

                <a onclick="plus()" class="btn btn-default">+</a>

             </div>

            <div class="detail_list">
            <input type="submit" value="加入购物车" class="btn btn-info" />
            </div>
            
            </form>
 	
 	</div>


 </div>

 <script>
    // 这里是写js的地方
    function changeImg( sm_img ){

        // 找到大图这个图片元素
        var img = document.getElementById('big_img');

        // 将大图的src变成和小图的src一至即可
        img.src = sm_img.src.replace('80_','400_'); 
        // alert(sm_img.src);
    }

    // 找到qty这个输入框
    var qty = document.getElementById('qty');

    // 找到库存数量,并转换成整数
    var store = parseInt(document.getElementById('store').innerHTML);

    function plus(){
        qty.value = parseInt(qty.value)+1;

        // 如果大于库存，你就等于库存
        if(qty.value > store){
            qty.value = store;
        }
    }

    function minus(){
        qty.value =  parseInt(qty.value)-1;

        // 如果小于1，你就是1
        if(qty.value < 1){
            qty.value = 1;
        }
    }

    function num(){

        if(qty.value < 1){
            qty.value = 1;
        }
        
        if(qty.value > store){
            qty.value = store;
        }
    }
</script>
<!-- <?php include 'footer.php'; ?> -->