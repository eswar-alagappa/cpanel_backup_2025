<style>
.animated h3{
	color:#d6a84a
}
</style>

<div role="main" class="right_col">
    <br>
	<div class="">
					<h2>Student Exam <small>Dashboard Count</small></h2>
					<div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-book"></i>
                                </div>
                                <div class="count"><?php echo ((isset($assignedExam[0]) && !empty($assignedExam[0])) ? $assignedExam[0] : '0');?></div>

                                <h3>Assigned Exam</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-book"></i>
                                </div>
                                <div class="count"><?php echo ((isset($assignedExam[1]) && !empty($assignedExam[1])) ? $assignedExam[1] : '0');?></div>

                                <h3>Exam Failed Attend</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-book"></i>
                                </div>
                                <div class="count"><?php echo ((isset($assignedExam[2]) && !empty($assignedExam[2])) ? $assignedExam[2] : '0');?></div>

                                <h3>Waiting For Result</h3>
                            </div>
                        </div>
						
                    </div>
					
					<h2>Students <small>Dashboard Count</small></h2>
					<div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-user"></i>
                                </div>
                                <div class="count"><?php echo ((isset($userCnt[0]) && !empty($userCnt[0])) ? $userCnt[0] : '0');?></div>

                                <h3>Registered Students</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-user"></i>
                                </div>
                                <div class="count"><?php echo ((isset($userCnt[1]) && !empty($userCnt[1])) ? $userCnt[1] : '0');?></div>

                                <h3>Approved Students</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-user"></i>
                                </div>
                                <div class="count"><?php echo ((isset($userCnt[2]) && !empty($userCnt[2])) ? $userCnt[2] : '0');?></div>

                                <h3>Waiting For Approval</h3>
                            </div>
                        </div>
                    </div>
					
					
					<h2>Center <small>Dashboard Count</small></h2>
					<div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-education"></i>
                                </div>
                                <div class="count"><?php echo ((isset($centerCnt[0]) && !empty($centerCnt[0])) ? $centerCnt[0] : '0');?></div>

                                <h3>Registered Centers</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-education"></i>
                                </div>
                                <div class="count"><?php echo ((isset($centerCnt[1]) && !empty($centerCnt[1])) ? $centerCnt[1] : '0');?></div>

                                <h3>Approved Centers</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="glyphicon glyphicon-education"></i>
                                </div>
                                <div class="count"><?php echo ((isset($centerCnt[2]) && !empty($centerCnt[2])) ? $centerCnt[2] : '0');?></div>

                                <h3>Waiting For Approval</h3>
                            </div>
                        </div>
                    </div>
					
					
					<h2>Feedback <small>Dashboard Count</small></h2>
					<div class="row top_tiles">
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i>
                                </div>
                                <div class="count"><?php echo ((isset($feedbackCnt[0]) && !empty($feedbackCnt[0])) ? $feedbackCnt[0] : '0');?></div>

                                <h3>Total Feedback</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i>
                                </div>
                                <div class="count"><?php echo ((isset($feedbackCnt[1]) && !empty($feedbackCnt[1])) ? $feedbackCnt[1] : '0');?></div>

                                <h3>Read Feedback</h3>
                            </div>
                        </div>
                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i>
                                </div>
                                <div class="count"><?php echo ((isset($feedbackCnt[2]) && !empty($feedbackCnt[2])) ? $feedbackCnt[2] : '0');?></div>

                                <h3>Unread Feedback</h3>
                            </div>
                        </div>
						
						<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-comments-o"></i>
                                </div>
                                <div class="count"><?php echo ((isset($feedbackCnt[3]) && !empty($feedbackCnt[3])) ? $feedbackCnt[3] : '0');?></div>

                                <h3>Replied Feedback</h3>
                            </div>
                        </div>
                    </div>
	</div>
</div>