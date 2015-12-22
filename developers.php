<?php 
require "functions.php";
echo "<!DOCTYPE html>\n<html>\n";
display_headers($title);
echo "\n<body>";
menu();
echo <<< a
<div class="container" style="margin-top:-15px;">
        <br>
            <div id="CSE1" class='well well-large' style="background:#FFF;">
                
               <div id="step1">     
					<h5 class='text-info'>Developers Page @ Attendance Portal </h5>
					<h6> &emsp;&emsp;&emsp; - &emsp; Contact us for any technical problems of Attendance Portal </h6><br>
				</div>
                	<br>
               <div class="row">
				   <div class='span1'></div>
				   <div class='span5'>
					   <div class='span1'><img src='assets/img/user.jpg'/></div>
					   <div class='span3'>
						       <address >
								<strong>Aneesh Kumar T</strong><br>
								N090247<br>
								CSE1 - 2009 <br>
								<a href="mailto:#">N090247@nuz.rgukt.in</a>
								</address>
						</div>
					</div>
					<div class='span5'>
					   <div class='span1'><img src='assets/img/user.jpg'/></div>
					   <div class='span3'>
						       <address >
								<strong>Anesh Parvatha</strong><br>
								N090977<br>
								CSE3 - 2009 <br>
								<a href="mailto:#">N090977@nuz.rgukt.in</a>
								</address>
						</div>
					</div>
               </div>
               <br>
                              <div class="row">
				   <div class='span1'></div>
				   <div class='span5'>
					   <div class='span1'><img src='assets/img/user.jpg'/></div>
					   <div class='span3'>
						       <address >
								<strong>Naresh Kommuri</strong><br>
								N090331<br>
								CSE5 - 2009 <br>
								<a href="mailto:#">N090331@nuz.rgukt.in</a>
								</address>
						</div>
					</div>
					<div class='span5'>
					   <div class='span1'><img src='assets/img/user.jpg'/></div>
					   <div class='span3'>
						       <address >
								<strong>Nageswararao P</strong><br>
								N091030<br>
								CSE3 - 2009 <br>
								<a href="mailto:#">N091030@nuz.rgukt.in</a>
								</address>
						</div>
					</div>
               </div>
               
         </div>  
    </div>
a;
display_footer();
echo "\n</body>\n</html>";
?>
