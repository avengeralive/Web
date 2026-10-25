import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  FlatList,
} from 'react-native';
import { ListItem, SearchBar, Avatar } from 'react-native-elements';
import formatNumber from "../format-number/FormatNumber";

class MyListItem extends React.PureComponent {
  render() {
    return <ListItem
        title={
          <View style={this.styles.listTitleContainer}>
            <Text style={[this.styles.listTitleCurrency, this.styles.listTitleCurrencyIcon]}>{this.props.item.sign}</Text>
            <Text style={this.styles.listTitleCurrency}>{this.props.title ? this.props.title : this.props.item.title}</Text>
          </View>
        }
        avatar={
          <Avatar
              small
              rounded
              source={{uri: this.props.item.logo}}
              activeOpacity={0.7}
          />
        }

        rightIcon={this.props.rightIcon}
        onPressRightIcon={() => this.onPress(this.props.onPress)}

        containerStyle={this.styles.listItemContainer}
        wrapperStyle={this.styles.listItemWrapper}
    />
  }

  styles = StyleSheet.create({
    listItemContainer: {
      borderBottomColor: 'transparent',
      borderBottomWidth: 0,
      paddingTop: 0,
      paddingBottom: 0,
    },
    listItemWrapper: {
      marginBottom: 2,
      backgroundColor: 'transparent',
      padding: 12,
    },
    listTitleContainer: {
      flexDirection: 'row',
    },
    listTitleCurrencyIcon: {
      fontWeight: 'bold',
    },
    listTitleCurrency: {
      fontFamily: 'Roboto',
      fontSize: 20,
      color: 'rgb(74, 74, 74)',
      letterSpacing: -0.8,
      marginLeft: 16,
    },
  });
}

class Currencies extends Component {
  constructor(props) {
    super(props);

    this.onPress = props.hasOwnProperty('onPress') ? props.onPress : (currency) => {};
    this.rightIcon = props.hasOwnProperty('rightIcon') ? props.icon : {name: 'clear'};
    this.showRates = props.hasOwnProperty('showRates') ? this.props.showRates : false;

    this.state = {
      searchBarText: '',
      isLoading: true,
      _cachedData: [],
      dataSource: [],
      rates: {},
    };
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
            dataSource: responseJson,
            _cachedData: responseJson,
          });
        })
        .then(() => {
          if(this.showRates) {
            return fetch('http://b.alphachange.ru/api/endpoint/currency-rates?token=' + this.props.user.accessToken)
                .then((response) => response.json())
                .then((responseJson) => {
                  this.setState({
                    rates: responseJson,
                    isLoading: false,
                  });
                })
          }
        })
        .then(() => {
          this.setState({
            isLoading: false,
          });
        })
        .catch((error) => {
          console.error(error);
        });
  }

  /**
   * Filter currencies
   * @param text
   * @returns {Array}
   */
  filterCurrencies(text) {
    // TODO: SearchBar сбрасывает фокус, при ре-редеринге списка, т.к. сам находится в хедере списка - ИСПРАВИТЬ!!!
    this.setState({searchBarText: text});

    if(text.length >= 3) {
      this.setState({isLoading: true});
      let filteredData = [];
      for (let index in this.state._cachedData) {
        const item = this.state._cachedData[index];
        if (item.title.includes(text)) {
          filteredData.push(item);
        }
      }

      this.setState({
        dataSource: filteredData,
        isLoading: false,
      });
    }
    else if(!text.length) {
      this.setState({
        dataSource: this.state._cachedData,
        isLoading: false,
      });
    }
  }

  /**
   * Component init
   */
  componentDidMount() {
    this.loadCurrencies();
  }

  _renderItem = ({item}) => {
    const defaultCurrency = this.props.user.settings.defaultCurrency ? this.props.user.settings.defaultCurrency.shortcode : 'EUR';
    const itemRate = (item.shortcode in this.state.rates) ? formatNumber(this.state.rates[item.shortcode], 2) + ' ' + defaultCurrency : '';
    return <MyListItem
      item={item}
      onPress={this.onPress}
      rightIcon={this.rightIcon}
      title={itemRate}
    />
  };

  _renderHeader = () => {
    return <SearchBar
        placeholder="search"
        lightTheme
        round
        containerStyle={this.styles.searchBarContainer}
        inputContainerStyle={this.styles.searchBarInputContainer}
        inputStyle={this.styles.searchBarInput}
        placeholderTextColor='rgb(74, 74, 74)'
        showLoadingIcon={this.state.isLoading}
        value={this.state.searchBarText}

        onChangeText={(text) => this.filterCurrencies(text)}
    />
  };

  /**
   * Main component render
   * @returns {*}
   */
  render() {
    return (
        <View style={this.styles.currenciesContainer}>
          <FlatList
              data={this.state.dataSource}
              keyExtractor={(item) => item.title}
              renderItem={this._renderItem}
              onEndReachedThreshold={50}
              ListHeaderComponent={this._renderHeader}
          />
        </View>
    )
  }

  styles = StyleSheet.create({
    searchBarContainer: {
      backgroundColor: 'transparent',
      borderBottomWidth: 0,
      borderTopWidth: 0,
      marginVertical: 6,
      marginHorizontal: 16,
    },
    searchBarInputContainer: {

    },
    searchBarInput: {
      fontFamily: 'Roboto',
      backgroundColor: '#ffffff',
      fontSize: 16,
      letterSpacing: -0.5,
      color: 'rgb(74, 74, 74)',
      shadowOffset:{ width: 0,  height: 2, },
      shadowColor: '#000000',
      shadowOpacity: 0.2,
    },
    currenciesContainer: {

    },
    listItemContainer: {
      borderBottomColor: 'transparent',
      borderBottomWidth: 0,
      paddingTop: 0,
      paddingBottom: 0,
    },
    listItemWrapper: {
      marginBottom: 2,
      backgroundColor: 'transparent',
      padding: 12,
    },
    listTitleContainer: {
      flexDirection: 'row',
    },
    listTitleCurrencyIcon: {
      fontWeight: 'bold',
    },
    listTitleCurrency: {
      fontFamily: 'Roboto',
      fontSize: 20,
      color: 'rgb(74, 74, 74)',
      letterSpacing: -0.8,
      marginLeft: 16,
    },
  });
}

export default Currencies