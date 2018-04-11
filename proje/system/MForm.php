<?php 

function pisset(){
	if ($_POST) {
		return true;
	}else{
		return false;
	}
}

function gisset(){
	if ($_GET) {
		return true;
	}else{
		return false;
	}
}

function post($value)
{
	if (isset($_POST[$value])) {
		return trim($_POST[$value]);
	}else{
		return false;
	}
}

function get($value)
{
	if (isset($_GET[$value])) {
		return trim($_GET[$value]);
	}else{
		return false;
	}
}