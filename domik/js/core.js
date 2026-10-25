! function(a) {
    var b = {
        defaults: {
            reloadbox: " ",
            loadBox: "",
            ctbTriggerBox: "",
            ctbTrigger: "a.ajax",
            loadErrorBg: "",
            loadErrorMessage: "<h2>404</h2><br>Page not found",
            loadErrorAddMessage: "Sorry, but the page you are looking for has not been found.",
            loadErrorBacklinkText: "Back to the last page",
            bouncingBoxes: "",
            topToBottom: !1,
            leftToRight: !1,
            inEasing: "easeInQuint",
            outEasing: "easeInQuint",
            inDuration: 700,
            outDuration: 500,
            preloadImages: !1,
            direction: "",
            positionType: "absolute"
        },
        listenToPopState: function(b, d) {
            a(window).off("popstate").on("popstate", function(a) {
                var e;
                switch (b.direction) {
                    case "left-to-right":
                        e = "ks-ctb-box-in-l-pushstate";
                        break;
                    case "right-to-left":
                        e = "ks-ctb-box-in-r-pushstate";
                        break;
                    case "top-to-bottom":
                        e = "ks-ctb-box-in-t-pushstate";
                        break;
                    case "bottom-to-top":
                        e = "ks-ctb-box-in-b-pushstate";
                        break;
                    case "":
                        e = "ks-ctb-box-in-pushstate";
                        break;
                    default:
                        return alert("Kool ctb Error: \n The defined direction " + b.direction + " does not exist."), !1
                }
                c.ctbHistoryPage(b, d, e), a.stopPropagation()
            })
        }
    };
    var c = {
        defaults: function(c, d) {
            return psSettings = c.data("kool-ctb-window"), "undefined" == typeof psSettings ? (psSettings = a.extend({}, b.defaults, d), c.data("kool-ctb-window", psSettings)) : psSettings = a.extend(psSettings, d), psSettings
        },
        init: function(d) {
            var f = window.history && history.pushState;
            return this.each(function() {
                c.defaults(a(this), d);
                var h = (a(psSettings.reloadbox), psSettings.ctbTriggerBox),
                    i = psSettings.ctbTrigger,
                    j = !0;
                f && a("html").not("[data-ks-initialised]") && (a("html").attr("data-ks-initialised", "true"), b.listenToPopState(psSettings, a(h + " " + i))), e.trigger(psSettings, f, h, i, j)
            })
        },
        ctbHistoryPage: function(b, c, d) {
            if (a("html").is("[data-ks-history-pushed]")) {
                var f = location.pathname;
                e.ksLoadPage(b, c, f, d, true), jQuery("nav a").removeClass("act-link");
                var g = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
                jQuery("a.ajax").each(function() {
                    jQuery(this).attr("href") != g && "" != jQuery(this).attr("href") || jQuery(this).addClass("act-link")
                })
            }
        },
        destroy: function(b) {
            return a(document).off("click", psSettings.ctbTriggerBox + " " + psSettings.ctbTrigger), a(this).each(function() {
                var b = a(this);
                b.removeData("kool-ctb-window")
            })
        }
    };
    var d = {
        defaults: function(c, d) {
            return settings = c.data("kool-ctb"), "undefined" == typeof settings ? (settings = a.extend({}, b.defaults, d), c.data("kool-ctb", settings)) : settings = a.extend(settings, d), settings
        },
        init: function(b) {
            return this.each(function() {
                d.defaults(a(this), b), settings.reloadbox = a(this);
                var c = settings.ctbTriggerBox,
                    f = settings.ctbTrigger,
                    g = !1;
                e.trigger(settings, !0, c, f, g)
            })
        },
        destroy: function(b) {
            return a(document).off("click", settings.ctbTriggerBox + " " + settings.ctbTrigger), a(this).each(function() {
                var b = a(this);
                b.removeData("kool-ctb")
            })
        }
    };
    var triggerClick = false;
    var e = {
        trigger: function(b, c, d, f, g) {
            if (c) {
                
                a(document).on('click touchend', ".abl", function() {
                    window.history.back();
                });
                a(document).on("touchstart", d + " " + f, function(d) {
                    triggerClick = true;
                }).on("touchmove", d + " " + f, function(d) {
                    triggerClick = false;
                }).on("click touchend", d + " " + f, function(d) {
                    d.preventDefault();
                    if (d.type == "click") triggerClick = true;
                    if (triggerClick){
                        var f = a(this);
                        e.ksDefinereloadboxIn(b, f, c, g);
                    }
                    
                });
            }
        },
        ksDefinereloadboxIn: function(b, c, d, f) {
            switch (b.direction) {
                case "left-to-right":
                case "right-to-left":
                case "top-to-bottom":
                case "bottom-to-top":
                case "":
                    if ($reloadboxIn = "ks-ctb-box-in", a(".ks-ctb-box-in").length) return !1;
                    a(this);
                    e.ksCollectLoadPageInfo(b, c, d, $reloadboxIn, f);
                    break;
                default:
                    return alert("Kool ctb Error: \n The defined direction " + b.direction + " does not exist."), !1
            }
        },
        ksCollectLoadPageInfo: function(b, c, d, f, g) {
            var f, h = c.attr("href");
            switch (b.direction) {
                case "left-to-right":
                    f = "ks-ctb-box-in-l";
                    break;
                case "right-to-left":
                    f = "ks-ctb-box-in-r";
                    break;
                case "top-to-bottom":
                    f = "ks-ctb-box-in-t";
                    break;
                case "bottom-to-top":
                    f = "ks-ctb-box-in-b";
                    break;
                case "":
                    f = "ks-ctb-box-in";
                    break;
                default:
                    return alert("Kool ctb Error: \n The defined direction " + b.direction + " does not exist."), !1
            }
            e.ksLoadPage(b, c, h, f, g), g && (history.pushState({
                url: h
            }, null, h), a("html").attr("data-ks-history-pushed", "true"))
        },
        ksLoadPage: function(b, c, d, f, g) {
            var h = a(b.reloadbox);
            "" != d ? (e.ksAddreloadboxIn(b, f), a.ajax({
                type: "GET",
                url: d,
                data: {},
                beforeSend: function() {
                    e.ksCreateLoadBox()
                },
                error: function(a, c, d) {
                    h.html('<div class="content"><div class="wrapper-inner error-404" style="opacity:1;"><div class= "back-link "><span>' + b.loadErrorMessage + '</span><div class="back-link-mes">' + b.loadErrorAddMessage + '</div><div class="back-link-but"><a class="abl ajaxPageSwitchBacklink">' + b.loadErrorBacklinkText + "</a></div></div></div></div>"+(b.loadErrorBg != '' ? '<div class="img-wrap hide_with_full"><div class="bg" style="background-image: url('+b.loadErrorBg+')"></div></div>' : '') )
                },
                success: function(a) {
                    b.bouncingBoxes ? e.ksFadeSiblings(b, c, a, f, g) : e.ksPositionAndPrepare(b, c, a, f, g)
                },
                dataType: "html"
            })) : alert("There is no target defined! Please check the references (i.e. normally href) of the ctbTriggers.")
        },
        ksAddreloadboxIn: function(b, c) {
            var d = a(b.reloadbox),
                e = d.attr("class"),
                f = d.prop("tagName");
            a(document).find(".ks-ctb-box-in").remove(), b.movereloadboxClasses ? d.after("<" + f.toLowerCase() + ' class="ks-ctb-box-in ' + ("undefined" != typeof e ? e : "") + '" id="' + c + '"></' + f.toLowerCase() + ">") : d.after("<" + f.toLowerCase() + ' class="ks-ctb-box-in" id="' + c + '"></' + f.toLowerCase() + ">"), d.siblings(".ks-ctb-box-in").hide()
        },
        ksFadeSiblings: function(b, c, d, f, g) {
            a(document).find(b.bouncingBoxes).animate({
                opacity: 0
            }, 50, function() {
                e.ksPositionAndPrepare(b, c, d, f)
            })
        },
        ksPositionAndPrepare: function(b, c, d, f, g) {
            var h = a(b.reloadbox),
                i = h.attr("id"),
                j = h.position(),
                k = h.width(),
                l = h.css("margin-left"),
                m = h.css("margin-left"),
                n = j.left + parseFloat(l);
            if (reloadboxRightAbsolute = j.left + parseFloat(l) + k - parseFloat(m), $reloadboxIn = a("#" + f), loadSelector = c.attr("data-ks-load-selector"), g) var o = d.match(/<\/*html\s+.*id="([^"].*)".*>/),
                p = d.match(/<\/*body\s+.*id="([^"].*)".*>/),
                q = d.match(/<\/*html\s+.*class="([^"].*)".*>/),
                r = d.match(/<\/*body\s+.*class="([^"].*)".*>/),
                s = d.match(/<\/*title>(.*)<\/title>/);
            if (h.addClass("ks-ctb-box-out").css({
                    position: "absolute",
                    top: j.top,
                    left: n,
                    marginLeft: 0,
                    width: k
                }), reloadboxInContents = void 0 != a(d).filter("#" + i).html()) {
                if (b.loadBox) var t = a(d).filter(b.loadBox);
                else if (loadSelector) var t = a(d).filter(loadSelector);
                else var t = a(d).filter("#" + i);
                reloadboxInContents = t.html();
                var u = t.attr("class")
            } else {
                if (b.loadBox) var t = a(d).find(b.loadBox);
                else if (loadSelector) var t = a(d).find(loadSelector);
                else var t = a(d).find("#" + i);
                reloadboxInContents = t.html();
                var u = t.attr("class")
            }
            $reloadboxIn.addClass(u).css({
                position: b.positionType,
                marginLeft: 0,
                top: j.top,
                left: n
            }).html(reloadboxInContents);
            var v = $reloadboxIn.find("img"),
                w = 0;
            v.length && 1 == b.preloadImages ? v.on("load", function() {
                w++, w == v.length && (a(document).trigger("ksLoadCallback"), e.ksctbContent(b, f, c, j, n, k, o, p, q, r, s, g))
            }) : (a(document).trigger("ksLoadCallback"), e.ksctbContent(b, f, c, j, n, k, o, p, q, r, s, g))
        },
        ksctbContent: function(b, c, d, f, g, h, i, j, k, l, m, n) {
            var o = a(b.reloadbox),
                p = o.attr("id"),
                q = a("#" + c),
                r = q.outerHeight(),
                t = (q.outerWidth(), o.outerHeight()),
                u = a(window).outerHeight(),
                v = a(window).outerWidth(),
                w = d.prop("hash");
            if (clearTimeout(loadTimer), e.ksRemoveLoadBox(), b.direction) {
                q.css({
                    width: h
                });
                var z, x = {},
                    y = {};
                switch (c) {
                    case "ks-ctb-box-in-b-pushstate":
                    case "ks-ctb-box-in-t":
                        q.css("top", 2 * -r), z = 3 * u;
                        break;
                    case "ks-ctb-box-in-t-pushstate":
                    case "ks-ctb-box-in-b":
                        q.css("top", 1.5 * t), z = 1.5 * -t;
                        break;
                    case "ks-ctb-box-in-r-pushstate":
                    case "ks-ctb-box-in-l":
                        q.css("left", -v), z = v;
                        break;
                    case "ks-ctb-box-in-l-pushstate":
                    case "ks-ctb-box-in-r":
                        q.css("left", v), z = -v;
                        break;
                    default:
                        return alert("Kool ctb Error: \n The reloadboxIn class is in an undefined format: " + c + "."), !1
                }
                switch (b.direction) {
                    case "left-to-right":
                    case "right-to-left":
                        var A = b.inDuration,
                            B = b.outDuration;
                        x = {
                            left: z
                        }, y = {
                            left: g
                        }, q.css("top", f.top), a("body").css({
                            overflowX: "hidden",
                            overflowY: "scroll"
                        });
                        break;
                    case "top-to-bottom":
                    case "bottom-to-top":
                        var C = t * b.inDuration / 1e3,
                            D = C / 100,
                            A = b.inDuration + D,
                            B = b.outDuration;
                        y = {
                            top: f.top
                        }, x = {
                            top: z
                        }, a("body").css("overflow-y", "scroll")
                }
                o.stop().show().animate(x, B, b.outEasing, function() {
                    a(this).remove(), n && e.ksSwitchClasses(i, j, k, l, m)
                }), q.stop().show().animate(y, A, b.inEasing, function() {
                    a(this).css({
                        display: "",
                        left: "",
                        marginLeft: "",
                        position: "",
                        top: "",
                        width: ""
                    }).attr("id", p).removeClass("ks-ctb-box-in"), e.animationCallback(w), e.ksCheckForSiblings(b)
                })
            } else {
                jQuery(".l-line").fadeIn(10), jQuery(".l-line span").animate({
                    width: "100%"
                }, {
                    queue: !1,
                    duration: 700,
                    easing: "swing"
                }), setTimeout(function() {
                    a("html, body").animate({
                        scrollTop: 0
                    }, {
                        queue: !0,
                        duration: 150,
                        easing: "easeInOutQuad"
                    })
                }, 1250), a(".loader").fadeIn(10), hideShare();
                var E = jQuery(window).width();
                E < 1024 && hideMenu(), contanimhide();
                var F = a.magnificPopup.instance;
                F.close(), o.delay(900).animate({
                    opacity: 0
                }, b.outDuration, function() {
                    a(this).remove(), n && e.ksSwitchClasses(i, j, k, l, m), q.css({
                        display: "",
                        left: "",
                        marginLeft: "",
                        opacity: 0,
                        position: "",
                        top: "",
                        width: ""
                    }).animate({
                        opacity: 1
                    }, b.inDuration, function() {
                        e.animationCallback(w), e.ksCheckForSiblings(b), a(".loader").fadeOut(10), contanimshow();
                        var c = window.location.href.split("#")[1],
                            d = jQuery("header").outerHeight(!0);
                        c && jQuery("#" + c).length && setTimeout(function() {
                            jQuery("html,body").animate({
                                scrollTop: jQuery("#" + c).offset().top - d
                            }, {
                                queue: !1,
                                duration: 800,
                                easing: "easeInOutExpo"
                            })
                        }, 950), jQuery(".l-line").fadeOut(10, function() {
                            jQuery(".l-line span").animate({
                                width: "0"
                            }, 10)
                        })
                    }).attr("id", p).removeClass("ks-ctb-box-in")
                })
            }
        },
        animationCallback: function(b) {
            b && a("html:not(:animated),body:not(:animated)").animate({
                scrollTop: a(b).position().top
            }, "normal")
        },
        ksCheckForSiblings: function(b) {
            b.bouncingBoxes ? a(document).find(b.bouncingBoxes).animate({
                opacity: 1
            }, 1400, function() {
                e.ksctbCallback()
            }) : e.ksctbCallback()
        },
        ksSwitchClasses: function(b, c, d, e, f) {
            a("html, body").attr({
                class: "",
                id: ""
            }), b ? a("html").attr("id", b[1]) : "", c ? a("body").attr("id", c[1]) : "", d ? a("html").addClass(d[1]) : "", e ? a("body").addClass(e[1]) : "", f ? a("title").text(f[1].replace(/&#8211;/g, "-")) : ""
        },
        ksCreateLoadBox: function() {
            a("#ks-loading-box").length ? (e.ksRemoveLoadBox(), e.ksCreateLoadBox()) : loadTimer = setTimeout(function() {}, 10)
        },
        ksRemoveLoadBox: function() {
            a("#ks-loading-box").fadeOut("1000").remove()
        },
        ksctbCallback: function() {
            a("body").css({
                overflowX: "auto"
            }), a(document).trigger("ksctbCallback")
        }
    };
    a.coretemp = function(b) {
        return c[b] ? c[b].apply(a(window), Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? void a.error("Method " + b + " does not exist on jQuery.coretemp") : c.init.apply(a(window), arguments, !1)
    }, a.fn.coretemp = function(b) {
        return d[b] ? d[b].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? void a.error("Method " + b + " does not exist on jQuery.coretemp") : d.init.apply(this, arguments)
    }
}(jQuery);