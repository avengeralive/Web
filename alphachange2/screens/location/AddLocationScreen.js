import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  TouchableHighlight,
  Text,
  ListView,
} from 'react-native';
import MapView from 'react-native-maps';
import { Marker } from 'react-native-maps';
import { SearchBar } from 'react-native-elements'
import { width, height, totalSize } from 'react-native-dimension';
import FormDataHelper from "../../helpers/FormDataHelper";

//const GOOGLE_APP_KEY = 'AIzaSyALFib6V18lbfVBEVihDyfurGBsPLBYvms';
const GOOGLE_APP_KEY = 'AIzaSyA41w3NWIYl5y7DhxGSqP0AQnbFAFUkhIE';
const LATITUDE_DELTA = 0.0922;
const LONGITUDE_DELTA = 0.0421;
const LATITUDE_ZOOM = 0.0092;
const LONGITUDE_ZOOM = 0.0042;

/**
 * Creating new location
 */
export default class AddLocationScreen extends Component {
  constructor(props) {
    super(props);

    this.state = {
      searchBarText: '',
      searchBarLoading: false,
      searchedAddresses: [],
      marker: null,

      mapRegion: {
        latitude: 0,
        //latitude: 55.7438,
        longitude: 0,
        //longitude: 37.6272,
        latitudeDelta: LATITUDE_DELTA,
        longitudeDelta: LONGITUDE_DELTA,
      },

      selectedLocation: {
        title: null,
        latitude: null,
        longitude: null,
      },
    };
  }

  /**
   * ListItem datasource
   * @type {ListViewDataSource}
   */
  ds = new ListView.DataSource({rowHasChanged: (r1, r2) => r1 !== r2});
  /**
   * Cache for google api location requests
   * @type {Array}
   * @private
   */
  _searchCache = [];

  /**
   * Component init method
   */
  componentDidMount() {
    navigator.geolocation.getCurrentPosition(
        (position) => {
          this.setState({
            mapRegion: {
              latitude: position.coords.latitude,
              longitude: position.coords.longitude,
              latitudeDelta: LATITUDE_DELTA,
              longitudeDelta: LONGITUDE_DELTA,
            }
          });
        },
    );
  }

  /**
   * Finding address with searchbar
   * @param text
   */
  findAddress(text) {
    this.setState({searchBarText: text});
    if (text.length >= 3) {
      this.setState({searchBarLoading: true});
      // checking if cache exists to avoid duplicating request
      if(text in this._searchCache) {
        this.setState({
          searchedAddresses: this._searchCache[text],
          searchBarLoading: false,
        });
      }
      else {
        fetch('https://maps.googleapis.com/maps/api/geocode/json?&address=' + encodeURIComponent(text) + '&key=' + GOOGLE_APP_KEY)
            .then((response) => response.json())
            .then((responseJson) => {
              this._searchCache[text] = responseJson.results.slice(0, 5);
              this.setState({
                searchedAddresses: this._searchCache[text],
                searchBarLoading: false,
              });
            })
            .catch((error) => {
              alert("Error fetching address!\n" + error);
            });
      }
    }
    else if(!text.length) {
      this.setState({searchedAddresses: []});
    }
  }

  /**
   * Tap autocomplete list item
   * @param location
   */
  selectLocation(location) {
    this.setState({
      searchBarText: location.formatted_address,
      selectedLocation: {
        title: location.formatted_address,
        latitude: location.geometry.location.lat,
        longitude: location.geometry.location.lng,
      },
      mapRegion: {
        latitude: location.geometry.location.lat,
        longitude: location.geometry.location.lng,
        latitudeDelta: LATITUDE_ZOOM,
        longitudeDelta: LONGITUDE_ZOOM,
      },
      marker: {
        title: location.formatted_address,
        latlng: {
          latitude: location.geometry.location.lat,
          longitude: location.geometry.location.lng,
        },
      },
    });
  }

  /**
   * Tap on map to set marker
   * @param location
   */
  clickMap(location) {
    // TODO: сделать постановку маркера по клику на карту
    //https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=
  }

  /**
   * Tap `Add location` button
   * @param location
   */
  addLocation() {
    if(this.state.selectedLocation.title == null) {
      alert('Nothing selected!');
    }
    else {
      fetch('http://b.alphachange.ru/api/location?token=' + this.props.user.accessToken, {
        method: 'POST',
        headers: {
          Accept: 'application/json',
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: FormDataHelper.body({
          user_id: this.props.user.id,
          name: this.state.selectedLocation.title,
          lat: this.state.selectedLocation.latitude,
          long: this.state.selectedLocation.longitude,
        }),
      })
      .then((response) => {
        return response.json()
      })
      .then((responseJson) => {
        this.props.navigation.navigate('Dashboard', {
            activeTab: 2,
        });
      })
      .catch((error) => {
        alert("Error saving location!\n" + error);
      });
    }
  }

  /**
   * Main component render
   * @returns {*}
   */
  render() {
    return <View style={this.styles.container}>
      <MapView
          style={this.styles.map}
          region={this.state.mapRegion}

          onPress={this.clickMap}
      >
        {this.state.marker != null ? <Marker coordinate={this.state.marker.latlng} title={this.state.marker.title}/> : null }
      </MapView>
      <View style={this.styles.searchBarWrap}>
        <SearchBar
            placeholder="address"
            lightTheme
            round
            containerStyle={this.styles.searchBarContainer}
            inputContainerStyle={this.styles.searchBarInputContainer}
            inputStyle={this.styles.searchBarInput}
            placeholderTextColor='rgb(155, 155, 155)'
            showLoadingIcon={this.state.searchBarLoading}
            value={this.state.searchBarText}

            onChangeText={(text) => this.findAddress(text)}
        />
        <ListView
            style={this.styles.autoCompleteList}
            enableEmptySections={true}
            dataSource={this.ds.cloneWithRows(this.state.searchedAddresses)}
            renderSeparator={() =>
                <View style={this.styles.autoCompleteListSeparator}/>
            }
            renderRow={(location) =>
                <View style={this.styles.autoCompleteListItem}>
                  <TouchableHighlight
                      style={this.styles.selectLocationButton}
                      underlayColor='#e1e1e1'
                      onPress={() => {
                        this.selectLocation(location);
                      }}
                  >
                    <Text style={this.styles.selectLocationButtonText}>{location.formatted_address}</Text>
                  </TouchableHighlight>
                </View>
            }
        />
      </View>
      <TouchableHighlight
          style={this.styles.addLocationButton}
          underlayColor='#46cdc3'
          onPress={() => {
            this.addLocation();
          }}
      >
        <Text style={this.styles.addLocationButtonText}>
          Create
        </Text>
      </TouchableHighlight>

    </View>
  }

  /**
   * Stylesheet
   * @type {*|{panHandlers, getInteractionHandle}|{duration, create, update, delete}|{type, property}}
   */
  styles = StyleSheet.create({
    container: {
      ...StyleSheet.absoluteFillObject,
      justifyContent: 'space-between',
      alignItems: 'center',
    },
    map: {
      ...StyleSheet.absoluteFillObject,
    },
    searchBarWrap: {
      width: width(90),
      marginTop: 12,
    },
    searchBarContainer: {
      flexDirection: 'row',
      backgroundColor: 'transparent',
      borderBottomWidth: 0,
      borderTopWidth: 0,
    },
    searchBarInputContainer: {
      alignSelf: 'stretch',
    },
    searchBarInput: {
      flex: 1,
      fontFamily: 'Roboto',
      backgroundColor: '#ffffff',
      fontSize: 16,
      letterSpacing: -0.5,
      color: 'rgb(74, 74, 74)',
    },
    autoCompleteList: {
      backgroundColor: 'rgba(255, 255, 255, 0.8)',
      marginHorizontal: 24,
      borderTopRightRadius: 4,
      borderTopLeftRadius: 4,
      borderBottomRightRadius: 0,
      borderBottomLeftRadius: 0,
    },
    autoCompleteListItem: {

    },
    autoCompleteListSeparator: {
      flex: 1,
      height: 1,
      backgroundColor: '#ffffff',
    },
    selectLocationButton: {
      flex: 1,
      alignSelf: 'stretch',
      paddingHorizontal: 12,
      paddingVertical: 8,
    },
    selectLocationButtonText: {
      fontFamily: 'Roboto',
      fontSize: 12,
    },
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
  });
};