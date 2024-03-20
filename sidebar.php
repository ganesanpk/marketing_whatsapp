<?php

if (!isset($_SESSION['user']))  {
   header ("Location: index.php");
} 
?>
<div>
   <div style="width:100%;" class="container">
   <div class="row">
      <div class="wrapper">
         <div class="side-bar">
            <ul>
               <li class="menu-head">
                  Main Menu <a href="#" class="push_menu"><span class="glyphicon glyphicon-align-justify pull-right"></span></a>
               </li>
               <div class="menu ">
                  <li>
                     <a href="home.php">Dashboard <span class="glyphicon glyphicon-dashboard pull-right"></span></a>
                  </li>
              
                  <li>
                     <a class="dropdown-toggle"> Campaign <span style=" float:right;" class="glyphicon glyphicon-triangle-bottom"></span></a>
                     <ul  class="submenu">
                              <li><a href="campaignlist.php">Campaign List</a></li>
                        </ul>
                  </li>
           
                  <li>
                     <a  class="dropdown-toggle">Message <span style=" float:right;" class="glyphicon glyphicon-triangle-bottom"></span></a>
                     <ul  class="submenu">
                             
                              <li><a href="messagelist.php">Message List</a></li>
                        </ul>
                  </li>

                  <li>
                     <a  class="dropdown-toggle">Message Group <span style=" float:right;" class="glyphicon glyphicon-triangle-bottom"></span></a>
                     <ul  class="submenu">
                              <li><a href="message_group_list.php">Message Group List</a></li>
                        </ul>
                  </li>

                  <li>
                     <a class="dropdown-toggle"> User Campaign <span class="glyphicon glyphicon-user pull-right"></span></a>
      
                       
                  </li>
                                    
                  <li>
                     <a href="#"> Analytics <span class="glyphicon glyphicon-search pull-right"></span></a>
                  </li>
                              
                  <li>
                     <a  class="dropdown-toggle"> User Logs <span class="glyphicon glyphicon-log-in pull-right"></span></a>
                     <ul  class="submenu">
                              <li><a href="loglist.php">log List</a></li>
                        </ul>
                  
                  </li>

               </div>
            </ul>
 
         </div>
       

  

  