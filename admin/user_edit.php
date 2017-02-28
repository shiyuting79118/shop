<?php 
  include'header.php';
  $id=$_GET['id'];

  $sql="select `name`,`sex`,`phone`,`mail`,`addr` from ".PRE."user where `id`='$id' ";

  $result=query($sql);
  $result=$result[0];



?>


<div class="content">
    <div class="talign">
    <form action="user_action.php?a=edit" method="post">
    <h3>编辑用户</h3>
 
      <div class="form_list">
        <div class="form_list_title">用户名：</div>
        <div class="form_list_content"><input class="form-control" type="text" name="name" placeholder="<?php echo $result['name'] ?>"/></div>
      </div>

      <div class="form_list">
        <div class="form_list_title">手机号码：</div>
        <div class="form_list_content"><input class="form-control" type="text" name="phone" placeholder="<?php echo $result['phone'] ?>"/></div>
      </div>

       <div class="form_list">
        <div class="form_list_title">地址：</div>
        <div class="form_list_content"><input class="form-control" type="text" name="addr" placeholder="<?php echo $result['addr'] ?>"/></div>
      </div>


       <div class="form_list">
                <div class="form_list_title">Email：</div>
                <div class="form_list_content"><input class="form-control" type="email" name="mail" placeholder="<?php echo $result['mail'] ?>"/></div>
            </div>

              <div class="form_list">
                 
                <div class="radio">
                <label >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;性别：</label>
                  <label>
                    <input type="radio" name="sex" id="optionsRadios1" value="sex" checked>
                   男
                  </label>
              
                  <label>
                    <input type="radio" name="sex" id="optionsRadios2" value="sex">
                   女
                  </label>
            </div> 
            </div>

            <div class="form_list">
                <div class="form_list_title">密码：</div>
                <div class="form_list_content"><input class="form-control" type="password" name="pwd" placeholder="请输入密码"/></div>
            </div>

            <div class="form_list">
                <div class="form_list_title">重复密码：</div>
                <div class="form_list_content"><input class="form-control" type="password" name="repwd" placeholder="请再次输入密码"/></div>
            </div>
            <!-- 使用隐藏域，把id传递到action.php的 edit这个case中 -->
            <input type="hidden" name="id" value="<?php echo $id ?>" />
       

       <div class="form_list">
                <div class="form_list_title"></div>
                <div class="form_list_content">
                    <input class="btn btn-primary" type="submit" value="点击添加"/>
                </div>
            </div>
    </form>
  </div>  
</div>


<?php include 'footer.php' ?>