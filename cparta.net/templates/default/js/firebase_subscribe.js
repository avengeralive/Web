
var config = {
  apiKey: "AIzaSyBug4Zcl0Qis79VDn_pO47zO8KeW2jOjv0",
  authDomain: "BlackDollar.firebaseapp.com",
  databaseURL: "https://BlackDollar.firebaseio.com",
  projectId: "BlackDollar",
  storageBucket: "BlackDollar.appspot.com",
  messagingSenderId: "1064927495097"
};
firebase.initializeApp(config);


function subscribe() {
    // запрашиваем разрешение на получение уведомлений
    messaging.requestPermission()
        .then(function () {
            // получаем ID устройства
            messaging.getToken()
                .then(function (currentToken) {
                    if (currentToken) {
                        sendTokenToServer(currentToken);
                    } else {
                        console.warn('Не удалось получить токен.');
                        setTokenSentToServer(false);
                    }
                })
                .catch(function (err) {
                    console.warn('При получении токена произошла ошибка.', err);
                    setTokenSentToServer(false);
                });
    })
    .catch(function (err) {
        console.warn('Не удалось получить разрешение на показ уведомлений.', err);
    });
}

// отправка ID на сервер
function sendTokenToServer(currentToken) {
    if (!isTokenSentToServer(currentToken)) {
        var url = '?push=save'; // адрес скрипта на сервере который сохраняет ID устройства
        $.post(url, {
            token: currentToken
        });
        setTokenSentToServer(currentToken);
    }
}

// используем localStorage для отметки того,
// что пользователь уже подписался на уведомления
function isTokenSentToServer(currentToken) {
    return window.localStorage.getItem('sentFirebaseMessagingToken') == currentToken;
}

function setTokenSentToServer(currentToken) {
    window.localStorage.setItem(
        'sentFirebaseMessagingToken',
        currentToken ? currentToken : ''
    );
}