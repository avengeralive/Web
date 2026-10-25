"use strict";
var api_host = "https://api.panaur.com";
var gcmServer = "https://android.googleapis.com/gcm/send/";
//var gcmServerFF = 'https://updates.push.services.mozilla.com/push/';


function endpointWorkaround(a) {
    //if (~a.indexOf(gcmServerFF)) {
//        var t = a.split(gcmServerFF);
//        return t[1];
//    } else {
        if (~a.indexOf(gcmServer)) {
            var b = a.split(gcmServer);
            return b[1]
        } else {
            return a
        }
  //  }
}
self.addEventListener("push", function (a) {
    a.waitUntil(self.registration.pushManager.getSubscription().then(function (c) {
        var b = null;
        if ("subscriptionId" in c) {
            b = c.subscriptionId
        } else {
            b = c.endpoint
        }
        b = endpointWorkaround(b);
        return fetch(api_host + "/message/" + b).then(function (d) {
            if (d.status !== 200) {
                throw new Error()
            }
            return d.json().then(function (l) {
                if (l.error || !l.notification) {
                    throw new Error()
                }
                if (l.notifications !== undefined) {
                    var e = false;
                    for (var h = 0; h < l.notifications.length; h++) {
                        var title = l.notifications[h].title;
                        var message = l.notifications[h].message;
                        var icon = l.notifications[h].icon;
                        var tag = l.notifications[h].tag;
                        var url = l.notifications[h].url;
                        e = self.registration.showNotification(title, {
                            body: msg,
                            icon: icon,
                            tag: tag + h,
                            data: {
                                redirectUrl: url
                            },
                            requireInteraction: true
                        })
                    }
                    return e
                } else {
                    var title = l.notification.title;
                    var msg = l.notification.message;
                    var icon = l.notification.icon;
                    var tag = l.notification.tag;
                    var url = l.notification.url;
                    return self.registration.showNotification(title, {
                        body: msg,
                        icon: icon,
                        tag: tag,
                        data: {
                            redirectUrl: url
                        },
                        requireInteraction: true
                    })
                }
            })
        })
    }))
});
self.addEventListener("notificationclick", function (event) {
    var target = event.notification.data.redirectUrl;
    event.notification.close();
    event.waitUntil(clients.matchAll({
        type: "window"
    }).then(function (clientList) {
        for (var i = 0; i < clientList.length; i++) {
            var client = clientList[i];
            if (client.url == "/" && "focus" in client) {
                return client.focus()
            }
        }
        if (clients.openWindow) {
            return clients.openWindow(target)
        }
    }))
});