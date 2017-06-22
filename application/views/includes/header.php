<html>
<head>
	<meta charset="utf-8" />
	<title> Vue Admin </title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/materialize/css/materialize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/main.css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<script type="text/javascript">
		var _URL = '<?php echo base_url();?>';
	</script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/jquery/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/materialize/js/materialize.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/vue/vue.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/vue/vue-resource.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/functions.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/vue/vue-router/dist/vue-router.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>	

</head>
<body class="not-scroll">

<div id="main-loader">
	<div class="container center" style="margin-top: 18%;">
		<h3 class="white-text" style="color: #fff;">Loading...</h3>
	  	<div class="progress">
	    	<div class="indeterminate"></div>
	  	</div>
	</div>
</div>