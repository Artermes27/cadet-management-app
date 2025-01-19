//false means every item is hidden, an id code mans that id codes more infomation is showing
var overall = false;
//first column more infomation ID tags
var c0r0 = ".R0M0";
var c0r1 = ".R0M1";
var c0r2 = ".R0M2";
var c0r3 = ".R0M3";
//seccond column more infomation ID tags
var c1r0 = ".R1M0";
var c1r1 = ".R1M1";
var c1r2 = ".R1M2";
var c1r3 = ".R1M3";
//third column more infomation ID tags
var c2r0 = ".R2M0";
var c2r1 = ".R2M1";
var c2r2 = ".R2M2";
var c2r3 = ".R2M3";
//fourth column more infomation ID tags
var c3r0 = ".R3M0";
var c3r1 = ".R3M1";
var c3r2 = ".R3M2";
var c3r3 = ".R3M3";

$(document).ready(function(){
  //first column code
  $("#R0I0").click(function(){

    if (overall == false){
      $(c0r0).show();
      overall = c0r0;
      console.log(overall);
    } else if (overall == c0r0){
      $(c0r0).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r0).show();
      overall = c0r0
      console.log(overall);
    }
  });
  $("#R0I1").click(function(){

    if (overall == false){
      $(c0r1).show();
      overall = c0r1;
      console.log(overall);
    } else if (overall == c0r1){
      $(c0r1).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r1).show();
      overall = c0r1
      console.log(overall);
    }
  });
  $("#R0I2").click(function(){

    if (overall == false){
      $(c0r2).show();
      overall = c0r2;
      console.log(overall);
    } else if (overall == c0r2){
      $(c0r2).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r2).show();
      overall = c0r2
      console.log(overall);
    }
  });
  $("#R0I3").click(function(){

    if (overall == false){
      $(c0r3).show();
      overall = c0r3;
      console.log(overall);
    } else if (overall == c0r3){
      $(c0r3).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r3).show();
      overall = c0r3
      console.log(overall);
    }
  });
  //seccond column code
  $("#R1I0").click(function(){

    if (overall == false){
      $(c1r0).show();
      overall = c1r0;
      console.log(overall);
    } else if (overall == c1r0){
      $(c1r0).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r0).show();
      overall = c1r0
      console.log(overall);
    }
  });
  $("#R1I1").click(function(){

    if (overall == false){
      $(c1r1).show();
      overall = c1r1;
      console.log(overall);
    } else if (overall == c1r1){
      $(c1r1).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r1).show();
      overall = c1r1
      console.log(overall);
    }
  });
  $("#R1I2").click(function(){

    if (overall == false){
      $(c1r2).show();
      overall = c1r2;
      console.log(overall);
    } else if (overall == c1r2){
      $(c1r2).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r2).show();
      overall = c1r2
      console.log(overall);
    }
  });
  $("#R1I3").click(function(){

    if (overall == false){
      $(c1r3).show();
      overall = c1r3;
      console.log(overall);
    } else if (overall == c1r3){
      $(c1r3).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r3).show();
      overall = c1r3
      console.log(overall);
    }
  });
  //third column code
  $("#R2I0").click(function(){

    if (overall == false){
      $(c2r0).show();
      overall = c2r0;
      console.log(overall);
    } else if (overall == c2r0){
      $(c2r0).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r0).show();
      overall = c2r0
      console.log(overall);
    }
  });
  $("#R2I1").click(function(){

    if (overall == false){
      $(c2r1).show();
      overall = c2r1;
      console.log(overall);
    } else if (overall == c2r1){
      $(c2r1).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r1).show();
      overall = c2r1
      console.log(overall);
    }
  });
  $("#R2I2").click(function(){

    if (overall == false){
      $(c2r2).show();
      overall = c2r2;
      console.log(overall);
    } else if (overall == c2r2){
      $(c2r2).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r2).show();
      overall = c2r2
      console.log(overall);
    }
  });
  $("#R2I3").click(function(){

    if (overall == false){
      $(c2r3).show();
      overall = c2r3;
      console.log(overall);
    } else if (overall == c2r3){
      $(c2r3).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r3).show();
      overall = c2r3
      console.log(overall);
    }
  });
  //fourth column code
  $("#R3I0").click(function(){

    if (overall == false){
      $(c3r0).show();
      overall = c3r0;
      console.log(overall);
    } else if (overall == c3r0){
      $(c3r0).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r0).show();
      overall = c3r0
      console.log(overall);
    }
  });
  $("#R3I1").click(function(){

    if (overall == false){
      $(c3r1).show();
      overall = c3r1;
      console.log(overall);
    } else if (overall == c3r1){
      $(c3r1).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r1).show();
      overall = c3r1
      console.log(overall);
    }
  });
  $("#R3I2").click(function(){

    if (overall == false){
      $(c3r2).show();
      overall = c3r2;
      console.log(overall);
    } else if (overall == c3r2){
      $(c3r2).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r2).show();
      overall = c3r2
      console.log(overall);
    }
  });
  $("#R3I3").click(function(){

    if (overall == false){
      $(c3r3).show();
      overall = c3r3;
      console.log(overall);
    } else if (overall == c3r3){
      $(c3r3).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r3).show();
      overall = c3r3
      console.log(overall);
    }
  });
});