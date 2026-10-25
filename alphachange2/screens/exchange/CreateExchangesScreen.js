import React, {Component} from 'react';
import {StyleSheet, Text, TextInput, TouchableHighlight, View, ScrollView, Picker} from 'react-native';
import BottomNavbar from "../../components/bottom-navbar/BottomNavbar";
import CurrencySelectNative from "../../components/currencies/CurrencySelectNative";
import { FormLabel, FormInput, FormValidationMessage } from 'react-native-elements'
import FormDataHelper from "../../helpers/FormDataHelper";
import {withNavigation} from 'react-navigation';

export default class CreateExchangesScreen extends withNavigation(Component) {
  constructor(props) {
    super(props);

    this.state = {
      currencyGive: null,
      currencyGiveSign: null,
      currencyNeed: null,
      currencyNeedSign: null,
      minAmount: null,
      maxAmount: null,
      location: 0,
      rate: null, // TODO: add default rate from `currency_rate` table
      Locations: [],
    };

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


  }

  onPress = () => {
    const params = {
      user_id: this.props.user.id,
      currency_need: this.state.currencyNeed,
      currency_give: this.state.currencyGive,
      location_id: this.state.location,
      name: '',
      total_amount: this.state.maxAmount,
      max_amount: this.state.maxAmount,
      min_amount: this.state.minAmount,
      exchange_rate: this.state.rate,
    };

    fetch('http://b.alphachange.ru/api/exchange?token=' + this.props.user.accessToken, {
      method: 'POST',
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
      this.props.navigation.navigate('Dashboard', {
        activeTab: 1,
      });
    })
    .catch((error) => {
      alert("Error creating exchange!\n" + error);
    });
  };

  render() {
    return (
        <View style={this.styles.container}>
          <ScrollView
            style={this.styles.scrollContainer}
            contentContainerStyle={this.styles.scrollContentContainer}
          >
            <View style={this.styles.marginContainer}>
              <Text style={this.styles.labelStyle}>Currency you give</Text>
              <CurrencySelectNative
                  {...this.props}
                  onPress={(currency) => {
                    this.setState({
                      currencyGive: currency.id,
                      currencyGiveSign: currency.sign,
                    });
                    return true;
                  }}
              />
              <TextInput
                  style={this.styles.textboxHiddenStyle}
                  value={String(this.state.currencyNeed)}
              />
            </View>

            <View style={[this.styles.textBoxContainer, this.styles.borderBottom]}>
              <FormInput
                  placeholder='Min amount'
                  placeholderTextColor='rgb(155,155,155)'
                  underlineColorAndroid='rgba(0,0,0,0)'
                  style={this.styles.textBox}
                  containerStyle={this.styles.textBoxWrap}
                  keyboardType='numeric'
                  value={this.state.minAmount}
                  onChangeText={(text) => this.setState({minAmount: text})}
              />
            </View>
            <View style={[this.styles.textBoxContainer, this.styles.marginContainer]}>
              <FormInput
                  placeholder='Max amount'
                  placeholderTextColor='rgb(155,155,155)'
                  underlineColorAndroid='rgba(0,0,0,0)'
                  style={this.styles.textBox}
                  containerStyle={this.styles.textBoxWrap}
                  keyboardType='numeric'
                  value={this.state.maxAmount}
                  onChangeText={(text) => this.setState({maxAmount: text})}
              />
            </View>

            <View style={this.styles.marginContainer}>
              <Text style={this.styles.labelStyle}>Currency you receive</Text>
              <CurrencySelectNative
                  {...this.props}
                  onPress={(currency) => {
                    this.setState({
                      currencyNeed: currency.id,
                      currencyNeedSign: currency.sign,
                    });
                    return true;
                  }}
              />
              <TextInput
                  style={this.styles.textboxHiddenStyle}
                  value={String(this.state.currencyNeed)}
              />
            </View>

            <View style={[this.styles.textBoxContainer, this.styles.borderBottom]}>
              <FormInput
                  placeholder='Exchange rate'
                  placeholderTextColor='rgb(155,155,155)'
                  underlineColorAndroid='rgba(0,0,0,0)'
                  style={this.styles.textBox}
                  containerStyle={this.styles.textBoxWrap}
                  keyboardType='numeric'
                  value={this.state.rate}
                  onChangeText={(text) => this.setState({rate: text})}
              />
            </View>

            <View style={[this.styles.selectContainer, this.styles.marginContainer]}>
              <Picker
                  style={this.styles.textBoxContainer}
                  selectedValue={this.state.location}
                  onValueChange={(itemValue, itemIndex) => this.setState({location: itemValue})}
              >
                <Picker.Item key='0' label="Select location" value="0" />
                {
                  this.state.Locations.map((location) => <Picker.Item key={location.id} label={location.title} value={location.id} />)
                }
              </Picker>
            </View>

            <TouchableHighlight style={this.styles.button}
              underlayColor='#99d9f4'
              onPress={() => this.onPress()}
            >
              <Text style={this.styles.buttonText}>Create</Text>
            </TouchableHighlight>
          </ScrollView>

          <BottomNavbar activeTab={2}/>
        </View>
    )
  }

  styles = StyleSheet.create({
    container: {
      flex: 1,
      justifyContent: 'center',
      paddingBottom: 50,
    },
    scrollContainer: {

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
    }
  });
};


