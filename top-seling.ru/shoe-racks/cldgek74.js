(function () {
    var _id = "30c72822413a4d4b510f111e4e45044d";
    while (document.getElementById("timer" + _id)) _id = _id + "0";
    document.write("<div id='timer" + _id + "' style=''></div>");
    var _t = document.createElement("script");
    _t.src = "//megatimer.ru/timer/timer.min.js";
    var _f = function (_k) {
        var l = new MegaTimer(_id, {
            "view": [0, 1, 1, 1],
            "type": {
                "currentType": "2",
                "params": {"startByFirst": true, "days": "0", "hours": "5", "minutes": "15", "utc": 0}
            },
            "design": {
                "type": "plate",
                "params": {
                    "round": "18",
                    "background": "solid",
                    "background-color": "#ff3636",
                    "effect": "flipchart",
                    "space": "0",
                    "separator-margin": "11",
                    "number-font-family": {
                        "family": "Open Sans",
                        "link": "<link href='//fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>"
                    },
                    "number-font-size": "24",
                    "number-font-color": "#ffffff",
                    "padding": "9",
                    "separator-on": true,
                    "separator-text": ":",
                    "text-on": true,
                    "text-font-family": {
                        "family": "Open Sans",
                        "link": "<link href='//fonts.googleapis.com/css?family=Open+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>"
                    },
                    "text-font-size": "12",
                    "text-font-color": "#000000"
                }
            },
            "designId": 2,
            "theme": "white",
            "width": 200,
            "height": 40
        });
        if (_k != null) l.run();
    };
    _t.onload = _f;
    _t.onreadystatechange = function () {
        if (_t.readyState == "loaded") _f(1);
    };
    var _h = document.head || document.getElementsByTagName("head")[0];
    _h.appendChild(_t);
}).call(this);