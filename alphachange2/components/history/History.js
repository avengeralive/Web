import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  SectionList,
  Image,
  TouchableOpacity,
} from 'react-native';
import { ListItem } from 'react-native-elements'
import FormDataHelper from "../../helpers/FormDataHelper";
import SimpleExchangeListItem from "./items/SimpleExchangeListItem";
import ApproveRequestListItem from "./items/ApproveRequestListItem";

class History extends Component {
  constructor(props) {
    super(props);

    this.state = {
      isLoading: true,
      history: [],
      currencies: [],
    };
  }

  /**
   * Component init
   */
  componentDidMount() {
    this.loadCurrencies();
    this.loadHistory();
  }

  _sectionName(timestamp) {
    const date = new Date(timestamp * 1000);
    return date.getFullYear() + '/' + (date.getMonth() + 1) + '/' + date.getDate();
  }

  /**
   * Load all currencies
   * @returns {Promise<T>}
   */
  loadCurrencies() {
    this.setState({isLoading: true});
    return fetch('http://b.alphachange.ru/api/currency?token=' + this.props.user.accessToken)
        .then((response) => response.json())
        .then((responseJson) => {
          this.setState({
            currencies: responseJson,
            isLoading: false,
          });
        })
        .catch((error) => {
          alert(error);
        });
  }

  /**
   * Load location list
   */
  loadHistory() {
    this.setState({isLoading: true});
    return fetch('http://b.alphachange.ru/api/history?expand=object&token=' + this.props.user.accessToken+'&user_id=' + this.props.user.id)
        .then((response) => response.json())
        .then((responseJson) => {
          responseJson.map((event) => {
            if (!event.hidden) {
              let newHistory = this.state.history;
              const section = this._sectionName(event.created_at);
              let index = newHistory.findIndex(s => s.title === section);
              if (index === -1) {
                newHistory.push({
                  title: section,
                  data: [],
                });
              }
              index = newHistory.findIndex(s => s.title === section);
              newHistory[index].data.push(event);

              this.setState({
                history: newHistory,
              });
            }
          });

          this.setState({
            isLoading: false,
          });
        })
        .catch((error) => {
          alert(error);
        });
  }

  getCurrency(currency_id) {
    const index = this.state.currencies.findIndex(c => c.id === parseInt(currency_id));
    return this.state.currencies[index];
  }

  render() {
    return (
        <SectionList
            keyExtractor={(item) => 'key-'+item.id}
            style={this.styles.sectionListWrapper}

            renderSectionHeader={({section}) =>
                <View style={this.styles.sectionContainer}>
                  <Text style={this.styles.sectionTitle}>{section.title}</Text>
                </View>}

            renderItem={({item}) => {
              try {
                const params = JSON.parse(item.params),
                    data = JSON.parse(item.data);
                let currencyNeed, currencyGive;
                switch (item.object_type) {
                  case 'app\\models\\base\\Exchange':
                    currencyNeed = this.getCurrency(params.currency_need);
                    currencyGive = this.getCurrency(params.currency_give);
                    if('undefined' === typeof currencyNeed) {
                      throw 'no currency';
                    }
                    if ('Created' === item.message) {
                      return <SimpleExchangeListItem
                          title={'Exchange created'}
                          amount={1}
                          rate={params.exchange_rate}
                          currencyGive={currencyGive.sign}
                          currencyNeed={currencyNeed.sign}
                          avatar={require('../../assets/images/history/plus.png')}
                      />;
                    }
                    break;

                  case 'app\\models\\base\\ExchangeRequest':
                    currencyNeed = this.getCurrency(data.exchange.currency_need);
                    currencyGive = this.getCurrency(data.exchange.currency_give);
                    if ('Created' === item.message) {
                      return <SimpleExchangeListItem
                          title={'Exchange request sent'}
                          amount={params.amount}
                          rate={data.exchange.exchange_rate}
                          currencyGive={currencyGive.sign}
                          currencyNeed={currencyNeed.sign}
                          avatar={{uri: 'http://b.alphachange.ru' + data.user_settings.avatar}}
                      />;
                    }
                    else if ('Request' === item.message) {
                      return <ApproveRequestListItem
                          {...this.props}
                          title={'Exchange request received'}
                          amount={params.amount}
                          rate={data.exchange.exchange_rate}
                          currencyGive={currencyGive.sign}
                          currencyNeed={currencyNeed.sign}
                          exchangeRequest={params}
                          exchangeRequestActual={item.object}
                          avatar={{uri: 'http://b.alphachange.ru' + data.user_settings.avatar}}
                      />;
                    }
                    else if ('Approved' === item.message) {
                      return <SimpleExchangeListItem
                          title={'Exchange request approved'}
                          amount={params.amount}
                          rate={data.exchange.exchange_rate}
                          currencyGive={currencyGive.sign}
                          currencyNeed={currencyNeed.sign}
                          avatar={{uri: 'http://b.alphachange.ru' + data.user_settings.avatar}}
                      />;
                    }
                    else if ('Declined' === item.message) {
                      return <SimpleExchangeListItem
                        title={'Exchange request declined'}
                        amount={params.amount}
                        rate={data.exchange.exchange_rate}
                        currencyGive={currencyGive.sign}
                        currencyNeed={currencyNeed.sign}
                        avatar={{uri: 'http://b.alphachange.ru' + data.user_settings.avatar}}
                      />;
                    }
                    break;
                }
              }
              catch(e) {
                return (
                    <ListItem
                        title='Nothing found'
                        containerStyle={this.styles.listItemContainer}
                        titleStyle={this.styles.listTitle}
                        wrapperStyle={this.styles.listItemWrapper}
                    />);
              }
            }}

            sections={this.state.history}
        />
    )
  }

  styles = StyleSheet.create({
    sectionListWrapper: {
      backgroundColor: 'rgb(242, 242, 242)',
      paddingBottom: 4,
    },
    sectionContainer: {
      flex: 1,
      marginLeft: 19,
      paddingTop: 10,
      paddingBottom: 10,
    },
    sectionTitle: {
      fontFamily: 'Roboto',
      fontSize: 12,
      color: 'rgb(134, 134, 134)',
      letterSpacing: -0.4,
    },

  });
}

export default History