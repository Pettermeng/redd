<?php
echo'<style type="text/css">
	
	.pagination_num ul{
		float: left;
		margin: 0;
		padding: 0;
	}
	.pagination ul li.inactive,
	.pagination ul li.inactive:hover{
		background-color:#ededed;
		color:#bababa;
		border:1px solid #bababa;
		cursor: default;
	}
	
	.pagination{
		/*width: 800px;*/
		width: 100%;
		height: auto;
		float:right;
		margin-bottom: 5px;
		margin: 0 !important;
		background: #EEE;
		padding:3px 0;
		position:relative;
		z-index:1000;
	}
	.pagination_page{
		display:inline;
		float:right;
	}
	.pagination_num{
		display:inline;
		float:right;
	}
	
	.pagination ul li{
		list-style: none;
		float: left;
		line-height:13px;
		border: 1px solid #006699;
		padding: 5px;
		margin: 0 2px;
		font-family: Verdana, arial, sans-serif;
		font-size: 11px;
		color: #0076ff !important;
		font-weight: bold;
		cursor: pointer;
		background-color: #FFF !important;
	}
	.pagination ul li:hover{
		color: #fff;
		background-color: #006699;
		cursor: pointer;
	}
	.pagination ul li.active{
	    background: #006699 !important;
	}
	.pagination ul li.active a{
	    color: #FFF !important;
	}
	.pagination ul li a{
	    text-decoration: none;
	}
	.go_button{
	    background-color:#f2f2f2;
	    border:1px solid #006699;
	    color:#cc0000;
	    padding:2px 6px 2px 6px;
	    cursor:pointer;
	    position:absolute;margin-top:-1px;
	}
	.total{
		font-size:14px;font-family:arial;color:#000 !important;
	}
</style>';
?>