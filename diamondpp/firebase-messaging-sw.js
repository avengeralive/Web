// firebase-messaging-sw.js
importScripts('https://www.gstatic.com/firebasejs/3.6.8/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/3.6.8/firebase-messaging.js');

var config = {
  apiKey: "AAAA9_KgA7k:APA91bH7uanCMeKlp3DtsE4uOUcuysxachYSTQLVs0vSl36RsUT7ECgXGg3r04h39o0TxtBijIkVkZGdPkP8Xij2Lt5nHgdR9PnnuBz6Uzp_4lZBlCEwP0_4e9RDOpTxBJ1_HI31R7Dx0490epxziOqeBtmY3SDIjQ",
  authDomain: "yes-cpa.com",
  databaseURL: "https://yes-cpa.com",
  projectId: "yes-cpa",
  storageBucket: "yes-cpa.com",
  messagingSenderId: "1064927495097"
};
firebase.initializeApp(config);

const messaging = firebase.messaging();

// Customize notification handler
messaging.setBackgroundMessageHandler(function(payload) {
  console.log('Handling background message', payload);

  // Copy data object to get parameters in the click handler
  payload.data.data = JSON.parse(JSON.stringify(payload.data));

  return self.registration.showNotification(payload.data.title, payload.data);
});

self.addEventListener('notificationclick', function(event) {
  const target = event.notification.data.click_action || '/';
  event.notification.close();

  // This looks to see if the current is already open and focuses if it is
  event.waitUntil(clients.matchAll({
    type: 'window',
    includeUncontrolled: true
  }).then(function(clientList) {
    // clientList always is empty?!
    for (var i = 0; i < clientList.length; i++) {
      var client = clientList[i];
      if (client.url === target && 'focus' in client) {
        return client.focus();
      }
    }

    return clients.openWindow(target);
  }));
});
