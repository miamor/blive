function mtip(a, c, title, content) {
	$(".alert").length && $(".alert").remove();
	if (a && a.length) $(a).prepend('<div class="alerts alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	else $('body').append('<div class="alert alert-' + c + ' just-add"><a class="close" onclick="htip(\'just-add\')" data-dismiss="alert">\u00d7</a><strong>' + title + " </strong>" + content + "</div>");
	stip('just-add')
}
function htip(a) {
	var l = $('.' + a).attr('class');
	if (l.indexOf('alerts') > -1) {
		$("." + a).slideUp(function () {
			$("." + a).remove()
		})
	} else {
		$(".alert").animate({
			right: "-=500"
		}, 1E3, function () {
			$(".alert").remove()
		})
	}
}
function stip(d) {
    $("." + d).fadeIn(1E3);
    setTimeout("htip('" + d + "')", 5E3)
}

function redirect(location) {
	window.location.href = location;
}

$(function () {
	$('#login-facebook').click(function () {
		window.open(MAIN_URL + '/fb.php', 'hybridauth_social_sing_on', 'location=0,status=0,scrollbars=0,width=800,height=500')
//		window.open('./login?login&oauth_provider=facebook', 'Login with facebook', 'left=300px,top=100px,width=800,height=500,toolbar=0,resizable=0')
//		window.open('./login?login&oauth_provider=facebook')
	});
	$('#login-twitter').click(function () {
//		window.open('./login?login&oauth_provider=twitter', 'Log in with twitter', 'left=20,top=20,width=600,height=400,toolbar=1,resizable=0')
		window.open('./login?login&oauth_provider=twitter')
	});
	$('#login-google').click(function () {
		window.open('./login?login&oauth_provider=google')
	});
	$('#login').submit(function () {
		$.ajax({
			url: MAIN_URL + '/pages/login.php?act=login',
			type: "POST",
			data: $("#login").serialize(),
			datatype: 'json',
			success: function (data) {
				mtip('', 'success', '', 'Redirecting...');
//				redirect(MAIN_URL);
				setTimeout(redirect(MAIN_URL), 1E3);
			},
			error: function (xhr) {
				mtip('', 'error', 'Error', xhr)
			}
		});
		return false
	});
	var idp = null;
	$(".idpico").click(function () { 
		idp = $(this).attr( "idp" );
		switch (idp) {
			case "google"  : case "twitter" : case "yahoo" : case "facebook": case "aol" : 
			case "vimeo" : case "tumblr" : case "lastfm" : case "twitter" : 
			case "linkedin" : 
				start_auth( "?provider=" + idp );
				break; 
			case "wordpress" : case "blogger" : case "flickr" :  case "livejournal" :  
				if (idp == "blogger") {
					$("#openidm").html("Please enter your blog name");
				} else {
					$("#openidm").html("Please enter your username");
				}
				$("#openidun").css( "width", "220" );
				$("#openidimg").attr( "src", "images/icons/" + idp + ".png" );
				$("#idps").slideUp(200, function () {
					$("#openidid").slideDown(200)
				});
				break;
			case "openid" : 
				$("#openidm").html( "Please enter your OpenID URL" );
				$("#openidun").css( "width", "350" );
				$("#openidimg").attr( "src", "images/icons/" + idp + ".png" );
				$("#idps").slideUp(200, function () {
					$("#openidid").slideDown(200)
				});
				break;
			default: alert( "u no fun" );
		}
	}); 
	$("#openidbtn").click(function () {
		oi = un = $( "#openidun" ).val();
		if (!un) {
			alert("nah not like that! put your username or blog name on this input field.");
			return false
		}
		switch (idp) { 
			case "wordpress" : oi = "http://" + un + ".wordpress.com"; break;
			case "livejournal" : oi = "http://" + un + ".livejournal.com"; break;
			case "blogger" : oi = "http://" + un + ".blogspot.com"; break;
			case "flickr" : oi = "http://www.flickr.com/photos/" + un + "/"; break;   
		}
		start_auth("?provider=OpenID&openid_identifier=" + escape( oi ))
	});  
	$("#backtolist").click(function () {
		$("#openidid").slideUp(200, function () {
			$("#idps").slideDown(200)
		});
		return false
	})
})
