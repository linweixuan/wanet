(function($) {
    $.extend($.browser, {
        client: function() {
            return {
                width: document.documentElement.clientWidth,
                height: document.documentElement.clientHeight,
                bodyWidth: document.body.clientWidth,
                bodyHeight: document.body.clientHeight
            };
        },
        scroll: function() {
            return {
                width: document.documentElement.scrollWidth,
                height: document.documentElement.scrollHeight,
                bodyWidth: document.body.scrollWidth,
                bodyHeight: document.body.scrollHeight,
                left: document.documentElement.scrollLeft,
                top: document.documentElement.scrollTop + document.body.scrollTop
            };
        },
        screen: function() {
            return {
                width: window.screen.width,
                height: window.screen.height
            };
        },
        isIE6: $.browser.msie && $.browser.version == 6,
        isMinW: function(val) {
            return Math.min($.browser.client().bodyWidth, $.browser.client().width) <= val;
        },
        isMinH: function(val) {
            return $.browser.client().height <= val;
        }
    })
})

(jQuery); (function($) {
    $.widthForIE6 = function(option) {
        var s = $.extend({
            max: null,
            min: null,
            padding: 0
        },
        option || {});
        var init = function() {
            var w = $(document.body);
            if ($.browser.client().width >= s.max + s.padding) {
                w.width(s.max + "px");
            } else if ($.browser.client().width <= s.min + s.padding) {
                w.width(s.min + "px");
            } else {
                w.width("auto");
            }
        };
        init();
        $(window).resize(init);
    }
})

(jQuery); (function($) {
    $.fn.hoverForIE6 = function(option) {
        var s = $.extend({
            current: "hover",
            delay: 10
        },
        option || {});
        $.each(this,
        function() {
            var timer1 = null,
            timer2 = null,
            flag = false;
            $(this).bind("mouseover",
            function() {
                if (flag) {
                    clearTimeout(timer2);
                } else {
                    var _this = $(this);
                    timer1 = setTimeout(function() {
                        _this.addClass(s.current);
                        flag = true;
                    },
                    s.delay);
                }
            }).bind("mouseout",
            function() {
                if (flag) {
                    var _this = $(this);
                    timer2 = setTimeout(function() {
                        _this.removeClass(s.current);
                        flag = false;
                    },
                    s.delay);
                } else {
                    clearTimeout(timer1);
                }
            })
        })
    }
})
/*
(jQuery); (function($) {
    $.extend({
        _jsonp: {
            scripts: {},
            counter: 1,
            head: document.getElementsByTagName("head")[0],
            name: function(callback) {
                var name = '_jsonp_' + (new Date).getTime() + '_' + this.counter;
                this.counter++;
                var cb = function(json) {
                    eval('delete ' + name);
                    callback(json);
                    $._jsonp.head.removeChild($._jsonp.scripts[name]);
                    delete $._jsonp.scripts[name];
                };
                eval(name + ' = cb');
                return name;
            },
            load: function(url, name) {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.charset = this.charset;
                script.src = url;
                this.head.appendChild(script);
                this.scripts[name] = script;
            }
        },
        getJSONP: function(url, callback) {
            var name = $._jsonp.name(callback);
            var url = url.replace(/{callback};/, name);
            $._jsonp.load(url, name);
            return this;
        }
    });
})
*/
(jQuery); (function($) {
    $.fn.jdTab = function(option, callback) {
        if (typeof option == "function") {
            callback = option;
            option = {};
        };
        var s = $.extend({
            type: "static",
            auto: false,
            source: "data",
            event: "mouseover",
            currClass: "curr",
            tab: ".tab",
            content: ".tabcon",
            itemTag: "li",
            stay: 5000,
            delay: 100,
            mainTimer: null,
            subTimer: null,
            index: 0
        },
        option || {});
        var tabItem = $(this).find(s.tab).eq(0).find(s.itemTag),
        contentItem = $(this).find(s.content);
        if (tabItem.length != contentItem.length) return false;
        var reg = s.source.toLowerCase().match(/http:\/\/|\d|\.aspx|\.ascx|\.asp|\.php|\.html\.htm|.shtml|.js|\W/g);
        var init = function(n, tag) {
            s.subTimer = setTimeout(function() {
                hide();
                if (tag) {
                    s.index++;
                    if (s.index == tabItem.length) s.index = 0;
                } else {
                    s.index = n;
                };
                s.type = (tabItem.eq(s.index).attr(s.source) != null) ? "dynamic": "static";
                show();
            },
            s.delay);
        };
        var autoSwitch = function() {
            s.mainTimer = setInterval(function() {
                init(s.index, true);
            },
            s.stay);
        };
        var show = function() {
            tabItem.eq(s.index).addClass(s.currClass);
            switch (s.type) {
            default:
            case "static":
                var source = "";
                break;
            case "dynamic":
                var source = (reg == null) ? tabItem.eq(s.index).attr(s.source) : s.source;
                tabItem.eq(s.index).removeAttr(s.source);
                break;
            };
            if (callback) {
                callback(source, contentItem.eq(s.index), s.index);
            };
            contentItem.eq(s.index).show();
        };
        var hide = function() {
            tabItem.eq(s.index).removeClass(s.currClass);
            contentItem.eq(s.index).hide();
        };
        tabItem.each(function(n) {
            $(this).bind(s.event,
            function() {
                clearTimeout(s.subTimer);
                clearInterval(s.mainTimer);
                init(n, false);
                return false;
            }).bind("mouseleave",
            function() {
                if (s.auto) {
                    autoSwitch();
                } else {
                    return;
                }
            })
        });
        if (s.type == "dynamic") {
            init(s.index, false);
        };
        if (s.auto) {
            autoSwitch();
        }
    }
})

// assign new url to iframe element's src property
function changeIframeSrc(id, url) {
    if (!document.getElementById) return;
    var el = document.getElementById(id);
    if (el && el.src) {
        el.src = url;
        return false;
    }
    return true;
}

function search(id) {
    var selKey = document.getElementById(id).value;	
    var curr = window.location.href;
    
    if( curr.indexOf('parts.php') == -1) {
		window.location = 'http://www.wanet.cn/parts.php?key=' + selKey;
    }else{
		var url = 'partlist.php?key=' + selKey;
		changeIframeSrc('ifrm',url);		
	}
}

function login() {
    location.href = "https://www.wanet.cn/login.php?ReturnUrl=" + escape(location.href);
    return false;
}
function regist() {
    location.href = "https://www.wanet.cn/register.php?ReturnUrl=" + escape(location.href);
    return false;
}
