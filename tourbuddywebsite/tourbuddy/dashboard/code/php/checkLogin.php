<?php

	if($_SESSION[$logged] === false)
	{
		header("Location:../login.html");
	}
?>