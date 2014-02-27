<!-- topbar starts -->
<div class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="<?php echo site_url('admin'); ?>"> <img alt="Logo" src="<?php echo base_url(); ?>assets/<?php echo $this->config->item('controlPanel') ?>/img/logo20.png" /> <span><?php echo $this->config->item('controlPanelTitle') ?></span></a>
			<?php if($this->session->userdata('sysuser_loggedin_user')!=''){ ?>
			<!-- user dropdown starts -->
			<div class="btn-group pull-right" >
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-user"></i><span class="hidden-phone"> <?php echo $this->session->userdata('sysuser_loggedin_user');?> </span>
					<span class="caret"></span>
				</a>
				<ul class="dropdown-menu">
                                        <?php if($this->session->userdata('sysuser_type')=='store'){ ?>
                                            <li><a href="<?php echo site_url($this->config->item('controlPanel') . '/store/myProfile/'.$this->session->userdata('sysuser_loggedin_user_id')) ?>">Profile</a></li>
                                        <?php }else{ ?>
                                            <li><a href="<?php echo site_url($this->config->item('controlPanel') . '/system/myProfile/'.$this->session->userdata('sysuser_loggedin_user_id')) ?>">Profile</a></li>
                                        <?php } ?>
					<li class="divider"></li>
					<li><a href="<?php echo site_url($this->config->item('controlPanel') . '/logout') ?>">Logout</a></li>
				</ul>
			</div>
			<!-- user dropdown ends -->
			<?php } ?>
		</div>
	</div>
</div>
<!-- topbar ends -->
<div class="container-fluid">
	<div class="row-fluid">
	<?php if($this->session->userdata('sysuser_loggedin_user')!=''){ ?>
	<?php $this->load->view($this->config->item('controlPanel')."/left_menu_view"); ?>
	<?php } ?>