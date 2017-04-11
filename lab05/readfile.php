<?php
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];

$province = "motto/".$_POST['province'].".txt";
$imgname = "sign/".$_POST['province'].".png";

$handle = fopen( iconv('utf-8','tis-620',$province), 'r');
echo "สวัสดีคุณ  ".$firstname." ".$lastname."<br>";
echo fread($handle,1024)."<br>";

echo "<img src='$imgname" . "' alt='error'>"."<br>";
fclose($handle);

?>

<script>
$("#subbt").click(function(){
		var mss = $("#province").val();
		var filename = "motto/"+mss+".txt";
		var imgname = "sign/"+mss+".png";
		var imgsrc = document.getElementById("myImg");
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		var year = $("#year").val();
		var radiochecked = $("#male").prop("checked");
		if(firstname == ""){
			alert("Firstname must be spacified !!!");
		}
		else if(year == ""){
			alert("Year must be spacified !!!");
		}
		else if(confirm("Your selected :  "+mss) == true){
  			$.get(filename,function(data){
				document.getElementById("slogan").innerHTML = "คำขวัญ : "+data;
			});
			imgsrc.src = imgname;
			document.getElementById("provincename").innerHTML = mss;
			document.getElementById("inform").innerHTML = "<h1>สวัสดี  คุณ"+firstname+"  "+lastname+"</h1>";
			if(2017-parseInt(year) <= 13){
				$("body").addClass("child");
			}
			else{
				if(radiochecked == true){
					$("body").addClass("men");
				}
				else{
					$("body").addClass("women");
				}
				
			}
		}
		$("#resultarea").show();
    });

</script>