import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text, TouchableOpacity, Image,
} from 'react-native';
import ListItem from "react-native-elements/src/list/ListItem";
import FormDataHelper from "../../../helpers/FormDataHelper";
import {withNavigation} from "react-navigation";
import formatNumber from "../../format-number/FormatNumber";

class ApproveRequestListItem extends withNavigation(Component) {
  constructor(props) {
    super(props);

    this.state = {
      title: props.title,
      amount: props.amount,
      rate: props.rate,
      currencyGive: props.currencyGive,
      currencyNeed: props.currencyNeed,
      avatar: props.avatar,
      exchangeRequest: props.exchangeRequest,
      exchangeRequestActual: props.exchangeRequestActual,
    }
  }

  _proceedExchangeRequest = (exchangeRequest, status) => {
    const params = {};

    const nowTimestamp = Math.floor(Date.now() / 1000);
    if(status === 'approve') {
      params.approved_at = nowTimestamp;
    }
    else if(status === 'decline') {
      params.declined_at = nowTimestamp;
    }

    fetch('http://b.alphachange.ru/api/exchange-request/' + exchangeRequest.id + '?token=' + this.props.user.accessToken, {
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
          this.props.navigation.navigate('Dashboard', {
            activeTab: 1,
          });
        })
        .catch((error) => {
          alert("Error `" + status + "` exchange-request!\n" + error);
        });
  };

  render() {
    const ApprovedLabel = () => <View style={this.styles.labelWrap}><Text style={this.styles.approved}>Approved</Text></View>;
    const DeclinedLabel = () => <View style={this.styles.labelWrap}><Text style={this.styles.declined}>Declined</Text></View>;
    return (
        <ListItem
            roundAvatar
            hideChevron
            title={
              <View>
                <Text style={[this.styles.listTitle, this.styles.listTitleMargin]}>{this.state.title}</Text>
                <Text style={this.styles.subtitleText}><Text style={this.styles.subtitleText}>{this.state.amount > 1 ? formatNumber(this.state.amount, 2) : this.state.amount} {this.state.currencyNeed} ⇄ {(this.state.amount * this.state.rate) > 1 ? formatNumber((this.state.amount * this.state.rate), 2) : (this.state.amount * this.state.rate)} {this.state.currencyGive}</Text></Text>
              </View>
            }
            subtitle={
              this.state.exchangeRequestActual.approved_at !== null ? <ApprovedLabel/> : this.state.exchangeRequestActual.declined_at !== null ? <DeclinedLabel/> :
                  <View style={this.styles.subtitleDividedView}>
                    <View style={this.styles.subtitleLeft}>
                      <TouchableOpacity
                          //style={this.styles.leaveMessageButton}
                          underlayColor='transparent'
                          onPress={() => this._proceedExchangeRequest(this.state.exchangeRequest, 'approve')}
                      >
                        <Text>Approve</Text>
                        <Image
                            source={require('../../../assets/images/history/approve.png')}
                            style={this.styles.voteImg}
                        />
                      </TouchableOpacity>
                    </View>
                    <View style={this.styles.subtitleRight}>
                      <TouchableOpacity
                          //style={this.styles.leaveMessageButton}
                          underlayColor='transparent'
                          onPress={() => this._proceedExchangeRequest(this.state.exchangeRequest, 'decline')}
                      >
                        <Text>Decline</Text>
                        <Image
                            source={require('../../../assets/images/history/decline.png')}
                            style={this.styles.voteImg}
                        />
                      </TouchableOpacity>
                    </View>
                  </View>
            }
            avatar={this.state.avatar}

            containerStyle={this.styles.listItemContainer}
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
    listTitleMargin: {
      paddingLeft: 20,
    },
    subtitleDividedView: {
      marginTop: 6,
      marginLeft: 20,
      paddingVertical: 4,
      paddingRight: 10,
      borderTopWidth: 1,
      borderTopColor: 'rgb(199,199,199)',
      flexDirection: 'row',
    },
    subtitleLeft: {
      flex: 1,
      justifyContent: 'center',
      alignItems: 'center',
      borderRightColor: 'rgb(199,199,199)',
      borderRightWidth: 1,
    },
    labelWrap: {
      marginLeft: 20,
    },
    approved: {
      fontSize: 16,
      fontFamily: 'Roboto-Bold',
      fontWeight: 'bold',
      color: 'rgb(20, 174, 7)',
    },
    declined: {
      fontSize: 16,
      fontFamily: 'Roboto-Bold',
      fontWeight: 'bold',
      color: 'rgb(208, 2, 27)',
    },
    subtitleRight: {
      flex: 1,
      justifyContent: 'center',
      alignItems: 'center',
    },
    voteText: {
      fontWeight: 'bold',
      fontFamily: 'Roboto-Bold',
    },
    voteImg: {
      marginVertical: 8,
      width: 34,
      height: 32,
    },
  })
}

export default ApproveRequestListItem