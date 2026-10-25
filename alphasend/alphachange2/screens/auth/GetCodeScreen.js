
/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 * @flow
 */

import React, {Component} from 'react';
import {StyleSheet, Text, TextInput, TouchableHighlight, View, ScrollView, Picker, Image} from 'react-native';
import LinearGradient from 'react-native-linear-gradient';
import { FormLabel, FormInput, FormValidationMessage, Avatar, Button } from 'react-native-elements';
import { width, height } from 'react-native-dimension';

export default class GetCodeScreen extends Component {
  constructor(props) {
    super(props);

    this.state = {
      phone: '',
    };
  }

  auth() {
    params = {
      phone: this.state.phone,
    };
    fetch('http://b.alphachange.ru/api/auth/auth', {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(params),
    })
        .then((response) => {
          return response.json()
        })
        .then((responseJson) => {
          if(responseJson.status === 'ok') {
            this.props.navigation.navigate('ConfirmCode', {
              phone: this.state.phone,
            });
          }
          else {
            throw 'Failed!\n' + responseJson.message;
          }
        })
        .catch((error) => {
          alert("Authentification error!\n" + error);
        });
  }

  render() {
    return (
        <View style={this.styles.container}>
          <LinearGradient
              start={{x: 0.0, y: 0.0}} end={{x: 0.0, y: 1.0}}
              locations={[0.0,1.0]}
              colors={['rgb(109, 220, 215)', 'rgb(70, 205, 195)']}
              style={this.styles.gradient}
          >
            <View style={this.styles.logoShadow}>
              <View style={this.styles.logoWrap}>
                <Image
                    source={require('../../assets/images/logo.png')}
                    style={this.styles.logo}
                    borderRadius={60}
                />
              </View>
            </View>
            <View style={this.styles.textBoxShadow}>
              <View style={this.styles.textBoxWrap}>
                <TextInput
                    placeholder='Phone'
                    placeholderTextColor='rgb(155,155,155)'
                    underlineColorAndroid='rgba(0,0,0,0)'
                    style={this.styles.textBox}
                    onChangeText={(text) => this.setState({phone: text})}
                    value={this.state.phone}
                />
              </View>
            </View>

            <Button
                title='Sign in'
                backgroundColor={this.state.phone.length ? 'rgb(30, 81, 197)' : 'rgb(178, 178, 178)'}
                color={'#ffffff'}
                borderRadius={30}
                fontSize={16}
                fontWeight={'bold'}
                fontFamily={'Roboto'}
                containerViewStyle={this.styles.buttonWrap}
                onPress={() => {this.auth()}}
            />

            <View style={this.styles.bottomTextWrap}>
              <Text style={this.styles.bottomText}>
                Peer to peer currency exchange at mutually agreed rate.
              </Text>
            </View>

          </LinearGradient>
        </View>
    )
  }

  styles = StyleSheet.create({
    container: {
      flex: 1,
    },
    gradient: {
      ...StyleSheet.absoluteFillObject,
      flex: 1,
      justifyContent: 'space-evenly',
      alignItems: 'center',
      paddingBottom: height(10),
    },
    logoShadow: {
      backgroundColor: 'rgba(0,0,0,0.07)',
      padding: 2,
      width: 124,
      height: 124,
      borderRadius: 65,
    },
    logoWrap: {
      backgroundColor: '#ffffff',
      width: 120,
      height: 120,
      borderRadius: 60,
      alignItems: 'center',
      justifyContent: 'center',
    },
    logo: {
      width: 110,
      height: 110,
      //resizeMode: Image.resizeMode.stretchs,
    },
    textBox: {
      fontSize: 16,
      borderBottomWidth: 0,
      borderBottomColor: '#ffffff',
      marginHorizontal: 30,
      width: width(65),
    },
    textBoxWrap: {
      backgroundColor: '#ffffff',
      borderRadius: 16,
      alignContent: 'center',
      justifyContent: 'center',
      height: 72,
    },
    textBoxShadow: {
      backgroundColor: 'rgba(0,0,0,0.07)',
      padding: 2,
      borderRadius: 18,
      width: width(80),
    },
    buttonWrap: {
      width: width(80),
    },
    bottomTextWrap: {
      width: width(80),
    },
    bottomText: {
      color: 'rgb(74, 74, 74)',
      fontFamily: 'Roboto',
      fontSize: 16,
      textAlign: 'center',
    },
  });
};


