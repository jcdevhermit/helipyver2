<?php
	$conn=mysqli_connect("localhost","root","","jobs");
	if(isset($_POST['todo']) && $_POST['todo']=='getEduc'){
		$qry="SELECT educ_level el, level_name ln 
			  FROM tbl_educ_level;";
		$res=mysqli_query($conn,$qry);
		$options="";
		while($row=mysqli_fetch_assoc($res)){
			$options=$options."<option value='".$row['el']."'>".$row['ln']."</option>";
		}
		echo $options;

	}else if(isset($_POST['todo']) && $_POST['todo']=='getDegree'){
		$EL=$_POST['educlevel'];
		$qry="SELECT educ_index, ifnull(degree,'N/A') degree 
			  FROM tbl_education 
			  WHERE educ_level=$EL;";
		$res=mysqli_query($conn,$qry);
		$options="";
		while($row=mysqli_fetch_assoc($res)){
			$options=$options."<option value='".$row['educ_index']."'>".$row['degree']."</option>";
		}
		echo $options;

	}else if(isset($_POST['todo']) && $_POST['todo']=='getJob'){
		$EI=$_POST['educindex'];
		$EL=$_POST['educlevel'];
		if($EL < 6){
		$qry="SELECT job_title from job_list 
			WHERE min_educ_level <=$EL ORDER BY min_educ_level;";
	
		}else if ($EL < 9){
		$qry="SELECT job_title from job_list 
			WHERE min_educ_level <=$EL OR educ_index=$EI ORDER BY min_educ_level;";
		
		}else{
			$qry="SELECT * from job_list ORDER BY min_educ_level;";
		}

		$res=mysqli_query($conn,$qry);
		$options="";
		while($row=mysqli_fetch_assoc($res)){
			$options=$options."<option value='".$row['job_index']."'>".$row['job_title']."</option>";
		}
		echo $options;

	}else{
		header("location: index.php");
	}
	#INNER JOIN tbl_education on tbl_education.educ_level=job_list.min_educ_level
			  #where (job_list.educ_index=$EI and tbl_education.educ_index=$EL) or tbl_education.educ_level < 7;
	#$qry="SELECT job_index, job_title from job_list where educ_index=$EI or min_educ_level<6 ORDER BY ;";
		#$res=mysqli_query($conn,$qry);
?>