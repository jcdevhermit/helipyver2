<html>
<head>
	<title>Company Statistics</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="js/jquery.js"></script> -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body>
	<div class="row"><!-- start of navigation -->
    <div id="mynav" class="col-sm-12">
	   <ul>
	   		<span>Company Statistics</span>
    		<li>
    		 <a class="main" onclick="openNav()" href="#">Employee Count</a>
    		</li>
    		<li>
    		<a class="main" onclick="openNav()" href="#">Employee Salaries</a>
        	</li>
    	</ul>
    </div>
    </div><!-- end of navigation -->

 <div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()"></a>
 <div id="form">
  <form>
     <div class="form-group">
    <label for="sel1"><h4>Department:</h4></label>
      <select class="form-control" id="departments">
       
      </select>
    </div> 

    <div class="form-group">
    <label for="sel1"><h4>Title:</h4></label>
      <select class="form-control" id="titles">
        
      </select>
    </div> 

    <h4>Date Range</h4>
	  <div class="form-group">
	  <label for="exampleInputEmail1">From:</label>
		<input  class="form-control" type="date" placeholder="dd/mm/yy">
		<label for="exampleInputEmail1">To:</label>
		<input  class="form-control" type="date" placeholder="dd/mm/yy">
			<div class="form-check">
	  			<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
	  			<label class="form-check-label" for="defaultCheck1">
	    		Current
	  			</label>
			</div>
			<button type="button" class="btn btn-success btn-block">Submit</button>

	</div>
  </form>
</div>
</div>

<!-- <div id="main">
  <button class="openbtn" onclick="openNav()">&#9776; Toggle Sidebar</button>
  <h2>Collapsed Sidebar</h2>
  <p>Content...</p>
</div> -->

<script>
/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidebar").style.width = "203px";
  document.getElementById("main").style.marginLeft = "203px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
} 
</script>
<script>
  $.ajax({
        type: "POST",
        url: "ajax_pr.php",
        data:{
          todo: "getDepts"
        },
        success: function(data){
          $("#departments").html(data);
          $(function(){
              $.ajax({
                type: "POST",
                url: "ajax_pr.php",
                data:{
                  todo: "getTitles",
                  dept_num: $("#departments").val()
                },
                success: function(data){
                $("#titles").html(data);
               
                }
                });   
              
          });
        }

  });


</script>
</body>
</html>