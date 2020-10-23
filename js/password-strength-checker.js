$(document).ready(function(){$("#pass").keyup(function(){check_pass()})});function check_pass()
{var val=document.getElementById("pass").value;var meter=document.getElementById("meter");var no=0;if(val!="")
{if(val.length<=5)no=1;if(val.length>5&&(val.match(/[a-z]/)||val.match(/\d+/)||val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;if(val.length>5&&((val.match(/[a-z]/)&&val.match(/\d+/))||(val.match(/\d+/)&&val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))||(val.match(/[a-z]/)&&val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;if(val.length>5&&val.match(/[a-z]/)&&val.match(/\d+/)&&val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;if(val.length>15)no=5;if(no==1)
{$("#meter").animate({width:'10%'},300);meter.style.backgroundColor="#dc3545";document.getElementById("pass_type").innerHTML="<p style='color:#dc3545; text-align:left; margin-bottom: 0rem;'>Very Weak</p>"}
if(no==2)
{$("#meter").animate({width:'25%'},300);meter.style.backgroundColor="#ffc107";document.getElementById("pass_type").innerHTML="<p style='color:#ffc107; text-align:left; margin-bottom: 0rem;'>Weak</p>"}
if(no==3)
{$("#meter").animate({width:'50%'},300);meter.style.backgroundColor="#17a2b8";document.getElementById("pass_type").innerHTML="<p style='color:#17a2b8; text-align:left; margin-bottom: 0rem;'>Good</p>"}
if(no==4)
{$("#meter").animate({width:'100%'},300);meter.style.backgroundColor="#28a745";document.getElementById("pass_type").innerHTML="<p style='color:#28a745; text-align:left; margin-bottom: 0rem;'>Strong</p>"}}
else{meter.style.backgroundColor="white";document.getElementById("pass_type").innerHTML="<p style='color:#17a2b8; text-align:left; margin-bottom: 0rem;'>Recommends to use strong password</p>"}}