function popup_shortlink_display(link, type, path)
{

	window.location = '#';

	if(type == 'hide')
	{
		document.getElementById('popup_shortlink_box').style.display = 'none';
		document.getElementById('popup_shortlink_link').value = 'Loading...';
		document.getElementById('popup_shortlink_network').innerHTML = '';
		document.getElementById('popup_shortlink_button').innerHTML = '';
	}
	else
	{
		document.getElementById('popup_shortlink_box').style.display = 'block';
		document.getElementById('popup_shortlink_network').innerHTML = popup_shortlink_sharelink('', path);
		document.getElementById('popup_shortlink_button').innerHTML = '<input type=\"button\" value=\"   Continue without shortcut   \" onclick=\"popup_shortlink_owr(\'' + link + '\')\">';

		var link_api = '';
		link_api = popup_shortlink_callfile(path + 'ps_api.php?l=' + link);

		document.getElementById('popup_shortlink_link').value = link_api;
		document.getElementById('popup_shortlink_network').innerHTML = popup_shortlink_sharelink(link_api, path);
	}
}

function popup_shortlink_owr(link)
{
	document.getElementById('popup_shortlink_box').style.display = 'none';
	document.getElementById('popup_shortlink_link').value = 'Loading...';
	document.getElementById('popup_shortlink_network').innerHTML = '';
	document.getElementById('popup_shortlink_button').innerHTML = '';
	window.open(link);
}

function popup_shortlink_content(path)
{
	var content = '';

	content += "<div id=\"popup_shortlink_box\">";
	content += "<div class=\"ps_box\">";
	content += "<div class=\"ps_close\">";
	content += "<a style=\"cursor: pointer;\" onclick=\"popup_shortlink_display('', 'hide', '');\">";
	content += "<img src=\"" + path + "ps_close.png\" width=\"32\" height=\"32\" border=\"0\" />";
	content += "</a>";
	content += "</div>";
	content += "<center>";
	content += "<br /><strong>Quick Link</strong> :<br /><br />";
	content += "<input id=\"popup_shortlink_link\" type=\"text\" value=\"Loading...\" onfocus=\"this.select();\" readonly><br /><br />";
	content += "<span id=\"popup_shortlink_network\"></span>";
	content += "<br /><br />";
	content += "<span id=\"popup_shortlink_button\"></span>";
	content += "</center>";
	content += "</div>";
	content += "</div>";

	return content;
}

function popup_shortlink_sharelink(url_page, path)
{
	var url_page = encodeURIComponent(url_page);
	var share_text = "<a href=\"http://digg.com/submit?url=" + url_page + "&title=&of=0ab_fr\" target=\"_blank\"><div style=\"width:50px;height:50px;background:url(\'" + path + "share_icon.png\');background-position:-0px 0px;display:inline-block;padding:0px;margin:0px;\" onmouseover=\"this.style.backgroundPosition=\'-0px -50px\';\" onmouseout=\"this.style.backgroundPosition=\'-0px 0px\';\" alt=\"Digg\"></div></a><a href=\"http://delicious.com/post?url=" + url_page + "&title=&notes=&of=0ab_fr\" target=\"_blank\"><div style=\"width:50px;height:50px;background:url(\'" + path + "share_icon.png\');background-position:-50px 0px;display:inline-block;padding:0px;margin:0px;\" onmouseover=\"this.style.backgroundPosition=\'-50px -50px\';\" onmouseout=\"this.style.backgroundPosition=\'-50px 0px\';\" alt=\"Delicious\"></div></a><a href=\"http://www.facebook.com/share.php?u=" + url_page + "&of=0ab_fr\" target=\"_blank\"><div style=\"width:50px;height:50px;background:url(\'" + path + "share_icon.png\');background-position:-100px 0px;display:inline-block;padding:0px;margin:0px;\" onmouseover=\"this.style.backgroundPosition=\'-100px -50px\';\" onmouseout=\"this.style.backgroundPosition=\'-100px 0px\';\" alt=\"Facebook\"></div></a><a href=\"http://twitter.com/?status=" + url_page + " via @0ab_fr\" target=\"_blank\"><div style=\"width:50px;height:50px;background:url(\'" + path + "share_icon.png\');background-position:-150px 0px;display:inline-block;padding:0px;margin:0px;\" onmouseover=\"this.style.backgroundPosition=\'-150px -50px\';\" onmouseout=\"this.style.backgroundPosition=\'-150px 0px\';\" alt=\"Twitter\"></div></a><a href=\"http://www.google.com/bookmarks/mark?op=add&bkmk=" + url_page + "&title=&of=0ab_fr\" target=\"_blank\"><div style=\"width:50px;height:50px;background:url(\'" + path + "share_icon.png\');background-position:-200px 0px;display:inline-block;padding:0px;margin:0px;\" onmouseover=\"this.style.backgroundPosition=\'-200px -50px\';\" onmouseout=\"this.style.backgroundPosition=\'-200px 0px\';\" alt=\"Google Bookmarks\"></div></a>";
	return share_text;
}

function popup_shortlink_callfile(f)
{
if(window.XMLHttpRequest) // FIREFOX
xhr_object = new XMLHttpRequest();
else if(window.ActiveXObject) // IE
xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
else
return(false);
xhr_object.open("GET", f, false);
xhr_object.send(null);
if(xhr_object.readyState == 4) return(xhr_object.responseText);
else return(false);
}