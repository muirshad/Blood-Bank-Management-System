
<style>
	.collapse a{
		text-indent:10px;
	}
	nav#sidebar{
		/*background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>) !important*/
	}
@media screen and (min-width: 100px) and (max-width:1500px) {
  /* For mobile phones: */
  #sidebar{
  width: 20%;
  display: block;
  display: flex;
  justify-content: space-between;
  display: grid;
  height: auto;
  position: relative;
  /*grid-template-columns: 1fr 3fr;*/
  }
}   

</style>

<nav id="sidebar" class='mx-lt-5 bg-primary' >
		
		<div class="sidebar-list">
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home text-warning"></i></span> Home</a>
				<a href="index.php?page=donors" class="nav-item nav-donors"><span class='icon-field'><i class="fa fa-user-friends text-warning"></i></span> Donors</a>
				<a href="index.php?page=donations" class="nav-item nav-donations"><span class='icon-field'><i class="fa fa-tint text-warning"></i></span> Blood Donations</a>
				<a href="index.php?page=requests" class="nav-item nav-requests"><span class='icon-field'><i class="fa fa-th-list text-warning"></i></span> Requests</a>
				<a href="index.php?page=handedovers" class="nav-item nav-handedovers"><span class='icon-field'><i class="fa fa-toolbox text-warning"></i></span> Handed Over</a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users text-warning"></i></span> Users</a>
				<!-- <a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs text-danger"></i></span> System Settings</a> -->
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav_collapse').click(function(){
		console.log($(this).attr('href'))
		$($(this).attr('href')).collapse()
	})
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
