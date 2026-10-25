import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
} from 'react-native';
import { ListItem } from 'react-native-elements'
import formatNumber from "../../format-number/FormatNumber";

class SimpleExchangeListItem extends Component {
  constructor(props) {
    super(props);

    this.state = {
      title: props.title,
      amount: props.amount,
      rate: props.rate,
      currencyGive: props.currencyGive,
      currencyNeed: props.currencyNeed,
      avatar: props.avatar,

      subtitleFooter: props.subtitleFooter,
    }
  }

  render() {
    return (
        <ListItem
            roundAvatar
            title={this.state.title}
            subtitle={
              <View>
                <View style={this.styles.subtitleView}>
                  <Text style={this.styles.subtitleText}>{this.state.amount > 1 ? formatNumber(this.state.amount, 2) : this.state.amount} {this.state.currencyNeed} ⇄ {(this.state.amount * this.state.rate) > 1 ? formatNumber((this.state.amount * this.state.rate), 2) : (this.state.amount * this.state.rate)} {this.state.currencyGive}</Text>
                </View>
                {this.state.subtitleFooter}
              </View>
            }
            avatar={this.state.avatar}

            containerStyle={this.styles.listItemContainer}
            titleStyle={this.styles.listTitle}
            wrapperStyle={this.styles.listItemWrapper}
        />
    )
  }

  styles = StyleSheet.create({
    subtitleView: {
      flexDirection: 'row',
      paddingTop: 5
    },
    subtitleText: {
      fontFamily: 'Roboto',
      color: 'rgb(0, 145, 124)',
      fontSize: 20,
      letterSpacing: -0.7,
      paddingLeft: 20,
    },
    listItemWrapper: {
      marginBottom: 2,
      borderRadius: 4,
      backgroundColor: '#ffffff',
      paddingTop: 8,
      paddingLeft: 22,
      paddingBottom: 12,
    },
    listTitle: {
      fontFamily: 'Roboto',
      fontSize: 14,
      color: 'rgb(0, 96, 82)',
      letterSpacing: -0.5,
      paddingLeft: 10,
    },
    listItemContainer: {
      borderBottomColor: 'transparent',
      borderBottomWidth: 0,
      paddingTop: 0,
      paddingBottom: 0,
    },

  })
}

export default SimpleExchangeListItem