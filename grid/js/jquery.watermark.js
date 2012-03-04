
(function($) {
    // 添加水印
    $.fn.watermark = function(options) {
        var defaults = {
            gray: "#ccc",
            black: "#000",
            tip: "请输入关键词..."
        }
        var options = $.extend(defaults, options);
        this.each(function() {
            var thistxt = $(this);
            $(thistxt).val(options.tip).css("color", options.gray);
            $(thistxt).click(function() {
                if ($(this).val() == options.tip)
                    $(this).val("").css("color", options.black);
            });
            $(thistxt).focus(function() {
                if ($(this).val() == options.tip)
                    $(this).val("").css("color", options.black);
            });
            $(thistxt).blur(function() {
                if ($(this).val() == options.tip || $(this).val() == "")
                    $(this).val(options.tip).css("color", options.gray);
            });
        });

    };
    // 移除水印
    $.fn.removewatermark = function(options) {
        var defaults = {
            gray: "#ccc",
            black: "#000",
            tip: "请输入关键词..."
        }
        var options = $.extend(defaults, options);
        this.each(function() {
            var thistxt = $(this);
            if ($(thistxt).val() != "" && $(thistxt).val() != options.tip) {
                $(this).css("color", options.black);
            }
        });
    };

})(jQuery);