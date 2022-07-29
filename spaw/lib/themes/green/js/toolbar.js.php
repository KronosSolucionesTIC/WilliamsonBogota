<?php 
  header('Content-Type: application/x-javascript');
?>
// toolbar button effects
function SPAW_green_bt_over(ctrl)
{
//  ctrl.className = "SPAW_green_tb_over";
  var imgfile = ctrl.src.substr(0, ctrl.src.length-4) + "_over.gif";
  ctrl.src = imgfile;
}
function SPAW_green_bt_out(ctrl)
{
//  ctrl.className = "SPAW_green_tb_out";
  var imgfile = ctrl.src.substr(0, ctrl.src.length-9) + ".gif";
  ctrl.src = imgfile;
}
function SPAW_green_bt_down(ctrl)
{
  ctrl.className = "SPAW_green_tb_down";
}
function SPAW_green_bt_up(ctrl)
{
  ctrl.className = "SPAW_green_tb_out";
}

