import React, {Component} from 'react';
import {StyleSheet, Text, TextInput, TouchableHighlight, View, ScrollView, Picker, Alert} from 'react-native';
import BottomNavbar from "../../components/bottom-navbar/BottomNavbar";
import CurrencySelect from "../../components/currencies/CurrencySelect";
import { FormLabel, FormInput, FormValidationMessage } from 'react-native-elements'
import FormDataHelper from "../../helpers/FormDataHelper";
import {withNavigation} from 'react-navigation';
import User from "../../components/user/User";
import CurrencySelectNative from "../../components/currencies/CurrencySelectNative";

export default class UserSettingsScreen extends withNavigation(Component) {
  constructor(props) {
    super(props);

    this.state = {
      defaultLocation: this.props.user.settings.defaultLocation,
      defaultCurrency: this.props.user.settings.defaultCurrency,
      timezone: this.props.user.settings.timezone,
      language: this.props.user.settings.language,
      name: this.props.user.settings.name,
      bio: this.props.user.settings.bio,

      Locations: [],
      Timezones: [],
      Languages: [],

      firstTimeShow: this.props.navigation.getParam('firstTime', false),
    };
  }

  componentDidMount() {
    // fetching locations
    fetch('http://b.alphachange.ru/api/location?token=' + this.props.user.accessToken + '&user_id=' + this.props.user.id)
        .then((response) => response.json())
        .then((responseJson) => {
          let locs = [];
          //alert(JSON.stringify(responseJson));
          responseJson.map((location) => {
            locs.push({
              id: location.id,
              title: location.name,
            })
          });
          this.setState({Locations: locs})
        })
        .catch((error) => {
          alert(error);
        });

    // fetching timezones
    fetch('http://b.alphachange.ru/api/endpoint/timezone?token=' + this.props.user.accessToken)
        .then((response) => response.json())
        .then((responseJson) => {
          let timezones = [];
          responseJson.map((timezone) => {
            timezones.push(timezone)
          });
          this.setState({Timezones: timezones})
        })
        .catch((error) => {
          alert(error);
        });

    // fetching languages
    // TODO: сделать забор списка языков из бэкенда
    this.setState({Languages: [
      {
        id: 'en-US',
        title: 'English',
      },
    ]});
  }

  onPress = () => {
    const params = {
      default_currency_id: this.state.defaultCurrency.id,
      timezone: this.state.timezone,
      language: this.state.language,
      name: this.state.name,
      bio: this.state.bio,
    };

    if(this.state.defaultLocation) {
      params.default_location_id = this.state.defaultLocation.id;
    }

    fetch('http://b.alphachange.ru/api/user-settings/' + this.props.user.id + '?token=' + this.props.user.accessToken, {
      method: 'PUT',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: FormDataHelper.body(params),
    })
    .then((response) => {
      return response.json()
    })
    .then((responseJson) => {
      // updating user in storage from server with new settings data
      return User.update()
    })
    .then((user) => {
     return fetch('http://b.alphachange.ru/api/user-settings/' + this.props.user.settings.id + '?expand=defaultLocation,defaultCurrency&token=' + this.props.user.accessToken)
          .then((response) => {
            return response.json()
          })
          .then((userSettings) => {
            const updatedUser = this.props.user;
            updatedUser.settings = userSettings;
            return this.props.setUser(updatedUser);
          })
          .catch((err) => alert(err));
    })
    .then(() => {
      if(this.state.firstTimeShow) {
        this.props.navigation.navigate('Camera');
      }
      else {
        this.props.navigation.navigate('Dashboard', {
          activeTab: 1,
        });
      }
    })
    .catch((error) => {
      alert("Error saving settings!\n" + error);
    });
  }     ;

  render() {
    return (
        <View style={this.styles.container}>
          <ScrollView
            style={this.state.firstTimeShow ? {} : this.styles.scrollContainer}
            contentContainerStyle={this.styles.scrollContentContainer}
          >
            {this.state.firstTimeShow && <View style={this.styles.alertContainer}>
              <Text style={this.styles.alertTextTitle}>
                Welcome!
              </Text>
              <Text style={this.styles.alertText}>
                Please set up your account settings first.
              </Text>
            </View>}

            <View style={[this.styles.textBoxContainer, this.styles.borderBottom]}>
              <FormInput
                  placeholder='Name'
                  placeholderTextColor='rgb(155,155,155)'
                  style={this.styles.textBox}
                  containerStyle={this.styles.textBoxWrap}
                  value={this.state.name}
                  onChangeText={(text) => this.setState({name: text})}
              />
            </View>

            <View style={[this.styles.textBoxContainer, this.styles.marginContainer]}>
              <FormInput
                  multiline
                  placeholder='Bio'
                  placeholderTextColor='rgb(155,155,155)'
                  style={this.styles.textBox}
                  containerStyle={this.styles.textBoxWrap}
                  value={this.state.bio}
                  onChangeText={(text) => this.setState({bio: text})}
              />
            </View>

            {!this.state.firstTimeShow && <View style={[this.styles.selectContainer, this.styles.marginContainer]}>
              <Picker
                  style={this.styles.textBoxContainer}
                  selectedValue={this.state.location}
                  onValueChange={(itemValue, itemIndex) => this.setState({location: itemValue})}
              >
                <Picker.Item key='0' label="Default location" value="0" />
                {
                  this.state.Locations.map((location) => <Picker.Item key={location.id} label={location.title} value={location.id} />)
                }
              </Picker>
            </View>}

            <View style={this.styles.marginContainer}>
              <Text style={this.styles.labelStyle}>Default currency</Text>
              <CurrencySelectNative
                  {...this.props}
                  currency={this.state.defaultCurrency}
                  onPress={(currency) => {
                    this.setState({
                      defaultCurrency: currency,
                    });
                    return true;
                  }}
              />
            </View>

            <View style={[this.styles.selectContainer, this.styles.marginContainer]}>
              <Picker
                  style={this.styles.textBoxContainer}
                  selectedValue={this.state.language}
                  onValueChange={(itemValue, itemIndex) => this.setState({language: itemValue})}
              >
                <Picker.Item key='0' label="Language" value="0" />
                {
                  this.state.Languages.map((language) => <Picker.Item key={'key'+language.id} label={language.title} value={language.id} />)
                }
              </Picker>
            </View>

            <View style={[this.styles.selectContainer, this.styles.marginContainer]}>
              <Picker
                  style={this.styles.textBoxContainer}
                  selectedValue={this.state.timezone}
                  onValueChange={(itemValue, itemIndex) => this.setState({timezone: itemValue})}
              >
                <Picker.Item key='0' label="Timezone" value="0" />
                {
                  this.state.Timezones.map((timezone) => <Picker.Item key={timezone} label={timezone} value={timezone} />)
                }
              </Picker>
            </View>

            <TouchableHighlight style={this.styles.button}
              underlayColor='#99d9f4'
              onPress={() => this.onPress()}
            >
              <Text style={this.styles.buttonText}>Save settings</Text>
            </TouchableHighlight>

            {!this.state.firstTimeShow && <TouchableHighlight style={this.styles.logoutButton}
                                underlayColor='transparent'
                                onPress={() => {
                                  Alert.alert(
                                      'Logout',
                                      'Are you sure you want to logout?',
                                      [
                                        {text: 'No', onPress: () => console.log('logout cancelled')},
                                        {
                                          text: 'Yes', onPress: () => {
                                            console.log('logout');
                                            User.logout()
                                                .then(() => {
                                                  return this.props.authLogoff()
                                                })
                                                .catch((err) => alert(err));
                                          }
                                        },
                                      ],
                                      {cancelable: false}
                                  )
                                }}
            >
              <Text style={this.styles.logoutButtonText}>Logout</Text>
            </TouchableHighlight>}

          </ScrollView>

          {!this.state.firstTimeShow && <BottomNavbar activeTab={2}/>}
        </View>
    )
  }

  styles = StyleSheet.create({
    container: {
      flex: 1,
      justifyContent: 'center',
    },
    scrollContainer: {
      marginBottom: 50,
    },
    scrollContentContainer: {
      justifyContent: 'flex-start',
      padding: 12,
      position: 'absolute',
      top: 0,
      left: 0,
      right: 0,
      bottom: 0,
      //height: (height(90) - 40),
    },
    marginContainer: {
      marginBottom: 8,
    },
    textBoxContainer: {
      backgroundColor: '#ffffff',
    },
    textBoxWrap: {
      marginLeft: 7,
      marginRight: 7,
      minHeight: 32,
    },
    borderBottom: {
      borderBottomColor: 'rgb(226,226,226)',
      borderBottomWidth: 1,
    },
    textBox: {
      fontSize: 16,
    },
    textboxHiddenStyle: {
      display: 'none',
    },
    picker: {
      color: 'rgb(74,74,74)',
    },
    alertContainer: {
      marginBottom: 12,
      marginTop: 6,
      alignItems: 'center',
    },
    alertTextTitle: {
      textAlign: 'center',
      fontFamily: 'Roboto',
      //fontWeight: 'bold',
      fontSize: 18,
      color: 'rgb(30, 81, 197)',
    },
    alertText: {
      textAlign: 'center',
      fontFamily: 'Roboto',
      //fontWeight: 'bold',
      fontSize: 16,
      color: 'rgb(30, 81, 197)',
    },
    labelStyle: {
      color: 'rgb(155,155,155)',
      fontSize: 16,
    },
    buttonText: {
      fontSize: 18,
      color: '#FFFFFF',
      fontFamily: 'Roboto-bold',
      fontWeight: 'bold',
    },
    button: {
      borderRadius: 20,
      marginTop: 6,
      backgroundColor: '#1eb9af',
      height: 44,
      justifyContent: 'center',           // Center vertically
      alignItems: 'center',               // Center horizontally
      paddingHorizontal: 32,
      marginHorizontal: 48,
    },
    logoutButtonText: {
      fontSize: 18,
      color: 'rgb(30, 81, 197)',
      fontFamily: 'Roboto-bold',
      fontWeight: 'bold',
    },
    logoutButton: {
      borderRadius: 20,
      marginTop: 6,
      backgroundColor: 'transparent',
      borderWidth: 1,
      borderColor: 'rgb(30, 81, 197)',
      height: 44,
      justifyContent: 'center',           // Center vertically
      alignItems: 'center',               // Center horizontally
      paddingHorizontal: 32,
      marginHorizontal: 48,
    },
  });
};


