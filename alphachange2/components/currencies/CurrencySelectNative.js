import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  TouchableHighlight,
} from 'react-native';
import { Avatar } from 'react-native-elements';
import DialogAndroid from 'react-native-dialogs';

class CurrencySelectNative extends Component {
  constructor(props) {
    super(props);

    this.onPress = props.hasOwnProperty('onPress') ? props.onPress : (currency) => {};
    this.rightIcon = props.hasOwnProperty('rightIcon') ? props.icon : {name: 'clear'};

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
        currencyTitle: 'Select currency', //'Select currency',
        currencyLogo: '../../assets/images/dev/flag1.png', //'../../assets/images/dev/flag1.png',
      };
    }

    this.state.currencyList = [];
    this.state.currencies = [];
  }

  componentDidMount() {
    this.loadCurrencies();
  }

  /**
   * Load all currencies
   * @returns {Promise<T>}
   */
  loadCurrencies() {
    return fetch('http://b.alphachange.ru/api/currency?token=' + this.props.user.accessToken)
        .then((response) => response.json())
        .then((responseJson) => {
          let currencies = [],
              currencyList = [];
          for(let key in responseJson) {
            currencyList.push({
              id: responseJson[key].id,
              label: responseJson[key].shortcode + ' / ' + responseJson[key].title,
            });

            currencies[responseJson[key].id] = responseJson[key];
          }
          this.setState({
            currencies: currencies,
            currencyList: currencyList,
          });
        })
        .catch((error) => {
          console.error(error);
        });
  }

  showDialog = async () => {
    const { selectedItem } = await DialogAndroid.showPicker('Select currency', null, {
      items: this.state.currencyList
    });
    if (selectedItem) {
      const currency = this.state.currencies[selectedItem.id];
      this.setState({
        currencyLogo: currency.logo,
        currencyTitle: currency.title,
        currencySign: currency.sign,
      });

      this.onPress(currency);
    }
  };

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

export default CurrencySelectNative