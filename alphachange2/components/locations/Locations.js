import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  FlatList,
  TouchableHighlight,
} from 'react-native';
import { ListItem } from 'react-native-elements'
import {withNavigation} from 'react-navigation';

class Locations extends Component {
  constructor(props) {
    super(props);

    this.state = {
      isLoading: true,
      dataSource: [],
    };
  }

  componentDidMount() {
    this.loadLocations();
  }

  /**
   * Load location list
   */
  loadLocations() {
    this.setState({isLoading: true});
    return fetch('http://b.alphachange.ru/api/location?token=' + this.props.user.accessToken+'&user_id=' + this.props.user.id)
        .then((response) => response.json())
        .then((responseJson) => {
          this.setState({
            dataSource: responseJson,
            isLoading: false,
          });
        })
        .catch((error) => {
          alert(error);
        });
  }

  /**
   * Tap `X` button (delete location)
   */
  deleteLocation(location) {
    fetch('http://b.alphachange.ru/api/location/' + location.id + '?token=' + this.props.user.accessToken, {
        method: 'DELETE',
      })
      .then((response) => {
        this.loadLocations();
      })
      .catch((error) => {
        alert("Error deleting location!\n" + error);

      });
  }

  render() {
    return (
        <View style={this.styles.locationsContainer}>
          <FlatList
              data={this.state.dataSource}
              keyExtractor={(item) => item.name}

              renderItem={({item}) =>
                  <ListItem
                      title={item.name}
                      rightIcon={{name: 'clear'}}
                      titleNumberOfLines={2}

                      containerStyle={this.styles.listItemContainer}
                      titleStyle={this.styles.listTitle}
                      wrapperStyle={this.styles.listItemWrapper}

                      onPressRightIcon={() => this.deleteLocation(item)}
                  />
              }

              ListHeaderComponent={() =>
                <TouchableHighlight
                    style={this.styles.addLocationButton}
                    onPress={() => {
                      this.props.navigation.navigate('AddLocation');
                    }}
                >
                  <Text style={this.styles.addLocationButtonText}>
                    Add location
                  </Text>
                </TouchableHighlight>
              }
          />
        </View>
    )
  }

  /**
   * Stylesheet
   * @type {*|{panHandlers, getInteractionHandle}|{duration, create, update, delete}|{type, property}}
   */
  styles = StyleSheet.create({
    addLocationButton: {
      borderRadius: 20,
      marginVertical: 20,
      backgroundColor: '#1eb9af',
      height: 44,
      justifyContent: 'center',           // Center vertically
      alignItems: 'center',               // Center horizontally
      paddingHorizontal: 32,
      marginHorizontal: 48,
    },
    addLocationButtonText: {
      fontSize: 18,
      color: '#FFFFFF',
      fontFamily: 'Roboto-bold',
      fontWeight: 'bold',
    },
    locationsContainer: {

    },
    listItemContainer: {
      borderBottomColor: 'transparent',
      borderBottomWidth: 0,
      paddingTop: 0,
      paddingBottom: 0,
    },
    listItemWrapper: {
      marginBottom: 12,
      borderRadius: 4,
      backgroundColor: '#ffffff',
      padding: 12,
    },
    listTitle: {
      fontFamily: 'Roboto',
      fontSize: 14,
      color: 'rgb(112, 112, 112)',
      letterSpacing: -0.5,
      marginLeft: 0,
    },
  })
}

export default withNavigation(Locations)