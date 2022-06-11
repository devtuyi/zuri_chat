$(document).ready(function() {
	$("#btnSend").click(function(){
		sendChatText();
		$('#chatInput').val("").focus();
	});
	$("#chatInput").on("keypress", function(e){
		if(e.keyCode == 13) {
			sendChatText();
			$('#chatInput').val("").focus();
		}
	});
	if($("#btnSend").length > 0) {
		startChat();
	}
	setTimeout(function(){
		$(".alert").hide();
	}, 5000);
});

function startChat(){
	setInterval(function(){
		getChatText();
		update_time();
		$('[data-toggle="tooltip"]').tooltip();
	}, 2500);
}

function getChatText(){
	var boxH = $("#view_ajax")[0].scrollHeight - 20;
	$.ajax({
		type: "POST",
		url: "php/refresh.php?_t="+(new Date().getTime()),
		data: {"_l": $("#view_ajax").children().length}
	}).done(function(data) {
		if(data.data === false) {
			window.location = window.location.href;
		} else {
			var html = "";
			for(var i = 1; i < data.length; i++) {
				var result = JSON.parse(data[i]);
				html += '<div class="card"><div class="card-header"><b data-toggle="tooltip" title="'+result.username+'">@'+result.user_name+'</b><span class="text-muted" style="float: right;" id="chat_time" data-time="'+result.chattime+'">'+time_ago(result.chattime)+'</span></div><div class="card-body">'+result.chattext+'</div></div>';
			}
			$('#view_ajax').append(html);
			var _boxH = $("#view_ajax")[0].scrollHeight - 20;
			if(_boxH > boxH) {
				$("#view_ajax").animate({ scrollTop: _boxH }, 'normal');
			}
		}
	});
}

function sendChatText(){
	var chatInput = $('#chatInput').val();
	if(chatInput != ""){
		$.ajax({
			type: "POST",
			url: "php/submit.php",
			data: {"chattext": chatInput}
		}).done(function(data) {
			if(data.data == false) {
				window.location = window.location.href;
			}
		});
	}
}

function time_ago(time){
    var time_difference = time - Math.floor(new Date().getTime() / 1000);
    if(time_difference < 1) { return 'just now'; }
	var _cond = [31104000, 2592000, 86400, 3600, 60, 1];
    var _cont = ['year', 'month', 'day', 'hour', 'minute', 'second'];
    for(var i = 0; i < _cond.length; i++) {
        d = time_difference / _cond[i];
        if(d >= 1) {
            t = Math.ceil( d );
            return t + ' ' + _cont[i] + ( t > 1 ? 's' : '' ) + ' ago';
        }
    }
}

function update_time() {
	var spans = $("span#chat_time");
	for(var i = 0; i < spans.length; i++) {
		$(spans[i]).html(time_ago($(spans[i]).data("time")));
	}
}