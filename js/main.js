var circle,bets=100500,timeleft=120,ms=1000;
var audioElement = document.createElement('audio');
audioElement.setAttribute('src', 'audio.mp3');
var audioElement2 = document.createElement('audio');
audioElement2.setAttribute('src', 'msg.mp3');

window.onload = function onLoad() {
	setInterval("reloadinfo()",1000);
};

function alert2(txt,typet) {
	var n = noty({
		layout: 'bottomRight',
		text: txt,
		type: typet,
		timeout: 10000
	});
	audioElement.play();
}


function reloadinfo() {
	$.ajax({
		type: "GET",
		url: "currentgame.php",
		success: function(msg){
			$("#gameid").text("#"+msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "currentchance.php",
		success: function(msg){
			$("#mychance").text(msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "currentbank.php",
		success: function(msg){
			$('#money_round').text(msg+'');
		}
	});
	$.ajax({
		type: "GET",
		url: "items.php",
		success: function(msg){
			$('.rounditems').html(msg);
		}
	});
	$.ajax({ 
		type: "GET",
		url: "currentitems.php", 
		success: function(msg){ 
			$(".ghbfv").html(msg+'/50'); 
		} 
	}); 
	$.ajax({
		type: "GET",
		url: "currentitemswidth.php",
		success: function(msg){
			$('#meter').width(msg);
		}
	});
	$.ajax({
		type: "GET",
		url: "timeleft.php",
		success: function(msg){
			$('#timeleft').html(msg);
		}
	});
}