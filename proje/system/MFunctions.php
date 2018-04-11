<?php

function git($value)
{
	header("location:$value");
	exit();
}

function sureliGit($url,$sure=0)
{
	header("refresh:$sure;$url");
}

function pr($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}