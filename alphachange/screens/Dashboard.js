import React, {Component} from 'react';
import {
  StyleSheet,
  Text,
  View,
  Image,
  TouchableOpacity,
} from 'react-native';
import LinearGradient from 'react-native-linear-gradient';
import BottomNavbar from '../components/bottom-navbar/BottomNavbar.js'
import DashboardInfo from '../components/dashboard-info/DashboardInfo.js'
import Tabs from '../components/tabs/Tabs.js'
import Locations from '../components/locations/Locations.js'
import History from "../components/history/History";
import Currencies from "../components/currencies/Currencies";
import {withNavigation} from "react-navigation";
import UserRating from "../components/user-rating/UserRating";
import logError from "../components/backend-logger/BackendLogger";

export default class Dashboard extends withNavigation(Component) {
  constructor(props) {
    super(props);

    this.state = {
      favorites: 0,
      amountChanged: 0,
      deals: 0,
    };
  }

  componentDidMount() {
    // if needed settings are not set - redirect to User Settings
    if(this.props.user.settings.name === null || this.props.user.settings.default_currency_id === null) {
      this.props.navigation.navigate('UserSettings', {
        firstTime: true,
      });
    }
    // loading dashboard info data
    this.loadStats();
  }

  /**
   * Load dashboard info
   */
  loadStats = () => {
    fetch('http://b.alphachange.ru/api/endpoint/user-stats?token=' + this.props.user.accessToken)
        .then((response) => response.json())
        .then((responseJson) => {
          this.setState({
            favorites: responseJson.favorites,
            amountChanged: responseJson.amount_changed,
            deals: responseJson.deals,
          });
        })
        .catch((error) => {
          alert(error);
        });
  };

  render() {
    const { navigation } = this.props;
    return (
      <View style={styles.container}>
        <LinearGradient
            start={{x: 0.0, y: 0.0}} end={{x: 0.0, y: 1.0}}
            locations={[0.0, 1.0]}
            colors={['#1eb9af', '#46cdc3']}
            style={styles.top}
        >
          {/* User avatar */}
          <TouchableOpacity
              style={styles.avatarWrap}
              onPress={() => {
                this.props.navigation.navigate('Camera');
              }}
          >
            <Image
                source={{uri: ('object' === typeof this.props.user.settings) ? 'http://b.alphachange.ru/' + this.props.user.settings.avatar/* + '?cacheToken=' + Date.now()*/ : 'http://b.alphachange.ru/images/empty_profile.png'}}
                style={styles.avatar}
            />
          </TouchableOpacity>
          <Image source="http://b.alphachange.ru/edit.png" style={styles.editIcon} onPress={() => {this.props.navigation.navigate('UserSettings'); }} />

          {/* User name/title */}
          <Text
              style={styles.profileName}
              onPress={() => {
                this.props.navigation.navigate('UserSettings');
              }}
          >
            {'object' === typeof this.props.user.settings && this.props.user.settings.name}
          </Text>

          {/*<Text style={styles.profileTitle}>
            Your rank - broker
          </Text>*/}
          <UserRating
              rating={0}
          />

          {/* User infographics */}
          <DashboardInfo
              {...this.props}
            favorites={this.state.favorites}
            total={this.state.amountChanged}
            deals={this.state.deals}
          />
        </LinearGradient>

        {/* Scrollable tabs (dashboard main content) */}
        <View style={styles.tabContainer}>
          <Tabs activeTab={navigation.getParam('activeTab', 1)}>

            <View title="Currency rates" style={styles.tabContent}>
              <Currencies {...this.props} showRates={true}/>
              <LinearGradient className={(activeTab==0)?"active":""}
                start={{x: 0.0, y: 0.0}} end={{x: 0.0, y: 1.0}}
                locations={[0.0, 1.0]}
                colors={['#1eb9af', '#46cdc3']}
                style={styles.activeTabStyle}
              >
              </LinearGradient>
            </View>

            <View title="History" style={styles.tabContent}>
              <History {...this.props}/>
              <LinearGradient className={(activeTab==1)?"active":""}
                start={{x: 0.0, y: 0.0}} end={{x: 0.0, y: 1.0}}
                locations={[0.0, 1.0]}
                colors={['#1eb9af', '#46cdc3']}
                style={styles.activeTabStyle}
              >
              </LinearGradient>
            </View>

            <View title="Locations" style={styles.tabContent}>
              <Locations {...this.props}/>
              <LinearGradient className={(activeTab==2)?"active":""}
                start={{x: 0.0, y: 0.0}} end={{x: 0.0, y: 1.0}}
                locations={[0.0, 1.0]}
                colors={['#1eb9af', '#46cdc3']}
                style={styles.activeTabStyle}
              >
              </LinearGradient>
            </View>

          </Tabs>
        </View>

        {/* Bottom navigation */}
        <BottomNavbar activeTab={0}/>
      </View>
  );
  }
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    //alignItems: 'center',
    backgroundColor: '#F5FCFF',
  },
  top: {
    flex: 282,
    justifyContent: 'center',
    alignItems: 'center',
    alignContent: 'center',
    width: '100%',
  },
  profileName: {
    flex: 1,
    color: '#ffffff',
    fontSize: 26,
    fontFamily: 'Roboto',
  },
  profileTitle: {
    flex: 1,
    color: '#ffffff',
    fontSize: 14,
    lineHeight: 26,
    fontFamily: 'Roboto',
  },
  avatarWrap: {
    //borderWidth:1,
    alignItems:'center',
    justifyContent:'flex-end',
    paddingBottom: 10,
    width:80,
    height:80,
    borderRadius:100,
    flex: 3,
  },
  avatar: {
    width: 80,
    height: 80,
    resizeMode: Image.resizeMode.stretchs,
    borderRadius:100,
  },

  editIcon: {
    width: 20,
    height: 20,
  },
  activeTabStyle {
    flex: 282,
    justifyContent: 'center',
    alignItems: 'center',
    alignContent: 'center',
    width: '100%',
    height: 3px,
  },

  // TABS
  tabContainer: {
    flex: 330,
  },
  tabContent: {
    flex: 1,                            // Take up all available space
    justifyContent: 'flex-start',           // Center vertically
    //alignItems: 'center',               // Center horizontally
    backgroundColor: 'rgb(242, 242, 242)',         // Darker background for content area
    marginBottom: 60,
  },

});
