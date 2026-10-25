 ! function(e, t) {
     "use strict";
     "object" == typeof module && "object" == typeof module.exports ? module.exports = e.document ? t(e, !0) : function(e) {
         if (!e.document) throw new Error("jQuery requires a window with a document");
         return t(e)
     } : t(e)
 }("undefined" != typeof window ? window : this, function(e, t) {
     "use strict";

     function n(e, t, n) {
         t = t || ae;
         var i, o = t.createElement("script");
         if (o.text = e, n)
             for (i in xe) n[i] && (o[i] = n[i]);
         t.head.appendChild(o).parentNode.removeChild(o)
     }

     function i(e) {
         return null == e ? e + "" : "object" == typeof e || "function" == typeof e ? fe[he.call(e)] || "object" : typeof e
     }

     function o(e) {
         var t = !!e && "length" in e && e.length,
             n = i(e);
         return !we(e) && !be(e) && ("array" === n || 0 === t || "number" == typeof t && t > 0 && t - 1 in e)
     }

     function r(e, t) {
         return e.nodeName && e.nodeName.toLowerCase() === t.toLowerCase()
     }

     function s(e, t, n) {
         return we(t) ? Te.grep(e, function(e, i) {
             return !!t.call(e, i, e) !== n
         }) : t.nodeType ? Te.grep(e, function(e) {
             return e === t !== n
         }) : "string" != typeof t ? Te.grep(e, function(e) {
             return pe.call(t, e) > -1 !== n
         }) : Te.filter(t, e, n)
     }

     function a(e, t) {
         for (;
             (e = e[t]) && 1 !== e.nodeType;);
         return e
     }

     function l(e) {
         var t = {};
         return Te.each(e.match(Oe) || [], function(e, n) {
             t[n] = !0
         }), t
     }

     function c(e) {
         return e
     }

     function d(e) {
         throw e
     }

     function u(e, t, n, i) {
         var o;
         try {
             e && we(o = e.promise) ? o.call(e).done(t).fail(n) : e && we(o = e.then) ? o.call(e, t, n) : t.apply(void 0, [e].slice(i))
         } catch (e) {
             n.apply(void 0, [e])
         }
     }

     function p() {
         ae.removeEventListener("DOMContentLoaded", p), e.removeEventListener("load", p), Te.ready()
     }

     function f(e, t) {
         return t.toUpperCase()
     }

     function h(e) {
         return e.replace(Ie, "ms-").replace(ze, f)
     }

     function v() {
         this.expando = Te.expando + v.uid++
     }

     function g(e) {
         return "true" === e || "false" !== e && ("null" === e ? null : e === +e + "" ? +e : Be.test(e) ? JSON.parse(e) : e)
     }

     function y(e, t, n) {
         var i;
         if (void 0 === n && 1 === e.nodeType)
             if (i = "data-" + t.replace(Ue, "-$&").toLowerCase(), "string" == typeof(n = e.getAttribute(i))) {
                 try {
                     n = g(n)
                 } catch (e) {}
                 Fe.set(e, t, n)
             } else n = void 0;
         return n
     }

     function m(e, t, n, i) {
         var o, r, s = 20,
             a = i ? function() {
                 return i.cur()
             } : function() {
                 return Te.css(e, t, "")
             },
             l = a(),
             c = n && n[3] || (Te.cssNumber[t] ? "" : "px"),
             d = (Te.cssNumber[t] || "px" !== c && +l) && _e.exec(Te.css(e, t));
         if (d && d[3] !== c) {
             for (l /= 2, c = c || d[3], d = +l || 1; s--;) Te.style(e, t, d + c), (1 - r) * (1 - (r = a() / l || .5)) <= 0 && (s = 0), d /= r;
             d *= 2, Te.style(e, t, d + c), n = n || []
         }
         return n && (d = +d || +l || 0, o = n[1] ? d + (n[1] + 1) * n[2] : +n[2], i && (i.unit = c, i.start = d, i.end = o)), o
     }

     function w(e) {
         var t, n = e.ownerDocument,
             i = e.nodeName,
             o = Qe[i];
         return o || (t = n.body.appendChild(n.createElement(i)), o = Te.css(t, "display"), t.parentNode.removeChild(t), "none" === o && (o = "block"), Qe[i] = o, o)
     }

     function b(e, t) {
         for (var n, i, o = [], r = 0, s = e.length; r < s; r++) i = e[r], i.style && (n = i.style.display, t ? ("none" === n && (o[r] = Re.get(i, "display") || null, o[r] || (i.style.display = "")), "" === i.style.display && Ve(i) && (o[r] = w(i))) : "none" !== n && (o[r] = "none", Re.set(i, "display", n)));
         for (r = 0; r < s; r++) null != o[r] && (e[r].style.display = o[r]);
         return e
     }

     function x(e, t) {
         var n;
         return n = void 0 !== e.getElementsByTagName ? e.getElementsByTagName(t || "*") : void 0 !== e.querySelectorAll ? e.querySelectorAll(t || "*") : [], void 0 === t || t && r(e, t) ? Te.merge([e], n) : n
     }

     function k(e, t) {
         for (var n = 0, i = e.length; n < i; n++) Re.set(e[n], "globalEval", !t || Re.get(t[n], "globalEval"))
     }

     function T(e, t, n, o, r) {
         for (var s, a, l, c, d, u, p = t.createDocumentFragment(), f = [], h = 0, v = e.length; h < v; h++)
             if ((s = e[h]) || 0 === s)
                 if ("object" === i(s)) Te.merge(f, s.nodeType ? [s] : s);
                 else if (tt.test(s)) {
             for (a = a || p.appendChild(t.createElement("div")), l = (Ke.exec(s) || ["", ""])[1].toLowerCase(), c = et[l] || et._default, a.innerHTML = c[1] + Te.htmlPrefilter(s) + c[2], u = c[0]; u--;) a = a.lastChild;
             Te.merge(f, a.childNodes), a = p.firstChild, a.textContent = ""
         } else f.push(t.createTextNode(s));
         for (p.textContent = "", h = 0; s = f[h++];)
             if (o && Te.inArray(s, o) > -1) r && r.push(s);
             else if (d = Te.contains(s.ownerDocument, s), a = x(p.appendChild(s), "script"), d && k(a), n)
             for (u = 0; s = a[u++];) Ze.test(s.type || "") && n.push(s);
         return p
     }

     function S() {
         return !0
     }

     function C() {
         return !1
     }

     function A() {
         try {
             return ae.activeElement
         } catch (e) {}
     }

     function E(e, t, n, i, o, r) {
         var s, a;
         if ("object" == typeof t) {
             "string" != typeof n && (i = i || n, n = void 0);
             for (a in t) E(e, a, n, i, t[a], r);
             return e
         }
         if (null == i && null == o ? (o = n, i = n = void 0) : null == o && ("string" == typeof n ? (o = i, i = void 0) : (o = i, i = n, n = void 0)), !1 === o) o = C;
         else if (!o) return e;
         return 1 === r && (s = o, o = function(e) {
             return Te().off(e), s.apply(this, arguments)
         }, o.guid = s.guid || (s.guid = Te.guid++)), e.each(function() {
             Te.event.add(this, t, o, i, n)
         })
     }

     function D(e, t) {
         return r(e, "table") && r(11 !== t.nodeType ? t : t.firstChild, "tr") ? Te(e).children("tbody")[0] || e : e
     }

     function j(e) {
         return e.type = (null !== e.getAttribute("type")) + "/" + e.type, e
     }

     function H(e) {
         return "true/" === (e.type || "").slice(0, 5) ? e.type = e.type.slice(5) : e.removeAttribute("type"), e
     }

     function N(e, t) {
         var n, i, o, r, s, a, l, c;
         if (1 === t.nodeType) {
             if (Re.hasData(e) && (r = Re.access(e), s = Re.set(t, r), c = r.events)) {
                 delete s.handle, s.events = {};
                 for (o in c)
                     for (n = 0, i = c[o].length; n < i; n++) Te.event.add(t, o, c[o][n])
             }
             Fe.hasData(e) && (a = Fe.access(e), l = Te.extend({}, a), Fe.set(t, l))
         }
     }

     function L(e, t) {
         var n = t.nodeName.toLowerCase();
         "input" === n && Je.test(e.type) ? t.checked = e.checked : "input" !== n && "textarea" !== n || (t.defaultValue = e.defaultValue)
     }

     function O(e, t, i, o) {
         t = de.apply([], t);
         var r, s, a, l, c, d, u = 0,
             p = e.length,
             f = p - 1,
             h = t[0],
             v = we(h);
         if (v || p > 1 && "string" == typeof h && !me.checkClone && lt.test(h)) return e.each(function(n) {
             var r = e.eq(n);
             v && (t[0] = h.call(this, n, r.html())), O(r, t, i, o)
         });
         if (p && (r = T(t, e[0].ownerDocument, !1, e, o), s = r.firstChild, 1 === r.childNodes.length && (r = s), s || o)) {
             for (a = Te.map(x(r, "script"), j), l = a.length; u < p; u++) c = r, u !== f && (c = Te.clone(c, !0, !0), l && Te.merge(a, x(c, "script"))), i.call(e[u], c, u);
             if (l)
                 for (d = a[a.length - 1].ownerDocument, Te.map(a, H), u = 0; u < l; u++) c = a[u], Ze.test(c.type || "") && !Re.access(c, "globalEval") && Te.contains(d, c) && (c.src && "module" !== (c.type || "").toLowerCase() ? Te._evalUrl && Te._evalUrl(c.src) : n(c.textContent.replace(ct, ""), d, c))
         }
         return e
     }

     function P(e, t, n) {
         for (var i, o = t ? Te.filter(t, e) : e, r = 0; null != (i = o[r]); r++) n || 1 !== i.nodeType || Te.cleanData(x(i)), i.parentNode && (n && Te.contains(i.ownerDocument, i) && k(x(i, "script")), i.parentNode.removeChild(i));
         return e
     }

     function q(e, t, n) {
         var i, o, r, s, a = e.style;
         return n = n || ut(e), n && (s = n.getPropertyValue(t) || n[t], "" !== s || Te.contains(e.ownerDocument, e) || (s = Te.style(e, t)), !me.pixelBoxStyles() && dt.test(s) && pt.test(t) && (i = a.width, o = a.minWidth, r = a.maxWidth, a.minWidth = a.maxWidth = a.width = s, s = n.width, a.width = i, a.minWidth = o, a.maxWidth = r)), void 0 !== s ? s + "" : s
     }

     function M(e, t) {
         return {
             get: function() {
                 return e() ? void delete this.get : (this.get = t).apply(this, arguments)
             }
         }
     }

     function I(e) {
         if (e in mt) return e;
         for (var t = e[0].toUpperCase() + e.slice(1), n = yt.length; n--;)
             if ((e = yt[n] + t) in mt) return e
     }

     function z(e) {
         var t = Te.cssProps[e];
         return t || (t = Te.cssProps[e] = I(e) || e), t
     }

     function W(e, t, n) {
         var i = _e.exec(t);
         return i ? Math.max(0, i[2] - (n || 0)) + (i[3] || "px") : t
     }

     function R(e, t, n, i, o, r) {
         var s = "width" === t ? 1 : 0,
             a = 0,
             l = 0;
         if (n === (i ? "border" : "content")) return 0;
         for (; s < 4; s += 2) "margin" === n && (l += Te.css(e, n + Ye[s], !0, o)), i ? ("content" === n && (l -= Te.css(e, "padding" + Ye[s], !0, o)), "margin" !== n && (l -= Te.css(e, "border" + Ye[s] + "Width", !0, o))) : (l += Te.css(e, "padding" + Ye[s], !0, o), "padding" !== n ? l += Te.css(e, "border" + Ye[s] + "Width", !0, o) : a += Te.css(e, "border" + Ye[s] + "Width", !0, o));
         return !i && r >= 0 && (l += Math.max(0, Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - r - l - a - .5))), l
     }

     function F(e, t, n) {
         var i = ut(e),
             o = q(e, t, i),
             r = "border-box" === Te.css(e, "boxSizing", !1, i),
             s = r;
         if (dt.test(o)) {
             if (!n) return o;
             o = "auto"
         }
         return s = s && (me.boxSizingReliable() || o === e.style[t]), ("auto" === o || !parseFloat(o) && "inline" === Te.css(e, "display", !1, i)) && (o = e["offset" + t[0].toUpperCase() + t.slice(1)], s = !0), (o = parseFloat(o) || 0) + R(e, t, n || (r ? "border" : "content"), s, i, o) + "px"
     }

     function B(e, t, n, i, o) {
         return new B.prototype.init(e, t, n, i, o)
     }

     function U() {
         bt && (!1 === ae.hidden && e.requestAnimationFrame ? e.requestAnimationFrame(U) : e.setTimeout(U, Te.fx.interval), Te.fx.tick())
     }

     function X() {
         return e.setTimeout(function() {
             wt = void 0
         }), wt = Date.now()
     }

     function _(e, t) {
         var n, i = 0,
             o = {
                 height: e
             };
         for (t = t ? 1 : 0; i < 4; i += 2 - t) n = Ye[i], o["margin" + n] = o["padding" + n] = e;
         return t && (o.opacity = o.width = e), o
     }

     function Y(e, t, n) {
         for (var i, o = (Q.tweeners[t] || []).concat(Q.tweeners["*"]), r = 0, s = o.length; r < s; r++)
             if (i = o[r].call(n, t, e)) return i
     }

     function V(e, t, n) {
         var i, o, r, s, a, l, c, d, u = "width" in t || "height" in t,
             p = this,
             f = {},
             h = e.style,
             v = e.nodeType && Ve(e),
             g = Re.get(e, "fxshow");
         n.queue || (s = Te._queueHooks(e, "fx"), null == s.unqueued && (s.unqueued = 0, a = s.empty.fire, s.empty.fire = function() {
             s.unqueued || a()
         }), s.unqueued++, p.always(function() {
             p.always(function() {
                 s.unqueued--, Te.queue(e, "fx").length || s.empty.fire()
             })
         }));
         for (i in t)
             if (o = t[i], xt.test(o)) {
                 if (delete t[i], r = r || "toggle" === o, o === (v ? "hide" : "show")) {
                     if ("show" !== o || !g || void 0 === g[i]) continue;
                     v = !0
                 }
                 f[i] = g && g[i] || Te.style(e, i)
             }
         if ((l = !Te.isEmptyObject(t)) || !Te.isEmptyObject(f)) {
             u && 1 === e.nodeType && (n.overflow = [h.overflow, h.overflowX, h.overflowY], c = g && g.display, null == c && (c = Re.get(e, "display")), d = Te.css(e, "display"), "none" === d && (c ? d = c : (b([e], !0), c = e.style.display || c, d = Te.css(e, "display"), b([e]))), ("inline" === d || "inline-block" === d && null != c) && "none" === Te.css(e, "float") && (l || (p.done(function() {
                 h.display = c
             }), null == c && (d = h.display, c = "none" === d ? "" : d)), h.display = "inline-block")), n.overflow && (h.overflow = "hidden", p.always(function() {
                 h.overflow = n.overflow[0], h.overflowX = n.overflow[1], h.overflowY = n.overflow[2]
             })), l = !1;
             for (i in f) l || (g ? "hidden" in g && (v = g.hidden) : g = Re.access(e, "fxshow", {
                 display: c
             }), r && (g.hidden = !v), v && b([e], !0), p.done(function() {
                 v || b([e]), Re.remove(e, "fxshow");
                 for (i in f) Te.style(e, i, f[i])
             })), l = Y(v ? g[i] : 0, i, p), i in g || (g[i] = l.start, v && (l.end = l.start, l.start = 0))
         }
     }

     function G(e, t) {
         var n, i, o, r, s;
         for (n in e)
             if (i = h(n), o = t[i], r = e[n], Array.isArray(r) && (o = r[1], r = e[n] = r[0]), n !== i && (e[i] = r, delete e[n]), (s = Te.cssHooks[i]) && "expand" in s) {
                 r = s.expand(r), delete e[i];
                 for (n in r) n in e || (e[n] = r[n], t[n] = o)
             } else t[i] = o
     }

     function Q(e, t, n) {
         var i, o, r = 0,
             s = Q.prefilters.length,
             a = Te.Deferred().always(function() {
                 delete l.elem
             }),
             l = function() {
                 if (o) return !1;
                 for (var t = wt || X(), n = Math.max(0, c.startTime + c.duration - t), i = n / c.duration || 0, r = 1 - i, s = 0, l = c.tweens.length; s < l; s++) c.tweens[s].run(r);
                 return a.notifyWith(e, [c, r, n]), r < 1 && l ? n : (l || a.notifyWith(e, [c, 1, 0]), a.resolveWith(e, [c]), !1)
             },
             c = a.promise({
                 elem: e,
                 props: Te.extend({}, t),
                 opts: Te.extend(!0, {
                     specialEasing: {},
                     easing: Te.easing._default
                 }, n),
                 originalProperties: t,
                 originalOptions: n,
                 startTime: wt || X(),
                 duration: n.duration,
                 tweens: [],
                 createTween: function(t, n) {
                     var i = Te.Tween(e, c.opts, t, n, c.opts.specialEasing[t] || c.opts.easing);
                     return c.tweens.push(i), i
                 },
                 stop: function(t) {
                     var n = 0,
                         i = t ? c.tweens.length : 0;
                     if (o) return this;
                     for (o = !0; n < i; n++) c.tweens[n].run(1);
                     return t ? (a.notifyWith(e, [c, 1, 0]), a.resolveWith(e, [c, t])) : a.rejectWith(e, [c, t]), this
                 }
             }),
             d = c.props;
         for (G(d, c.opts.specialEasing); r < s; r++)
             if (i = Q.prefilters[r].call(c, e, d, c.opts)) return we(i.stop) && (Te._queueHooks(c.elem, c.opts.queue).stop = i.stop.bind(i)), i;
         return Te.map(d, Y, c), we(c.opts.start) && c.opts.start.call(e, c), c.progress(c.opts.progress).done(c.opts.done, c.opts.complete).fail(c.opts.fail).always(c.opts.always), Te.fx.timer(Te.extend(l, {
             elem: e,
             anim: c,
             queue: c.opts.queue
         })), c
     }

     function J(e) {
         return (e.match(Oe) || []).join(" ")
     }

     function K(e) {
         return e.getAttribute && e.getAttribute("class") || ""
     }

     function Z(e) {
         return Array.isArray(e) ? e : "string" == typeof e ? e.match(Oe) || [] : []
     }

     function ee(e, t, n, o) {
         var r;
         if (Array.isArray(t)) Te.each(t, function(t, i) {
             n || Lt.test(e) ? o(e, i) : ee(e + "[" + ("object" == typeof i && null != i ? t : "") + "]", i, n, o)
         });
         else if (n || "object" !== i(t)) o(e, t);
         else
             for (r in t) ee(e + "[" + r + "]", t[r], n, o)
     }

     function te(e) {
         return function(t, n) {
             "string" != typeof t && (n = t, t = "*");
             var i, o = 0,
                 r = t.toLowerCase().match(Oe) || [];
             if (we(n))
                 for (; i = r[o++];) "+" === i[0] ? (i = i.slice(1) || "*", (e[i] = e[i] || []).unshift(n)) : (e[i] = e[i] || []).push(n)
         }
     }

     function ne(e, t, n, i) {
         function o(a) {
             var l;
             return r[a] = !0, Te.each(e[a] || [], function(e, a) {
                 var c = a(t, n, i);
                 return "string" != typeof c || s || r[c] ? s ? !(l = c) : void 0 : (t.dataTypes.unshift(c), o(c), !1)
             }), l
         }
         var r = {},
             s = e === Xt;
         return o(t.dataTypes[0]) || !r["*"] && o("*")
     }

     function ie(e, t) {
         var n, i, o = Te.ajaxSettings.flatOptions || {};
         for (n in t) void 0 !== t[n] && ((o[n] ? e : i || (i = {}))[n] = t[n]);
         return i && Te.extend(!0, e, i), e
     }

     function oe(e, t, n) {
         for (var i, o, r, s, a = e.contents, l = e.dataTypes;
             "*" === l[0];) l.shift(), void 0 === i && (i = e.mimeType || t.getResponseHeader("Content-Type"));
         if (i)
             for (o in a)
                 if (a[o] && a[o].test(i)) {
                     l.unshift(o);
                     break
                 }
         if (l[0] in n) r = l[0];
         else {
             for (o in n) {
                 if (!l[0] || e.converters[o + " " + l[0]]) {
                     r = o;
                     break
                 }
                 s || (s = o)
             }
             r = r || s
         }
         if (r) return r !== l[0] && l.unshift(r), n[r]
     }

     function re(e, t, n, i) {
         var o, r, s, a, l, c = {},
             d = e.dataTypes.slice();
         if (d[1])
             for (s in e.converters) c[s.toLowerCase()] = e.converters[s];
         for (r = d.shift(); r;)
             if (e.responseFields[r] && (n[e.responseFields[r]] = t), !l && i && e.dataFilter && (t = e.dataFilter(t, e.dataType)), l = r, r = d.shift())
                 if ("*" === r) r = l;
                 else if ("*" !== l && l !== r) {
             if (!(s = c[l + " " + r] || c["* " + r]))
                 for (o in c)
                     if (a = o.split(" "), a[1] === r && (s = c[l + " " + a[0]] || c["* " + a[0]])) {
                         !0 === s ? s = c[o] : !0 !== c[o] && (r = a[0], d.unshift(a[1]));
                         break
                     }
             if (!0 !== s)
                 if (s && e.throws) t = s(t);
                 else try {
                     t = s(t)
                 } catch (e) {
                     return {
                         state: "parsererror",
                         error: s ? e : "No conversion from " + l + " to " + r
                     }
                 }
         }
         return {
             state: "success",
             data: t
         }
     }
     var se = [],
         ae = e.document,
         le = Object.getPrototypeOf,
         ce = se.slice,
         de = se.concat,
         ue = se.push,
         pe = se.indexOf,
         fe = {},
         he = fe.toString,
         ve = fe.hasOwnProperty,
         ge = ve.toString,
         ye = ge.call(Object),
         me = {},
         we = function e(t) {
             return "function" == typeof t && "number" != typeof t.nodeType
         },
         be = function e(t) {
             return null != t && t === t.window
         },
         xe = {
             type: !0,
             src: !0,
             noModule: !0
         },
         ke = "3.3.1",
         Te = function(e, t) {
             return new Te.fn.init(e, t)
         },
         Se = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;
     Te.fn = Te.prototype = {
         jquery: "3.3.1",
         constructor: Te,
         length: 0,
         toArray: function() {
             return ce.call(this)
         },
         get: function(e) {
             return null == e ? ce.call(this) : e < 0 ? this[e + this.length] : this[e]
         },
         pushStack: function(e) {
             var t = Te.merge(this.constructor(), e);
             return t.prevObject = this, t
         },
         each: function(e) {
             return Te.each(this, e)
         },
         map: function(e) {
             return this.pushStack(Te.map(this, function(t, n) {
                 return e.call(t, n, t)
             }))
         },
         slice: function() {
             return this.pushStack(ce.apply(this, arguments))
         },
         first: function() {
             return this.eq(0)
         },
         last: function() {
             return this.eq(-1)
         },
         eq: function(e) {
             var t = this.length,
                 n = +e + (e < 0 ? t : 0);
             return this.pushStack(n >= 0 && n < t ? [this[n]] : [])
         },
         end: function() {
             return this.prevObject || this.constructor()
         },
         push: ue,
         sort: se.sort,
         splice: se.splice
     }, Te.extend = Te.fn.extend = function() {
         var e, t, n, i, o, r, s = arguments[0] || {},
             a = 1,
             l = arguments.length,
             c = !1;
         for ("boolean" == typeof s && (c = s, s = arguments[a] || {}, a++), "object" == typeof s || we(s) || (s = {}), a === l && (s = this, a--); a < l; a++)
             if (null != (e = arguments[a]))
                 for (t in e) n = s[t], i = e[t], s !== i && (c && i && (Te.isPlainObject(i) || (o = Array.isArray(i))) ? (o ? (o = !1, r = n && Array.isArray(n) ? n : []) : r = n && Te.isPlainObject(n) ? n : {}, s[t] = Te.extend(c, r, i)) : void 0 !== i && (s[t] = i));
         return s
     }, Te.extend({
         expando: "jQuery" + ("3.3.1" + Math.random()).replace(/\D/g, ""),
         isReady: !0,
         error: function(e) {
             throw new Error(e)
         },
         noop: function() {},
         isPlainObject: function(e) {
             var t, n;
             return !(!e || "[object Object]" !== he.call(e)) && (!(t = le(e)) || "function" == typeof(n = ve.call(t, "constructor") && t.constructor) && ge.call(n) === ye)
         },
         isEmptyObject: function(e) {
             var t;
             for (t in e) return !1;
             return !0
         },
         globalEval: function(e) {
             n(e)
         },
         each: function(e, t) {
             var n, i = 0;
             if (o(e))
                 for (n = e.length; i < n && !1 !== t.call(e[i], i, e[i]); i++);
             else
                 for (i in e)
                     if (!1 === t.call(e[i], i, e[i])) break; return e
         },
         trim: function(e) {
             return null == e ? "" : (e + "").replace(Se, "")
         },
         makeArray: function(e, t) {
             var n = t || [];
             return null != e && (o(Object(e)) ? Te.merge(n, "string" == typeof e ? [e] : e) : ue.call(n, e)), n
         },
         inArray: function(e, t, n) {
             return null == t ? -1 : pe.call(t, e, n)
         },
         merge: function(e, t) {
             for (var n = +t.length, i = 0, o = e.length; i < n; i++) e[o++] = t[i];
             return e.length = o, e
         },
         grep: function(e, t, n) {
             for (var i, o = [], r = 0, s = e.length, a = !n; r < s; r++)(i = !t(e[r], r)) !== a && o.push(e[r]);
             return o
         },
         map: function(e, t, n) {
             var i, r, s = 0,
                 a = [];
             if (o(e))
                 for (i = e.length; s < i; s++) null != (r = t(e[s], s, n)) && a.push(r);
             else
                 for (s in e) null != (r = t(e[s], s, n)) && a.push(r);
             return de.apply([], a)
         },
         guid: 1,
         support: me
     }), "function" == typeof Symbol && (Te.fn[Symbol.iterator] = se[Symbol.iterator]), Te.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "), function(e, t) {
         fe["[object " + t + "]"] = t.toLowerCase()
     });
     var Ce = function(e) {
         function t(e, t, n, i) {
             var o, r, s, a, l, c, d, p = t && t.ownerDocument,
                 h = t ? t.nodeType : 9;
             if (n = n || [], "string" != typeof e || !e || 1 !== h && 9 !== h && 11 !== h) return n;
             if (!i && ((t ? t.ownerDocument || t : F) !== O && L(t), t = t || O, q)) {
                 if (11 !== h && (l = me.exec(e)))
                     if (o = l[1]) {
                         if (9 === h) {
                             if (!(s = t.getElementById(o))) return n;
                             if (s.id === o) return n.push(s), n
                         } else if (p && (s = p.getElementById(o)) && W(t, s) && s.id === o) return n.push(s), n
                     } else {
                         if (l[2]) return Z.apply(n, t.getElementsByTagName(e)), n;
                         if ((o = l[3]) && k.getElementsByClassName && t.getElementsByClassName) return Z.apply(n, t.getElementsByClassName(o)), n
                     }
                 if (k.qsa && !Y[e + " "] && (!M || !M.test(e))) {
                     if (1 !== h) p = t, d = e;
                     else if ("object" !== t.nodeName.toLowerCase()) {
                         for ((a = t.getAttribute("id")) ? a = a.replace(ke, Te) : t.setAttribute("id", a = R), c = A(e), r = c.length; r--;) c[r] = "#" + a + " " + f(c[r]);
                         d = c.join(","), p = we.test(e) && u(t.parentNode) || t
                     }
                     if (d) try {
                         return Z.apply(n, p.querySelectorAll(d)), n
                     } catch (e) {} finally {
                         a === R && t.removeAttribute("id")
                     }
                 }
             }
             return D(e.replace(le, "$1"), t, n, i)
         }

         function n() {
             function e(n, i) {
                 return t.push(n + " ") > T.cacheLength && delete e[t.shift()], e[n + " "] = i
             }
             var t = [];
             return e
         }

         function i(e) {
             return e[R] = !0, e
         }

         function o(e) {
             var t = O.createElement("fieldset");
             try {
                 return !!e(t)
             } catch (e) {
                 return !1
             } finally {
                 t.parentNode && t.parentNode.removeChild(t), t = null
             }
         }

         function r(e, t) {
             for (var n = e.split("|"), i = n.length; i--;) T.attrHandle[n[i]] = t
         }

         function s(e, t) {
             var n = t && e,
                 i = n && 1 === e.nodeType && 1 === t.nodeType && e.sourceIndex - t.sourceIndex;
             if (i) return i;
             if (n)
                 for (; n = n.nextSibling;)
                     if (n === t) return -1;
             return e ? 1 : -1
         }

         function a(e) {
             return function(t) {
                 return "input" === t.nodeName.toLowerCase() && t.type === e
             }
         }

         function l(e) {
             return function(t) {
                 var n = t.nodeName.toLowerCase();
                 return ("input" === n || "button" === n) && t.type === e
             }
         }

         function c(e) {
             return function(t) {
                 return "form" in t ? t.parentNode && !1 === t.disabled ? "label" in t ? "label" in t.parentNode ? t.parentNode.disabled === e : t.disabled === e : t.isDisabled === e || t.isDisabled !== !e && Ce(t) === e : t.disabled === e : "label" in t && t.disabled === e
             }
         }

         function d(e) {
             return i(function(t) {
                 return t = +t, i(function(n, i) {
                     for (var o, r = e([], n.length, t), s = r.length; s--;) n[o = r[s]] && (n[o] = !(i[o] = n[o]))
                 })
             })
         }

         function u(e) {
             return e && void 0 !== e.getElementsByTagName && e
         }

         function p() {}

         function f(e) {
             for (var t = 0, n = e.length, i = ""; t < n; t++) i += e[t].value;
             return i
         }

         function h(e, t, n) {
             var i = t.dir,
                 o = t.next,
                 r = o || i,
                 s = n && "parentNode" === r,
                 a = U++;
             return t.first ? function(t, n, o) {
                 for (; t = t[i];)
                     if (1 === t.nodeType || s) return e(t, n, o);
                 return !1
             } : function(t, n, l) {
                 var c, d, u, p = [B, a];
                 if (l) {
                     for (; t = t[i];)
                         if ((1 === t.nodeType || s) && e(t, n, l)) return !0
                 } else
                     for (; t = t[i];)
                         if (1 === t.nodeType || s)
                             if (u = t[R] || (t[R] = {}), d = u[t.uniqueID] || (u[t.uniqueID] = {}), o && o === t.nodeName.toLowerCase()) t = t[i] || t;
                             else {
                                 if ((c = d[r]) && c[0] === B && c[1] === a) return p[2] = c[2];
                                 if (d[r] = p, p[2] = e(t, n, l)) return !0
                             } return !1
             }
         }

         function v(e) {
             return e.length > 1 ? function(t, n, i) {
                 for (var o = e.length; o--;)
                     if (!e[o](t, n, i)) return !1;
                 return !0
             } : e[0]
         }

         function g(e, n, i) {
             for (var o = 0, r = n.length; o < r; o++) t(e, n[o], i);
             return i
         }

         function y(e, t, n, i, o) {
             for (var r, s = [], a = 0, l = e.length, c = null != t; a < l; a++)(r = e[a]) && (n && !n(r, i, o) || (s.push(r), c && t.push(a)));
             return s
         }

         function m(e, t, n, o, r, s) {
             return o && !o[R] && (o = m(o)), r && !r[R] && (r = m(r, s)), i(function(i, s, a, l) {
                 var c, d, u, p = [],
                     f = [],
                     h = s.length,
                     v = i || g(t || "*", a.nodeType ? [a] : a, []),
                     m = !e || !i && t ? v : y(v, p, e, a, l),
                     w = n ? r || (i ? e : h || o) ? [] : s : m;
                 if (n && n(m, w, a, l), o)
                     for (c = y(w, f), o(c, [], a, l), d = c.length; d--;)(u = c[d]) && (w[f[d]] = !(m[f[d]] = u));
                 if (i) {
                     if (r || e) {
                         if (r) {
                             for (c = [], d = w.length; d--;)(u = w[d]) && c.push(m[d] = u);
                             r(null, w = [], c, l)
                         }
                         for (d = w.length; d--;)(u = w[d]) && (c = r ? te(i, u) : p[d]) > -1 && (i[c] = !(s[c] = u))
                     }
                 } else w = y(w === s ? w.splice(h, w.length) : w), r ? r(null, s, w, l) : Z.apply(s, w)
             })
         }

         function w(e) {
             for (var t, n, i, o = e.length, r = T.relative[e[0].type], s = r || T.relative[" "], a = r ? 1 : 0, l = h(function(e) {
                     return e === t
                 }, s, !0), c = h(function(e) {
                     return te(t, e) > -1
                 }, s, !0), d = [function(e, n, i) {
                     var o = !r && (i || n !== j) || ((t = n).nodeType ? l(e, n, i) : c(e, n, i));
                     return t = null, o
                 }]; a < o; a++)
                 if (n = T.relative[e[a].type]) d = [h(v(d), n)];
                 else {
                     if (n = T.filter[e[a].type].apply(null, e[a].matches), n[R]) {
                         for (i = ++a; i < o && !T.relative[e[i].type]; i++);
                         return m(a > 1 && v(d), a > 1 && f(e.slice(0, a - 1).concat({
                             value: " " === e[a - 2].type ? "*" : ""
                         })).replace(le, "$1"), n, a < i && w(e.slice(a, i)), i < o && w(e = e.slice(i)), i < o && f(e))
                     }
                     d.push(n)
                 }
             return v(d)
         }

         function b(e, n) {
             var o = n.length > 0,
                 r = e.length > 0,
                 s = function(i, s, a, l, c) {
                     var d, u, p, f = 0,
                         h = "0",
                         v = i && [],
                         g = [],
                         m = j,
                         w = i || r && T.find.TAG("*", c),
                         b = B += null == m ? 1 : Math.random() || .1,
                         x = w.length;
                     for (c && (j = s === O || s || c); h !== x && null != (d = w[h]); h++) {
                         if (r && d) {
                             for (u = 0, s || d.ownerDocument === O || (L(d), a = !q); p = e[u++];)
                                 if (p(d, s || O, a)) {
                                     l.push(d);
                                     break
                                 }
                             c && (B = b)
                         }
                         o && ((d = !p && d) && f--, i && v.push(d))
                     }
                     if (f += h, o && h !== f) {
                         for (u = 0; p = n[u++];) p(v, g, s, a);
                         if (i) {
                             if (f > 0)
                                 for (; h--;) v[h] || g[h] || (g[h] = J.call(l));
                             g = y(g)
                         }
                         Z.apply(l, g), c && !i && g.length > 0 && f + n.length > 1 && t.uniqueSort(l)
                     }
                     return c && (B = b, j = m), v
                 };
             return o ? i(s) : s
         }
         var x, k, T, S, C, A, E, D, j, H, N, L, O, P, q, M, I, z, W, R = "sizzle" + 1 * new Date,
             F = e.document,
             B = 0,
             U = 0,
             X = n(),
             _ = n(),
             Y = n(),
             V = function(e, t) {
                 return e === t && (N = !0), 0
             },
             G = {}.hasOwnProperty,
             Q = [],
             J = Q.pop,
             K = Q.push,
             Z = Q.push,
             ee = Q.slice,
             te = function(e, t) {
                 for (var n = 0, i = e.length; n < i; n++)
                     if (e[n] === t) return n;
                 return -1
             },
             ne = "checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",
             ie = "[\\x20\\t\\r\\n\\f]",
             oe = "(?:\\\\.|[\\w-]|[^\0-\\xa0])+",
             re = "\\[" + ie + "*(" + oe + ")(?:" + ie + "*([*^$|!~]?=)" + ie + "*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|(" + oe + "))|)" + ie + "*\\]",
             se = ":(" + oe + ")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|" + re + ")*)|.*)\\)|)",
             ae = new RegExp(ie + "+", "g"),
             le = new RegExp("^" + ie + "+|((?:^|[^\\\\])(?:\\\\.)*)" + ie + "+$", "g"),
             ce = new RegExp("^" + ie + "*," + ie + "*"),
             de = new RegExp("^" + ie + "*([>+~]|" + ie + ")" + ie + "*"),
             ue = new RegExp("=" + ie + "*([^\\]'\"]*?)" + ie + "*\\]", "g"),
             pe = new RegExp(se),
             fe = new RegExp("^" + oe + "$"),
             he = {
                 ID: new RegExp("^#(" + oe + ")"),
                 CLASS: new RegExp("^\\.(" + oe + ")"),
                 TAG: new RegExp("^(" + oe + "|[*])"),
                 ATTR: new RegExp("^" + re),
                 PSEUDO: new RegExp("^" + se),
                 CHILD: new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\(" + ie + "*(even|odd|(([+-]|)(\\d*)n|)" + ie + "*(?:([+-]|)" + ie + "*(\\d+)|))" + ie + "*\\)|)", "i"),
                 bool: new RegExp("^(?:" + ne + ")$", "i"),
                 needsContext: new RegExp("^" + ie + "*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\(" + ie + "*((?:-\\d)?\\d*)" + ie + "*\\)|)(?=[^-]|$)", "i")
             },
             ve = /^(?:input|select|textarea|button)$/i,
             ge = /^h\d$/i,
             ye = /^[^{]+\{\s*\[native \w/,
             me = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,
             we = /[+~]/,
             be = new RegExp("\\\\([\\da-f]{1,6}" + ie + "?|(" + ie + ")|.)", "ig"),
             xe = function(e, t, n) {
                 var i = "0x" + t - 65536;
                 return i !== i || n ? t : i < 0 ? String.fromCharCode(i + 65536) : String.fromCharCode(i >> 10 | 55296, 1023 & i | 56320)
             },
             ke = /([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,
             Te = function(e, t) {
                 return t ? "\0" === e ? "�" : e.slice(0, -1) + "\\" + e.charCodeAt(e.length - 1).toString(16) + " " : "\\" + e
             },
             Se = function() {
                 L()
             },
             Ce = h(function(e) {
                 return !0 === e.disabled && ("form" in e || "label" in e)
             }, {
                 dir: "parentNode",
                 next: "legend"
             });
         try {
             Z.apply(Q = ee.call(F.childNodes), F.childNodes), Q[F.childNodes.length].nodeType
         } catch (e) {
             Z = {
                 apply: Q.length ? function(e, t) {
                     K.apply(e, ee.call(t))
                 } : function(e, t) {
                     for (var n = e.length, i = 0; e[n++] = t[i++];);
                     e.length = n - 1
                 }
             }
         }
         k = t.support = {}, C = t.isXML = function(e) {
             var t = e && (e.ownerDocument || e).documentElement;
             return !!t && "HTML" !== t.nodeName
         }, L = t.setDocument = function(e) {
             var t, n, i = e ? e.ownerDocument || e : F;
             return i !== O && 9 === i.nodeType && i.documentElement ? (O = i, P = O.documentElement, q = !C(O), F !== O && (n = O.defaultView) && n.top !== n && (n.addEventListener ? n.addEventListener("unload", Se, !1) : n.attachEvent && n.attachEvent("onunload", Se)), k.attributes = o(function(e) {
                 return e.className = "i", !e.getAttribute("className")
             }), k.getElementsByTagName = o(function(e) {
                 return e.appendChild(O.createComment("")), !e.getElementsByTagName("*").length
             }), k.getElementsByClassName = ye.test(O.getElementsByClassName), k.getById = o(function(e) {
                 return P.appendChild(e).id = R, !O.getElementsByName || !O.getElementsByName(R).length
             }), k.getById ? (T.filter.ID = function(e) {
                 var t = e.replace(be, xe);
                 return function(e) {
                     return e.getAttribute("id") === t
                 }
             }, T.find.ID = function(e, t) {
                 if (void 0 !== t.getElementById && q) {
                     var n = t.getElementById(e);
                     return n ? [n] : []
                 }
             }) : (T.filter.ID = function(e) {
                 var t = e.replace(be, xe);
                 return function(e) {
                     var n = void 0 !== e.getAttributeNode && e.getAttributeNode("id");
                     return n && n.value === t
                 }
             }, T.find.ID = function(e, t) {
                 if (void 0 !== t.getElementById && q) {
                     var n, i, o, r = t.getElementById(e);
                     if (r) {
                         if ((n = r.getAttributeNode("id")) && n.value === e) return [r];
                         for (o = t.getElementsByName(e), i = 0; r = o[i++];)
                             if ((n = r.getAttributeNode("id")) && n.value === e) return [r]
                     }
                     return []
                 }
             }), T.find.TAG = k.getElementsByTagName ? function(e, t) {
                 return void 0 !== t.getElementsByTagName ? t.getElementsByTagName(e) : k.qsa ? t.querySelectorAll(e) : void 0
             } : function(e, t) {
                 var n, i = [],
                     o = 0,
                     r = t.getElementsByTagName(e);
                 if ("*" === e) {
                     for (; n = r[o++];) 1 === n.nodeType && i.push(n);
                     return i
                 }
                 return r
             }, T.find.CLASS = k.getElementsByClassName && function(e, t) {
                 if (void 0 !== t.getElementsByClassName && q) return t.getElementsByClassName(e)
             }, I = [], M = [], (k.qsa = ye.test(O.querySelectorAll)) && (o(function(e) {
                 P.appendChild(e).innerHTML = "<a id='" + R + "'></a><select id='" + R + "-\r\\' msallowcapture=''><option selected=''></option></select>", e.querySelectorAll("[msallowcapture^='']").length && M.push("[*^$]=" + ie + "*(?:''|\"\")"), e.querySelectorAll("[selected]").length || M.push("\\[" + ie + "*(?:value|" + ne + ")"), e.querySelectorAll("[id~=" + R + "-]").length || M.push("~="), e.querySelectorAll(":checked").length || M.push(":checked"), e.querySelectorAll("a#" + R + "+*").length || M.push(".#.+[+~]")
             }), o(function(e) {
                 e.innerHTML = "<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";
                 var t = O.createElement("input");
                 t.setAttribute("type", "hidden"), e.appendChild(t).setAttribute("name", "D"), e.querySelectorAll("[name=d]").length && M.push("name" + ie + "*[*^$|!~]?="), 2 !== e.querySelectorAll(":enabled").length && M.push(":enabled", ":disabled"), P.appendChild(e).disabled = !0, 2 !== e.querySelectorAll(":disabled").length && M.push(":enabled", ":disabled"), e.querySelectorAll("*,:x"), M.push(",.*:")
             })), (k.matchesSelector = ye.test(z = P.matches || P.webkitMatchesSelector || P.mozMatchesSelector || P.oMatchesSelector || P.msMatchesSelector)) && o(function(e) {
                 k.disconnectedMatch = z.call(e, "*"), z.call(e, "[s!='']:x"), I.push("!=", se)
             }), M = M.length && new RegExp(M.join("|")), I = I.length && new RegExp(I.join("|")), t = ye.test(P.compareDocumentPosition), W = t || ye.test(P.contains) ? function(e, t) {
                 var n = 9 === e.nodeType ? e.documentElement : e,
                     i = t && t.parentNode;
                 return e === i || !(!i || 1 !== i.nodeType || !(n.contains ? n.contains(i) : e.compareDocumentPosition && 16 & e.compareDocumentPosition(i)))
             } : function(e, t) {
                 if (t)
                     for (; t = t.parentNode;)
                         if (t === e) return !0;
                 return !1
             }, V = t ? function(e, t) {
                 if (e === t) return N = !0, 0;
                 var n = !e.compareDocumentPosition - !t.compareDocumentPosition;
                 return n || (n = (e.ownerDocument || e) === (t.ownerDocument || t) ? e.compareDocumentPosition(t) : 1, 1 & n || !k.sortDetached && t.compareDocumentPosition(e) === n ? e === O || e.ownerDocument === F && W(F, e) ? -1 : t === O || t.ownerDocument === F && W(F, t) ? 1 : H ? te(H, e) - te(H, t) : 0 : 4 & n ? -1 : 1)
             } : function(e, t) {
                 if (e === t) return N = !0, 0;
                 var n, i = 0,
                     o = e.parentNode,
                     r = t.parentNode,
                     a = [e],
                     l = [t];
                 if (!o || !r) return e === O ? -1 : t === O ? 1 : o ? -1 : r ? 1 : H ? te(H, e) - te(H, t) : 0;
                 if (o === r) return s(e, t);
                 for (n = e; n = n.parentNode;) a.unshift(n);
                 for (n = t; n = n.parentNode;) l.unshift(n);
                 for (; a[i] === l[i];) i++;
                 return i ? s(a[i], l[i]) : a[i] === F ? -1 : l[i] === F ? 1 : 0
             }, O) : O
         }, t.matches = function(e, n) {
             return t(e, null, null, n)
         }, t.matchesSelector = function(e, n) {
             if ((e.ownerDocument || e) !== O && L(e), n = n.replace(ue, "='$1']"), k.matchesSelector && q && !Y[n + " "] && (!I || !I.test(n)) && (!M || !M.test(n))) try {
                 var i = z.call(e, n);
                 if (i || k.disconnectedMatch || e.document && 11 !== e.document.nodeType) return i
             } catch (e) {}
             return t(n, O, null, [e]).length > 0
         }, t.contains = function(e, t) {
             return (e.ownerDocument || e) !== O && L(e), W(e, t)
         }, t.attr = function(e, t) {
             (e.ownerDocument || e) !== O && L(e);
             var n = T.attrHandle[t.toLowerCase()],
                 i = n && G.call(T.attrHandle, t.toLowerCase()) ? n(e, t, !q) : void 0;
             return void 0 !== i ? i : k.attributes || !q ? e.getAttribute(t) : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
         }, t.escape = function(e) {
             return (e + "").replace(ke, Te)
         }, t.error = function(e) {
             throw new Error("Syntax error, unrecognized expression: " + e)
         }, t.uniqueSort = function(e) {
             var t, n = [],
                 i = 0,
                 o = 0;
             if (N = !k.detectDuplicates, H = !k.sortStable && e.slice(0), e.sort(V), N) {
                 for (; t = e[o++];) t === e[o] && (i = n.push(o));
                 for (; i--;) e.splice(n[i], 1)
             }
             return H = null, e
         }, S = t.getText = function(e) {
             var t, n = "",
                 i = 0,
                 o = e.nodeType;
             if (o) {
                 if (1 === o || 9 === o || 11 === o) {
                     if ("string" == typeof e.textContent) return e.textContent;
                     for (e = e.firstChild; e; e = e.nextSibling) n += S(e)
                 } else if (3 === o || 4 === o) return e.nodeValue
             } else
                 for (; t = e[i++];) n += S(t);
             return n
         }, T = t.selectors = {
             cacheLength: 50,
             createPseudo: i,
             match: he,
             attrHandle: {},
             find: {},
             relative: {
                 ">": {
                     dir: "parentNode",
                     first: !0
                 },
                 " ": {
                     dir: "parentNode"
                 },
                 "+": {
                     dir: "previousSibling",
                     first: !0
                 },
                 "~": {
                     dir: "previousSibling"
                 }
             },
             preFilter: {
                 ATTR: function(e) {
                     return e[1] = e[1].replace(be, xe), e[3] = (e[3] || e[4] || e[5] || "").replace(be, xe), "~=" === e[2] && (e[3] = " " + e[3] + " "), e.slice(0, 4)
                 },
                 CHILD: function(e) {
                     return e[1] = e[1].toLowerCase(), "nth" === e[1].slice(0, 3) ? (e[3] || t.error(e[0]), e[4] = +(e[4] ? e[5] + (e[6] || 1) : 2 * ("even" === e[3] || "odd" === e[3])), e[5] = +(e[7] + e[8] || "odd" === e[3])) : e[3] && t.error(e[0]), e
                 },
                 PSEUDO: function(e) {
                     var t, n = !e[6] && e[2];
                     return he.CHILD.test(e[0]) ? null : (e[3] ? e[2] = e[4] || e[5] || "" : n && pe.test(n) && (t = A(n, !0)) && (t = n.indexOf(")", n.length - t) - n.length) && (e[0] = e[0].slice(0, t), e[2] = n.slice(0, t)), e.slice(0, 3))
                 }
             },
             filter: {
                 TAG: function(e) {
                     var t = e.replace(be, xe).toLowerCase();
                     return "*" === e ? function() {
                         return !0
                     } : function(e) {
                         return e.nodeName && e.nodeName.toLowerCase() === t
                     }
                 },
                 CLASS: function(e) {
                     var t = X[e + " "];
                     return t || (t = new RegExp("(^|" + ie + ")" + e + "(" + ie + "|$)")) && X(e, function(e) {
                         return t.test("string" == typeof e.className && e.className || void 0 !== e.getAttribute && e.getAttribute("class") || "")
                     })
                 },
                 ATTR: function(e, n, i) {
                     return function(o) {
                         var r = t.attr(o, e);
                         return null == r ? "!=" === n : !n || (r += "", "=" === n ? r === i : "!=" === n ? r !== i : "^=" === n ? i && 0 === r.indexOf(i) : "*=" === n ? i && r.indexOf(i) > -1 : "$=" === n ? i && r.slice(-i.length) === i : "~=" === n ? (" " + r.replace(ae, " ") + " ").indexOf(i) > -1 : "|=" === n && (r === i || r.slice(0, i.length + 1) === i + "-"))
                     }
                 },
                 CHILD: function(e, t, n, i, o) {
                     var r = "nth" !== e.slice(0, 3),
                         s = "last" !== e.slice(-4),
                         a = "of-type" === t;
                     return 1 === i && 0 === o ? function(e) {
                         return !!e.parentNode
                     } : function(t, n, l) {
                         var c, d, u, p, f, h, v = r !== s ? "nextSibling" : "previousSibling",
                             g = t.parentNode,
                             y = a && t.nodeName.toLowerCase(),
                             m = !l && !a,
                             w = !1;
                         if (g) {
                             if (r) {
                                 for (; v;) {
                                     for (p = t; p = p[v];)
                                         if (a ? p.nodeName.toLowerCase() === y : 1 === p.nodeType) return !1;
                                     h = v = "only" === e && !h && "nextSibling"
                                 }
                                 return !0
                             }
                             if (h = [s ? g.firstChild : g.lastChild], s && m) {
                                 for (p = g, u = p[R] || (p[R] = {}), d = u[p.uniqueID] || (u[p.uniqueID] = {}), c = d[e] || [], f = c[0] === B && c[1], w = f && c[2], p = f && g.childNodes[f]; p = ++f && p && p[v] || (w = f = 0) || h.pop();)
                                     if (1 === p.nodeType && ++w && p === t) {
                                         d[e] = [B, f, w];
                                         break
                                     }
                             } else if (m && (p = t, u = p[R] || (p[R] = {}), d = u[p.uniqueID] || (u[p.uniqueID] = {}), c = d[e] || [], f = c[0] === B && c[1], w = f), !1 === w)
                                 for (;
                                     (p = ++f && p && p[v] || (w = f = 0) || h.pop()) && ((a ? p.nodeName.toLowerCase() !== y : 1 !== p.nodeType) || !++w || (m && (u = p[R] || (p[R] = {}), d = u[p.uniqueID] || (u[p.uniqueID] = {}), d[e] = [B, w]), p !== t)););
                             return (w -= o) === i || w % i == 0 && w / i >= 0
                         }
                     }
                 },
                 PSEUDO: function(e, n) {
                     var o, r = T.pseudos[e] || T.setFilters[e.toLowerCase()] || t.error("unsupported pseudo: " + e);
                     return r[R] ? r(n) : r.length > 1 ? (o = [e, e, "", n], T.setFilters.hasOwnProperty(e.toLowerCase()) ? i(function(e, t) {
                         for (var i, o = r(e, n), s = o.length; s--;) i = te(e, o[s]), e[i] = !(t[i] = o[s])
                     }) : function(e) {
                         return r(e, 0, o)
                     }) : r
                 }
             },
             pseudos: {
                 not: i(function(e) {
                     var t = [],
                         n = [],
                         o = E(e.replace(le, "$1"));
                     return o[R] ? i(function(e, t, n, i) {
                         for (var r, s = o(e, null, i, []), a = e.length; a--;)(r = s[a]) && (e[a] = !(t[a] = r))
                     }) : function(e, i, r) {
                         return t[0] = e, o(t, null, r, n), t[0] = null, !n.pop()
                     }
                 }),
                 has: i(function(e) {
                     return function(n) {
                         return t(e, n).length > 0
                     }
                 }),
                 contains: i(function(e) {
                     return e = e.replace(be, xe),
                         function(t) {
                             return (t.textContent || t.innerText || S(t)).indexOf(e) > -1
                         }
                 }),
                 lang: i(function(e) {
                     return fe.test(e || "") || t.error("unsupported lang: " + e), e = e.replace(be, xe).toLowerCase(),
                         function(t) {
                             var n;
                             do {
                                 if (n = q ? t.lang : t.getAttribute("xml:lang") || t.getAttribute("lang")) return (n = n.toLowerCase()) === e || 0 === n.indexOf(e + "-")
                             } while ((t = t.parentNode) && 1 === t.nodeType);
                             return !1
                         }
                 }),
                 target: function(t) {
                     var n = e.location && e.location.hash;
                     return n && n.slice(1) === t.id
                 },
                 root: function(e) {
                     return e === P
                 },
                 focus: function(e) {
                     return e === O.activeElement && (!O.hasFocus || O.hasFocus()) && !!(e.type || e.href || ~e.tabIndex)
                 },
                 enabled: c(!1),
                 disabled: c(!0),
                 checked: function(e) {
                     var t = e.nodeName.toLowerCase();
                     return "input" === t && !!e.checked || "option" === t && !!e.selected
                 },
                 selected: function(e) {
                     return e.parentNode && e.parentNode.selectedIndex, !0 === e.selected
                 },
                 empty: function(e) {
                     for (e = e.firstChild; e; e = e.nextSibling)
                         if (e.nodeType < 6) return !1;
                     return !0
                 },
                 parent: function(e) {
                     return !T.pseudos.empty(e)
                 },
                 header: function(e) {
                     return ge.test(e.nodeName)
                 },
                 input: function(e) {
                     return ve.test(e.nodeName)
                 },
                 button: function(e) {
                     var t = e.nodeName.toLowerCase();
                     return "input" === t && "button" === e.type || "button" === t
                 },
                 text: function(e) {
                     var t;
                     return "input" === e.nodeName.toLowerCase() && "text" === e.type && (null == (t = e.getAttribute("type")) || "text" === t.toLowerCase())
                 },
                 first: d(function() {
                     return [0]
                 }),
                 last: d(function(e, t) {
                     return [t - 1]
                 }),
                 eq: d(function(e, t, n) {
                     return [n < 0 ? n + t : n]
                 }),
                 even: d(function(e, t) {
                     for (var n = 0; n < t; n += 2) e.push(n);
                     return e
                 }),
                 odd: d(function(e, t) {
                     for (var n = 1; n < t; n += 2) e.push(n);
                     return e
                 }),
                 lt: d(function(e, t, n) {
                     for (var i = n < 0 ? n + t : n; --i >= 0;) e.push(i);
                     return e
                 }),
                 gt: d(function(e, t, n) {
                     for (var i = n < 0 ? n + t : n; ++i < t;) e.push(i);
                     return e
                 })
             }
         }, T.pseudos.nth = T.pseudos.eq;
         for (x in {
                 radio: !0,
                 checkbox: !0,
                 file: !0,
                 password: !0,
                 image: !0
             }) T.pseudos[x] = a(x);
         for (x in {
                 submit: !0,
                 reset: !0
             }) T.pseudos[x] = l(x);
         return p.prototype = T.filters = T.pseudos, T.setFilters = new p, A = t.tokenize = function(e, n) {
             var i, o, r, s, a, l, c, d = _[e + " "];
             if (d) return n ? 0 : d.slice(0);
             for (a = e, l = [], c = T.preFilter; a;) {
                 i && !(o = ce.exec(a)) || (o && (a = a.slice(o[0].length) || a), l.push(r = [])), i = !1, (o = de.exec(a)) && (i = o.shift(), r.push({
                     value: i,
                     type: o[0].replace(le, " ")
                 }), a = a.slice(i.length));
                 for (s in T.filter) !(o = he[s].exec(a)) || c[s] && !(o = c[s](o)) || (i = o.shift(), r.push({
                     value: i,
                     type: s,
                     matches: o
                 }), a = a.slice(i.length));
                 if (!i) break
             }
             return n ? a.length : a ? t.error(e) : _(e, l).slice(0)
         }, E = t.compile = function(e, t) {
             var n, i = [],
                 o = [],
                 r = Y[e + " "];
             if (!r) {
                 for (t || (t = A(e)), n = t.length; n--;) r = w(t[n]), r[R] ? i.push(r) : o.push(r);
                 r = Y(e, b(o, i)), r.selector = e
             }
             return r
         }, D = t.select = function(e, t, n, i) {
             var o, r, s, a, l, c = "function" == typeof e && e,
                 d = !i && A(e = c.selector || e);
             if (n = n || [], 1 === d.length) {
                 if (r = d[0] = d[0].slice(0), r.length > 2 && "ID" === (s = r[0]).type && 9 === t.nodeType && q && T.relative[r[1].type]) {
                     if (!(t = (T.find.ID(s.matches[0].replace(be, xe), t) || [])[0])) return n;
                     c && (t = t.parentNode), e = e.slice(r.shift().value.length)
                 }
                 for (o = he.needsContext.test(e) ? 0 : r.length; o-- && (s = r[o], !T.relative[a = s.type]);)
                     if ((l = T.find[a]) && (i = l(s.matches[0].replace(be, xe), we.test(r[0].type) && u(t.parentNode) || t))) {
                         if (r.splice(o, 1), !(e = i.length && f(r))) return Z.apply(n, i), n;
                         break
                     }
             }
             return (c || E(e, d))(i, t, !q, n, !t || we.test(e) && u(t.parentNode) || t), n
         }, k.sortStable = R.split("").sort(V).join("") === R, k.detectDuplicates = !!N, L(), k.sortDetached = o(function(e) {
             return 1 & e.compareDocumentPosition(O.createElement("fieldset"))
         }), o(function(e) {
             return e.innerHTML = "<a href='#'></a>", "#" === e.firstChild.getAttribute("href")
         }) || r("type|href|height|width", function(e, t, n) {
             if (!n) return e.getAttribute(t, "type" === t.toLowerCase() ? 1 : 2)
         }), k.attributes && o(function(e) {
             return e.innerHTML = "<input/>", e.firstChild.setAttribute("value", ""), "" === e.firstChild.getAttribute("value")
         }) || r("value", function(e, t, n) {
             if (!n && "input" === e.nodeName.toLowerCase()) return e.defaultValue
         }), o(function(e) {
             return null == e.getAttribute("disabled")
         }) || r(ne, function(e, t, n) {
             var i;
             if (!n) return !0 === e[t] ? t.toLowerCase() : (i = e.getAttributeNode(t)) && i.specified ? i.value : null
         }), t
     }(e);
     Te.find = Ce, Te.expr = Ce.selectors, Te.expr[":"] = Te.expr.pseudos, Te.uniqueSort = Te.unique = Ce.uniqueSort, Te.text = Ce.getText, Te.isXMLDoc = Ce.isXML, Te.contains = Ce.contains, Te.escapeSelector = Ce.escape;
     var $e = function(e, t, n) {
             for (var i = [], o = void 0 !== n;
                 (e = e[t]) && 9 !== e.nodeType;)
                 if (1 === e.nodeType) {
                     if (o && Te(e).is(n)) break;
                     i.push(e)
                 }
             return i
         },
         Ae = function(e, t) {
             for (var n = []; e; e = e.nextSibling) 1 === e.nodeType && e !== t && n.push(e);
             return n
         },
         Ee = Te.expr.match.needsContext,
         De = /^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;
     Te.filter = function(e, t, n) {
         var i = t[0];
         return n && (e = ":not(" + e + ")"), 1 === t.length && 1 === i.nodeType ? Te.find.matchesSelector(i, e) ? [i] : [] : Te.find.matches(e, Te.grep(t, function(e) {
             return 1 === e.nodeType
         }))
     }, Te.fn.extend({
         find: function(e) {
             var t, n, i = this.length,
                 o = this;
             if ("string" != typeof e) return this.pushStack(Te(e).filter(function() {
                 for (t = 0; t < i; t++)
                     if (Te.contains(o[t], this)) return !0
             }));
             for (n = this.pushStack([]), t = 0; t < i; t++) Te.find(e, o[t], n);
             return i > 1 ? Te.uniqueSort(n) : n
         },
         filter: function(e) {
             return this.pushStack(s(this, e || [], !1))
         },
         not: function(e) {
             return this.pushStack(s(this, e || [], !0))
         },
         is: function(e) {
             return !!s(this, "string" == typeof e && Ee.test(e) ? Te(e) : e || [], !1).length
         }
     });
     var je, He = /^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;
     (Te.fn.init = function(e, t, n) {
         var i, o;
         if (!e) return this;
         if (n = n || je, "string" == typeof e) {
             if (!(i = "<" === e[0] && ">" === e[e.length - 1] && e.length >= 3 ? [null, e, null] : He.exec(e)) || !i[1] && t) return !t || t.jquery ? (t || n).find(e) : this.constructor(t).find(e);
             if (i[1]) {
                 if (t = t instanceof Te ? t[0] : t, Te.merge(this, Te.parseHTML(i[1], t && t.nodeType ? t.ownerDocument || t : ae, !0)), De.test(i[1]) && Te.isPlainObject(t))
                     for (i in t) we(this[i]) ? this[i](t[i]) : this.attr(i, t[i]);
                 return this
             }
             return o = ae.getElementById(i[2]), o && (this[0] = o, this.length = 1), this
         }
         return e.nodeType ? (this[0] = e, this.length = 1, this) : we(e) ? void 0 !== n.ready ? n.ready(e) : e(Te) : Te.makeArray(e, this)
     }).prototype = Te.fn, je = Te(ae);
     var Ne = /^(?:parents|prev(?:Until|All))/,
         Le = {
             children: !0,
             contents: !0,
             next: !0,
             prev: !0
         };
     Te.fn.extend({
         has: function(e) {
             var t = Te(e, this),
                 n = t.length;
             return this.filter(function() {
                 for (var e = 0; e < n; e++)
                     if (Te.contains(this, t[e])) return !0
             })
         },
         closest: function(e, t) {
             var n, i = 0,
                 o = this.length,
                 r = [],
                 s = "string" != typeof e && Te(e);
             if (!Ee.test(e))
                 for (; i < o; i++)
                     for (n = this[i]; n && n !== t; n = n.parentNode)
                         if (n.nodeType < 11 && (s ? s.index(n) > -1 : 1 === n.nodeType && Te.find.matchesSelector(n, e))) {
                             r.push(n);
                             break
                         }
             return this.pushStack(r.length > 1 ? Te.uniqueSort(r) : r)
         },
         index: function(e) {
             return e ? "string" == typeof e ? pe.call(Te(e), this[0]) : pe.call(this, e.jquery ? e[0] : e) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1
         },
         add: function(e, t) {
             return this.pushStack(Te.uniqueSort(Te.merge(this.get(), Te(e, t))))
         },
         addBack: function(e) {
             return this.add(null == e ? this.prevObject : this.prevObject.filter(e))
         }
     }), Te.each({
         parent: function(e) {
             var t = e.parentNode;
             return t && 11 !== t.nodeType ? t : null
         },
         parents: function(e) {
             return $e(e, "parentNode")
         },
         parentsUntil: function(e, t, n) {
             return $e(e, "parentNode", n)
         },
         next: function(e) {
             return a(e, "nextSibling")
         },
         prev: function(e) {
             return a(e, "previousSibling")
         },
         nextAll: function(e) {
             return $e(e, "nextSibling")
         },
         prevAll: function(e) {
             return $e(e, "previousSibling")
         },
         nextUntil: function(e, t, n) {
             return $e(e, "nextSibling", n)
         },
         prevUntil: function(e, t, n) {
             return $e(e, "previousSibling", n)
         },
         siblings: function(e) {
             return Ae((e.parentNode || {}).firstChild, e)
         },
         children: function(e) {
             return Ae(e.firstChild)
         },
         contents: function(e) {
             return r(e, "iframe") ? e.contentDocument : (r(e, "template") && (e = e.content || e), Te.merge([], e.childNodes))
         }
     }, function(e, t) {
         Te.fn[e] = function(n, i) {
             var o = Te.map(this, t, n);
             return "Until" !== e.slice(-5) && (i = n), i && "string" == typeof i && (o = Te.filter(i, o)), this.length > 1 && (Le[e] || Te.uniqueSort(o), Ne.test(e) && o.reverse()), this.pushStack(o)
         }
     });
     var Oe = /[^\x20\t\r\n\f]+/g;
     Te.Callbacks = function(e) {
         e = "string" == typeof e ? l(e) : Te.extend({}, e);
         var t, n, o, r, s = [],
             a = [],
             c = -1,
             d = function() {
                 for (r = r || e.once, o = t = !0; a.length; c = -1)
                     for (n = a.shift(); ++c < s.length;) !1 === s[c].apply(n[0], n[1]) && e.stopOnFalse && (c = s.length, n = !1);
                 e.memory || (n = !1), t = !1, r && (s = n ? [] : "")
             },
             u = {
                 add: function() {
                     return s && (n && !t && (c = s.length - 1, a.push(n)), function t(n) {
                         Te.each(n, function(n, o) {
                             we(o) ? e.unique && u.has(o) || s.push(o) : o && o.length && "string" !== i(o) && t(o)
                         })
                     }(arguments), n && !t && d()), this
                 },
                 remove: function() {
                     return Te.each(arguments, function(e, t) {
                         for (var n;
                             (n = Te.inArray(t, s, n)) > -1;) s.splice(n, 1), n <= c && c--
                     }), this
                 },
                 has: function(e) {
                     return e ? Te.inArray(e, s) > -1 : s.length > 0
                 },
                 empty: function() {
                     return s && (s = []), this
                 },
                 disable: function() {
                     return r = a = [], s = n = "", this
                 },
                 disabled: function() {
                     return !s
                 },
                 lock: function() {
                     return r = a = [], n || t || (s = n = ""), this
                 },
                 locked: function() {
                     return !!r
                 },
                 fireWith: function(e, n) {
                     return r || (n = n || [], n = [e, n.slice ? n.slice() : n], a.push(n), t || d()), this
                 },
                 fire: function() {
                     return u.fireWith(this, arguments), this
                 },
                 fired: function() {
                     return !!o
                 }
             };
         return u
     }, Te.extend({
         Deferred: function(t) {
             var n = [
                     ["notify", "progress", Te.Callbacks("memory"), Te.Callbacks("memory"), 2],
                     ["resolve", "done", Te.Callbacks("once memory"), Te.Callbacks("once memory"), 0, "resolved"],
                     ["reject", "fail", Te.Callbacks("once memory"), Te.Callbacks("once memory"), 1, "rejected"]
                 ],
                 i = "pending",
                 o = {
                     state: function() {
                         return i
                     },
                     always: function() {
                         return r.done(arguments).fail(arguments), this
                     },
                     catch: function(e) {
                         return o.then(null, e)
                     },
                     pipe: function() {
                         var e = arguments;
                         return Te.Deferred(function(t) {
                             Te.each(n, function(n, i) {
                                 var o = we(e[i[4]]) && e[i[4]];
                                 r[i[1]](function() {
                                     var e = o && o.apply(this, arguments);
                                     e && we(e.promise) ? e.promise().progress(t.notify).done(t.resolve).fail(t.reject) : t[i[0] + "With"](this, o ? [e] : arguments)
                                 })
                             }), e = null
                         }).promise()
                     },
                     then: function(t, i, o) {
                         function r(t, n, i, o) {
                             return function() {
                                 var a = this,
                                     l = arguments,
                                     u = function() {
                                         var e, u;
                                         if (!(t < s)) {
                                             if ((e = i.apply(a, l)) === n.promise()) throw new TypeError("Thenable self-resolution");
                                             u = e && ("object" == typeof e || "function" == typeof e) && e.then, we(u) ? o ? u.call(e, r(s, n, c, o), r(s, n, d, o)) : (s++, u.call(e, r(s, n, c, o), r(s, n, d, o), r(s, n, c, n.notifyWith))) : (i !== c && (a = void 0, l = [e]), (o || n.resolveWith)(a, l))
                                         }
                                     },
                                     p = o ? u : function() {
                                         try {
                                             u()
                                         } catch (e) {
                                             Te.Deferred.exceptionHook && Te.Deferred.exceptionHook(e, p.stackTrace), t + 1 >= s && (i !== d && (a = void 0, l = [e]), n.rejectWith(a, l))
                                         }
                                     };
                                 t ? p() : (Te.Deferred.getStackHook && (p.stackTrace = Te.Deferred.getStackHook()), e.setTimeout(p))
                             }
                         }
                         var s = 0;
                         return Te.Deferred(function(e) {
                             n[0][3].add(r(0, e, we(o) ? o : c, e.notifyWith)), n[1][3].add(r(0, e, we(t) ? t : c)), n[2][3].add(r(0, e, we(i) ? i : d))
                         }).promise()
                     },
                     promise: function(e) {
                         return null != e ? Te.extend(e, o) : o
                     }
                 },
                 r = {};
             return Te.each(n, function(e, t) {
                 var s = t[2],
                     a = t[5];
                 o[t[1]] = s.add, a && s.add(function() {
                     i = a
                 }, n[3 - e][2].disable, n[3 - e][3].disable, n[0][2].lock, n[0][3].lock), s.add(t[3].fire), r[t[0]] = function() {
                     return r[t[0] + "With"](this === r ? void 0 : this, arguments), this
                 }, r[t[0] + "With"] = s.fireWith
             }), o.promise(r), t && t.call(r, r), r
         },
         when: function(e) {
             var t = arguments.length,
                 n = t,
                 i = Array(n),
                 o = ce.call(arguments),
                 r = Te.Deferred(),
                 s = function(e) {
                     return function(n) {
                         i[e] = this, o[e] = arguments.length > 1 ? ce.call(arguments) : n, --t || r.resolveWith(i, o)
                     }
                 };
             if (t <= 1 && (u(e, r.done(s(n)).resolve, r.reject, !t), "pending" === r.state() || we(o[n] && o[n].then))) return r.then();
             for (; n--;) u(o[n], s(n), r.reject);
             return r.promise()
         }
     });
     var Pe = /^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;
     Te.Deferred.exceptionHook = function(t, n) {
         e.console && e.console.warn && t && Pe.test(t.name) && e.console.warn("jQuery.Deferred exception: " + t.message, t.stack, n)
     }, Te.readyException = function(t) {
         e.setTimeout(function() {
             throw t
         })
     };
     var qe = Te.Deferred();
     Te.fn.ready = function(e) {
         return qe.then(e).catch(function(e) {
             Te.readyException(e)
         }), this
     }, Te.extend({
         isReady: !1,
         readyWait: 1,
         ready: function(e) {
             (!0 === e ? --Te.readyWait : Te.isReady) || (Te.isReady = !0, !0 !== e && --Te.readyWait > 0 || qe.resolveWith(ae, [Te]))
         }
     }), Te.ready.then = qe.then, "complete" === ae.readyState || "loading" !== ae.readyState && !ae.documentElement.doScroll ? e.setTimeout(Te.ready) : (ae.addEventListener("DOMContentLoaded", p), e.addEventListener("load", p));
     var Me = function(e, t, n, o, r, s, a) {
             var l = 0,
                 c = e.length,
                 d = null == n;
             if ("object" === i(n)) {
                 r = !0;
                 for (l in n) Me(e, t, l, n[l], !0, s, a)
             } else if (void 0 !== o && (r = !0, we(o) || (a = !0), d && (a ? (t.call(e, o), t = null) : (d = t, t = function(e, t, n) {
                     return d.call(Te(e), n)
                 })), t))
                 for (; l < c; l++) t(e[l], n, a ? o : o.call(e[l], l, t(e[l], n)));
             return r ? e : d ? t.call(e) : c ? t(e[0], n) : s
         },
         Ie = /^-ms-/,
         ze = /-([a-z])/g,
         We = function(e) {
             return 1 === e.nodeType || 9 === e.nodeType || !+e.nodeType
         };
     v.uid = 1, v.prototype = {
         cache: function(e) {
             var t = e[this.expando];
             return t || (t = {}, We(e) && (e.nodeType ? e[this.expando] = t : Object.defineProperty(e, this.expando, {
                 value: t,
                 configurable: !0
             }))), t
         },
         set: function(e, t, n) {
             var i, o = this.cache(e);
             if ("string" == typeof t) o[h(t)] = n;
             else
                 for (i in t) o[h(i)] = t[i];
             return o
         },
         get: function(e, t) {
             return void 0 === t ? this.cache(e) : e[this.expando] && e[this.expando][h(t)]
         },
         access: function(e, t, n) {
             return void 0 === t || t && "string" == typeof t && void 0 === n ? this.get(e, t) : (this.set(e, t, n), void 0 !== n ? n : t)
         },
         remove: function(e, t) {
             var n, i = e[this.expando];
             if (void 0 !== i) {
                 if (void 0 !== t) {
                     Array.isArray(t) ? t = t.map(h) : (t = h(t), t = t in i ? [t] : t.match(Oe) || []), n = t.length;
                     for (; n--;) delete i[t[n]]
                 }(void 0 === t || Te.isEmptyObject(i)) && (e.nodeType ? e[this.expando] = void 0 : delete e[this.expando])
             }
         },
         hasData: function(e) {
             var t = e[this.expando];
             return void 0 !== t && !Te.isEmptyObject(t)
         }
     };
     var Re = new v,
         Fe = new v,
         Be = /^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,
         Ue = /[A-Z]/g;
     Te.extend({
         hasData: function(e) {
             return Fe.hasData(e) || Re.hasData(e)
         },
         data: function(e, t, n) {
             return Fe.access(e, t, n)
         },
         removeData: function(e, t) {
             Fe.remove(e, t)
         },
         _data: function(e, t, n) {
             return Re.access(e, t, n)
         },
         _removeData: function(e, t) {
             Re.remove(e, t)
         }
     }), Te.fn.extend({
         data: function(e, t) {
             var n, i, o, r = this[0],
                 s = r && r.attributes;
             if (void 0 === e) {
                 if (this.length && (o = Fe.get(r), 1 === r.nodeType && !Re.get(r, "hasDataAttrs"))) {
                     for (n = s.length; n--;) s[n] && (i = s[n].name, 0 === i.indexOf("data-") && (i = h(i.slice(5)), y(r, i, o[i])));
                     Re.set(r, "hasDataAttrs", !0)
                 }
                 return o
             }
             return "object" == typeof e ? this.each(function() {
                 Fe.set(this, e)
             }) : Me(this, function(t) {
                 var n;
                 if (r && void 0 === t) {
                     if (void 0 !== (n = Fe.get(r, e))) return n;
                     if (void 0 !== (n = y(r, e))) return n
                 } else this.each(function() {
                     Fe.set(this, e, t)
                 })
             }, null, t, arguments.length > 1, null, !0)
         },
         removeData: function(e) {
             return this.each(function() {
                 Fe.remove(this, e)
             })
         }
     }), Te.extend({
         queue: function(e, t, n) {
             var i;
             if (e) return t = (t || "fx") + "queue", i = Re.get(e, t), n && (!i || Array.isArray(n) ? i = Re.access(e, t, Te.makeArray(n)) : i.push(n)), i || []
         },
         dequeue: function(e, t) {
             t = t || "fx";
             var n = Te.queue(e, t),
                 i = n.length,
                 o = n.shift(),
                 r = Te._queueHooks(e, t),
                 s = function() {
                     Te.dequeue(e, t)
                 };
             "inprogress" === o && (o = n.shift(), i--), o && ("fx" === t && n.unshift("inprogress"), delete r.stop, o.call(e, s, r)), !i && r && r.empty.fire()
         },
         _queueHooks: function(e, t) {
             var n = t + "queueHooks";
             return Re.get(e, n) || Re.access(e, n, {
                 empty: Te.Callbacks("once memory").add(function() {
                     Re.remove(e, [t + "queue", n])
                 })
             })
         }
     }), Te.fn.extend({
         queue: function(e, t) {
             var n = 2;
             return "string" != typeof e && (t = e, e = "fx", n--), arguments.length < n ? Te.queue(this[0], e) : void 0 === t ? this : this.each(function() {
                 var n = Te.queue(this, e, t);
                 Te._queueHooks(this, e), "fx" === e && "inprogress" !== n[0] && Te.dequeue(this, e)
             })
         },
         dequeue: function(e) {
             return this.each(function() {
                 Te.dequeue(this, e)
             })
         },
         clearQueue: function(e) {
             return this.queue(e || "fx", [])
         },
         promise: function(e, t) {
             var n, i = 1,
                 o = Te.Deferred(),
                 r = this,
                 s = this.length,
                 a = function() {
                     --i || o.resolveWith(r, [r])
                 };
             for ("string" != typeof e && (t = e, e = void 0), e = e || "fx"; s--;)(n = Re.get(r[s], e + "queueHooks")) && n.empty && (i++, n.empty.add(a));
             return a(), o.promise(t)
         }
     });
     var Xe = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,
         _e = new RegExp("^(?:([+-])=|)(" + Xe + ")([a-z%]*)$", "i"),
         Ye = ["Top", "Right", "Bottom", "Left"],
         Ve = function(e, t) {
             return e = t || e, "none" === e.style.display || "" === e.style.display && Te.contains(e.ownerDocument, e) && "none" === Te.css(e, "display")
         },
         Ge = function(e, t, n, i) {
             var o, r, s = {};
             for (r in t) s[r] = e.style[r], e.style[r] = t[r];
             o = n.apply(e, i || []);
             for (r in t) e.style[r] = s[r];
             return o
         },
         Qe = {};
     Te.fn.extend({
         show: function() {
             return b(this, !0)
         },
         hide: function() {
             return b(this)
         },
         toggle: function(e) {
             return "boolean" == typeof e ? e ? this.show() : this.hide() : this.each(function() {
                 Ve(this) ? Te(this).show() : Te(this).hide()
             })
         }
     });
     var Je = /^(?:checkbox|radio)$/i,
         Ke = /<([a-z][^\/\0>\x20\t\r\n\f]+)/i,
         Ze = /^$|^module$|\/(?:java|ecma)script/i,
         et = {
             option: [1, "<select multiple='multiple'>", "</select>"],
             thead: [1, "<table>", "</table>"],
             col: [2, "<table><colgroup>", "</colgroup></table>"],
             tr: [2, "<table><tbody>", "</tbody></table>"],
             td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
             _default: [0, "", ""]
         };
     et.optgroup = et.option, et.tbody = et.tfoot = et.colgroup = et.caption = et.thead, et.th = et.td;
     var tt = /<|&#?\w+;/;
     ! function() {
         var e = ae.createDocumentFragment(),
             t = e.appendChild(ae.createElement("div")),
             n = ae.createElement("input");
         n.setAttribute("type", "radio"), n.setAttribute("checked", "checked"), n.setAttribute("name", "t"), t.appendChild(n), me.checkClone = t.cloneNode(!0).cloneNode(!0).lastChild.checked, t.innerHTML = "<textarea>x</textarea>", me.noCloneChecked = !!t.cloneNode(!0).lastChild.defaultValue
     }();
     var nt = ae.documentElement,
         it = /^key/,
         ot = /^(?:mouse|pointer|contextmenu|drag|drop)|click/,
         rt = /^([^.]*)(?:\.(.+)|)/;
     Te.event = {
         global: {},
         add: function(e, t, n, i, o) {
             var r, s, a, l, c, d, u, p, f, h, v, g = Re.get(e);
             if (g)
                 for (n.handler && (r = n, n = r.handler, o = r.selector), o && Te.find.matchesSelector(nt, o), n.guid || (n.guid = Te.guid++), (l = g.events) || (l = g.events = {}), (s = g.handle) || (s = g.handle = function(t) {
                         return void 0 !== Te && Te.event.triggered !== t.type ? Te.event.dispatch.apply(e, arguments) : void 0
                     }), t = (t || "").match(Oe) || [""], c = t.length; c--;) a = rt.exec(t[c]) || [], f = v = a[1], h = (a[2] || "").split(".").sort(), f && (u = Te.event.special[f] || {}, f = (o ? u.delegateType : u.bindType) || f, u = Te.event.special[f] || {}, d = Te.extend({
                     type: f,
                     origType: v,
                     data: i,
                     handler: n,
                     guid: n.guid,
                     selector: o,
                     needsContext: o && Te.expr.match.needsContext.test(o),
                     namespace: h.join(".")
                 }, r), (p = l[f]) || (p = l[f] = [], p.delegateCount = 0, u.setup && !1 !== u.setup.call(e, i, h, s) || e.addEventListener && e.addEventListener(f, s)), u.add && (u.add.call(e, d), d.handler.guid || (d.handler.guid = n.guid)), o ? p.splice(p.delegateCount++, 0, d) : p.push(d), Te.event.global[f] = !0)
         },
         remove: function(e, t, n, i, o) {
             var r, s, a, l, c, d, u, p, f, h, v, g = Re.hasData(e) && Re.get(e);
             if (g && (l = g.events)) {
                 for (t = (t || "").match(Oe) || [""], c = t.length; c--;)
                     if (a = rt.exec(t[c]) || [], f = v = a[1], h = (a[2] || "").split(".").sort(), f) {
                         for (u = Te.event.special[f] || {}, f = (i ? u.delegateType : u.bindType) || f, p = l[f] || [], a = a[2] && new RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)"), s = r = p.length; r--;) d = p[r], !o && v !== d.origType || n && n.guid !== d.guid || a && !a.test(d.namespace) || i && i !== d.selector && ("**" !== i || !d.selector) || (p.splice(r, 1), d.selector && p.delegateCount--, u.remove && u.remove.call(e, d));
                         s && !p.length && (u.teardown && !1 !== u.teardown.call(e, h, g.handle) || Te.removeEvent(e, f, g.handle), delete l[f])
                     } else
                         for (f in l) Te.event.remove(e, f + t[c], n, i, !0);
                 Te.isEmptyObject(l) && Re.remove(e, "handle events")
             }
         },
         dispatch: function(e) {
             var t = Te.event.fix(e),
                 n, i, o, r, s, a, l = new Array(arguments.length),
                 c = (Re.get(this, "events") || {})[t.type] || [],
                 d = Te.event.special[t.type] || {};
             for (l[0] = t, n = 1; n < arguments.length; n++) l[n] = arguments[n];
             if (t.delegateTarget = this, !d.preDispatch || !1 !== d.preDispatch.call(this, t)) {
                 for (a = Te.event.handlers.call(this, t, c), n = 0;
                     (r = a[n++]) && !t.isPropagationStopped();)
                     for (t.currentTarget = r.elem, i = 0;
                         (s = r.handlers[i++]) && !t.isImmediatePropagationStopped();) t.rnamespace && !t.rnamespace.test(s.namespace) || (t.handleObj = s, t.data = s.data, void 0 !== (o = ((Te.event.special[s.origType] || {}).handle || s.handler).apply(r.elem, l)) && !1 === (t.result = o) && (t.preventDefault(), t.stopPropagation()));
                 return d.postDispatch && d.postDispatch.call(this, t), t.result
             }
         },
         handlers: function(e, t) {
             var n, i, o, r, s, a = [],
                 l = t.delegateCount,
                 c = e.target;
             if (l && c.nodeType && !("click" === e.type && e.button >= 1))
                 for (; c !== this; c = c.parentNode || this)
                     if (1 === c.nodeType && ("click" !== e.type || !0 !== c.disabled)) {
                         for (r = [], s = {}, n = 0; n < l; n++) i = t[n], o = i.selector + " ", void 0 === s[o] && (s[o] = i.needsContext ? Te(o, this).index(c) > -1 : Te.find(o, this, null, [c]).length), s[o] && r.push(i);
                         r.length && a.push({
                             elem: c,
                             handlers: r
                         })
                     }
             return c = this, l < t.length && a.push({
                 elem: c,
                 handlers: t.slice(l)
             }), a
         },
         addProp: function(e, t) {
             Object.defineProperty(Te.Event.prototype, e, {
                 enumerable: !0,
                 configurable: !0,
                 get: we(t) ? function() {
                     if (this.originalEvent) return t(this.originalEvent)
                 } : function() {
                     if (this.originalEvent) return this.originalEvent[e]
                 },
                 set: function(t) {
                     Object.defineProperty(this, e, {
                         enumerable: !0,
                         configurable: !0,
                         writable: !0,
                         value: t
                     })
                 }
             })
         },
         fix: function(e) {
             return e[Te.expando] ? e : new Te.Event(e)
         },
         special: {
             load: {
                 noBubble: !0
             },
             focus: {
                 trigger: function() {
                     if (this !== A() && this.focus) return this.focus(), !1
                 },
                 delegateType: "focusin"
             },
             blur: {
                 trigger: function() {
                     if (this === A() && this.blur) return this.blur(), !1
                 },
                 delegateType: "focusout"
             },
             click: {
                 trigger: function() {
                     if ("checkbox" === this.type && this.click && r(this, "input")) return this.click(), !1
                 },
                 _default: function(e) {
                     return r(e.target, "a")
                 }
             },
             beforeunload: {
                 postDispatch: function(e) {
                     void 0 !== e.result && e.originalEvent && (e.originalEvent.returnValue = e.result)
                 }
             }
         }
     }, Te.removeEvent = function(e, t, n) {
         e.removeEventListener && e.removeEventListener(t, n)
     }, Te.Event = function(e, t) {
         if (!(this instanceof Te.Event)) return new Te.Event(e, t);
         e && e.type ? (this.originalEvent = e, this.type = e.type, this.isDefaultPrevented = e.defaultPrevented || void 0 === e.defaultPrevented && !1 === e.returnValue ? S : C, this.target = e.target && 3 === e.target.nodeType ? e.target.parentNode : e.target, this.currentTarget = e.currentTarget, this.relatedTarget = e.relatedTarget) : this.type = e, t && Te.extend(this, t), this.timeStamp = e && e.timeStamp || Date.now(), this[Te.expando] = !0
     }, Te.Event.prototype = {
         constructor: Te.Event,
         isDefaultPrevented: C,
         isPropagationStopped: C,
         isImmediatePropagationStopped: C,
         isSimulated: !1,
         preventDefault: function() {
             var e = this.originalEvent;
             this.isDefaultPrevented = S, e && !this.isSimulated && e.preventDefault()
         },
         stopPropagation: function() {
             var e = this.originalEvent;
             this.isPropagationStopped = S, e && !this.isSimulated && e.stopPropagation()
         },
         stopImmediatePropagation: function() {
             var e = this.originalEvent;
             this.isImmediatePropagationStopped = S, e && !this.isSimulated && e.stopImmediatePropagation(), this.stopPropagation()
         }
     }, Te.each({
         altKey: !0,
         bubbles: !0,
         cancelable: !0,
         changedTouches: !0,
         ctrlKey: !0,
         detail: !0,
         eventPhase: !0,
         metaKey: !0,
         pageX: !0,
         pageY: !0,
         shiftKey: !0,
         view: !0,
         char: !0,
         charCode: !0,
         key: !0,
         keyCode: !0,
         button: !0,
         buttons: !0,
         clientX: !0,
         clientY: !0,
         offsetX: !0,
         offsetY: !0,
         pointerId: !0,
         pointerType: !0,
         screenX: !0,
         screenY: !0,
         targetTouches: !0,
         toElement: !0,
         touches: !0,
         which: function(e) {
             var t = e.button;
             return null == e.which && it.test(e.type) ? null != e.charCode ? e.charCode : e.keyCode : !e.which && void 0 !== t && ot.test(e.type) ? 1 & t ? 1 : 2 & t ? 3 : 4 & t ? 2 : 0 : e.which
         }
     }, Te.event.addProp), Te.each({
         mouseenter: "mouseover",
         mouseleave: "mouseout",
         pointerenter: "pointerover",
         pointerleave: "pointerout"
     }, function(e, t) {
         Te.event.special[e] = {
             delegateType: t,
             bindType: t,
             handle: function(e) {
                 var n, i = this,
                     o = e.relatedTarget,
                     r = e.handleObj;
                 return o && (o === i || Te.contains(i, o)) || (e.type = r.origType, n = r.handler.apply(this, arguments), e.type = t), n
             }
         }
     }), Te.fn.extend({
         on: function(e, t, n, i) {
             return E(this, e, t, n, i)
         },
         one: function(e, t, n, i) {
             return E(this, e, t, n, i, 1)
         },
         off: function(e, t, n) {
             var i, o;
             if (e && e.preventDefault && e.handleObj) return i = e.handleObj, Te(e.delegateTarget).off(i.namespace ? i.origType + "." + i.namespace : i.origType, i.selector, i.handler), this;
             if ("object" == typeof e) {
                 for (o in e) this.off(o, t, e[o]);
                 return this
             }
             return !1 !== t && "function" != typeof t || (n = t, t = void 0), !1 === n && (n = C), this.each(function() {
                 Te.event.remove(this, e, n, t)
             })
         }
     });
     var st = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([a-z][^\/\0>\x20\t\r\n\f]*)[^>]*)\/>/gi,
         at = /<script|<style|<link/i,
         lt = /checked\s*(?:[^=]|=\s*.checked.)/i,
         ct = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;
     Te.extend({
         htmlPrefilter: function(e) {
             return e.replace(st, "<$1></$2>")
         },
         clone: function(e, t, n) {
             var i, o, r, s, a = e.cloneNode(!0),
                 l = Te.contains(e.ownerDocument, e);
             if (!(me.noCloneChecked || 1 !== e.nodeType && 11 !== e.nodeType || Te.isXMLDoc(e)))
                 for (s = x(a), r = x(e), i = 0, o = r.length; i < o; i++) L(r[i], s[i]);
             if (t)
                 if (n)
                     for (r = r || x(e), s = s || x(a), i = 0, o = r.length; i < o; i++) N(r[i], s[i]);
                 else N(e, a);
             return s = x(a, "script"), s.length > 0 && k(s, !l && x(e, "script")), a
         },
         cleanData: function(e) {
             for (var t, n, i, o = Te.event.special, r = 0; void 0 !== (n = e[r]); r++)
                 if (We(n)) {
                     if (t = n[Re.expando]) {
                         if (t.events)
                             for (i in t.events) o[i] ? Te.event.remove(n, i) : Te.removeEvent(n, i, t.handle);
                         n[Re.expando] = void 0
                     }
                     n[Fe.expando] && (n[Fe.expando] = void 0)
                 }
         }
     }), Te.fn.extend({
         detach: function(e) {
             return P(this, e, !0)
         },
         remove: function(e) {
             return P(this, e)
         },
         text: function(e) {
             return Me(this, function(e) {
                 return void 0 === e ? Te.text(this) : this.empty().each(function() {
                     1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || (this.textContent = e)
                 })
             }, null, e, arguments.length)
         },
         append: function() {
             return O(this, arguments, function(e) {
                 if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                     D(this, e).appendChild(e)
                 }
             })
         },
         prepend: function() {
             return O(this, arguments, function(e) {
                 if (1 === this.nodeType || 11 === this.nodeType || 9 === this.nodeType) {
                     var t = D(this, e);
                     t.insertBefore(e, t.firstChild)
                 }
             })
         },
         before: function() {
             return O(this, arguments, function(e) {
                 this.parentNode && this.parentNode.insertBefore(e, this)
             })
         },
         after: function() {
             return O(this, arguments, function(e) {
                 this.parentNode && this.parentNode.insertBefore(e, this.nextSibling)
             })
         },
         empty: function() {
             for (var e, t = 0; null != (e = this[t]); t++) 1 === e.nodeType && (Te.cleanData(x(e, !1)), e.textContent = "");
             return this
         },
         clone: function(e, t) {
             return e = null != e && e, t = null == t ? e : t, this.map(function() {
                 return Te.clone(this, e, t)
             })
         },
         html: function(e) {
             return Me(this, function(e) {
                 var t = this[0] || {},
                     n = 0,
                     i = this.length;
                 if (void 0 === e && 1 === t.nodeType) return t.innerHTML;
                 if ("string" == typeof e && !at.test(e) && !et[(Ke.exec(e) || ["", ""])[1].toLowerCase()]) {
                     e = Te.htmlPrefilter(e);
                     try {
                         for (; n < i; n++) t = this[n] || {}, 1 === t.nodeType && (Te.cleanData(x(t, !1)), t.innerHTML = e);
                         t = 0
                     } catch (e) {}
                 }
                 t && this.empty().append(e)
             }, null, e, arguments.length)
         },
         replaceWith: function() {
             var e = [];
             return O(this, arguments, function(t) {
                 var n = this.parentNode;
                 Te.inArray(this, e) < 0 && (Te.cleanData(x(this)), n && n.replaceChild(t, this))
             }, e)
         }
     }), Te.each({
         appendTo: "append",
         prependTo: "prepend",
         insertBefore: "before",
         insertAfter: "after",
         replaceAll: "replaceWith"
     }, function(e, t) {
         Te.fn[e] = function(e) {
             for (var n, i = [], o = Te(e), r = o.length - 1, s = 0; s <= r; s++) n = s === r ? this : this.clone(!0), Te(o[s])[t](n), ue.apply(i, n.get());
             return this.pushStack(i)
         }
     });
     var dt = new RegExp("^(" + Xe + ")(?!px)[a-z%]+$", "i"),
         ut = function(t) {
             var n = t.ownerDocument.defaultView;
             return n && n.opener || (n = e), n.getComputedStyle(t)
         },
         pt = new RegExp(Ye.join("|"), "i");
     ! function() {
         function t() {
             if (c) {
                 l.style.cssText = "position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0", c.style.cssText = "position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%", nt.appendChild(l).appendChild(c);
                 var t = e.getComputedStyle(c);
                 i = "1%" !== t.top, a = 12 === n(t.marginLeft), c.style.right = "60%", s = 36 === n(t.right), o = 36 === n(t.width), c.style.position = "absolute", r = 36 === c.offsetWidth || "absolute", nt.removeChild(l), c = null
             }
         }

         function n(e) {
             return Math.round(parseFloat(e))
         }
         var i, o, r, s, a, l = ae.createElement("div"),
             c = ae.createElement("div");
         c.style && (c.style.backgroundClip = "content-box", c.cloneNode(!0).style.backgroundClip = "", me.clearCloneStyle = "content-box" === c.style.backgroundClip, Te.extend(me, {
             boxSizingReliable: function() {
                 return t(), o
             },
             pixelBoxStyles: function() {
                 return t(), s
             },
             pixelPosition: function() {
                 return t(), i
             },
             reliableMarginLeft: function() {
                 return t(), a
             },
             scrollboxSize: function() {
                 return t(), r
             }
         }))
     }();
     var ft = /^(none|table(?!-c[ea]).+)/,
         ht = /^--/,
         vt = {
             position: "absolute",
             visibility: "hidden",
             display: "block"
         },
         gt = {
             letterSpacing: "0",
             fontWeight: "400"
         },
         yt = ["Webkit", "Moz", "ms"],
         mt = ae.createElement("div").style;
     Te.extend({
         cssHooks: {
             opacity: {
                 get: function(e, t) {
                     if (t) {
                         var n = q(e, "opacity");
                         return "" === n ? "1" : n
                     }
                 }
             }
         },
         cssNumber: {
             animationIterationCount: !0,
             columnCount: !0,
             fillOpacity: !0,
             flexGrow: !0,
             flexShrink: !0,
             fontWeight: !0,
             lineHeight: !0,
             opacity: !0,
             order: !0,
             orphans: !0,
             widows: !0,
             zIndex: !0,
             zoom: !0
         },
         cssProps: {},
         style: function(e, t, n, i) {
             if (e && 3 !== e.nodeType && 8 !== e.nodeType && e.style) {
                 var o, r, s, a = h(t),
                     l = ht.test(t),
                     c = e.style;
                 if (l || (t = z(a)), s = Te.cssHooks[t] || Te.cssHooks[a], void 0 === n) return s && "get" in s && void 0 !== (o = s.get(e, !1, i)) ? o : c[t];
                 r = typeof n, "string" === r && (o = _e.exec(n)) && o[1] && (n = m(e, t, o), r = "number"), null != n && n === n && ("number" === r && (n += o && o[3] || (Te.cssNumber[a] ? "" : "px")), me.clearCloneStyle || "" !== n || 0 !== t.indexOf("background") || (c[t] = "inherit"), s && "set" in s && void 0 === (n = s.set(e, n, i)) || (l ? c.setProperty(t, n) : c[t] = n))
             }
         },
         css: function(e, t, n, i) {
             var o, r, s, a = h(t);
             return ht.test(t) || (t = z(a)), s = Te.cssHooks[t] || Te.cssHooks[a], s && "get" in s && (o = s.get(e, !0, n)), void 0 === o && (o = q(e, t, i)), "normal" === o && t in gt && (o = gt[t]), "" === n || n ? (r = parseFloat(o), !0 === n || isFinite(r) ? r || 0 : o) : o
         }
     }), Te.each(["height", "width"], function(e, t) {
         Te.cssHooks[t] = {
             get: function(e, n, i) {
                 if (n) return !ft.test(Te.css(e, "display")) || e.getClientRects().length && e.getBoundingClientRect().width ? F(e, t, i) : Ge(e, vt, function() {
                     return F(e, t, i)
                 })
             },
             set: function(e, n, i) {
                 var o, r = ut(e),
                     s = "border-box" === Te.css(e, "boxSizing", !1, r),
                     a = i && R(e, t, i, s, r);
                 return s && me.scrollboxSize() === r.position && (a -= Math.ceil(e["offset" + t[0].toUpperCase() + t.slice(1)] - parseFloat(r[t]) - R(e, t, "border", !1, r) - .5)), a && (o = _e.exec(n)) && "px" !== (o[3] || "px") && (e.style[t] = n, n = Te.css(e, t)), W(e, n, a)
             }
         }
     }), Te.cssHooks.marginLeft = M(me.reliableMarginLeft, function(e, t) {
         if (t) return (parseFloat(q(e, "marginLeft")) || e.getBoundingClientRect().left - Ge(e, {
             marginLeft: 0
         }, function() {
             return e.getBoundingClientRect().left
         })) + "px"
     }), Te.each({
         margin: "",
         padding: "",
         border: "Width"
     }, function(e, t) {
         Te.cssHooks[e + t] = {
             expand: function(n) {
                 for (var i = 0, o = {}, r = "string" == typeof n ? n.split(" ") : [n]; i < 4; i++) o[e + Ye[i] + t] = r[i] || r[i - 2] || r[0];
                 return o
             }
         }, "margin" !== e && (Te.cssHooks[e + t].set = W)
     }), Te.fn.extend({
         css: function(e, t) {
             return Me(this, function(e, t, n) {
                 var i, o, r = {},
                     s = 0;
                 if (Array.isArray(t)) {
                     for (i = ut(e), o = t.length; s < o; s++) r[t[s]] = Te.css(e, t[s], !1, i);
                     return r
                 }
                 return void 0 !== n ? Te.style(e, t, n) : Te.css(e, t)
             }, e, t, arguments.length > 1)
         }
     }), Te.Tween = B, B.prototype = {
         constructor: B,
         init: function(e, t, n, i, o, r) {
             this.elem = e, this.prop = n, this.easing = o || Te.easing._default, this.options = t, this.start = this.now = this.cur(), this.end = i, this.unit = r || (Te.cssNumber[n] ? "" : "px")
         },
         cur: function() {
             var e = B.propHooks[this.prop];
             return e && e.get ? e.get(this) : B.propHooks._default.get(this)
         },
         run: function(e) {
             var t, n = B.propHooks[this.prop];
             return this.options.duration ? this.pos = t = Te.easing[this.easing](e, this.options.duration * e, 0, 1, this.options.duration) : this.pos = t = e, this.now = (this.end - this.start) * t + this.start, this.options.step && this.options.step.call(this.elem, this.now, this), n && n.set ? n.set(this) : B.propHooks._default.set(this), this
         }
     }, B.prototype.init.prototype = B.prototype, B.propHooks = {
         _default: {
             get: function(e) {
                 var t;
                 return 1 !== e.elem.nodeType || null != e.elem[e.prop] && null == e.elem.style[e.prop] ? e.elem[e.prop] : (t = Te.css(e.elem, e.prop, ""), t && "auto" !== t ? t : 0)
             },
             set: function(e) {
                 Te.fx.step[e.prop] ? Te.fx.step[e.prop](e) : 1 !== e.elem.nodeType || null == e.elem.style[Te.cssProps[e.prop]] && !Te.cssHooks[e.prop] ? e.elem[e.prop] = e.now : Te.style(e.elem, e.prop, e.now + e.unit)
             }
         }
     }, B.propHooks.scrollTop = B.propHooks.scrollLeft = {
         set: function(e) {
             e.elem.nodeType && e.elem.parentNode && (e.elem[e.prop] = e.now)
         }
     }, Te.easing = {
         linear: function(e) {
             return e
         },
         swing: function(e) {
             return .5 - Math.cos(e * Math.PI) / 2
         },
         _default: "swing"
     }, Te.fx = B.prototype.init, Te.fx.step = {};
     var wt, bt, xt = /^(?:toggle|show|hide)$/,
         kt = /queueHooks$/;
     Te.Animation = Te.extend(Q, {
             tweeners: {
                 "*": [function(e, t) {
                     var n = this.createTween(e, t);
                     return m(n.elem, e, _e.exec(t), n), n
                 }]
             },
             tweener: function(e, t) {
                 we(e) ? (t = e, e = ["*"]) : e = e.match(Oe);
                 for (var n, i = 0, o = e.length; i < o; i++) n = e[i], Q.tweeners[n] = Q.tweeners[n] || [], Q.tweeners[n].unshift(t)
             },
             prefilters: [V],
             prefilter: function(e, t) {
                 t ? Q.prefilters.unshift(e) : Q.prefilters.push(e)
             }
         }), Te.speed = function(e, t, n) {
             var i = e && "object" == typeof e ? Te.extend({}, e) : {
                 complete: n || !n && t || we(e) && e,
                 duration: e,
                 easing: n && t || t && !we(t) && t
             };
             return Te.fx.off ? i.duration = 0 : "number" != typeof i.duration && (i.duration in Te.fx.speeds ? i.duration = Te.fx.speeds[i.duration] : i.duration = Te.fx.speeds._default), null != i.queue && !0 !== i.queue || (i.queue = "fx"), i.old = i.complete, i.complete = function() {
                 we(i.old) && i.old.call(this), i.queue && Te.dequeue(this, i.queue)
             }, i
         }, Te.fn.extend({
             fadeTo: function(e, t, n, i) {
                 return this.filter(Ve).css("opacity", 0).show().end().animate({
                     opacity: t
                 }, e, n, i)
             },
             animate: function(e, t, n, i) {
                 var o = Te.isEmptyObject(e),
                     r = Te.speed(t, n, i),
                     s = function() {
                         var t = Q(this, Te.extend({}, e), r);
                         (o || Re.get(this, "finish")) && t.stop(!0)
                     };
                 return s.finish = s, o || !1 === r.queue ? this.each(s) : this.queue(r.queue, s)
             },
             stop: function(e, t, n) {
                 var i = function(e) {
                     var t = e.stop;
                     delete e.stop, t(n)
                 };
                 return "string" != typeof e && (n = t, t = e, e = void 0), t && !1 !== e && this.queue(e || "fx", []), this.each(function() {
                     var t = !0,
                         o = null != e && e + "queueHooks",
                         r = Te.timers,
                         s = Re.get(this);
                     if (o) s[o] && s[o].stop && i(s[o]);
                     else
                         for (o in s) s[o] && s[o].stop && kt.test(o) && i(s[o]);
                     for (o = r.length; o--;) r[o].elem !== this || null != e && r[o].queue !== e || (r[o].anim.stop(n), t = !1, r.splice(o, 1));
                     !t && n || Te.dequeue(this, e)
                 })
             },
             finish: function(e) {
                 return !1 !== e && (e = e || "fx"), this.each(function() {
                     var t, n = Re.get(this),
                         i = n[e + "queue"],
                         o = n[e + "queueHooks"],
                         r = Te.timers,
                         s = i ? i.length : 0;
                     for (n.finish = !0, Te.queue(this, e, []), o && o.stop && o.stop.call(this, !0), t = r.length; t--;) r[t].elem === this && r[t].queue === e && (r[t].anim.stop(!0), r.splice(t, 1));
                     for (t = 0; t < s; t++) i[t] && i[t].finish && i[t].finish.call(this);
                     delete n.finish
                 })
             }
         }), Te.each(["toggle", "show", "hide"], function(e, t) {
             var n = Te.fn[t];
             Te.fn[t] = function(e, i, o) {
                 return null == e || "boolean" == typeof e ? n.apply(this, arguments) : this.animate(_(t, !0), e, i, o)
             }
         }), Te.each({
             slideDown: _("show"),
             slideUp: _("hide"),
             slideToggle: _("toggle"),
             fadeIn: {
                 opacity: "show"
             },
             fadeOut: {
                 opacity: "hide"
             },
             fadeToggle: {
                 opacity: "toggle"
             }
         }, function(e, t) {
             Te.fn[e] = function(e, n, i) {
                 return this.animate(t, e, n, i)
             }
         }), Te.timers = [], Te.fx.tick = function() {
             var e, t = 0,
                 n = Te.timers;
             for (wt = Date.now(); t < n.length; t++)(e = n[t])() || n[t] !== e || n.splice(t--, 1);
             n.length || Te.fx.stop(), wt = void 0
         }, Te.fx.timer = function(e) {
             Te.timers.push(e), Te.fx.start()
         }, Te.fx.interval = 13, Te.fx.start = function() {
             bt || (bt = !0, U())
         }, Te.fx.stop = function() {
             bt = null
         }, Te.fx.speeds = {
             slow: 600,
             fast: 200,
             _default: 400
         }, Te.fn.delay = function(t, n) {
             return t = Te.fx ? Te.fx.speeds[t] || t : t, n = n || "fx", this.queue(n, function(n, i) {
                 var o = e.setTimeout(n, t);
                 i.stop = function() {
                     e.clearTimeout(o)
                 }
             })
         },
         function() {
             var e = ae.createElement("input"),
                 t = ae.createElement("select"),
                 n = t.appendChild(ae.createElement("option"));
             e.type = "checkbox", me.checkOn = "" !== e.value, me.optSelected = n.selected, e = ae.createElement("input"), e.value = "t", e.type = "radio", me.radioValue = "t" === e.value
         }();
     var Tt, St = Te.expr.attrHandle;
     Te.fn.extend({
         attr: function(e, t) {
             return Me(this, Te.attr, e, t, arguments.length > 1)
         },
         removeAttr: function(e) {
             return this.each(function() {
                 Te.removeAttr(this, e)
             })
         }
     }), Te.extend({
         attr: function(e, t, n) {
             var i, o, r = e.nodeType;
             if (3 !== r && 8 !== r && 2 !== r) return void 0 === e.getAttribute ? Te.prop(e, t, n) : (1 === r && Te.isXMLDoc(e) || (o = Te.attrHooks[t.toLowerCase()] || (Te.expr.match.bool.test(t) ? Tt : void 0)), void 0 !== n ? null === n ? void Te.removeAttr(e, t) : o && "set" in o && void 0 !== (i = o.set(e, n, t)) ? i : (e.setAttribute(t, n + ""), n) : o && "get" in o && null !== (i = o.get(e, t)) ? i : (i = Te.find.attr(e, t), null == i ? void 0 : i))
         },
         attrHooks: {
             type: {
                 set: function(e, t) {
                     if (!me.radioValue && "radio" === t && r(e, "input")) {
                         var n = e.value;
                         return e.setAttribute("type", t), n && (e.value = n), t
                     }
                 }
             }
         },
         removeAttr: function(e, t) {
             var n, i = 0,
                 o = t && t.match(Oe);
             if (o && 1 === e.nodeType)
                 for (; n = o[i++];) e.removeAttribute(n)
         }
     }), Tt = {
         set: function(e, t, n) {
             return !1 === t ? Te.removeAttr(e, n) : e.setAttribute(n, n), n
         }
     }, Te.each(Te.expr.match.bool.source.match(/\w+/g), function(e, t) {
         var n = St[t] || Te.find.attr;
         St[t] = function(e, t, i) {
             var o, r, s = t.toLowerCase();
             return i || (r = St[s], St[s] = o, o = null != n(e, t, i) ? s : null, St[s] = r), o
         }
     });
     var Ct = /^(?:input|select|textarea|button)$/i,
         $t = /^(?:a|area)$/i;
     Te.fn.extend({
         prop: function(e, t) {
             return Me(this, Te.prop, e, t, arguments.length > 1)
         },
         removeProp: function(e) {
             return this.each(function() {
                 delete this[Te.propFix[e] || e]
             })
         }
     }), Te.extend({
         prop: function(e, t, n) {
             var i, o, r = e.nodeType;
             if (3 !== r && 8 !== r && 2 !== r) return 1 === r && Te.isXMLDoc(e) || (t = Te.propFix[t] || t, o = Te.propHooks[t]), void 0 !== n ? o && "set" in o && void 0 !== (i = o.set(e, n, t)) ? i : e[t] = n : o && "get" in o && null !== (i = o.get(e, t)) ? i : e[t]
         },
         propHooks: {
             tabIndex: {
                 get: function(e) {
                     var t = Te.find.attr(e, "tabindex");
                     return t ? parseInt(t, 10) : Ct.test(e.nodeName) || $t.test(e.nodeName) && e.href ? 0 : -1
                 }
             }
         },
         propFix: {
             for: "htmlFor",
             class: "className"
         }
     }), me.optSelected || (Te.propHooks.selected = {
         get: function(e) {
             var t = e.parentNode;
             return t && t.parentNode && t.parentNode.selectedIndex, null
         },
         set: function(e) {
             var t = e.parentNode;
             t && (t.selectedIndex, t.parentNode && t.parentNode.selectedIndex)
         }
     }), Te.each(["tabIndex", "readOnly", "maxLength", "cellSpacing", "cellPadding", "rowSpan", "colSpan", "useMap", "frameBorder", "contentEditable"], function() {
         Te.propFix[this.toLowerCase()] = this
     }), Te.fn.extend({
         addClass: function(e) {
             var t, n, i, o, r, s, a, l = 0;
             if (we(e)) return this.each(function(t) {
                 Te(this).addClass(e.call(this, t, K(this)))
             });
             if (t = Z(e), t.length)
                 for (; n = this[l++];)
                     if (o = K(n), i = 1 === n.nodeType && " " + J(o) + " ") {
                         for (s = 0; r = t[s++];) i.indexOf(" " + r + " ") < 0 && (i += r + " ");
                         a = J(i), o !== a && n.setAttribute("class", a)
                     }
             return this
         },
         removeClass: function(e) {
             var t, n, i, o, r, s, a, l = 0;
             if (we(e)) return this.each(function(t) {
                 Te(this).removeClass(e.call(this, t, K(this)))
             });
             if (!arguments.length) return this.attr("class", "");
             if (t = Z(e), t.length)
                 for (; n = this[l++];)
                     if (o = K(n), i = 1 === n.nodeType && " " + J(o) + " ") {
                         for (s = 0; r = t[s++];)
                             for (; i.indexOf(" " + r + " ") > -1;) i = i.replace(" " + r + " ", " ");
                         a = J(i), o !== a && n.setAttribute("class", a)
                     }
             return this
         },
         toggleClass: function(e, t) {
             var n = typeof e,
                 i = "string" === n || Array.isArray(e);
             return "boolean" == typeof t && i ? t ? this.addClass(e) : this.removeClass(e) : we(e) ? this.each(function(n) {
                 Te(this).toggleClass(e.call(this, n, K(this), t), t)
             }) : this.each(function() {
                 var t, o, r, s;
                 if (i)
                     for (o = 0, r = Te(this), s = Z(e); t = s[o++];) r.hasClass(t) ? r.removeClass(t) : r.addClass(t);
                 else void 0 !== e && "boolean" !== n || (t = K(this), t && Re.set(this, "__className__", t), this.setAttribute && this.setAttribute("class", t || !1 === e ? "" : Re.get(this, "__className__") || ""))
             })
         },
         hasClass: function(e) {
             var t, n, i = 0;
             for (t = " " + e + " "; n = this[i++];)
                 if (1 === n.nodeType && (" " + J(K(n)) + " ").indexOf(t) > -1) return !0;
             return !1
         }
     });
     var At = /\r/g;
     Te.fn.extend({
         val: function(e) {
             var t, n, i, o = this[0]; {
                 if (arguments.length) return i = we(e), this.each(function(n) {
                     var o;
                     1 === this.nodeType && (o = i ? e.call(this, n, Te(this).val()) : e, null == o ? o = "" : "number" == typeof o ? o += "" : Array.isArray(o) && (o = Te.map(o, function(e) {
                         return null == e ? "" : e + ""
                     })), (t = Te.valHooks[this.type] || Te.valHooks[this.nodeName.toLowerCase()]) && "set" in t && void 0 !== t.set(this, o, "value") || (this.value = o))
                 });
                 if (o) return (t = Te.valHooks[o.type] || Te.valHooks[o.nodeName.toLowerCase()]) && "get" in t && void 0 !== (n = t.get(o, "value")) ? n : (n = o.value, "string" == typeof n ? n.replace(At, "") : null == n ? "" : n)
             }
         }
     }), Te.extend({
         valHooks: {
             option: {
                 get: function(e) {
                     var t = Te.find.attr(e, "value");
                     return null != t ? t : J(Te.text(e))
                 }
             },
             select: {
                 get: function(e) {
                     var t, n, i, o = e.options,
                         s = e.selectedIndex,
                         a = "select-one" === e.type,
                         l = a ? null : [],
                         c = a ? s + 1 : o.length;
                     for (i = s < 0 ? c : a ? s : 0; i < c; i++)
                         if (n = o[i], (n.selected || i === s) && !n.disabled && (!n.parentNode.disabled || !r(n.parentNode, "optgroup"))) {
                             if (t = Te(n).val(), a) return t;
                             l.push(t)
                         }
                     return l
                 },
                 set: function(e, t) {
                     for (var n, i, o = e.options, r = Te.makeArray(t), s = o.length; s--;) i = o[s], (i.selected = Te.inArray(Te.valHooks.option.get(i), r) > -1) && (n = !0);
                     return n || (e.selectedIndex = -1), r
                 }
             }
         }
     }), Te.each(["radio", "checkbox"], function() {
         Te.valHooks[this] = {
             set: function(e, t) {
                 if (Array.isArray(t)) return e.checked = Te.inArray(Te(e).val(), t) > -1
             }
         }, me.checkOn || (Te.valHooks[this].get = function(e) {
             return null === e.getAttribute("value") ? "on" : e.value
         })
     }), me.focusin = "onfocusin" in e;
     var Et = /^(?:focusinfocus|focusoutblur)$/,
         Dt = function(e) {
             e.stopPropagation()
         };
     Te.extend(Te.event, {
         trigger: function(t, n, i, o) {
             var r, s, a, l, c, d, u, p, f = [i || ae],
                 h = ve.call(t, "type") ? t.type : t,
                 v = ve.call(t, "namespace") ? t.namespace.split(".") : [];
             if (s = p = a = i = i || ae, 3 !== i.nodeType && 8 !== i.nodeType && !Et.test(h + Te.event.triggered) && (h.indexOf(".") > -1 && (v = h.split("."), h = v.shift(), v.sort()), c = h.indexOf(":") < 0 && "on" + h, t = t[Te.expando] ? t : new Te.Event(h, "object" == typeof t && t), t.isTrigger = o ? 2 : 3, t.namespace = v.join("."), t.rnamespace = t.namespace ? new RegExp("(^|\\.)" + v.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, t.result = void 0, t.target || (t.target = i), n = null == n ? [t] : Te.makeArray(n, [t]), u = Te.event.special[h] || {}, o || !u.trigger || !1 !== u.trigger.apply(i, n))) {
                 if (!o && !u.noBubble && !be(i)) {
                     for (l = u.delegateType || h, Et.test(l + h) || (s = s.parentNode); s; s = s.parentNode) f.push(s), a = s;
                     a === (i.ownerDocument || ae) && f.push(a.defaultView || a.parentWindow || e)
                 }
                 for (r = 0;
                     (s = f[r++]) && !t.isPropagationStopped();) p = s, t.type = r > 1 ? l : u.bindType || h, d = (Re.get(s, "events") || {})[t.type] && Re.get(s, "handle"), d && d.apply(s, n), (d = c && s[c]) && d.apply && We(s) && (t.result = d.apply(s, n), !1 === t.result && t.preventDefault());
                 return t.type = h, o || t.isDefaultPrevented() || u._default && !1 !== u._default.apply(f.pop(), n) || !We(i) || c && we(i[h]) && !be(i) && (a = i[c], a && (i[c] = null), Te.event.triggered = h, t.isPropagationStopped() && p.addEventListener(h, Dt), i[h](), t.isPropagationStopped() && p.removeEventListener(h, Dt), Te.event.triggered = void 0, a && (i[c] = a)), t.result
             }
         },
         simulate: function(e, t, n) {
             var i = Te.extend(new Te.Event, n, {
                 type: e,
                 isSimulated: !0
             });
             Te.event.trigger(i, null, t)
         }
     }), Te.fn.extend({
         trigger: function(e, t) {
             return this.each(function() {
                 Te.event.trigger(e, t, this)
             })
         },
         triggerHandler: function(e, t) {
             var n = this[0];
             if (n) return Te.event.trigger(e, t, n, !0)
         }
     }), me.focusin || Te.each({
         focus: "focusin",
         blur: "focusout"
     }, function(e, t) {
         var n = function(e) {
             Te.event.simulate(t, e.target, Te.event.fix(e))
         };
         Te.event.special[t] = {
             setup: function() {
                 var i = this.ownerDocument || this,
                     o = Re.access(i, t);
                 o || i.addEventListener(e, n, !0), Re.access(i, t, (o || 0) + 1)
             },
             teardown: function() {
                 var i = this.ownerDocument || this,
                     o = Re.access(i, t) - 1;
                 o ? Re.access(i, t, o) : (i.removeEventListener(e, n, !0), Re.remove(i, t))
             }
         }
     });
     var jt = e.location,
         Ht = Date.now(),
         Nt = /\?/;
     Te.parseXML = function(t) {
         var n;
         if (!t || "string" != typeof t) return null;
         try {
             n = (new e.DOMParser).parseFromString(t, "text/xml")
         } catch (e) {
             n = void 0
         }
         return n && !n.getElementsByTagName("parsererror").length || Te.error("Invalid XML: " + t), n
     };
     var Lt = /\[\]$/,
         Ot = /\r?\n/g,
         Pt = /^(?:submit|button|image|reset|file)$/i,
         qt = /^(?:input|select|textarea|keygen)/i;
     Te.param = function(e, t) {
         var n, i = [],
             o = function(e, t) {
                 var n = we(t) ? t() : t;
                 i[i.length] = encodeURIComponent(e) + "=" + encodeURIComponent(null == n ? "" : n)
             };
         if (Array.isArray(e) || e.jquery && !Te.isPlainObject(e)) Te.each(e, function() {
             o(this.name, this.value)
         });
         else
             for (n in e) ee(n, e[n], t, o);
         return i.join("&")
     }, Te.fn.extend({
         serialize: function() {
             return Te.param(this.serializeArray())
         },
         serializeArray: function() {
             return this.map(function() {
                 var e = Te.prop(this, "elements");
                 return e ? Te.makeArray(e) : this
             }).filter(function() {
                 var e = this.type;
                 return this.name && !Te(this).is(":disabled") && qt.test(this.nodeName) && !Pt.test(e) && (this.checked || !Je.test(e))
             }).map(function(e, t) {
                 var n = Te(this).val();
                 return null == n ? null : Array.isArray(n) ? Te.map(n, function(e) {
                     return {
                         name: t.name,
                         value: e.replace(Ot, "\r\n")
                     }
                 }) : {
                     name: t.name,
                     value: n.replace(Ot, "\r\n")
                 }
             }).get()
         }
     });
     var Mt = /%20/g,
         It = /#.*$/,
         zt = /([?&])_=[^&]*/,
         Wt = /^(.*?):[ \t]*([^\r\n]*)$/gm,
         Rt = /^(?:about|app|app-storage|.+-extension|file|res|widget):$/,
         Ft = /^(?:GET|HEAD)$/,
         Bt = /^\/\//,
         Ut = {},
         Xt = {},
         _t = "*/".concat("*"),
         Yt = ae.createElement("a");
     Yt.href = jt.href, Te.extend({
         active: 0,
         lastModified: {},
         etag: {},
         ajaxSettings: {
             url: jt.href,
             type: "GET",
             isLocal: Rt.test(jt.protocol),
             global: !0,
             processData: !0,
             async: !0,
             contentType: "application/x-www-form-urlencoded; charset=UTF-8",
             accepts: {
                 "*": _t,
                 text: "text/plain",
                 html: "text/html",
                 xml: "application/xml, text/xml",
                 json: "application/json, text/javascript"
             },
             contents: {
                 xml: /\bxml\b/,
                 html: /\bhtml/,
                 json: /\bjson\b/
             },
             responseFields: {
                 xml: "responseXML",
                 text: "responseText",
                 json: "responseJSON"
             },
             converters: {
                 "* text": String,
                 "text html": !0,
                 "text json": JSON.parse,
                 "text xml": Te.parseXML
             },
             flatOptions: {
                 url: !0,
                 context: !0
             }
         },
         ajaxSetup: function(e, t) {
             return t ? ie(ie(e, Te.ajaxSettings), t) : ie(Te.ajaxSettings, e)
         },
         ajaxPrefilter: te(Ut),
         ajaxTransport: te(Xt),
         ajax: function(t, n) {
             function i(t, n, i, a) {
                 var c, p, f, b, x, k = n;
                 d || (d = !0, l && e.clearTimeout(l), o = void 0, s = a || "", T.readyState = t > 0 ? 4 : 0, c = t >= 200 && t < 300 || 304 === t, i && (b = oe(h, T, i)), b = re(h, b, T, c), c ? (h.ifModified && (x = T.getResponseHeader("Last-Modified"), x && (Te.lastModified[r] = x), (x = T.getResponseHeader("etag")) && (Te.etag[r] = x)), 204 === t || "HEAD" === h.type ? k = "nocontent" : 304 === t ? k = "notmodified" : (k = b.state, p = b.data, f = b.error, c = !f)) : (f = k, !t && k || (k = "error", t < 0 && (t = 0))), T.status = t, T.statusText = (n || k) + "", c ? y.resolveWith(v, [p, k, T]) : y.rejectWith(v, [T, k, f]), T.statusCode(w), w = void 0, u && g.trigger(c ? "ajaxSuccess" : "ajaxError", [T, h, c ? p : f]), m.fireWith(v, [T, k]), u && (g.trigger("ajaxComplete", [T, h]), --Te.active || Te.event.trigger("ajaxStop")))
             }
             "object" == typeof t && (n = t, t = void 0), n = n || {};
             var o, r, s, a, l, c, d, u, p, f, h = Te.ajaxSetup({}, n),
                 v = h.context || h,
                 g = h.context && (v.nodeType || v.jquery) ? Te(v) : Te.event,
                 y = Te.Deferred(),
                 m = Te.Callbacks("once memory"),
                 w = h.statusCode || {},
                 b = {},
                 x = {},
                 k = "canceled",
                 T = {
                     readyState: 0,
                     getResponseHeader: function(e) {
                         var t;
                         if (d) {
                             if (!a)
                                 for (a = {}; t = Wt.exec(s);) a[t[1].toLowerCase()] = t[2];
                             t = a[e.toLowerCase()]
                         }
                         return null == t ? null : t
                     },
                     getAllResponseHeaders: function() {
                         return d ? s : null
                     },
                     setRequestHeader: function(e, t) {
                         return null == d && (e = x[e.toLowerCase()] = x[e.toLowerCase()] || e, b[e] = t), this
                     },
                     overrideMimeType: function(e) {
                         return null == d && (h.mimeType = e), this
                     },
                     statusCode: function(e) {
                         var t;
                         if (e)
                             if (d) T.always(e[T.status]);
                             else
                                 for (t in e) w[t] = [w[t], e[t]];
                         return this
                     },
                     abort: function(e) {
                         var t = e || k;
                         return o && o.abort(t), i(0, t), this
                     }
                 };
             if (y.promise(T), h.url = ((t || h.url || jt.href) + "").replace(Bt, jt.protocol + "//"), h.type = n.method || n.type || h.method || h.type, h.dataTypes = (h.dataType || "*").toLowerCase().match(Oe) || [""], null == h.crossDomain) {
                 c = ae.createElement("a");
                 try {
                     c.href = h.url, c.href = c.href, h.crossDomain = Yt.protocol + "//" + Yt.host != c.protocol + "//" + c.host
                 } catch (e) {
                     h.crossDomain = !0
                 }
             }
             if (h.data && h.processData && "string" != typeof h.data && (h.data = Te.param(h.data, h.traditional)), ne(Ut, h, n, T), d) return T;
             u = Te.event && h.global, u && 0 == Te.active++ && Te.event.trigger("ajaxStart"), h.type = h.type.toUpperCase(), h.hasContent = !Ft.test(h.type), r = h.url.replace(It, ""), h.hasContent ? h.data && h.processData && 0 === (h.contentType || "").indexOf("application/x-www-form-urlencoded") && (h.data = h.data.replace(Mt, "+")) : (f = h.url.slice(r.length), h.data && (h.processData || "string" == typeof h.data) && (r += (Nt.test(r) ? "&" : "?") + h.data, delete h.data), !1 === h.cache && (r = r.replace(zt, "$1"), f = (Nt.test(r) ? "&" : "?") + "_=" + Ht++ + f), h.url = r + f), h.ifModified && (Te.lastModified[r] && T.setRequestHeader("If-Modified-Since", Te.lastModified[r]), Te.etag[r] && T.setRequestHeader("If-None-Match", Te.etag[r])), (h.data && h.hasContent && !1 !== h.contentType || n.contentType) && T.setRequestHeader("Content-Type", h.contentType), T.setRequestHeader("Accept", h.dataTypes[0] && h.accepts[h.dataTypes[0]] ? h.accepts[h.dataTypes[0]] + ("*" !== h.dataTypes[0] ? ", " + _t + "; q=0.01" : "") : h.accepts["*"]);
             for (p in h.headers) T.setRequestHeader(p, h.headers[p]);
             if (h.beforeSend && (!1 === h.beforeSend.call(v, T, h) || d)) return T.abort();
             if (k = "abort", m.add(h.complete), T.done(h.success), T.fail(h.error), o = ne(Xt, h, n, T)) {
                 if (T.readyState = 1, u && g.trigger("ajaxSend", [T, h]), d) return T;
                 h.async && h.timeout > 0 && (l = e.setTimeout(function() {
                     T.abort("timeout")
                 }, h.timeout));
                 try {
                     d = !1, o.send(b, i)
                 } catch (e) {
                     if (d) throw e;
                     i(-1, e)
                 }
             } else i(-1, "No Transport");
             return T
         },
         getJSON: function(e, t, n) {
             return Te.get(e, t, n, "json")
         },
         getScript: function(e, t) {
             return Te.get(e, void 0, t, "script")
         }
     }), Te.each(["get", "post"], function(e, t) {
         Te[t] = function(e, n, i, o) {
             return we(n) && (o = o || i, i = n, n = void 0), Te.ajax(Te.extend({
                 url: e,
                 type: t,
                 dataType: o,
                 data: n,
                 success: i
             }, Te.isPlainObject(e) && e))
         }
     }), Te._evalUrl = function(e) {
         return Te.ajax({
             url: e,
             type: "GET",
             dataType: "script",
             cache: !0,
             async: !1,
             global: !1,
             throws: !0
         })
     }, Te.fn.extend({
         wrapAll: function(e) {
             var t;
             return this[0] && (we(e) && (e = e.call(this[0])), t = Te(e, this[0].ownerDocument).eq(0).clone(!0), this[0].parentNode && t.insertBefore(this[0]), t.map(function() {
                 for (var e = this; e.firstElementChild;) e = e.firstElementChild;
                 return e
             }).append(this)), this
         },
         wrapInner: function(e) {
             return we(e) ? this.each(function(t) {
                 Te(this).wrapInner(e.call(this, t))
             }) : this.each(function() {
                 var t = Te(this),
                     n = t.contents();
                 n.length ? n.wrapAll(e) : t.append(e)
             })
         },
         wrap: function(e) {
             var t = we(e);
             return this.each(function(n) {
                 Te(this).wrapAll(t ? e.call(this, n) : e)
             })
         },
         unwrap: function(e) {
             return this.parent(e).not("body").each(function() {
                 Te(this).replaceWith(this.childNodes)
             }), this
         }
     }), Te.expr.pseudos.hidden = function(e) {
         return !Te.expr.pseudos.visible(e)
     }, Te.expr.pseudos.visible = function(e) {
         return !!(e.offsetWidth || e.offsetHeight || e.getClientRects().length)
     }, Te.ajaxSettings.xhr = function() {
         try {
             return new e.XMLHttpRequest
         } catch (e) {}
     };
     var Vt = {
             0: 200,
             1223: 204
         },
         Gt = Te.ajaxSettings.xhr();
     me.cors = !!Gt && "withCredentials" in Gt, me.ajax = Gt = !!Gt, Te.ajaxTransport(function(t) {
         var n, i;
         if (me.cors || Gt && !t.crossDomain) return {
             send: function(o, r) {
                 var s, a = t.xhr();
                 if (a.open(t.type, t.url, t.async, t.username, t.password), t.xhrFields)
                     for (s in t.xhrFields) a[s] = t.xhrFields[s];
                 t.mimeType && a.overrideMimeType && a.overrideMimeType(t.mimeType), t.crossDomain || o["X-Requested-With"] || (o["X-Requested-With"] = "XMLHttpRequest");
                 for (s in o) a.setRequestHeader(s, o[s]);
                 n = function(e) {
                     return function() {
                         n && (n = i = a.onload = a.onerror = a.onabort = a.ontimeout = a.onreadystatechange = null, "abort" === e ? a.abort() : "error" === e ? "number" != typeof a.status ? r(0, "error") : r(a.status, a.statusText) : r(Vt[a.status] || a.status, a.statusText, "text" !== (a.responseType || "text") || "string" != typeof a.responseText ? {
                             binary: a.response
                         } : {
                             text: a.responseText
                         }, a.getAllResponseHeaders()))
                     }
                 }, a.onload = n(), i = a.onerror = a.ontimeout = n("error"), void 0 !== a.onabort ? a.onabort = i : a.onreadystatechange = function() {
                     4 === a.readyState && e.setTimeout(function() {
                         n && i()
                     })
                 }, n = n("abort");
                 try {
                     a.send(t.hasContent && t.data || null)
                 } catch (e) {
                     if (n) throw e
                 }
             },
             abort: function() {
                 n && n()
             }
         }
     }), Te.ajaxPrefilter(function(e) {
         e.crossDomain && (e.contents.script = !1)
     }), Te.ajaxSetup({
         accepts: {
             script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"
         },
         contents: {
             script: /\b(?:java|ecma)script\b/
         },
         converters: {
             "text script": function(e) {
                 return Te.globalEval(e), e
             }
         }
     }), Te.ajaxPrefilter("script", function(e) {
         void 0 === e.cache && (e.cache = !1), e.crossDomain && (e.type = "GET")
     }), Te.ajaxTransport("script", function(e) {
         if (e.crossDomain) {
             var t, n;
             return {
                 send: function(i, o) {
                     t = Te("<script>").prop({
                         charset: e.scriptCharset,
                         src: e.url
                     }).on("load error", n = function(e) {
                         t.remove(), n = null, e && o("error" === e.type ? 404 : 200, e.type)
                     }), ae.head.appendChild(t[0])
                 },
                 abort: function() {
                     n && n()
                 }
             }
         }
     });
     var Qt = [],
         Jt = /(=)\?(?=&|$)|\?\?/;
     Te.ajaxSetup({
         jsonp: "callback",
         jsonpCallback: function() {
             var e = Qt.pop() || Te.expando + "_" + Ht++;
             return this[e] = !0, e
         }
     }), Te.ajaxPrefilter("json jsonp", function(t, n, i) {
         var o, r, s, a = !1 !== t.jsonp && (Jt.test(t.url) ? "url" : "string" == typeof t.data && 0 === (t.contentType || "").indexOf("application/x-www-form-urlencoded") && Jt.test(t.data) && "data");
         if (a || "jsonp" === t.dataTypes[0]) return o = t.jsonpCallback = we(t.jsonpCallback) ? t.jsonpCallback() : t.jsonpCallback, a ? t[a] = t[a].replace(Jt, "$1" + o) : !1 !== t.jsonp && (t.url += (Nt.test(t.url) ? "&" : "?") + t.jsonp + "=" + o), t.converters["script json"] = function() {
             return s || Te.error(o + " was not called"), s[0]
         }, t.dataTypes[0] = "json", r = e[o], e[o] = function() {
             s = arguments
         }, i.always(function() {
             void 0 === r ? Te(e).removeProp(o) : e[o] = r, t[o] && (t.jsonpCallback = n.jsonpCallback, Qt.push(o)), s && we(r) && r(s[0]), s = r = void 0
         }), "script"
     }), me.createHTMLDocument = function() {
         var e = ae.implementation.createHTMLDocument("").body;
         return e.innerHTML = "<form></form><form></form>", 2 === e.childNodes.length
     }(), Te.parseHTML = function(e, t, n) {
         if ("string" != typeof e) return [];
         "boolean" == typeof t && (n = t, t = !1);
         var i, o, r;
         return t || (me.createHTMLDocument ? (t = ae.implementation.createHTMLDocument(""), i = t.createElement("base"), i.href = ae.location.href, t.head.appendChild(i)) : t = ae), o = De.exec(e), r = !n && [], o ? [t.createElement(o[1])] : (o = T([e], t, r), r && r.length && Te(r).remove(), Te.merge([], o.childNodes))
     }, Te.fn.load = function(e, t, n) {
         var i, o, r, s = this,
             a = e.indexOf(" ");
         return a > -1 && (i = J(e.slice(a)), e = e.slice(0, a)), we(t) ? (n = t, t = void 0) : t && "object" == typeof t && (o = "POST"), s.length > 0 && Te.ajax({
             url: e,
             type: o || "GET",
             dataType: "html",
             data: t
         }).done(function(e) {
             r = arguments, s.html(i ? Te("<div>").append(Te.parseHTML(e)).find(i) : e)
         }).always(n && function(e, t) {
             s.each(function() {
                 n.apply(this, r || [e.responseText, t, e])
             })
         }), this
     }, Te.each(["ajaxStart", "ajaxStop", "ajaxComplete", "ajaxError", "ajaxSuccess", "ajaxSend"], function(e, t) {
         Te.fn[t] = function(e) {
             return this.on(t, e)
         }
     }), Te.expr.pseudos.animated = function(e) {
         return Te.grep(Te.timers, function(t) {
             return e === t.elem
         }).length
     }, Te.offset = {
         setOffset: function(e, t, n) {
             var i, o, r, s, a, l, c, d = Te.css(e, "position"),
                 u = Te(e),
                 p = {};
             "static" === d && (e.style.position = "relative"), a = u.offset(), r = Te.css(e, "top"), l = Te.css(e, "left"), c = ("absolute" === d || "fixed" === d) && (r + l).indexOf("auto") > -1, c ? (i = u.position(), s = i.top, o = i.left) : (s = parseFloat(r) || 0, o = parseFloat(l) || 0), we(t) && (t = t.call(e, n, Te.extend({}, a))), null != t.top && (p.top = t.top - a.top + s), null != t.left && (p.left = t.left - a.left + o), "using" in t ? t.using.call(e, p) : u.css(p)
         }
     }, Te.fn.extend({
         offset: function(e) {
             if (arguments.length) return void 0 === e ? this : this.each(function(t) {
                 Te.offset.setOffset(this, e, t)
             });
             var t, n, i = this[0];
             if (i) return i.getClientRects().length ? (t = i.getBoundingClientRect(), n = i.ownerDocument.defaultView, {
                 top: t.top + n.pageYOffset,
                 left: t.left + n.pageXOffset
             }) : {
                 top: 0,
                 left: 0
             }
         },
         position: function() {
             if (this[0]) {
                 var e, t, n, i = this[0],
                     o = {
                         top: 0,
                         left: 0
                     };
                 if ("fixed" === Te.css(i, "position")) t = i.getBoundingClientRect();
                 else {
                     for (t = this.offset(), n = i.ownerDocument, e = i.offsetParent || n.documentElement; e && (e === n.body || e === n.documentElement) && "static" === Te.css(e, "position");) e = e.parentNode;
                     e && e !== i && 1 === e.nodeType && (o = Te(e).offset(), o.top += Te.css(e, "borderTopWidth", !0), o.left += Te.css(e, "borderLeftWidth", !0))
                 }
                 return {
                     top: t.top - o.top - Te.css(i, "marginTop", !0),
                     left: t.left - o.left - Te.css(i, "marginLeft", !0)
                 }
             }
         },
         offsetParent: function() {
             return this.map(function() {
                 for (var e = this.offsetParent; e && "static" === Te.css(e, "position");) e = e.offsetParent;
                 return e || nt
             })
         }
     }), Te.each({
         scrollLeft: "pageXOffset",
         scrollTop: "pageYOffset"
     }, function(e, t) {
         var n = "pageYOffset" === t;
         Te.fn[e] = function(i) {
             return Me(this, function(e, i, o) {
                 var r;
                 if (be(e) ? r = e : 9 === e.nodeType && (r = e.defaultView), void 0 === o) return r ? r[t] : e[i];
                 r ? r.scrollTo(n ? r.pageXOffset : o, n ? o : r.pageYOffset) : e[i] = o
             }, e, i, arguments.length)
         }
     }), Te.each(["top", "left"], function(e, t) {
         Te.cssHooks[t] = M(me.pixelPosition, function(e, n) {
             if (n) return n = q(e, t), dt.test(n) ? Te(e).position()[t] + "px" : n
         })
     }), Te.each({
         Height: "height",
         Width: "width"
     }, function(e, t) {
         Te.each({
             padding: "inner" + e,
             content: t,
             "": "outer" + e
         }, function(n, i) {
             Te.fn[i] = function(o, r) {
                 var s = arguments.length && (n || "boolean" != typeof o),
                     a = n || (!0 === o || !0 === r ? "margin" : "border");
                 return Me(this, function(t, n, o) {
                     var r;
                     return be(t) ? 0 === i.indexOf("outer") ? t["inner" + e] : t.document.documentElement["client" + e] : 9 === t.nodeType ? (r = t.documentElement, Math.max(t.body["scroll" + e], r["scroll" + e], t.body["offset" + e], r["offset" + e], r["client" + e])) : void 0 === o ? Te.css(t, n, a) : Te.style(t, n, o, a)
                 }, t, s ? o : void 0, s)
             }
         })
     }), Te.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "), function(e, t) {
         Te.fn[t] = function(e, n) {
             return arguments.length > 0 ? this.on(t, null, e, n) : this.trigger(t)
         }
     }), Te.fn.extend({
         hover: function(e, t) {
             return this.mouseenter(e).mouseleave(t || e)
         }
     }), Te.fn.extend({
         bind: function(e, t, n) {
             return this.on(e, null, t, n)
         },
         unbind: function(e, t) {
             return this.off(e, null, t)
         },
         delegate: function(e, t, n, i) {
             return this.on(t, e, n, i)
         },
         undelegate: function(e, t, n) {
             return 1 === arguments.length ? this.off(e, "**") : this.off(t, e || "**", n)
         }
     }), Te.proxy = function(e, t) {
         var n, i, o;
         if ("string" == typeof t && (n = e[t], t = e, e = n), we(e)) return i = ce.call(arguments, 2), o = function() {
             return e.apply(t || this, i.concat(ce.call(arguments)))
         }, o.guid = e.guid = e.guid || Te.guid++, o
     }, Te.holdReady = function(e) {
         e ? Te.readyWait++ : Te.ready(!0)
     }, Te.isArray = Array.isArray, Te.parseJSON = JSON.parse, Te.nodeName = r, Te.isFunction = we, Te.isWindow = be, Te.camelCase = h, Te.type = i, Te.now = Date.now, Te.isNumeric = function(e) {
         var t = Te.type(e);
         return ("number" === t || "string" === t) && !isNaN(e - parseFloat(e))
     }, "function" == typeof define && define.amd && define("jquery", [], function() {
         return Te
     });
     var Kt = e.jQuery,
         Zt = e.$;
     return Te.noConflict = function(t) {
         return e.$ === Te && (e.$ = Zt), t && e.jQuery === Te && (e.jQuery = Kt), Te
     }, t || (e.jQuery = e.$ = Te), Te
 }),
 function(e) {
     "use strict";
     "function" == typeof define && define.amd ? define(["jquery"], e) : "undefined" != typeof exports ? module.exports = e(require("jquery")) : e(jQuery)
 }(function($) {
     "use strict";
     var e = window.Slick || {};
     e = function() {
         function e(e, n) {
             var i = this,
                 o;
             i.defaults = {
                 accessibility: !0,
                 adaptiveHeight: !1,
                 appendArrows: $(e),
                 appendDots: $(e),
                 arrows: !0,
                 asNavFor: null,
                 prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                 nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                 autoplay: !1,
                 autoplaySpeed: 3e3,
                 centerMode: !1,
                 centerPadding: "50px",
                 cssEase: "ease",
                 customPaging: function(e, t) {
                     return $('<button type="button" />').text(t + 1)
                 },
                 dots: !1,
                 dotsClass: "slick-dots",
                 draggable: !0,
                 easing: "linear",
                 edgeFriction: .35,
                 fade: !1,
                 focusOnSelect: !1,
                 focusOnChange: !1,
                 infinite: !0,
                 initialSlide: 0,
                 lazyLoad: "ondemand",
                 mobileFirst: !1,
                 pauseOnHover: !0,
                 pauseOnFocus: !0,
                 pauseOnDotsHover: !1,
                 respondTo: "window",
                 responsive: null,
                 rows: 1,
                 rtl: !1,
                 slide: "",
                 slidesPerRow: 1,
                 slidesToShow: 1,
                 slidesToScroll: 1,
                 speed: 500,
                 swipe: !0,
                 swipeToSlide: !1,
                 touchMove: !0,
                 touchThreshold: 5,
                 useCSS: !0,
                 useTransform: !0,
                 variableWidth: !1,
                 vertical: !1,
                 verticalSwiping: !1,
                 waitForAnimate: !0,
                 zIndex: 1e3
             }, i.initials = {
                 animating: !1,
                 dragging: !1,
                 autoPlayTimer: null,
                 currentDirection: 0,
                 currentLeft: null,
                 currentSlide: 0,
                 direction: 1,
                 $dots: null,
                 listWidth: null,
                 listHeight: null,
                 loadIndex: 0,
                 $nextArrow: null,
                 $prevArrow: null,
                 scrolling: !1,
                 slideCount: null,
                 slideWidth: null,
                 $slideTrack: null,
                 $slides: null,
                 sliding: !1,
                 slideOffset: 0,
                 swipeLeft: null,
                 swiping: !1,
                 $list: null,
                 touchObject: {},
                 transformsEnabled: !1,
                 unslicked: !1
             }, $.extend(i, i.initials), i.activeBreakpoint = null, i.animType = null, i.animProp = null, i.breakpoints = [], i.breakpointSettings = [], i.cssTransitions = !1, i.focussed = !1, i.interrupted = !1, i.hidden = "hidden", i.paused = !0, i.positionProp = null, i.respondTo = null, i.rowCount = 1, i.shouldClick = !0, i.$slider = $(e), i.$slidesCache = null, i.transformType = null, i.transitionType = null, i.visibilityChange = "visibilitychange", i.windowWidth = 0, i.windowTimer = null, o = $(e).data("slick") || {}, i.options = $.extend({}, i.defaults, n, o), i.currentSlide = i.options.initialSlide, i.originalSettings = i.options, void 0 !== document.mozHidden ? (i.hidden = "mozHidden", i.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (i.hidden = "webkitHidden", i.visibilityChange = "webkitvisibilitychange"), i.autoPlay = $.proxy(i.autoPlay, i), i.autoPlayClear = $.proxy(i.autoPlayClear, i), i.autoPlayIterator = $.proxy(i.autoPlayIterator, i), i.changeSlide = $.proxy(i.changeSlide, i), i.clickHandler = $.proxy(i.clickHandler, i), i.selectHandler = $.proxy(i.selectHandler, i), i.setPosition = $.proxy(i.setPosition, i), i.swipeHandler = $.proxy(i.swipeHandler, i), i.dragHandler = $.proxy(i.dragHandler, i), i.keyHandler = $.proxy(i.keyHandler, i), i.instanceUid = t++, i.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, i.registerBreakpoints(), i.init(!0)
         }
         var t = 0;
         return e
     }(), e.prototype.activateADA = function() {
         this.$slideTrack.find(".slick-active").attr({
             "aria-hidden": "false"
         }).find("a, input, button, select").attr({
             tabindex: "0"
         })
     }, e.prototype.addSlide = e.prototype.slickAdd = function(e, t, n) {
         var i = this;
         if ("boolean" == typeof t) n = t, t = null;
         else if (t < 0 || t >= i.slideCount) return !1;
         i.unload(), "number" == typeof t ? 0 === t && 0 === i.$slides.length ? $(e).appendTo(i.$slideTrack) : n ? $(e).insertBefore(i.$slides.eq(t)) : $(e).insertAfter(i.$slides.eq(t)) : !0 === n ? $(e).prependTo(i.$slideTrack) : $(e).appendTo(i.$slideTrack), i.$slides = i.$slideTrack.children(this.options.slide), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.append(i.$slides), i.$slides.each(function(e, t) {
             $(t).attr("data-slick-index", e)
         }), i.$slidesCache = i.$slides, i.reinit()
     }, e.prototype.animateHeight = function() {
         var e = this;
         if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
             var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
             e.$list.animate({
                 height: t
             }, e.options.speed)
         }
     }, e.prototype.animateSlide = function(e, t) {
         var n = {},
             i = this;
         i.animateHeight(), !0 === i.options.rtl && !1 === i.options.vertical && (e = -e), !1 === i.transformsEnabled ? !1 === i.options.vertical ? i.$slideTrack.animate({
             left: e
         }, i.options.speed, i.options.easing, t) : i.$slideTrack.animate({
             top: e
         }, i.options.speed, i.options.easing, t) : !1 === i.cssTransitions ? (!0 === i.options.rtl && (i.currentLeft = -i.currentLeft), $({
             animStart: i.currentLeft
         }).animate({
             animStart: e
         }, {
             duration: i.options.speed,
             easing: i.options.easing,
             step: function(e) {
                 e = Math.ceil(e), !1 === i.options.vertical ? (n[i.animType] = "translate(" + e + "px, 0px)", i.$slideTrack.css(n)) : (n[i.animType] = "translate(0px," + e + "px)", i.$slideTrack.css(n))
             },
             complete: function() {
                 t && t.call()
             }
         })) : (i.applyTransition(), e = Math.ceil(e), !1 === i.options.vertical ? n[i.animType] = "translate3d(" + e + "px, 0px, 0px)" : n[i.animType] = "translate3d(0px," + e + "px, 0px)", i.$slideTrack.css(n), t && setTimeout(function() {
             i.disableTransition(), t.call()
         }, i.options.speed))
     }, e.prototype.getNavTarget = function() {
         var e = this,
             t = e.options.asNavFor;
         return t && null !== t && (t = $(t).not(e.$slider)), t
     }, e.prototype.asNavFor = function(e) {
         var t = this,
             n = t.getNavTarget();
         null !== n && "object" == typeof n && n.each(function() {
             var t = $(this).slick("getSlick");
             t.unslicked || t.slideHandler(e, !0)
         })
     }, e.prototype.applyTransition = function(e) {
         var t = this,
             n = {};
         !1 === t.options.fade ? n[t.transitionType] = t.transformType + " " + t.options.speed + "ms " + t.options.cssEase : n[t.transitionType] = "opacity " + t.options.speed + "ms " + t.options.cssEase, !1 === t.options.fade ? t.$slideTrack.css(n) : t.$slides.eq(e).css(n)
     }, e.prototype.autoPlay = function() {
         var e = this;
         e.autoPlayClear(), e.slideCount > e.options.slidesToShow && (e.autoPlayTimer = setInterval(e.autoPlayIterator, e.options.autoplaySpeed))
     }, e.prototype.autoPlayClear = function() {
         var e = this;
         e.autoPlayTimer && clearInterval(e.autoPlayTimer)
     }, e.prototype.autoPlayIterator = function() {
         var e = this,
             t = e.currentSlide + e.options.slidesToScroll;
         e.paused || e.interrupted || e.focussed || (!1 === e.options.infinite && (1 === e.direction && e.currentSlide + 1 === e.slideCount - 1 ? e.direction = 0 : 0 === e.direction && (t = e.currentSlide - e.options.slidesToScroll, e.currentSlide - 1 == 0 && (e.direction = 1))), e.slideHandler(t))
     }, e.prototype.buildArrows = function() {
         var e = this;
         !0 === e.options.arrows && (e.$prevArrow = $(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = $(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
             "aria-disabled": "true",
             tabindex: "-1"
         }))
     }, e.prototype.buildDots = function() {
         var e = this,
             t, n;
         if (!0 === e.options.dots && e.slideCount > e.options.slidesToShow) {
             for (e.$slider.addClass("slick-dotted"), n = $("<ul />").addClass(e.options.dotsClass), t = 0; t <= e.getDotCount(); t += 1) n.append($("<li />").append(e.options.customPaging.call(this, e, t)));
             e.$dots = n.appendTo(e.options.appendDots), e.$dots.find("li").first().addClass("slick-active")
         }
     }, e.prototype.buildOut = function() {
         var e = this;
         e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function(e, t) {
             $(t).attr("data-slick-index", e).data("originalStyling", $(t).attr("style") || "")
         }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? $('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), !0 !== e.options.centerMode && !0 !== e.options.swipeToSlide || (e.options.slidesToScroll = 1), $("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
     }, e.prototype.buildRows = function() {
         var e = this,
             t, n, i, o, r, s, a;
         if (o = document.createDocumentFragment(), s = e.$slider.children(), e.options.rows > 0) {
             for (a = e.options.slidesPerRow * e.options.rows, r = Math.ceil(s.length / a), t = 0; t < r; t++) {
                 var l = document.createElement("div");
                 for (n = 0; n < e.options.rows; n++) {
                     var c = document.createElement("div");
                     for (i = 0; i < e.options.slidesPerRow; i++) {
                         var d = t * a + (n * e.options.slidesPerRow + i);
                         s.get(d) && c.appendChild(s.get(d))
                     }
                     l.appendChild(c)
                 }
                 o.appendChild(l)
             }
             e.$slider.empty().append(o), e.$slider.children().children().children().css({
                 width: 100 / e.options.slidesPerRow + "%",
                 display: "inline-block"
             })
         }
     }, e.prototype.checkResponsive = function(e, t) {
         var n = this,
             i, o, r, s = !1,
             a = n.$slider.width(),
             l = window.innerWidth || $(window).width();
         if ("window" === n.respondTo ? r = l : "slider" === n.respondTo ? r = a : "min" === n.respondTo && (r = Math.min(l, a)), n.options.responsive && n.options.responsive.length && null !== n.options.responsive) {
             o = null;
             for (i in n.breakpoints) n.breakpoints.hasOwnProperty(i) && (!1 === n.originalSettings.mobileFirst ? r < n.breakpoints[i] && (o = n.breakpoints[i]) : r > n.breakpoints[i] && (o = n.breakpoints[i]));
             null !== o ? null !== n.activeBreakpoint ? (o !== n.activeBreakpoint || t) && (n.activeBreakpoint = o, "unslick" === n.breakpointSettings[o] ? n.unslick(o) : (n.options = $.extend({}, n.originalSettings, n.breakpointSettings[o]), !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e)), s = o) : (n.activeBreakpoint = o, "unslick" === n.breakpointSettings[o] ? n.unslick(o) : (n.options = $.extend({}, n.originalSettings, n.breakpointSettings[o]), !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e)), s = o) : null !== n.activeBreakpoint && (n.activeBreakpoint = null, n.options = n.originalSettings, !0 === e && (n.currentSlide = n.options.initialSlide), n.refresh(e), s = o), e || !1 === s || n.$slider.trigger("breakpoint", [n, s])
         }
     }, e.prototype.changeSlide = function(e, t) {
         var n = this,
             i = $(e.currentTarget),
             o, r, s;
         switch (i.is("a") && e.preventDefault(), i.is("li") || (i = i.closest("li")), s = n.slideCount % n.options.slidesToScroll != 0, o = s ? 0 : (n.slideCount - n.currentSlide) % n.options.slidesToScroll, e.data.message) {
             case "previous":
                 r = 0 === o ? n.options.slidesToScroll : n.options.slidesToShow - o, n.slideCount > n.options.slidesToShow && n.slideHandler(n.currentSlide - r, !1, t);
                 break;
             case "next":
                 r = 0 === o ? n.options.slidesToScroll : o, n.slideCount > n.options.slidesToShow && n.slideHandler(n.currentSlide + r, !1, t);
                 break;
             case "index":
                 var a = 0 === e.data.index ? 0 : e.data.index || i.index() * n.options.slidesToScroll;
                 n.slideHandler(n.checkNavigable(a), !1, t), i.children().trigger("focus");
                 break;
             default:
                 return
         }
     }, e.prototype.checkNavigable = function(e) {
         var t = this,
             n, i;
         if (n = t.getNavigableIndexes(), i = 0, e > n[n.length - 1]) e = n[n.length - 1];
         else
             for (var o in n) {
                 if (e < n[o]) {
                     e = i;
                     break
                 }
                 i = n[o]
             }
         return e
     }, e.prototype.cleanUpEvents = function() {
         var e = this;
         e.options.dots && null !== e.$dots && ($("li", e.$dots).off("click.slick", e.changeSlide).off("mouseenter.slick", $.proxy(e.interrupt, e, !0)).off("mouseleave.slick", $.proxy(e.interrupt, e, !1)), !0 === e.options.accessibility && e.$dots.off("keydown.slick", e.keyHandler)), e.$slider.off("focus.slick blur.slick"), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow && e.$prevArrow.off("keydown.slick", e.keyHandler), e.$nextArrow && e.$nextArrow.off("keydown.slick", e.keyHandler))), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), $(document).off(e.visibilityChange, e.visibility), e.cleanUpSlideEvents(), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && $(e.$slideTrack).children().off("click.slick", e.selectHandler), $(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), $(window).off("resize.slick.slick-" + e.instanceUid, e.resize), $("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), $(window).off("load.slick.slick-" + e.instanceUid, e.setPosition)
     }, e.prototype.cleanUpSlideEvents = function() {
         var e = this;
         e.$list.off("mouseenter.slick", $.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.slick", $.proxy(e.interrupt, e, !1))
     }, e.prototype.cleanUpRows = function() {
         var e = this,
             t;
         e.options.rows > 0 && (t = e.$slides.children().children(), t.removeAttr("style"), e.$slider.empty().append(t))
     }, e.prototype.clickHandler = function(e) {
         !1 === this.shouldClick && (e.stopImmediatePropagation(), e.stopPropagation(), e.preventDefault())
     }, e.prototype.destroy = function(e) {
         var t = this;
         t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), $(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && t.$prevArrow.length && (t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove()), t.$nextArrow && t.$nextArrow.length && (t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove()), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function() {
             $(this).attr("style", $(this).data("originalStyling"))
         }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.$slider.removeClass("slick-dotted"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t])
     }, e.prototype.disableTransition = function(e) {
         var t = this,
             n = {};
         n[t.transitionType] = "", !1 === t.options.fade ? t.$slideTrack.css(n) : t.$slides.eq(e).css(n)
     }, e.prototype.fadeSlide = function(e, t) {
         var n = this;
         !1 === n.cssTransitions ? (n.$slides.eq(e).css({
             zIndex: n.options.zIndex
         }), n.$slides.eq(e).animate({
             opacity: 1
         }, n.options.speed, n.options.easing, t)) : (n.applyTransition(e), n.$slides.eq(e).css({
             opacity: 1,
             zIndex: n.options.zIndex
         }), t && setTimeout(function() {
             n.disableTransition(e), t.call()
         }, n.options.speed))
     }, e.prototype.fadeSlideOut = function(e) {
         var t = this;
         !1 === t.cssTransitions ? t.$slides.eq(e).animate({
             opacity: 0,
             zIndex: t.options.zIndex - 2
         }, t.options.speed, t.options.easing) : (t.applyTransition(e), t.$slides.eq(e).css({
             opacity: 0,
             zIndex: t.options.zIndex - 2
         }))
     }, e.prototype.filterSlides = e.prototype.slickFilter = function(e) {
         var t = this;
         null !== e && (t.$slidesCache = t.$slides, t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.filter(e).appendTo(t.$slideTrack), t.reinit())
     }, e.prototype.focusHandler = function() {
         var e = this;
         e.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function(t) {
             t.stopImmediatePropagation();
             var n = $(this);
             setTimeout(function() {
                 e.options.pauseOnFocus && (e.focussed = n.is(":focus"), e.autoPlay())
             }, 0)
         })
     }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function() {
         return this.currentSlide
     }, e.prototype.getDotCount = function() {
         var e = this,
             t = 0,
             n = 0,
             i = 0;
         if (!0 === e.options.infinite)
             if (e.slideCount <= e.options.slidesToShow) ++i;
             else
                 for (; t < e.slideCount;) ++i, t = n + e.options.slidesToScroll, n += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
         else if (!0 === e.options.centerMode) i = e.slideCount;
         else if (e.options.asNavFor)
             for (; t < e.slideCount;) ++i, t = n + e.options.slidesToScroll, n += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
         else i = 1 + Math.ceil((e.slideCount - e.options.slidesToShow) / e.options.slidesToScroll);
         return i - 1
     }, e.prototype.getLeft = function(e) {
         var t = this,
             n, i, o = 0,
             r, s;
         return t.slideOffset = 0, i = t.$slides.first().outerHeight(!0), !0 === t.options.infinite ? (t.slideCount > t.options.slidesToShow && (t.slideOffset = t.slideWidth * t.options.slidesToShow * -1, s = -1, !0 === t.options.vertical && !0 === t.options.centerMode && (2 === t.options.slidesToShow ? s = -1.5 : 1 === t.options.slidesToShow && (s = -2)), o = i * t.options.slidesToShow * s), t.slideCount % t.options.slidesToScroll != 0 && e + t.options.slidesToScroll > t.slideCount && t.slideCount > t.options.slidesToShow && (e > t.slideCount ? (t.slideOffset = (t.options.slidesToShow - (e - t.slideCount)) * t.slideWidth * -1, o = (t.options.slidesToShow - (e - t.slideCount)) * i * -1) : (t.slideOffset = t.slideCount % t.options.slidesToScroll * t.slideWidth * -1, o = t.slideCount % t.options.slidesToScroll * i * -1))) : e + t.options.slidesToShow > t.slideCount && (t.slideOffset = (e + t.options.slidesToShow - t.slideCount) * t.slideWidth, o = (e + t.options.slidesToShow - t.slideCount) * i), t.slideCount <= t.options.slidesToShow && (t.slideOffset = 0, o = 0), !0 === t.options.centerMode && t.slideCount <= t.options.slidesToShow ? t.slideOffset = t.slideWidth * Math.floor(t.options.slidesToShow) / 2 - t.slideWidth * t.slideCount / 2 : !0 === t.options.centerMode && !0 === t.options.infinite ? t.slideOffset += t.slideWidth * Math.floor(t.options.slidesToShow / 2) - t.slideWidth : !0 === t.options.centerMode && (t.slideOffset = 0, t.slideOffset += t.slideWidth * Math.floor(t.options.slidesToShow / 2)), n = !1 === t.options.vertical ? e * t.slideWidth * -1 + t.slideOffset : e * i * -1 + o, !0 === t.options.variableWidth && (r = t.slideCount <= t.options.slidesToShow || !1 === t.options.infinite ? t.$slideTrack.children(".slick-slide").eq(e) : t.$slideTrack.children(".slick-slide").eq(e + t.options.slidesToShow), n = !0 === t.options.rtl ? r[0] ? -1 * (t.$slideTrack.width() - r[0].offsetLeft - r.width()) : 0 : r[0] ? -1 * r[0].offsetLeft : 0, !0 === t.options.centerMode && (r = t.slideCount <= t.options.slidesToShow || !1 === t.options.infinite ? t.$slideTrack.children(".slick-slide").eq(e) : t.$slideTrack.children(".slick-slide").eq(e + t.options.slidesToShow + 1), n = !0 === t.options.rtl ? r[0] ? -1 * (t.$slideTrack.width() - r[0].offsetLeft - r.width()) : 0 : r[0] ? -1 * r[0].offsetLeft : 0, n += (t.$list.width() - r.outerWidth()) / 2)), n
     }, e.prototype.getOption = e.prototype.slickGetOption = function(e) {
         return this.options[e]
     }, e.prototype.getNavigableIndexes = function() {
         var e = this,
             t = 0,
             n = 0,
             i = [],
             o;
         for (!1 === e.options.infinite ? o = e.slideCount : (t = -1 * e.options.slidesToScroll, n = -1 * e.options.slidesToScroll, o = 2 * e.slideCount); t < o;) i.push(t), t = n + e.options.slidesToScroll, n += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
         return i
     }, e.prototype.getSlick = function() {
         return this
     }, e.prototype.getSlideCount = function() {
         var e = this,
             t, n, i;
         return i = !0 === e.options.centerMode ? e.slideWidth * Math.floor(e.options.slidesToShow / 2) : 0, !0 === e.options.swipeToSlide ? (e.$slideTrack.find(".slick-slide").each(function(t, o) {
             if (o.offsetLeft - i + $(o).outerWidth() / 2 > -1 * e.swipeLeft) return n = o, !1
         }), t = Math.abs($(n).attr("data-slick-index") - e.currentSlide) || 1) : e.options.slidesToScroll
     }, e.prototype.goTo = e.prototype.slickGoTo = function(e, t) {
         this.changeSlide({
             data: {
                 message: "index",
                 index: parseInt(e)
             }
         }, t)
     }, e.prototype.init = function(e) {
         var t = this;
         $(t.$slider).hasClass("slick-initialized") || ($(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots(), t.checkResponsive(!0), t.focusHandler()), e && t.$slider.trigger("init", [t]), !0 === t.options.accessibility && t.initADA(), t.options.autoplay && (t.paused = !1, t.autoPlay())
     }, e.prototype.initADA = function() {
         var e = this,
             t = Math.ceil(e.slideCount / e.options.slidesToShow),
             n = e.getNavigableIndexes().filter(function(t) {
                 return t >= 0 && t < e.slideCount
             });
         e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({
             "aria-hidden": "true",
             tabindex: "-1"
         }).find("a, input, button, select").attr({
             tabindex: "-1"
         }), null !== e.$dots && (e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function(t) {
             var i = n.indexOf(t);
             if ($(this).attr({
                     role: "tabpanel",
                     id: "slick-slide" + e.instanceUid + t,
                     tabindex: -1
                 }), -1 !== i) {
                 var o = "slick-slide-control" + e.instanceUid + i;
                 $("#" + o).length && $(this).attr({
                     "aria-describedby": o
                 })
             }
         }), e.$dots.attr("role", "tablist").find("li").each(function(i) {
             var o = n[i];
             $(this).attr({
                 role: "presentation"
             }), $(this).find("button").first().attr({
                 role: "tab",
                 id: "slick-slide-control" + e.instanceUid + i,
                 "aria-controls": "slick-slide" + e.instanceUid + o,
                 "aria-label": i + 1 + " of " + t,
                 "aria-selected": null,
                 tabindex: "-1"
             })
         }).eq(e.currentSlide).find("button").attr({
             "aria-selected": "true",
             tabindex: "0"
         }).end());
         for (var i = e.currentSlide, o = i + e.options.slidesToShow; i < o; i++) e.options.focusOnChange ? e.$slides.eq(i).attr({
             tabindex: "0"
         }) : e.$slides.eq(i).removeAttr("tabindex");
         e.activateADA()
     }, e.prototype.initArrowEvents = function() {
         var e = this;
         !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.off("click.slick").on("click.slick", {
             message: "previous"
         }, e.changeSlide), e.$nextArrow.off("click.slick").on("click.slick", {
             message: "next"
         }, e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow.on("keydown.slick", e.keyHandler), e.$nextArrow.on("keydown.slick", e.keyHandler)))
     }, e.prototype.initDotEvents = function() {
         var e = this;
         !0 === e.options.dots && e.slideCount > e.options.slidesToShow && ($("li", e.$dots).on("click.slick", {
             message: "index"
         }, e.changeSlide), !0 === e.options.accessibility && e.$dots.on("keydown.slick", e.keyHandler)), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && e.slideCount > e.options.slidesToShow && $("li", e.$dots).on("mouseenter.slick", $.proxy(e.interrupt, e, !0)).on("mouseleave.slick", $.proxy(e.interrupt, e, !1))
     }, e.prototype.initSlideEvents = function() {
         var e = this;
         e.options.pauseOnHover && (e.$list.on("mouseenter.slick", $.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.slick", $.proxy(e.interrupt, e, !1)))
     }, e.prototype.initializeEvents = function() {
         var e = this;
         e.initArrowEvents(), e.initDotEvents(), e.initSlideEvents(), e.$list.on("touchstart.slick mousedown.slick", {
             action: "start"
         }, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {
             action: "move"
         }, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {
             action: "end"
         }, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {
             action: "end"
         }, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), $(document).on(e.visibilityChange, $.proxy(e.visibility, e)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && $(e.$slideTrack).children().on("click.slick", e.selectHandler), $(window).on("orientationchange.slick.slick-" + e.instanceUid, $.proxy(e.orientationChange, e)), $(window).on("resize.slick.slick-" + e.instanceUid, $.proxy(e.resize, e)), $("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), $(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), $(e.setPosition)
     }, e.prototype.initUI = function() {
         var e = this;
         !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.show(), e.$nextArrow.show()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.show()
     }, e.prototype.keyHandler = function(e) {
         var t = this;
         e.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === e.keyCode && !0 === t.options.accessibility ? t.changeSlide({
             data: {
                 message: !0 === t.options.rtl ? "next" : "previous"
             }
         }) : 39 === e.keyCode && !0 === t.options.accessibility && t.changeSlide({
             data: {
                 message: !0 === t.options.rtl ? "previous" : "next"
             }
         }))
     }, e.prototype.lazyLoad = function() {
         function e(e) {
             $("img[data-lazy]", e).each(function() {
                 var e = $(this),
                     n = $(this).attr("data-lazy"),
                     i = $(this).attr("data-srcset"),
                     o = $(this).attr("data-sizes") || t.$slider.attr("data-sizes"),
                     r = document.createElement("img");
                 r.onload = function() {
                     e.animate({
                         opacity: 0
                     }, 100, function() {
                         i && (e.attr("srcset", i), o && e.attr("sizes", o)), e.attr("src", n).animate({
                             opacity: 1
                         }, 200, function() {
                             e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                         }), t.$slider.trigger("lazyLoaded", [t, e, n])
                     })
                 }, r.onerror = function() {
                     e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), t.$slider.trigger("lazyLoadError", [t, e, n])
                 }, r.src = n
             })
         }
         var t = this,
             n, i, o, r;
         if (!0 === t.options.centerMode ? !0 === t.options.infinite ? (o = t.currentSlide + (t.options.slidesToShow / 2 + 1), r = o + t.options.slidesToShow + 2) : (o = Math.max(0, t.currentSlide - (t.options.slidesToShow / 2 + 1)), r = t.options.slidesToShow / 2 + 1 + 2 + t.currentSlide) : (o = t.options.infinite ? t.options.slidesToShow + t.currentSlide : t.currentSlide, r = Math.ceil(o + t.options.slidesToShow), !0 === t.options.fade && (o > 0 && o--, r <= t.slideCount && r++)), n = t.$slider.find(".slick-slide").slice(o, r), "anticipated" === t.options.lazyLoad)
             for (var s = o - 1, a = r, l = t.$slider.find(".slick-slide"), c = 0; c < t.options.slidesToScroll; c++) s < 0 && (s = t.slideCount - 1), n = n.add(l.eq(s)), n = n.add(l.eq(a)), s--, a++;
         e(n), t.slideCount <= t.options.slidesToShow ? (i = t.$slider.find(".slick-slide"), e(i)) : t.currentSlide >= t.slideCount - t.options.slidesToShow ? (i = t.$slider.find(".slick-cloned").slice(0, t.options.slidesToShow), e(i)) : 0 === t.currentSlide && (i = t.$slider.find(".slick-cloned").slice(-1 * t.options.slidesToShow), e(i))
     }, e.prototype.loadSlider = function() {
         var e = this;
         e.setPosition(), e.$slideTrack.css({
             opacity: 1
         }), e.$slider.removeClass("slick-loading"), e.initUI(), "progressive" === e.options.lazyLoad && e.progressiveLazyLoad()
     }, e.prototype.next = e.prototype.slickNext = function() {
         this.changeSlide({
             data: {
                 message: "next"
             }
         })
     }, e.prototype.orientationChange = function() {
         var e = this;
         e.checkResponsive(), e.setPosition()
     }, e.prototype.pause = e.prototype.slickPause = function() {
         var e = this;
         e.autoPlayClear(), e.paused = !0
     }, e.prototype.play = e.prototype.slickPlay = function() {
         var e = this;
         e.autoPlay(), e.options.autoplay = !0, e.paused = !1, e.focussed = !1, e.interrupted = !1
     }, e.prototype.postSlide = function(e) {
         var t = this;
         if (!t.unslicked && (t.$slider.trigger("afterChange", [t, e]), t.animating = !1, t.slideCount > t.options.slidesToShow && t.setPosition(), t.swipeLeft = null, t.options.autoplay && t.autoPlay(), !0 === t.options.accessibility && (t.initADA(), t.options.focusOnChange))) {
             $(t.$slides.get(t.currentSlide)).attr("tabindex", 0).focus()
         }
     }, e.prototype.prev = e.prototype.slickPrev = function() {
         this.changeSlide({
             data: {
                 message: "previous"
             }
         })
     }, e.prototype.preventDefault = function(e) {
         e.preventDefault()
     }, e.prototype.progressiveLazyLoad = function(e) {
         e = e || 1;
         var t = this,
             n = $("img[data-lazy]", t.$slider),
             i, o, r, s, a;
         n.length ? (i = n.first(), o = i.attr("data-lazy"), r = i.attr("data-srcset"), s = i.attr("data-sizes") || t.$slider.attr("data-sizes"), a = document.createElement("img"), a.onload = function() {
             r && (i.attr("srcset", r), s && i.attr("sizes", s)), i.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === t.options.adaptiveHeight && t.setPosition(), t.$slider.trigger("lazyLoaded", [t, i, o]), t.progressiveLazyLoad()
         }, a.onerror = function() {
             e < 3 ? setTimeout(function() {
                 t.progressiveLazyLoad(e + 1)
             }, 500) : (i.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), t.$slider.trigger("lazyLoadError", [t, i, o]), t.progressiveLazyLoad())
         }, a.src = o) : t.$slider.trigger("allImagesLoaded", [t])
     }, e.prototype.refresh = function(e) {
         var t = this,
             n, i;
         i = t.slideCount - t.options.slidesToShow, !t.options.infinite && t.currentSlide > i && (t.currentSlide = i), t.slideCount <= t.options.slidesToShow && (t.currentSlide = 0), n = t.currentSlide, t.destroy(!0), $.extend(t, t.initials, {
             currentSlide: n
         }), t.init(), e || t.changeSlide({
             data: {
                 message: "index",
                 index: n
             }
         }, !1)
     }, e.prototype.registerBreakpoints = function() {
         var e = this,
             t, n, i, o = e.options.responsive || null;
         if ("array" === $.type(o) && o.length) {
             e.respondTo = e.options.respondTo || "window";
             for (t in o)
                 if (i = e.breakpoints.length - 1, o.hasOwnProperty(t)) {
                     for (n = o[t].breakpoint; i >= 0;) e.breakpoints[i] && e.breakpoints[i] === n && e.breakpoints.splice(i, 1), i--;
                     e.breakpoints.push(n), e.breakpointSettings[n] = o[t].settings
                 }
             e.breakpoints.sort(function(t, n) {
                 return e.options.mobileFirst ? t - n : n - t
             })
         }
     }, e.prototype.reinit = function() {
         var e = this;
         e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.cleanUpSlideEvents(), e.initSlideEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && $(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), e.setPosition(), e.focusHandler(), e.paused = !e.options.autoplay, e.autoPlay(), e.$slider.trigger("reInit", [e])
     }, e.prototype.resize = function() {
         var e = this;
         $(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function() {
             e.windowWidth = $(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
         }, 50))
     }, e.prototype.removeSlide = e.prototype.slickRemove = function(e, t, n) {
         var i = this;
         if ("boolean" == typeof e ? (t = e, e = !0 === t ? 0 : i.slideCount - 1) : e = !0 === t ? --e : e, i.slideCount < 1 || e < 0 || e > i.slideCount - 1) return !1;
         i.unload(), !0 === n ? i.$slideTrack.children().remove() : i.$slideTrack.children(this.options.slide).eq(e).remove(), i.$slides = i.$slideTrack.children(this.options.slide), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.append(i.$slides), i.$slidesCache = i.$slides, i.reinit()
     }, e.prototype.setCSS = function(e) {
         var t = this,
             n = {},
             i, o;
         !0 === t.options.rtl && (e = -e), i = "left" == t.positionProp ? Math.ceil(e) + "px" : "0px", o = "top" == t.positionProp ? Math.ceil(e) + "px" : "0px", n[t.positionProp] = e, !1 === t.transformsEnabled ? t.$slideTrack.css(n) : (n = {}, !1 === t.cssTransitions ? (n[t.animType] = "translate(" + i + ", " + o + ")", t.$slideTrack.css(n)) : (n[t.animType] = "translate3d(" + i + ", " + o + ", 0px)", t.$slideTrack.css(n)))
     }, e.prototype.setDimensions = function() {
         var e = this;
         !1 === e.options.vertical ? !0 === e.options.centerMode && e.$list.css({
             padding: "0px " + e.options.centerPadding
         }) : (e.$list.height(e.$slides.first().outerHeight(!0) * e.options.slidesToShow), !0 === e.options.centerMode && e.$list.css({
             padding: e.options.centerPadding + " 0px"
         })), e.listWidth = e.$list.width(), e.listHeight = e.$list.height(), !1 === e.options.vertical && !1 === e.options.variableWidth ? (e.slideWidth = Math.ceil(e.listWidth / e.options.slidesToShow), e.$slideTrack.width(Math.ceil(e.slideWidth * e.$slideTrack.children(".slick-slide").length))) : !0 === e.options.variableWidth ? e.$slideTrack.width(5e3 * e.slideCount) : (e.slideWidth = Math.ceil(e.listWidth), e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0) * e.$slideTrack.children(".slick-slide").length)));
         var t = e.$slides.first().outerWidth(!0) - e.$slides.first().width();
         !1 === e.options.variableWidth && e.$slideTrack.children(".slick-slide").width(e.slideWidth - t)
     }, e.prototype.setFade = function() {
         var e = this,
             t;
         e.$slides.each(function(n, i) {
             t = e.slideWidth * n * -1, !0 === e.options.rtl ? $(i).css({
                 position: "relative",
                 right: t,
                 top: 0,
                 zIndex: e.options.zIndex - 2,
                 opacity: 0
             }) : $(i).css({
                 position: "relative",
                 left: t,
                 top: 0,
                 zIndex: e.options.zIndex - 2,
                 opacity: 0
             })
         }), e.$slides.eq(e.currentSlide).css({
             zIndex: e.options.zIndex - 1,
             opacity: 1
         })
     }, e.prototype.setHeight = function() {
         var e = this;
         if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
             var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
             e.$list.css("height", t)
         }
     }, e.prototype.setOption = e.prototype.slickSetOption = function() {
         var e = this,
             t, n, i, o, r = !1,
             s;
         if ("object" === $.type(arguments[0]) ? (i = arguments[0], r = arguments[1], s = "multiple") : "string" === $.type(arguments[0]) && (i = arguments[0], o = arguments[1], r = arguments[2], "responsive" === arguments[0] && "array" === $.type(arguments[1]) ? s = "responsive" : void 0 !== arguments[1] && (s = "single")), "single" === s) e.options[i] = o;
         else if ("multiple" === s) $.each(i, function(t, n) {
             e.options[t] = n
         });
         else if ("responsive" === s)
             for (n in o)
                 if ("array" !== $.type(e.options.responsive)) e.options.responsive = [o[n]];
                 else {
                     for (t = e.options.responsive.length - 1; t >= 0;) e.options.responsive[t].breakpoint === o[n].breakpoint && e.options.responsive.splice(t, 1), t--;
                     e.options.responsive.push(o[n])
                 }
         r && (e.unload(), e.reinit())
     }, e.prototype.setPosition = function() {
         var e = this;
         e.setDimensions(), e.setHeight(), !1 === e.options.fade ? e.setCSS(e.getLeft(e.currentSlide)) : e.setFade(), e.$slider.trigger("setPosition", [e])
     }, e.prototype.setProps = function() {
         var e = this,
             t = document.body.style;
         e.positionProp = !0 === e.options.vertical ? "top" : "left", "top" === e.positionProp ? e.$slider.addClass("slick-vertical") : e.$slider.removeClass("slick-vertical"), void 0 === t.WebkitTransition && void 0 === t.MozTransition && void 0 === t.msTransition || !0 === e.options.useCSS && (e.cssTransitions = !0), e.options.fade && ("number" == typeof e.options.zIndex ? e.options.zIndex < 3 && (e.options.zIndex = 3) : e.options.zIndex = e.defaults.zIndex), void 0 !== t.OTransform && (e.animType = "OTransform", e.transformType = "-o-transform", e.transitionType = "OTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.MozTransform && (e.animType = "MozTransform", e.transformType = "-moz-transform", e.transitionType = "MozTransition", void 0 === t.perspectiveProperty && void 0 === t.MozPerspective && (e.animType = !1)), void 0 !== t.webkitTransform && (e.animType = "webkitTransform", e.transformType = "-webkit-transform", e.transitionType = "webkitTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.msTransform && (e.animType = "msTransform", e.transformType = "-ms-transform", e.transitionType = "msTransition", void 0 === t.msTransform && (e.animType = !1)), void 0 !== t.transform && !1 !== e.animType && (e.animType = "transform", e.transformType = "transform", e.transitionType = "transition"), e.transformsEnabled = e.options.useTransform && null !== e.animType && !1 !== e.animType
     }, e.prototype.setSlideClasses = function(e) {
         var t = this,
             n, i, o, r;
         if (i = t.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), t.$slides.eq(e).addClass("slick-current"), !0 === t.options.centerMode) {
             var s = t.options.slidesToShow % 2 == 0 ? 1 : 0;
             n = Math.floor(t.options.slidesToShow / 2), !0 === t.options.infinite && (e >= n && e <= t.slideCount - 1 - n ? t.$slides.slice(e - n + s, e + n + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = t.options.slidesToShow + e, i.slice(o - n + 1 + s, o + n + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === e ? i.eq(i.length - 1 - t.options.slidesToShow).addClass("slick-center") : e === t.slideCount - 1 && i.eq(t.options.slidesToShow).addClass("slick-center")), t.$slides.eq(e).addClass("slick-center")
         } else e >= 0 && e <= t.slideCount - t.options.slidesToShow ? t.$slides.slice(e, e + t.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : i.length <= t.options.slidesToShow ? i.addClass("slick-active").attr("aria-hidden", "false") : (r = t.slideCount % t.options.slidesToShow, o = !0 === t.options.infinite ? t.options.slidesToShow + e : e, t.options.slidesToShow == t.options.slidesToScroll && t.slideCount - e < t.options.slidesToShow ? i.slice(o - (t.options.slidesToShow - r), o + r).addClass("slick-active").attr("aria-hidden", "false") : i.slice(o, o + t.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
         "ondemand" !== t.options.lazyLoad && "anticipated" !== t.options.lazyLoad || t.lazyLoad()
     }, e.prototype.setupInfinite = function() {
         var e = this,
             t, n, i;
         if (!0 === e.options.fade && (e.options.centerMode = !1), !0 === e.options.infinite && !1 === e.options.fade && (n = null, e.slideCount > e.options.slidesToShow)) {
             for (i = !0 === e.options.centerMode ? e.options.slidesToShow + 1 : e.options.slidesToShow, t = e.slideCount; t > e.slideCount - i; t -= 1) n = t - 1, $(e.$slides[n]).clone(!0).attr("id", "").attr("data-slick-index", n - e.slideCount).prependTo(e.$slideTrack).addClass("slick-cloned");
             for (t = 0; t < i + e.slideCount; t += 1) n = t, $(e.$slides[n]).clone(!0).attr("id", "").attr("data-slick-index", n + e.slideCount).appendTo(e.$slideTrack).addClass("slick-cloned");
             e.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
                 $(this).attr("id", "")
             })
         }
     }, e.prototype.interrupt = function(e) {
         var t = this;
         e || t.autoPlay(), t.interrupted = e
     }, e.prototype.selectHandler = function(e) {
         var t = this,
             n = $(e.target).is(".slick-slide") ? $(e.target) : $(e.target).parents(".slick-slide"),
             i = parseInt(n.attr("data-slick-index"));
         if (i || (i = 0), t.slideCount <= t.options.slidesToShow) return void t.slideHandler(i, !1, !0);
         t.slideHandler(i)
     }, e.prototype.slideHandler = function(e, t, n) {
         var i, o, r, s, a = null,
             l = this,
             c;
         if (t = t || !1, !(!0 === l.animating && !0 === l.options.waitForAnimate || !0 === l.options.fade && l.currentSlide === e)) {
             if (!1 === t && l.asNavFor(e), i = e, a = l.getLeft(i), s = l.getLeft(l.currentSlide), l.currentLeft = null === l.swipeLeft ? s : l.swipeLeft, !1 === l.options.infinite && !1 === l.options.centerMode && (e < 0 || e > l.getDotCount() * l.options.slidesToScroll)) return void(!1 === l.options.fade && (i = l.currentSlide, !0 !== n && l.slideCount > l.options.slidesToShow ? l.animateSlide(s, function() {
                 l.postSlide(i)
             }) : l.postSlide(i)));
             if (!1 === l.options.infinite && !0 === l.options.centerMode && (e < 0 || e > l.slideCount - l.options.slidesToScroll)) return void(!1 === l.options.fade && (i = l.currentSlide, !0 !== n && l.slideCount > l.options.slidesToShow ? l.animateSlide(s, function() {
                 l.postSlide(i)
             }) : l.postSlide(i)));
             if (l.options.autoplay && clearInterval(l.autoPlayTimer), o = i < 0 ? l.slideCount % l.options.slidesToScroll != 0 ? l.slideCount - l.slideCount % l.options.slidesToScroll : l.slideCount + i : i >= l.slideCount ? l.slideCount % l.options.slidesToScroll != 0 ? 0 : i - l.slideCount : i, l.animating = !0, l.$slider.trigger("beforeChange", [l, l.currentSlide, o]), r = l.currentSlide, l.currentSlide = o, l.setSlideClasses(l.currentSlide), l.options.asNavFor && (c = l.getNavTarget(), c = c.slick("getSlick"), c.slideCount <= c.options.slidesToShow && c.setSlideClasses(l.currentSlide)), l.updateDots(), l.updateArrows(), !0 === l.options.fade) return !0 !== n ? (l.fadeSlideOut(r), l.fadeSlide(o, function() {
                 l.postSlide(o)
             })) : l.postSlide(o), void l.animateHeight();
             !0 !== n && l.slideCount > l.options.slidesToShow ? l.animateSlide(a, function() {
                 l.postSlide(o)
             }) : l.postSlide(o)
         }
     }, e.prototype.startLoad = function() {
         var e = this;
         !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.hide(), e.$nextArrow.hide()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.hide(), e.$slider.addClass("slick-loading")
     }, e.prototype.swipeDirection = function() {
         var e, t, n, i, o = this;
         return e = o.touchObject.startX - o.touchObject.curX, t = o.touchObject.startY - o.touchObject.curY, n = Math.atan2(t, e), i = Math.round(180 * n / Math.PI), i < 0 && (i = 360 - Math.abs(i)), i <= 45 && i >= 0 ? !1 === o.options.rtl ? "left" : "right" : i <= 360 && i >= 315 ? !1 === o.options.rtl ? "left" : "right" : i >= 135 && i <= 225 ? !1 === o.options.rtl ? "right" : "left" : !0 === o.options.verticalSwiping ? i >= 35 && i <= 135 ? "down" : "up" : "vertical"
     }, e.prototype.swipeEnd = function(e) {
         var t = this,
             n, i;
         if (t.dragging = !1, t.swiping = !1, t.scrolling) return t.scrolling = !1, !1;
         if (t.interrupted = !1, t.shouldClick = !(t.touchObject.swipeLength > 10), void 0 === t.touchObject.curX) return !1;
         if (!0 === t.touchObject.edgeHit && t.$slider.trigger("edge", [t, t.swipeDirection()]), t.touchObject.swipeLength >= t.touchObject.minSwipe) {
             switch (i = t.swipeDirection()) {
                 case "left":
                 case "down":
                     n = t.options.swipeToSlide ? t.checkNavigable(t.currentSlide + t.getSlideCount()) : t.currentSlide + t.getSlideCount(), t.currentDirection = 0;
                     break;
                 case "right":
                 case "up":
                     n = t.options.swipeToSlide ? t.checkNavigable(t.currentSlide - t.getSlideCount()) : t.currentSlide - t.getSlideCount(), t.currentDirection = 1;
                     break;
                 default:
             }
             "vertical" != i && (t.slideHandler(n), t.touchObject = {}, t.$slider.trigger("swipe", [t, i]))
         } else t.touchObject.startX !== t.touchObject.curX && (t.slideHandler(t.currentSlide), t.touchObject = {})
     }, e.prototype.swipeHandler = function(e) {
         var t = this;
         if (!(!1 === t.options.swipe || "ontouchend" in document && !1 === t.options.swipe || !1 === t.options.draggable && -1 !== e.type.indexOf("mouse"))) switch (t.touchObject.fingerCount = e.originalEvent && void 0 !== e.originalEvent.touches ? e.originalEvent.touches.length : 1, t.touchObject.minSwipe = t.listWidth / t.options.touchThreshold, !0 === t.options.verticalSwiping && (t.touchObject.minSwipe = t.listHeight / t.options.touchThreshold), e.data.action) {
             case "start":
                 t.swipeStart(e);
                 break;
             case "move":
                 t.swipeMove(e);
                 break;
             case "end":
                 t.swipeEnd(e);
                 break
         }
     }, e.prototype.swipeMove = function(e) {
         var t = this,
             n = !1,
             i, o, r, s, a, l;
         return a = void 0 !== e.originalEvent ? e.originalEvent.touches : null, !(!t.dragging || t.scrolling || a && 1 !== a.length) && (i = t.getLeft(t.currentSlide), t.touchObject.curX = void 0 !== a ? a[0].pageX : e.clientX, t.touchObject.curY = void 0 !== a ? a[0].pageY : e.clientY, t.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(t.touchObject.curX - t.touchObject.startX, 2))), l = Math.round(Math.sqrt(Math.pow(t.touchObject.curY - t.touchObject.startY, 2))), !t.options.verticalSwiping && !t.swiping && l > 4 ? (t.scrolling = !0, !1) : (!0 === t.options.verticalSwiping && (t.touchObject.swipeLength = l), o = t.swipeDirection(), void 0 !== e.originalEvent && t.touchObject.swipeLength > 4 && (t.swiping = !0, e.preventDefault()), s = (!1 === t.options.rtl ? 1 : -1) * (t.touchObject.curX > t.touchObject.startX ? 1 : -1), !0 === t.options.verticalSwiping && (s = t.touchObject.curY > t.touchObject.startY ? 1 : -1), r = t.touchObject.swipeLength, t.touchObject.edgeHit = !1, !1 === t.options.infinite && (0 === t.currentSlide && "right" === o || t.currentSlide >= t.getDotCount() && "left" === o) && (r = t.touchObject.swipeLength * t.options.edgeFriction, t.touchObject.edgeHit = !0), !1 === t.options.vertical ? t.swipeLeft = i + r * s : t.swipeLeft = i + r * (t.$list.height() / t.listWidth) * s, !0 === t.options.verticalSwiping && (t.swipeLeft = i + r * s), !0 !== t.options.fade && !1 !== t.options.touchMove && (!0 === t.animating ? (t.swipeLeft = null, !1) : void t.setCSS(t.swipeLeft))))
     }, e.prototype.swipeStart = function(e) {
         var t = this,
             n;
         if (t.interrupted = !0, 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow) return t.touchObject = {}, !1;
         void 0 !== e.originalEvent && void 0 !== e.originalEvent.touches && (n = e.originalEvent.touches[0]), t.touchObject.startX = t.touchObject.curX = void 0 !== n ? n.pageX : e.clientX, t.touchObject.startY = t.touchObject.curY = void 0 !== n ? n.pageY : e.clientY, t.dragging = !0
     }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function() {
         var e = this;
         null !== e.$slidesCache && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.appendTo(e.$slideTrack), e.reinit())
     }, e.prototype.unload = function() {
         var e = this;
         $(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
     }, e.prototype.unslick = function(e) {
         var t = this;
         t.$slider.trigger("unslick", [t, e]), t.destroy()
     }, e.prototype.updateArrows = function() {
         var e = this,
             t;
         t = Math.floor(e.options.slidesToShow / 2), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && !e.options.infinite && (e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === e.currentSlide ? (e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - e.options.slidesToShow && !1 === e.options.centerMode ? (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - 1 && !0 === e.options.centerMode && (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
     }, e.prototype.updateDots = function() {
         var e = this;
         null !== e.$dots && (e.$dots.find("li").removeClass("slick-active").end(), e.$dots.find("li").eq(Math.floor(e.currentSlide / e.options.slidesToScroll)).addClass("slick-active"))
     }, e.prototype.visibility = function() {
         var e = this;
         e.options.autoplay && (document[e.hidden] ? e.interrupted = !0 : e.interrupted = !1)
     }, $.fn.slick = function() {
         var t = this,
             n = arguments[0],
             i = Array.prototype.slice.call(arguments, 1),
             o = t.length,
             r, s;
         for (r = 0; r < o; r++)
             if ("object" == typeof n || void 0 === n ? t[r].slick = new e(t[r], n) : s = t[r].slick[n].apply(t[r].slick, i), void 0 !== s) return s;
         return t
     }
 }), $(document).ready(function() {
     $(".quotes").slick({
         dots: !0,
         infinite: !0,
         autoplay: !0,
         autoplaySpeed: 6e3,
         speed: 800,
         slidesToShow: 1,
         adaptiveHeight: !0,
         prevArrow: '<div class="slick-prev"><</div>',
         nextArrow: '<div class="slick-next">></div>'
     })
 }), $(document).ready(function() {
     var e = {
             d: 1,
             h: 1,
             m: 59,
             s: 59
         },
         t = 120,
         n = 2,
         i = 24,
         o = 60,
         r = 60;
     setInterval(function() {
         $(".d").html(e.d), $(".h").html(e.h), $(".m").html(e.m).attr("data-t", e.m - 1), $(".s").html(e.s).attr("data-t", e.s - 1), e.s--, $(".s").addClass("flip"), $(".m").removeClass("flip"), $(".id .circle").css("stroke-dashoffset", t - 60 * e.d), $(".ih .circle").css("stroke-dashoffset", t - 5 * e.h), $(".im .circle").css("stroke-dashoffset", t - 2 * e.m), $(".is .circle").css("stroke-dashoffset", t - 2 * e.s), 58 === e.s && $(".m").addClass("flip"), 0 === e.s && (e.m--, e.s = 59, 0 === e.m && (e.h--, e.m = 59))
     }, 1e3)
 }), $(document).ready(function() {
     $(".popup-trigger").on("click", function(e) {
         e.preventDefault(), $(".popup").addClass("is-visible")
     }), $(".popup").on("click", function(e) {
         ($(e.target).is(".popup-close") || $(e.target).is(".popup")) && (e.preventDefault(), $(this).removeClass("is-visible"))
     }), $(document).keyup(function(e) {
         "27" == e.which && $(".popup").removeClass("is-visible")
     })
 });