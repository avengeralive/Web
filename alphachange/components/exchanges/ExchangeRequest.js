import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  TouchableHighlight,
  TouchableOpacity,
  Image,
} from 'react-native';
import { FormLabel, FormInput, FormValidationMessage } from 'react-native-elements'
import {width, height} from "react-native-dimension";
import UserRating from "../user-rating/UserRating";
import FormDataHelper from "../../helpers/FormDataHelper";
import {withNavigation} from "react-navigation";

export default class ExchangeRequest extends withNavigation(Component) {
  constructor(props) {
    super(props);

    this.state = {
      showTextInput: false,

      exchange: props.exchange,

      amountGive: props.exchange.min_amount,
      amountGet: props.exchange.exchange_rate * props.exchange.min_amount,
      textMessage: '',
    };
  }

  componentDidMount() {

  }

  /**
   * Save exchange request
   */
  sendRequest = () => {
    const params = {
      user_id: this.props.user.id,
      exchange_id: this.state.exchange.id,
      amount: this.state.amountGive,
      message: this.state.textMessage,
    };

    fetch('http://b.alphachange.ru/api/exchange-request?token=' + this.props.user.accessToken, {
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
          alert("Error creating exchange request!\n" + error);
        });
  };

  /**
   * Main component render
   * @returns {*}
   */
  render() {
    return <View style={this.styles.container}>
      <View style={this.styles.contentWrap}>
        <View style={this.styles.content}>
          <TouchableOpacity
              style={this.styles.avatarWrap}
          >
            <Image
                source={{uri: 'http://b.alphachange.ru/' + this.state.exchange.user.settings.avatar}}
                style={this.styles.avatar}
            />
          </TouchableOpacity>

          {this.state.exchange.user.settings.name !== null && this.state.exchange.user.settings.name.length > 0 &&
          <View style={this.styles.sellerNameWrap}>
            <Text style={this.styles.sellerName}>{this.state.exchange.user.settings.name}</Text>
          </View>}

          {/*<View style={this.styles.exchangeTitleWrap}>
            <Text style={this.styles.exchangeTitle}>exchange</Text>
          </View>*/}

          <View style={this.styles.exchangeTotalWrap}>
            <View style={this.styles.exchangeTotalCol}>
              <View style={this.styles.exchangeShortcodeWrap}>
                <Image
                    source={{uri: this.state.exchange.currencyGive.logo}}
                    style={this.styles.currencyLogo}
                />
                <Text style={this.styles.exchangeTotalShortcode}>{this.state.exchange.currencyGive.shortcode}</Text>
              </View>
              <View style={this.styles.exchangeTotalTextWrap}>
                {/*<Text style={this.styles.exchangeTotal}>{this.state.amountGive}</Text>*/}
                <FormInput
                    style={this.styles.exchangeAmount}
                    underlineColorAndroid='rgb(30, 185, 175)'
                    containerStyle={this.styles.exchangeAmountContainer}
                    keyboardType='numeric'
                    value={String(this.state.amountGive)}
                    onChangeText={(amount) => {
                      this.setState({
                        amountGive: amount,
                        amountGet: amount * this.state.exchange.exchange_rate,
                      })
                    }}
                />
              </View>
            </View>

            <View style={this.styles.exchangeTotalMidCol}>
              <Text style={this.styles.exchangeTotalMid}>⇄</Text>
            </View>

            <View style={this.styles.exchangeTotalCol}>
              <View style={this.styles.exchangeShortcodeWrap}>
                <Image
                    source={{uri: this.state.exchange.currencyNeed.logo}}
                    style={this.styles.currencyLogo}
                />
                <Text style={this.styles.exchangeTotalShortcode}>{this.state.exchange.currencyNeed.shortcode}</Text>
              </View>
              <View style={this.styles.exchangeTotalTextWrap}>
                {/*<Text style={this.styles.exchangeTotal}>{this.state.amountGet}</Text>*/}
                <FormInput
                    style={this.styles.exchangeAmount}
                    underlineColorAndroid='rgb(30, 185, 175)'
                    containerStyle={this.styles.exchangeAmountContainer}
                    keyboardType='numeric'
                    value={String(this.state.amountGet)}
                    onChangeText={(amount) => {
                      this.setState({
                        amountGet: amount,
                        amountGive: amount / this.state.exchange.exchange_rate
                      })
                    }}
                />
              </View>
            </View>
          </View>

          <View style={this.styles.exchangeDefaultRateWrap}>
            <Text style={this.styles.exchangeDefaultRate}>Limits: {this.state.exchange.min_amount} - {this.state.exchange.max_amount} {this.state.exchange.currencyGive.shortcode}</Text>
          </View>

          <View style={this.styles.exchangeSellerRatingTitleWrap}>
            <Text style={this.styles.exchangeSellerRatingTitle}>Seller rating</Text>
          </View>

          <View style={this.styles.exchangeSellerRatingWrap}>
            <UserRating rating={3.5}/>
          </View>

          {this.state.showTextInput ? <FormInput
              style={this.styles.textMessage}
              underlineColorAndroid={'transparent'}
              containerStyle={this.styles.leaveMessageMessage}
              value={String(this.state.textMessage)}
              onChangeText={(text) => {
                this.setState({
                  textMessage: text,
                })
              }}
          /> : <TouchableOpacity
              style={this.styles.leaveMessageButton}
              underlayColor='transparent'
              onPress={() => {
                this.setState({
                  showTextInput: true,
                });
                setTimeout(() => {
                  if(this.state.textMessage.length === 0) {
                    this.setState({
                      showTextInput: false,
                    });
                  }
                }, 8000);
              }}
          >
            <View style={this.styles.leaveMessageContainer}>
              <Image
                  style={this.styles.chatButtonImage}
                  source={require('../../assets/images/icons/comment.png')}
              />
              <Text style={this.styles.exchangeLeaveMessageTitle}>Leave message</Text>
            </View>
          </TouchableOpacity>}

        </View>

        <TouchableHighlight
            style={this.styles.proceedExchangeButton}
            underlayColor='#46cdc3'
            onPress={this.sendRequest}
        >
          <Text style={this.styles.proceedExchangeButtonText}>
            Send request
          </Text>
        </TouchableHighlight>
      </View>
    </View>
  }

  /**
   * Stylesheet
   * @type {*|{panHandlers, getInteractionHandle}|{duration, create, update, delete}|{type, property}}
   */
  styles = StyleSheet.create({
    container: {
      //marginBottom: 20,
    },
    contentWrap: {
      alignItems: 'center',
      marginBottom: 20,
    },
    content: {
      backgroundColor: '#ffffff',
      borderRadius: 16,
      flexDirection: 'column',
      justifyContent: 'flex-start',
      alignItems: 'center',
      paddingTop: 12,
      paddingBottom: 12,
      paddingHorizontal: 18,
      marginBottom: 20,
      alignSelf: 'stretch',
      height: 400,
    },
    sellerNameWrap: {
      alignItems: 'center',
    },
    sellerName: {
      //fontFamily: 'Roboto',
      fontFamily: 'Roboto-Bold',
      fontWeight: 'bold',
      fontSize: 18,
      //letterSpacing: -0.5,
      color: 'rgb(112, 112, 112)',
    },
    exchangeTitleWrap: {
      marginTop: 14,
      alignItems: 'center',
    },
    exchangeTitle: {
      fontFamily: 'Roboto-Bold',
      fontSize: 16,
      fontWeight: 'bold',
      letterSpacing: -0.5,
      color: 'rgb(30, 81, 197)',
    },
    exchangeTotalWrap: {
      marginTop: 10,
      marginBottom: 0,
      alignItems: 'center',
      flexDirection: 'row',
    },
    exchangeTotalCol: {
      flex: 2,
      alignItems: 'center',
      justifyContent: 'center',
      flexDirection: 'column',
    },
    exchangeTotalMidCol: {
      flex: 1,
      alignItems: 'center',
      justifyContent: 'center',
    },
    exchangeTotalMid: {
      fontSize: 26,
      fontWeight: 'bold',
      color: 'rgb(30, 185, 175)',
    },
    exchangeShortcodeWrap: {
      flexDirection: 'row',
      justifyContent: 'center',
      alignItems: 'center',
    },
    currencyLogo: {
      width: 18,
      height: 18,
      resizeMode: Image.resizeMode.stretchs,
      borderRadius: 9,
      marginRight: 6,
    },
    exchangeTotalShortcode: {
      fontFamily: 'Roboto-Bold',
      fontSize: 20,
      fontWeight: 'bold',
      letterSpacing: -0.8,
      color: 'rgb(74, 74, 74)',
    },
    exchangeTotalTextWrap: {
      //paddingBottom: 4,
    },
    exchangeTotal: {
      fontFamily: 'Roboto',
      fontSize: 24,
      letterSpacing: -0.7,
      color: 'rgb(0, 145, 124)',
    },
    exchangeDefaultRateWrap: {
      //marginTop: 8,
      alignItems: 'center',
      paddingBottom: 6,
      borderBottomWidth: 1,
      borderBottomColor: 'rgb(199, 199, 199)',
      //borderTopWidth: 1,
      //borderTopColor: 'rgb(151, 151, 151)',
      width: width(65),
    },
    exchangeDefaultRate: {
      fontFamily: 'Roboto',
      fontSize: 14,
      color: 'rgb(199, 199, 199)',
    },
    exchangeSellerRatingTitleWrap: {
      alignItems: 'center',
      marginBottom: 8,
      marginTop: 16,
    },
    exchangeSellerRatingTitle: {
      //fontFamily: 'Roboto-Bold',
      fontFamily: 'Roboto',
      fontSize: 16,
      //fontWeight: 'bold',
      color: 'rgb(74, 74, 74)',
    },
    exchangeSellerRatingWrap: {
      alignItems: 'center',
      height: 32,
      marginBottom: 10,
    },
    exchangeLeaveMessageTitle: {
      flex: 1,
      //fontFamily: 'Roboto-Bold',
      fontFamily: 'Roboto',
      fontSize: 18,
      //fontWeight: 'bold',
      //color: 'rgb(74, 74, 74)',
      color: 'rgb(30, 185, 175)',
      paddingBottom: 4,
    },
    exchangeAmountWrap: {
      alignItems: 'center',
    },
    exchangeAmountContainer: {
      width: 80,
    },
    exchangeAmount: {
      fontFamily: 'Roboto-Bold',
      fontSize: 16,
      fontWeight: 'bold',
      color: 'rgb(30, 185, 175)',
    },
    leaveMessageContainer: {
      flexDirection: 'row',
      alignItems: 'center',
    },
    leaveMessageButton: {
      height: 40,
//      flex: 1,
      borderRadius: 20,
      borderWidth: 1,
      //borderColor: '#1eb9af',
      borderColor: 'rgb(30, 185, 175)',
      alignItems: 'center',
      justifyContent: 'center',
      paddingHorizontal: 20,
      width: width(60),
    },
    leaveMessageMessage: {
      height: 40,
//      flex: 1,
      borderRadius: 20,
      borderWidth: 1,
      //borderColor: '#1eb9af',
      borderColor: 'rgb(30, 185, 175)',
      paddingHorizontal: 20,
      width: width(60),
      justifyContent: 'center',
    },
    textMessage: {
      color: 'rgb(74,74,74)',
      fontSize: 16,
    },
    chatButtonImage: {
      width: 24,
      height: 24,
      resizeMode: Image.resizeMode.stretch,
      marginRight: 12,
    },
    proceedExchangeButton: {
      position: 'absolute',
      zIndex: 100,
      bottom: 0,
      borderRadius: 20,
      backgroundColor: '#1eb9af',
      height: 40,
      justifyContent: 'center',           // Center vertically
      alignItems: 'center',               // Center horizontally
      paddingHorizontal: 32,
    },
    proceedExchangeButtonText: {
      fontSize: 18,
      color: '#FFFFFF',
      fontFamily: 'Roboto-bold',
      fontWeight: 'bold',
    },
    avatarWrap: {
      marginVertical: 12,
      alignItems:'center',
      justifyContent:'flex-end',
      width: 52,
      height: 52,
      borderRadius: 26,
    },
    avatar: {
      width: 52,
      height: 52,
      resizeMode: Image.resizeMode.stretchs,
      borderRadius: 26,
    },
  });

}