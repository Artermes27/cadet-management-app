function showResutsSearchForOwner(str, paradeID, event_id) {
  //console.log(str);
  var id = "livesearch_owner[" + paradeID + "," + event_id + "]";
  if (str.length==0) {
    document.getElementById(id).innerHTML="";
    document.getElementById(id).style.border="0px";
    return;
  }
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      console.log("functions.php?search_first_name_owner_calendar="+str+"&event_id="+event_id+"&parade_id="+paradeID);
      document.getElementById(id).innerHTML=this.responseText;
      document.getElementById(id).style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","functions.php?search_first_name_owner_calendar="+str+"&event_id="+event_id+"&parade_id="+paradeID,true);
  xmlhttp.send();
}

function resultHasBeenClickedOwner(user_id, paradeID, event_id) {
  var owner_id_tag = "owner[" + paradeID + "," + event_id + "]";
  var id = "livesearch_owner[" + paradeID + "," + event_id + "]";
  document.getElementById(id).innerHTML="";
  document.getElementById(id).style.border="0px";
  document.getElementById(owner_id_tag).value = user_id;
  return;
}

//false means every item is hidden, an id code mans that id codes more infomation is showing
var overall = false;
//first column more infomation ID tags
var c0r0 = ".R0M0";
var c0r1 = ".R0M1";
var c0r2 = ".R0M2";
var c0r3 = ".R0M3";
var c0r4 = ".R0M4";
var c0r5 = ".R0M5";
var c0r6 = ".R0M6";
var c0r7 = ".R0M7";
var c0r8 = ".R0M8";
var c0r9 = ".R0M9";
//seccond column more infomation ID tags
var c1r0 = ".R1M0";
var c1r1 = ".R1M1";
var c1r2 = ".R1M2";
var c1r3 = ".R1M3";
var c1r4 = ".R1M4";
var c1r5 = ".R1M5";
var c1r6 = ".R1M6";
var c1r7 = ".R1M7";
var c1r8 = ".R1M8";
var c1r9 = ".R1M9";
//third column more infomation ID tags
var c2r0 = ".R2M0";
var c2r1 = ".R2M1";
var c2r2 = ".R2M2";
var c2r3 = ".R2M3";
var c2r4 = ".R2M4";
var c2r5 = ".R2M5";
var c2r6 = ".R2M6";
var c2r7 = ".R2M7";
var c2r8 = ".R2M8";
var c2r9 = ".R2M9";
//fourth column more infomation ID tags
var c3r0 = ".R3M0";
var c3r1 = ".R3M1";
var c3r2 = ".R3M2";
var c3r3 = ".R3M3";
var c3r4 = ".R3M4";
var c3r5 = ".R3M5";
var c3r6 = ".R3M6";
var c3r7 = ".R3M7";
var c3r8 = ".R3M8";
var c3r9 = ".R3M9";

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
  $("#R0I4").click(function(){
    if (overall == false){
      $(c0r4).show();
      overall = c0r4;
      console.log(overall);
    } else if (overall == c0r4){
      $(c0r4).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r4).show();
      overall = c0r4
      console.log(overall);
    }
  });
  $("#R0I5").click(function(){
    if (overall == false){
      $(c0r5).show();
      overall = c0r5;
      console.log(overall);
    } else if (overall == c0r5){
      $(c0r5).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r5).show();
      overall = c0r5
      console.log(overall);
    }
  });
  $("#R0I6").click(function(){
    if (overall == false){
      $(c0r6).show();
      overall = c0r6;
      console.log(overall);
    } else if (overall == c0r6){
      $(c0r6).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r6).show();
      overall = c0r6
      console.log(overall);
    }
  });
  $("#R0I7").click(function(){
    if (overall == false){
      $(c0r7).show();
      overall = c0r7;
      console.log(overall);
    } else if (overall == c0r7){
      $(c0r7).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r7).show();
      overall = c0r7
      console.log(overall);
    }
  });
  $("#R0I8").click(function(){
    if (overall == false){
      $(c0r8).show();
      overall = c0r8;
      console.log(overall);
    } else if (overall == c0r8){
      $(c0r8).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r8).show();
      overall = c0r8
      console.log(overall);
    }
  });
  $("#R0I9").click(function(){
    if (overall == false){
      $(c0r9).show();
      overall = c0r9;
      console.log(overall);
    } else if (overall == c0r9){
      $(c0r9).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c0r9).show();
      overall = c0r9
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
  $("#R1I4").click(function(){
    if (overall == false){
      $(c1r4).show();
      overall = c1r4;
      console.log(overall);
    } else if (overall == c1r4){
      $(c1r4).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r4).show();
      overall = c1r4
      console.log(overall);
    }
  });
  $("#R1I5").click(function(){
    if (overall == false){
      $(c1r5).show();
      overall = c1r5;
      console.log(overall);
    } else if (overall == c1r5){
      $(c1r5).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r5).show();
      overall = c1r5
      console.log(overall);
    }
  });
  $("#R1I6").click(function(){
    if (overall == false){
      $(c1r6).show();
      overall = c1r6;
      console.log(overall);
    } else if (overall == c1r6){
      $(c1r6).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r6).show();
      overall = c1r6
      console.log(overall);
    }
  });
  $("#R1I7").click(function(){
    if (overall == false){
      $(c1r7).show();
      overall = c1r7;
      console.log(overall);
    } else if (overall == c1r7){
      $(c1r7).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r7).show();
      overall = c1r7
      console.log(overall);
    }
  });
  $("#R1I8").click(function(){
    if (overall == false){
      $(c1r8).show();
      overall = c1r8;
      console.log(overall);
    } else if (overall == c1r8){
      $(c1r8).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r8).show();
      overall = c1r8
      console.log(overall);
    }
  });
  $("#R1I9").click(function(){
    if (overall == false){
      $(c1r9).show();
      overall = c1r9;
      console.log(overall);
    } else if (overall == c1r9){
      $(c1r9).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c1r9).show();
      overall = c1r9
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
  $("#R2I4").click(function(){
    if (overall == false){
      $(c2r4).show();
      overall = c2r4;
      console.log(overall);
    } else if (overall == c2r4){
      $(c2r4).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r4).show();
      overall = c2r4
      console.log(overall);
    }
  });
  $("#R2I5").click(function(){
    if (overall == false){
      $(c2r5).show();
      overall = c2r5;
      console.log(overall);
    } else if (overall == c2r5){
      $(c2r5).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r5).show();
      overall = c2r5
      console.log(overall);
    }
  });
  $("#R2I6").click(function(){
    if (overall == false){
      $(c2r6).show();
      overall = c2r6;
      console.log(overall);
    } else if (overall == c2r6){
      $(c2r6).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r6).show();
      overall = c2r6
      console.log(overall);
    }
  });
  $("#R2I7").click(function(){
    if (overall == false){
      $(c2r7).show();
      overall = c2r7;
      console.log(overall);
    } else if (overall == c2r7){
      $(c2r7).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r7).show();
      overall = c2r7
      console.log(overall);
    }
  });
  $("#R2I8").click(function(){
    if (overall == false){
      $(c2r8).show();
      overall = c2r8;
      console.log(overall);
    } else if (overall == c2r8){
      $(c2r8).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r8).show();
      overall = c2r8
      console.log(overall);
    }
  });
  $("#R2I9").click(function(){
    if (overall == false){
      $(c2r9).show();
      overall = c2r9;
      console.log(overall);
    } else if (overall == c2r9){
      $(c2r9).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c2r9).show();
      overall = c2r9
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
  $("#R3I4").click(function(){
    if (overall == false){
      $(c3r4).show();
      overall = c3r4;
      console.log(overall);
    } else if (overall == c3r4){
      $(c3r4).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r4).show();
      overall = c3r4
      console.log(overall);
    }
  });
  $("#R3I5").click(function(){
    if (overall == false){
      $(c3r5).show();
      overall = c3r5;
      console.log(overall);
    } else if (overall == c3r5){
      $(c3r5).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r5).show();
      overall = c3r5
      console.log(overall);
    }
  });
  $("#R3I6").click(function(){
    if (overall == false){
      $(c3r6).show();
      overall = c3r6;
      console.log(overall);
    } else if (overall == c3r6){
      $(c3r6).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r6).show();
      overall = c3r6
      console.log(overall);
    }
  });
  $("#R3I7").click(function(){
    if (overall == false){
      $(c3r7).show();
      overall = c3r7;
      console.log(overall);
    } else if (overall == c3r7){
      $(c3r7).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r7).show();
      overall = c3r7
      console.log(overall);
    }
  });
  $("#R3I8").click(function(){
    if (overall == false){
      $(c3r8).show();
      overall = c3r8;
      console.log(overall);
    } else if (overall == c3r8){
      $(c3r8).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r8).show();
      overall = c3r8
      console.log(overall);
    }
  });
  $("#R3I9").click(function(){
    if (overall == false){
      $(c3r9).show();
      overall = c3r9;
      console.log(overall);
    } else if (overall == c3r9){
      $(c3r9).hide();
      overall = false;
      console.log(overall);
    } else {
      console.log(overall);
      $(overall).hide();
      $(c3r9).show();
      overall = c3r9
      console.log(overall);
    }
  });
});