@php
$is_logged_user=false;

if(isset($_COOKIE["AuthU"])&&$_COOKIE["AuthU"]!="")
{
	list($cookieUser,$cookiePassword,$cookieExpire)=explode("~",$_COOKIE["AuthU"]);

	if($cookieExpire>time())
	{
		$is_logged_user=true;
	}
}

if($is_logged_user)
{
@endphp
    <ul class="top-links">
        <li><a href="USERS/index.php">My Profile</a></li>
        <li><a href="USERS/logout.php">Logout</a></li>
    </ul>
@php
}
else
{
@endphp
	@php if ($GLOBALS['implemented']['user_registry']): @endphp
		<li><a href="index.php?mod=registration">Register</a></li>
	@php endif; @endphp
@php
}
@endphp