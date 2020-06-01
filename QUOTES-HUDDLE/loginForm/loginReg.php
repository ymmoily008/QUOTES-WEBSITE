<?php 
  if( !isset($_POST["submit1"]) ){
    $login_error="";
  }
?>

<!-- POPUP FORM-->
<div id="myModal" class="modal fade">
  <div class="modal-dialog modal-login">
    <div class="modal-content">
      <div class="modal-header">
        <div class="avatar">
          <img src="../loginForm/user.png" alt="User">
        </div>        
        <h4 class="modal-title">Login</h4> 
                <button type="button" id="close_btn" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      <div class="modal-body">
        <form action="../includes/loginAction.php" method="post">
          
            <input name="username" type="text"  class="form-control" placeholder="Username" required="required">   
          
       
            <input name="password" type="password" class="form-control" placeholder="Password" required="required"> 
            
       
            <button name="submit" type="submit1" class="btn btn-primary btn-lg btn-block login-btn">Login</button>
        
        </form>
      </div>

      <div id="myFooter" class="modal-footer">
         <?php echo $login_error; ?>
      </div>

    </div>

  </div>
</div>     


<script type="text/javascript">
    var header1 = document.getElementById("navbar-collapse-main");
    var close_btn  = document.getElementById("close_btn");

    close_btn.addEventListener("click", function() {
        var login_link1  = header1.getElementsByClassName("link5");
        login_link1[0].className = login_link1[0].className.replace(" active", "");

  });

</script>