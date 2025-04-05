//**************** Course User File
<?php				        
		
		$query = "SELECT * FROM `cours`";

        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0){
        
                        //We have data 
                        //output the data
         while( $row = mysqli_fetch_assoc($result) ){
         		$courseId = $row["id"];
         	 	$coursePic = $row["cover"];
                $coursename = $row["name"];
                $courseDescription = $row["description"];

                echo '<div class="col-sm-6 col-md-3">
							<div class="thumbnail image_fade">
							  <img data-src="holder.js/300x200" alt="Image" src="gotoep/images/courses/'.$coursePic.'" style="display: block; border: 2px solid #555;">
							  <div class="caption">
							  	
								<h5>'.$coursename.'</h5>
								<p>'.$courseDescription.'</p>
								<a href="lecture.php?id='.$courseId.'" class="btn btn-success btn-lg btn-block"  role="button"><strong>Go To Course</strong></a>
							  </div>
							</div>
						  </div>';
         }
     }else{echo '<div class="section notopmargin notopborder">
					<div class="container clearfix">
						<div class="heading-block center nomargin">
							<h3>Courses are not available Yet</h3>
							</div>
						</div>
					</div>';}
                    
                   /* <div class="row">
                    @forelse($courses as $course)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail image_fade">
                                <img alt="Image" src="{{ asset('gotoep/images/courses/' . $course->cover) }}" style="display: block; border: 2px solid #555;">
                                <div class="caption">
                                    <h5>{{ $course->name }}</h5>
                                    <p>{{ $course->description }}</p>
                                    <a href="{{ url('lecture?id=' . $course->id) }}" class="btn btn-success btn-lg btn-block" role="button">
                                        <strong>Go To Course</strong>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="section notopmargin notopborder">
                            <div class="container clearfix">
                                <div class="heading-block center nomargin">
                                    <h3>Courses are not available Yet</h3>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>*/
                
                    ?>