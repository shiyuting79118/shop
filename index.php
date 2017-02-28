<?php 
include './header.php'; 

 

?>



<div class="gun">
     <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="item active">
           <img src="./images/gun1.jpg" alt="ipad-pro">
          <div class="carousel-caption">
            ...
          </div>
        </div>


        <div class="item">
            <img src="./images/gun2.jpg" alt="macbook">
          <div class="carousel-caption">
            ...
          </div>
        </div>

       <div class="item">
          <img src="./images/gun3.jpg" alt="watch">
          <div class="carousel-caption">
            ...
          </div>
        </div>

      </div>

      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

</div>


<?php include './footer.php' ?>
