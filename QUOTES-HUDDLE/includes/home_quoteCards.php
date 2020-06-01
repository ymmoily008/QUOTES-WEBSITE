 <?php
 /*Prints out the quotes obtained from the query to the database*/

      echo "<div class=\"container\"> ";
      echo "<div class=\"cardWrapper\">";
      echo "<center><h1>Quotes</h1>";
      echo "<div class=\"cardCols\">";


      $sql_query = "SELECT * FROM quotes WHERE LENGTH(quote_text<=27) ORDER BY RAND() LIMIT 10" ; 
      $result = mysqli_query($conn,$sql_query);
      $resultCheck = mysqli_num_rows($result);
      $counter = 501;

      if($resultCheck>0){
        // shuffle_assoc($result);


        while ( $row = mysqli_fetch_assoc($result)) {

             
          $quote =$row["quote_text"];
          $author_name=$row["quote_author"];
          $url_img_no = $counter;           //Counter var
          $counter ++;
          $url_img_no=(string) $url_img_no;
          $url_img = "https://unsplash.it/".$url_img_no."/".$url_img_no."/";

          echo "<div class=\"cardColumn\" ontouchstart=\"this.classList.toggle('hover'); \"> ";
          echo "<div class=\"cardContainer\"> ";
          echo "<div class=\"cardFront\" style=\"background-image: url(".$url_img." )\"> ";
          //Change the url nos

          echo " <div class=\"cardInner\"> ";
          echo " <p>Quote by</p>";

          echo "<span>".$author_name."</span>"; 
          //Change the name of the author 

          echo "</div> </div> ";        
          echo "<div class=\"cardBack\"> ";     
          echo "<div class=\"cardInner\">"; 
          echo "<p>".$quote."</p> ";  
          //Change the quote

          echo "</div> </div> </div> </div>"; 

          }//while
      }//if
      echo "</div> </div> </div>"; 

    ?>