import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
} from 'react-native';

class DashboardInfo extends Component {
  currencySign = '$';

  constructor(props) {
    super(props);

    if(this.props.user.settings.defaultCurrency !== null) {
      this.currencySign = this.props.user.settings.defaultCurrency.sign;
    }
  }

  render() {
    return (
        <View style={this.styles.infobar}>
          <View style={this.styles.infobarPart}>
            <Text style={this.styles.infobarTitle}>Favorites</Text>
            <Text style={this.styles.infobarValue}>{this.props.favorites}</Text>
          </View>
          <View style={this.styles.infobarPart}>
            <Text style={this.styles.infobarTitle}>Changed</Text>
            <Text style={this.styles.infobarValue}>{Math.floor(Number.parseFloat(this.props.total)) + ' ' + this.currencySign}</Text>
          </View>
          <View style={this.styles.infobarPart}>
            <Text style={this.styles.infobarTitle}>Deals</Text>
            <Text style={this.styles.infobarValue}>{this.props.deals}</Text>
          </View>
        </View>
    )
  }

  styles = StyleSheet.create({
    infobar: {
      flex: 2,
      flexDirection: 'row',
      paddingBottom: 10,
    },
    infobarPart: {
      flex: 1,
      alignItems: 'center',
      justifyContent: 'center',
    },
    infobarTitle: {
      color: '#000000',
      fontSize: 14,
      fontWeight: 'bold',
      lineHeight: 24,
    },
    infobarValue: {
      color: '#000000',
      fontSize: 22,
    },
  })
}

export default DashboardInfo