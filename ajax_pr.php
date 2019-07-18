<?php
$conn=mysqli_connect("localhost","root","","company");
	if(isset($_POST['todo']) && $_POST['todo']=='getDepts'){
		$qry="SELECT dept_no as dno, dept_name as dn FROM departments;";
		$res=mysqli_query($conn,$qry);
		$options="";
		while($row=mysqli_fetch_assoc($res)){
			$options=$options."<option value='".$row['dno']."'>".$row['dn']."</option>";
		}
		echo $options;
	}else if(isset($_POST['todo']) && $_POST['todo']=='geTitles'){
		$DN=$_POST['dept_num'];
		$qry="SELECT distinct title FROM titles INNER JOIN dept_emp ON titles.emp_no=dept_emp.emp_no 
		INNER JOIN departments ON dept_emp.dept_no=departments.dept_no where departments.dept_no='$DN' 
		ORDER BY title;";
		die($qry);
		$res=mysqli_query($conn,$qry);
		$options="";
		while($row=mysqli_fetch_assoc($res)){
			$options=$options."<option value='".$row['dept_no']."'>".$row['title']."</option>";
		}
		echo $options;

	}else{
		header("location: index.php");
	}

?>