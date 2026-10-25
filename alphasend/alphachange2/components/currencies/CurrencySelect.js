import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  TouchableHighlight,
} from 'react-native';
import { Avatar } from 'react-native-elements';
import PopupDialog from 'react-native-popup-dialog';
import Currencies from "./Currencies";

class CurrencySelect extends Component {
  constructor(props) {
    super(props);

    this.onPress = props.hasOwnProperty('onPress') ? props.onPress : (currency) => {};
    this.rightIcon = props.hasOwnProperty('rightIcon') ? props.icon : {name: 'clear'};
    this.dialogContainerStyle =  props.dialogContainerStyle ? props.dialogContainerStyle : {};

    if(props.hasOwnProperty('currency') && props.currency !== null) {
      this.state = {
        currencySign: props.currency.sign,
        currencyTitle: props.currency.title,
        currencyLogo: props.currency.logo,
      };
    }
    else {
      this.state = {
        currencySign: '',
        currencyTitle: 'Select currency',//'Select currency',
        currencyLogo: '../../assets/images/dev/flag1.png',//'../../assets/images/dev/flag1.png',
      };
    }
  }

  showDialog() {
    this.popupDialog.show();
  }

  /**
   * Main component render
   * @returns {*}
   */
  render() {
    return (
        <View style={this.styles.wrap}>
          <TouchableHighlight
              style={this.styles.selectTouchable}
              underlayColor='#99d9f4'
              onPress={() => this.showDialog()}
          >
            <View style={this.styles.selectContainer}>
              <Avatar
                  small
                  rounded
                  source={{uri: this.state.currencyLogo}}
                  activeOpacity={0.7}
              />
              <Text style={[this.styles.selectCurrency, this.styles.selectCurrencyIcon]}>{this.state.currencySign}</Text>
              <Text style={[this.styles.selectCurrency, this.styles.selectCurrencyTitle]}>{this.state.currencyTitle}</Text>
            </View>
          </TouchableHighlight>

          <PopupDialog
              ref={(popupDialog) => { this.popupDialog = popupDialog; }}
              dialogStyle={this.styles.popupStyle}
              containerStyle={[this.styles.popupContainer, this.dialogContainerStyle]}
              height={0.64}
              width={0.9}
              overlayOpacity={0.3}
          >
            <Currencies
                user={this.props.user}
                onPress={(currency) => {
                  if (true === this.onPress(currency)) {
                    this.popupDialog.dismiss();
                    this.setState({
                      currencyTitle: currency.title,
                      currencySign: currency.sign,
                      currencyLogo: currency.logo,
                    });
                  }
                }}
                rightIcon={{name: 'add'}}
            />
          </PopupDialog>
        </View>
    )
  }

  styles = StyleSheet.create({
    wrap: {
      marginTop: 12,
    },
    selectTouchable: {
      padding: 12,
      backgroundColor: '#ffffff',
    },
    selectContainer: {
      flexDirection: 'row',
    },
    selectCurrencyIcon: {
      fontWeight: 'bold',
    },
    selectCurrency: {
      fontFamily: 'Roboto',
      fontSize: 20,
      color: 'rgb(74, 74, 74)',
      letterSpacing: -0.8,
      marginLeft: 6,
    },
    selectCurrencyTitle: {
      paddingTop: 2,
      color: 'rgb(74,74,74)',
    },
    popupContainer: {
      // marginTop: -45,
      // marginLeft: -12,
      // backgroundColor: 'rgb(210,20,10)',
    },
    popupStyle: {

    },
  });
}

export default CurrencySelect