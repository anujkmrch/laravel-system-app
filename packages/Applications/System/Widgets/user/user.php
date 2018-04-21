<?php if(\System::isGuestCreated()): ?>
	<ul class="nav navbar-nav navbar-right">
	    <li>
	        <p class="navbar-btn">
	            <a href="<?php echo route('auth.register'); ?>" class="btn  btn-sm btn-default
	            ">Sign up</a>
	        </p>
	    </li>
	     <li>
	        <p class="navbar-btn">
	            <a href="<?php echo route('auth.login'); ?>" class="btn btn-sm btn-primary">Login</a>
	        </p>
	    </li>
	</ul>
<?php else: ?>
<ul class="nav navbar-nav navbar-right">
    <li><p class="navbar-btn">
		<a href="<?php echo route('client.user.profile'); ?>" class="btn btn-sm btn-default btn-xs">Profile</a>
	        </p>
	</li>
	<li><p class="navbar-btn">
		<a href="<?php echo route('auth.logout'); ?>" class="btn  btn-sm btn-primary">Logout</a>
	        </p></li>
</ul>
<?php endif; ?>