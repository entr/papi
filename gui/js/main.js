!function(a){a.Ptb=a.Ptb||{}}(window),!function(a,b){var c={};c.init=function(){this.binds()},c.binds=function(){b(".ptb-box-list > li > p").on("click",function(){a.location=b(this).prev().attr("href")}),b("input[name=add-new-page-search]").on("keyup",function(){var a=b(this),c=b(".ptb-box-list"),d=a.val();c.find("li").each(function(){var a=b(this);a[-1===a.text().toLowerCase().indexOf(d)?"hide":"show"]()})}),function(){var c="string"==typeof a.location?a.location:a.location.href,d=b("#adminmenu");d.find("li.current > a.current").length||(c=c.substr(c.lastIndexOf("/")+1),b('a[href="'+c+'"]',d).addClass("current").parent().addClass("current"))}(),b("[data-ptb-href]").on("click touchstart",function(c){c.preventDefault(),a.location=b(this).data("ptb-href")})},a.Ptb.Core=c}(window,window.jQuery),!function(a,b){var c={};c.init=function(){this.binds()},c.binds=function(){b("a[data-ptb-tab]").on("click",function(a){a.preventDefault();var c=b(this),d=c.data("ptb-tab");b("a[data-ptb-tab]").parent().removeClass("active"),c.parent().addClass("active"),b("div[data-ptb-tab]").removeClass("active").hide(),b("div[data-ptb-tab="+d+"]").addClass("active").show()})},a.Ptb.Tabs=c}(window,window.jQuery),!function(a){var b={};b.wp_media_editor=function(a){var b=wp.media({multiple:!1}).on("select",function(){var c=b.state().get("selection").first().toJSON();"function"==typeof a?a(c):a.val(c.url)}).on("escape",function(){"function"==typeof a&&a()}).open()},b.is_image=function(a){return/\.(jpeg|jpg|gif|png)$/.test(a.toLowerCase())},a.Ptb.Utils=b}(window),!function(){Ptb.Core.init(),Ptb.Tabs.init()}();