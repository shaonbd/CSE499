<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
    <body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('progress_link_student.php'); ?>
                <div class="span8" id="content">
                     <div class="row-fluid">

					    <!-- breadcrumb -->
				
						<?php   $class_query = mysql_query(" SELECT * from teacher_class LEFT JOIN class ON class.class_id = teacher_class.class_id
											   where teacher_class_id = '$get_id'")or die(mysql_error());

								$class_row = mysql_fetch_array($class_query);
								$class_id = $class_row['class_id'];
								$school_year = $class_row['school_year'];
						?>
				
					    <ul class="breadcrumb">
							<li><a href="#"><?php echo $class_row['class_name']; ?></a> <span class="divider">/</span></li>
							<li><a href="#">Academic Year: <?php echo $class_row['school_year']; ?></a> <span class="divider">/</span></li>
							<li><a href="#"><b>Progress</b></a></li>
						</ul>
						 
						<!-- end breadcrumb -->
					 
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
							    <div id="" class="muted pull-left"><h4> Assignment Grade Progress</h4></div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">
										<table cellpadding="0" cellspacing="0" border="0" class="table" id="">
						
										<thead>
										        <tr>
												<th>Date Upload</th>
												<th>Assignment</th>											
												<th>Grade</th>
												</tr>
												
										</thead>
										<tbody>
											
                              		<?php
										$query = mysql_query(" SELECT * FROM student_assignment 
										LEFT JOIN student ON student.student_id  = student_assignment.student_id
										RIGHT JOIN assignment ON student_assignment.assignment_id  = assignment.assignment_id
										WHERE student_assignment.student_id = '$session_id'
										order by fdatein DESC")or die(mysql_error());
										while($row = mysql_fetch_array($query)){
										$id  = $row['student_assignment_id'];
										$student_id = $row['student_id'];
									?>                              
										<tr>
										 <td><?php echo $row['fdatein']; ?></td>
                                         <td><?php echo $row['fname']; ?></td>
                                      
										 <?php if ($session_id == $student_id){ ?>
                                         <td>
										 <span class="badge badge-success"><?php echo $row['grade']; ?></span>
										 </td>
										 <?php }else{ ?>
										 <td></td>
										 <?php } ?>										 
                                </tr>
                         
						 <?php } ?>
						   
                              
										</tbody>
									</table>
						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
				
				
				
				<div class="span8" id="content">

                    <div class="row-fluid">
					    <!-- breadcrumb -->		
							
				
					     <ul class="breadcrumb">
		
							<li><a href="#"></a></li>
						</ul>
						 <!-- end breadcrumb -->
					 
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
							    <div id="" class="muted pull-left"><h4>Test Progress</h4></div>
							</div>
                            <div class="block-content collapse in">
                                <div class="span12">
			
								<table cellpadding="0" cellspacing="0" border="0" class="table" id="">
										<thead>
										        <tr>
										        <th>Date</th>
												<th>Test</th>												
												<th>Score / Number</th>
												<th>Score_% / Marks(%)</th>
												</tr>
										</thead>
										<tbody>
                              		<?php
	                              		$percent_score_sum = 0;
	                              		$percent_weight_total = 0;
	                              		$grade_on_percentage = 0;
										$query = mysql_query("SELECT * FROM teacher_class_student RIGHT JOIN marks on marks.teacher_class_student_id = teacher_class_student.teacher_class_student_id INNER JOIN full_marks ON full_marks.poll_id = marks.poll_id where student_id = '$session_id' ")or die(mysql_error());

										while($row = mysql_fetch_array($query)){
										
										
										$percent_score = round(($row['marks'] * $row['poll_weight']) / $row['number']);
										$percent_score_sum += $percent_score;
										$percent_weight_total += $row['poll_weight'];
										$grade_on_percentage = round(($percent_score_sum * 100) / $percent_weight_total);		
					
									    
									?>	
										<tr>
										 <td><?php echo $row['pdatein']; ?></td>                     
										 <td><?php echo $row['poll_name']; ?></td>
										 <td><?php  echo $row['marks'] ."/". $row['number']; ?></td>
                                         <td><?php  echo $percent_score."/". $row['poll_weight']; ?></td>                                 			 
										</tr>



										<?php } ?>
						 
										</tbody>
									</table>
						
                                </div>
                            </div>

                            <div class="navbar navbar-inner block-header">
                            <tbody>
							    
							    <tr>
								    <td><div class="span6"><h4>Grade on Total</h4></div></td>
								    <td>
								    	<div class="span6">
								    	<span class="badge badge-success" style="margin-left: 200px">
									    <?php 

									    		if($grade_on_percentage >= 93){
									    			echo "A"; 
									    		}
									    		else if($grade_on_percentage >= 90 && $grade_on_percentage <= 92){
									    			echo "A-"; 
									    		}
									    		else if($grade_on_percentage >= 87 && $grade_on_percentage <= 89){
									    			echo "B+"; 
									    		}
									    		else if($grade_on_percentage >= 83 && $grade_on_percentage <= 86){
									    			echo "B"; 
									    		}
									    		else if($grade_on_percentage >= 80 && $grade_on_percentage <= 82){
									    			echo "B-"; 
									    		}
									    		else if($grade_on_percentage >= 77 && $grade_on_percentage <= 79){
									    			echo "C+"; 
									    		}
									    		else if($grade_on_percentage >= 73 && $grade_on_percentage <= 76){
									    			echo "C"; 
									    		}
									    		else if($grade_on_percentage >= 70 && $grade_on_percentage <= 72){
									    			echo "C-"; 
									    		}
									    		else if($grade_on_percentage >= 67 && $grade_on_percentage <= 69){
									    			echo "D+"; 
									    		}
									    		else if($grade_on_percentage >= 60 && $grade_on_percentage <= 66){
									    			echo "D"; 
									    		}
									    		else if($grade_on_percentage <= 60){
									    			echo "F"; 
									    		}
									    		else{
									    			echo "I/W";
									    		}

									    ?>
								    	</span>
								    	</div>
								    </td>
								</tr>    
							  </tbody>	
							</div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
				
				<?php /* include('downloadable_sidebar.php') */ ?>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>
</html>