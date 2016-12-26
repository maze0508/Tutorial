<?php
session_start();

unset($_SESSION['account']);
unset($_SESSION['member_id']);
unset($_SESSION['compet']);
unset($_SESSION['name']);
ini_set('default_charset','utf-8');
echo "<script>alert('已登出')</script>";
echo "<script>document.location.href='../index2.php'</script>";
?>