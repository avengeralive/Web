import React, {Component} from 'react';
import {View, StyleSheet, YellowBox, ActivityIndicator} from 'react-native'
import { Icon } from 'react-native-elements'
import { StackNavigator } from 'react-navigation';
import Dashboard from './screens/Dashboard.js';
import LocationScreen from './screens/location/LocationScreen.js';
import AddLocationScreen from './screens/location/AddLocationScreen.js';
import ExchangesScreen from "./screens/exchange/ExchangesScreen";
import CreateExchangesScreen from "./screens/exchange/CreateExchangesScreen";
import GetCodeScreen from "./screens/auth/GetCodeScreen";
import ConfirmCodeScreen from "./screens/auth/ConfirmCodeScreen";
import User from "./components/user/User";
import UserSettingsScreen from "./screens/user/UserSettingsScreen";
import CameraScreen from "./screens/user/CameraScreen";
import logError from "./components/backend-logger/BackendLogger";
import firebase from 'react-native-firebase';
import FormDataHelper from "./helpers/FormDataHelper";
import ChatScreen from "./screens/messages/ChatScreen";
import ChatsListScreen from "./screens/messages/ChatsListScreen";

YellowBox.ignoreWarnings([
  'Warning: isMounted(...) is deprecated',
  "Warning: Can't call",
  'source.uri should not be an empty string',
]);

const navStyles = StyleSheet.create({
  navigationTopStyle: {
    backgroundColor: '#1eb9af',
  },
  navigationTopTitleStyle: {
    fontFamily: 'Roboto',
    fontWeight: 'bold',
    fontSize: 18,
    color: '#ffffff',
  },
});

export const UserContext = React.createContext();

export default class App extends Component {
  constructor(props) {
    super(props);

    this.setUser = this.setUser.bind(this);
    this.authLogoff = this.authLogoff.bind(this);
    this.authLogin = this.authLogin.bind(this);

    this.state = {
      hasToken: false,
      isLoaded: false,
      user: {},
    };
  }

  initFirebase = (user) => {
    // requesting notification permissions
    firebase.messaging().hasPermission()
        .then(enabled => {
          if (!enabled) {
            return firebase.messaging().requestPermission()
          }
        })
        .then(() => firebase.messaging().getToken())
        .then((token) => {
          return fetch('http://b.alphachange.ru/api/firebase-device?token=' + user.accessToken, {
            method: 'POST',
            headers: {
              Accept: 'application/json',
              'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: FormDataHelper.body({
              user_id: user.id,
              fcm_token: token,
            }),
          })
          .catch((error) => {
            alert("Error saving firebase token!\n" + error);
          });
        })
        .then(() => {
          this.notificationDisplayedListener = firebase.notifications().onNotificationDisplayed((notification: Notification) => {
            //alert(notification.body);
            // Process your notification as required
            // ANDROID: Remote notifications do not contain the channel ID. You will have to specify this manually if you'd like to re-display the notification.
          });
          this.notificationListener = firebase.notifications().onNotification((notification: Notification) => {
            //alert(notification.body);
            // Process your notification as required
          });
        })
        .then(() => {
          // Build a channel
          const channel = new firebase.notifications.Android.Channel('notification-channel', 'Notification Channel', firebase.notifications.Android.Importance.Max)
              .setDescription('Application notification channel');
          // Create the channel
          firebase.notifications().android.createChannel(channel);
        })
        .then(() => {
          this.tokenRefreshListener = firebase.messaging().onTokenRefresh(fcm_token => {
            return fetch('http://b.alphachange.ru/api/firebase-device/' + encodeURIComponent(fcm_token) + '?token=' + user.accessToken, {
              method: 'PUT',
              headers: {
                Accept: 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: FormDataHelper.body({
                // new fcm_token from firebase
                fcm_token: fcm_token,
              }),
            })
            .catch((error) => {
              alert("Error updating firebase token!\n" + error);
            });
          });
        })
        .catch((err) => {
          alert('initFirebase error: ' + err);
        });

  };

  componentDidMount() {
    User.get()
        .then((user) => {
          if(user) {
            console.log('logged in!');
            // initializing firebase
            this.initFirebase(user);
            return this.setState({
              hasToken: true,
              isLoaded: true,
              user: user,
            });
          } else {
            console.log('NOT logged in!');
            return this.setState({
              hasToken: false,
              isLoaded: true,
            });
          }
        })
        .catch((err)=> alert(err));
  }

  componentWillUnmount() {
    this.notificationDisplayedListener();
    this.notificationListener();
    this.tokenRefreshListener();
  }

  /**
   * Logoff
   */
  authLogoff() {
    this.setState({
      user: {},
      hasToken: false,
      isLoaded: true,
    });
  }

  /**
   * Login
   */
  authLogin() {
    this.setState({
      hasToken: false,
      isLoaded: false,
    });

    this.componentDidMount();
  }

  /**
   * @param user
   * @returns {*}
   */
  setUser(user) {
    return this.setState({
      user: user,
    })
  }

  render() {
    if (!this.state.isLoaded) {
      const indicatorStyle = {
        ...StyleSheet.absoluteFillObject,
        justifyContent: 'center',
        alignItems: 'center',
      };
      return (
          <View style={indicatorStyle}>
            <ActivityIndicator/>
          </View>
      )
    } else {
      if(this.state.hasToken) {
        const RootStack = StackNavigator({
              Dashboard: {
                screen: (props) => <Dashboard {...props} user={this.state.user}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Dashboard',
                  header: null,
                }),
              },
              UserSettings: {
                screen: (props) => <UserSettingsScreen {...props} user={this.state.user} setUser={this.setUser} authLogoff={this.authLogoff}/>,
                navigationOptions: ({navigation}) => {
                  if (navigation.getParam('firstTime', false)) {
                    return {
                      title: 'User settings',
                      header: null,
                    };
                  }
                  else {
                    return {
                      title: 'User settings',
                      //headerLeft: navigation.getParam('firstTime', false) ? '' : <Icon name={'arrow-left'} onPress={ () => { navigation.goBack() }} />,
                      headerStyle: navStyles.navigationTopStyle,
                      headerTitleStyle: navStyles.navigationTopTitleStyle,
                      headerTintColor: '#ffffff',
                    };
                  }
                },
              },
              Camera: {
                screen: (props) => <CameraScreen {...props} user={this.state.user} setUser={this.setUser}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Take photo',
                  header: null,
                }),
              },
              Locations: {
                screen: (props) => <LocationScreen {...props} user={this.state.user}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'My locations',
                  headerStyle: navStyles.navigationTopStyle,
                  headerTitleStyle: navStyles.navigationTopTitleStyle,
                  headerTintColor: '#ffffff',
                }),
              },
              AddLocation: {
                screen: (props) => <AddLocationScreen {...props} user={this.state.user}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Create location',
                  headerStyle: navStyles.navigationTopStyle,
                  headerTitleStyle: navStyles.navigationTopTitleStyle,
                  headerTintColor: '#ffffff',
                }),
              },
              Exchanges: {
                screen: (props) => <ExchangesScreen {...props} user={this.state.user}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Exchanges list',
                  headerStyle: navStyles.navigationTopStyle,
                  headerTitleStyle: navStyles.navigationTopTitleStyle,
                  headerTintColor: '#ffffff',
                }),
              },
              CreateExchanges: {
                screen: (props) => <CreateExchangesScreen {...props} user={this.state.user}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Create exchange',
                  headerStyle: navStyles.navigationTopStyle,
                  headerTitleStyle: navStyles.navigationTopTitleStyle,
                  headerTintColor: '#ffffff',
                }),
              },
              ChatsList: {
                screen: (props) => <ChatsListScreen {...props} user={this.state.user}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Conversations',
                  headerStyle: navStyles.navigationTopStyle,
                  headerTitleStyle: navStyles.navigationTopTitleStyle,
                  headerTintColor: '#ffffff',
                }),
              },
              Chat: {
                screen: (props) => <ChatScreen {...props} user={this.state.user} chatId={'test-chat'}/>,
                navigationOptions: ({navigation}) => ({
                  title: 'Chat',
                  headerStyle: navStyles.navigationTopStyle,
                  headerTitleStyle: navStyles.navigationTopTitleStyle,
                  headerTintColor: '#ffffff',
                }),
              },
            },
            {
              initialRouteName: 'Dashboard',
              headerMode: 'screen',
            }
        );
        return <UserContext.Provider value={this.state.user}>
          <RootStack/>
        </UserContext.Provider>
      }
      else {
        const AuthStack = StackNavigator({
          GetCode: {
            screen: GetCodeScreen,
            navigationOptions: ({navigation}) => ({
              title: 'Sign in',
              header: null,
            }),
          },
          ConfirmCode: {
            screen: (props) => <ConfirmCodeScreen {...props} authLogin={this.authLogin}/>,
            navigationOptions: ({navigation}) => ({
              title: 'Confirm',
              header: null,
            }),
          },
        });
        return <AuthStack/>;
      }
    }
  }
}