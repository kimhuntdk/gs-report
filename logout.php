<?php
@ob_start();
@session_start();


unset($_SESSION["SES_EXAM_STD_ID"]);

session_destroy();
			echo"<script>window.location='index.php';</script>";
?>
