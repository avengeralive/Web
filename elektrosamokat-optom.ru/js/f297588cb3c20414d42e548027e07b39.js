(function() {
    var _id = "f297588cb3c20414d42e548027e07b39";
    while (document.getElementById("timer" + _id)) _id = _id + "0";
    document.write("<div id='timer" + _id + "' style='min-width:392px;height:92px;'></div>");
    var _t = document.createElement("script");
    _t.src = "js/timer.min.js";
    var _f = function(_k) {
        var l = new MegaTimer(_id, {
            "view": [1, 1, 1, 1],
            "type": {
                "currentType": "3",
                "params": {
                    "weekdays": [1, 1, 1, 1, 1, 1, 1],
                    "usertime": true,
                    "time": "00:00",
                    "tz": -180,
                    "hours": "24",
                    "minutes": "0"
                }
            },
            "design": {
                "type": "circle",
                "params": {
                    "width": "8",
                    "radius": "37",
                    "line": "gradient",
                    "line-color": ["#fb1a1b", "#df238c"],
                    "background": "solid",
                    "background-color": "rgba(251,26,27,0.24)",
                    "direction": "direct",
                    "number-font-family": {
                        "family": "Comfortaa",
                        "link": "<link href='http://fonts.googleapis.com/css?family=Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>"
                    },
                    "number-font-size": "39",
                    "number-font-color": "#ffffff",
                    "separator-margin": "4",
                    "separator-on": false,
                    "separator-text": ":",
                    "text-on": true,
                    "text-font-family": {
                        "family": "Comfortaa",
                        "link": "<link href='http://fonts.googleapis.com/css?family=Comfortaa&subset=latin,cyrillic' rel='stylesheet' type='text/css'>"
                    },
                    "text-font-size": "13",
                    "text-font-color": "#ffffff"
                }
            },
            "designId": 9,
            "theme": "black",
            "width": 392,
            "height": 92
        });
        if (_k != null) l.run();
    };
    _t.onload = _f;
    _t.onreadystatechange = function() {
        if (_t.readyState == "loaded") _f(1);
    };
    var _h = document.head || document.getElementsByTagName("head")[0];
    _h.appendChild(_t);
}).call(this);