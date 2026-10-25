const ReactNative = require('react-native');
const {
  AsyncStorage,
} = ReactNative;

const STORAGE_KEY = 'alphaUser';
const STORAGE_CACHE_TIME = 3600;

/**
 * Authentificated user class
 */
class User {
  static login(user_id, token) {
    console.log('login');
    return this._getFromServer({
          id: user_id,
          accessToken: token,
        })
        .then((user) => {
          console.log('login user');
          console.log(user);
          return this._saveToStorage(user)
        })
        .catch((err) => console.log(err));
  }

  static logout() {
    console.log('logout');
    return this._removeFromStorage();
  }

  static get() {
    console.log('get');
    return this._getFromStorage();
  }

  static update() {
    console.log('update');
    return this._updateFromServer();
  }

  static _saveToStorage(user) {
    console.log('_saveToStorage');
    const cache = {
      user: user,
      cacheTime: (Date.now() + STORAGE_CACHE_TIME),
    };
    return AsyncStorage.setItem(STORAGE_KEY, JSON.stringify(cache));
  }

  static _updateFromServer() {
    console.log('_getFromStorage');
    return new Promise((resolve, reject) => {
      AsyncStorage.getItem(STORAGE_KEY)
          .then(res => {
            if (res !== null) {
              console.log(res);
              return res;
            } else {
              console.log('no cache');
              resolve(false);
            }
          })
          .then((cacheJson) => {
            try {
              const cache = JSON.parse(cacheJson);
              if(!('user' in cache && 'cacheTime' in cache)) {
                throw 'Wrong cache format';
              }
              return cache;
            }
            catch(error) {
              resolve(false)
            }
          })
          .then((cache) => {
            return this._getFromServer(cache.user)
                .then((user) => {
                  this._saveToStorage(user);
                  return user;
                })
                .catch(err => reject(err));

          })
          .then((user) => {
            console.log('resolving');
            console.log(user);
            resolve(user)
          })
          .catch((err) => {
            console.log(err);
            reject(err)
          });
    });
  }



  static _getFromStorage() {
    console.log('_getFromStorage');
    return new Promise((resolve, reject) => {
      AsyncStorage.getItem(STORAGE_KEY)
          .then(res => {
            if (res !== null) {
              console.log(res);
              return res;
            } else {
              console.log('no cache');
              resolve(false);
            }
          })
          .then((cacheJson) => {
            try {
              const cache = JSON.parse(cacheJson);
              if(!('user' in cache && 'cacheTime' in cache)) {
                throw 'Wrong cache format';
              }
              return cache;
            }
            catch(error) {
              resolve(false)
            }
          })
          .then((cache) => {
            if(Date.now() > cache.cacheTime) {
              return this._getFromServer(cache.user)
                  .then((user) => {
                    this._saveToStorage(user);
                    return user;
                  })
                  .catch(err => reject(err));
            }
            else {
             return cache.user
            }
          })
          .then((user) => {
            console.log('resolving');
            console.log(user);
            resolve(user)
          })
          .catch((err) => {
            console.log(err);
            reject(err)
          });
    });
  }

  static _getFromServer(user) {
    console.log('_getFromServer');
    return fetch('http://b.alphachange.ru/api/user/' + user.id + '?token=' + user.accessToken + '&expand=settings,settings.defaultLocation,settings.defaultCurrency')
        .then((userJson) => userJson.json())
        .then((user) => {
          console.log(user);
          return user;
        })
        .catch((err) => console.log(err));
  };

  static _removeFromStorage() {
    console.log('_removeFromStorage');
    return AsyncStorage.removeItem(STORAGE_KEY);
  }
}

export default User