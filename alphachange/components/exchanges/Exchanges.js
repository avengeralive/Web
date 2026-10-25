import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  TouchableHighlight,
  TouchableOpacity,
  Image,
} from 'react-native';
import { Marker } from 'react-native-maps';
import Carousel from 'react-native-snap-carousel';
import MapView from 'react-native-maps';
import {width} from "react-native-dimension";
import PopupDialog from 'react-native-popup-dialog';
import BottomNavbar from '../../components/bottom-navbar/BottomNavbar.js'
import ExchangeRequest from "./ExchangeRequest";

const GOOGLE_APP_KEY = 'AIzaSyALFib6V18lbfVBEVihDyfurGBsPLBYvms';
const LATITUDE_DELTA = 0.0922;
const LONGITUDE_DELTA = 0.0421;
const LATITUDE_ZOOM = 0.0092;
const LONGITUDE_ZOOM = 0.0042;

class Exchanges extends Component {
  constructor(props) {
    super(props);

    this.state = {
      exchange: {
        id: 0,
        /*"user_id": 0,
        "location_id": 0,
        "title": "string",
        "description": "string",
        "currency_give": 0,
        "currency_need": 0,
        "total_amount": 0,
        "min_amount": 0,
        "max_amount": 0,
        "exchange_rate": 0,
        "created_at": 0,
        "updated_at": 0,
        "user": {
          "id": 18,
          "username": "",
          "password": "",
          "authKey": "",
          "accessToken": "",
          "phone": "",
          settings: {
            "id": 0,
            "user_id": 0,
            "timezone": "",
            "language": "en-US",
            "avatar": null,
            "default_location_id": 0,
            "default_currency_id": 0,
            "locations": null,
            "currencies": null,
            "name": "",
            "bio": "",
          },
        },
        "location": {},
        "currencyGive": {sign: ''},
        "currencyNeed": {sign: ''}*/
      },
      exchanges: [],

      myLocation: {
        latitude: null,
        longitude: null,
      },
    };
  }

  /**
   * Carousel reference
   * @type {null}
   * @private
   */
  _carousel = null;

  componentDidMount() {
    // TODO: в будущем нужно для поиска обменов по удаленности от координат пользователя
    navigator.geolocation.getCurrentPosition(
        (position) => {
          this.setState({
            myLocation: {
              latitude: position.coords.latitude,
              longitude: position.coords.longitude,
            }
          });
        },
    );

    this.loadExchanges(this.state.myLocation.latitude, this.state.myLocation.longitude);
  }

  /**
   * Load exchanges list
   */
  loadExchanges(latitude, longitude) {
    fetch('http://b.alphachange.ru/api/exchange?token=' + this.props.user.accessToken + '&expand=user,location,currencyGive,currencyNeed,user.settings')
      .then((response) => response.json())
      .then((responseJson) => {
        this.setState({
          exchanges: responseJson,
        });
      })
      .catch((error) => {
        alert(error);
      });

    // TODO: заменить на then, когда будет нормальный аякс запрос
    setTimeout(() => {
      this._centerMapOnMarker(0);
    }, 500);
  }

  /**
   * Jump to target marker
   * @param index
   * @private
   */
  _centerMapOnMarker(index) {
    const item = this.state.exchanges[index];

    this._map.animateToRegion({
      latitude: item.location.lat,
      longitude: item.location.long,
      latitudeDelta: LATITUDE_ZOOM,
      longitudeDelta: LONGITUDE_DELTA,
    });
  }

  /**
   * Render carousel item
   * @param item
   * @param index
   * @returns {*}
   * @private
   */
  renderItem ({item, index}) {
    return (
        <View style={this.styles.carouselItemWrap}>
          <View style={this.styles.carouselItem}>
            <TouchableOpacity
                style={this.styles.avatarWrap}
            >
              <Image
                  source={{uri: 'http://b.alphachange.ru/' + item.user.settings.avatar}}
                  style={this.styles.avatar}
              />
            </TouchableOpacity>

            {item.title !== null && item.title.length > 0 &&
              <View style={this.styles.carouselItemTitleWrap}>
                <Text style={this.styles.carouselItemTitle}>{item.title}</Text>
              </View>
            }

            <View style={this.styles.carouselItemInfoWrap}>
              <Text style={this.styles.carouselItemInfo}>1 {item.currencyNeed.sign} ⇄ {item.exchange_rate} {item.currencyGive.sign}</Text>
            </View>

            <View style={this.styles.carouselItemInfo2Wrap}>
              <Text style={this.styles.carouselItemInfo2}>{item.min_amount} - {item.max_amount}</Text>
            </View>
          </View>

          <TouchableHighlight
              style={this.styles.proceedExchangeButton}
              underlayColor='#46cdc3'
              onPress={() => {
                this.setState({exchange: item});
                this.popupDialog.forceUpdate();
                this.popupDialog.show();
              }}
          >
            <Text style={this.styles.proceedExchangeButtonText}>
              Show
            </Text>
          </TouchableHighlight>
        </View>
    );
  }

  /**
   * Main component render
   * @returns {*}
   */
  render() {
    return <View style={this.styles.container}>
      <MapView
          ref={(m) => { this._map = m; }}
          style={this.styles.map}
          //region={this.state.mapRegion}
      >
        {this.state.exchanges.map((exchange, index) =>
            <Marker
                key={'marker-'+index}
                coordinate={{
                  latitude: exchange.location.lat,
                  longitude: exchange.location.long,
                }}
                title={exchange.title}
                onPress={() => {this._carousel.snapToItem(index)}}
            />
        )}
      </MapView>

      <View style={this.styles.carouselWrap}>
        <Carousel
            ref={(c) => { this._carousel = c; }}
            data={this.state.exchanges}
            renderItem={(item, index) => this.renderItem(item, index)}
            sliderWidth={width(100)}
            itemWidth={width(80)}
            containerCustomStyle={this.styles.carousel}

            onSnapToItem={(index) => this._centerMapOnMarker(index)}
        />
      </View>

      {/* Popup dialog to accept exchange */}
      <PopupDialog
          ref={(popupDialog) => { this.popupDialog = popupDialog; }}
          dialogStyle={this.styles.popupStyle}
          containerStyle={[this.styles.popupContainer, this.dialogContainerStyle]}
          width={0.8}
          height={420}
          overlayOpacity={0.3}
      >
        <View>
          {this.state.exchange.id ? <ExchangeRequest {...this.props} exchange={this.state.exchange} /> : <Text>Empty</Text>}
        </View>
      </PopupDialog>

      {/* Bottom navigation */}
      <BottomNavbar activeTab={1}/>
    </View>
  }

  /**
   * Stylesheet
   * @type {*|{panHandlers, getInteractionHandle}|{duration, create, update, delete}|{type, property}}
   */
  styles = StyleSheet.create({
    container: {
      ...StyleSheet.absoluteFillObject,
      justifyContent: 'flex-end',
      alignItems: 'center',
      flexDirection: 'column',
      paddingBottom: 60,
    },
    map: {
      ...StyleSheet.absoluteFillObject,
    },
    carouselWrap: {

    },
    carousel: {
      flexGrow: 0,
      marginBottom: 14,
    },
    carouselItemWrap: {
      alignItems: 'center',
    },
    carouselItem: {
      backgroundColor: '#ffffff',
      borderRadius: 16,
      flexDirection: 'column',
      justifyContent: 'flex-start',
      alignItems: 'center',
      paddingTop: 12,
      paddingBottom: 30,
      paddingHorizontal: 18,
      marginBottom: 20,
      alignSelf: 'stretch',
    },
    carouselItemTitleWrap: {

    },
    carouselItemTitle: {
      fontFamily: 'Roboto',
      fontSize: 16,
      color: 'rgb(112, 112, 112)',
    },
    carouselItemInfoWrap: {

    },
    carouselItemInfo: {
      fontFamily: 'Roboto',
      fontSize: 22,
      fontWeight: 'bold',
      color: 'rgb(74, 74, 74)',
    },
    carouselItemInfo2Wrap: {

    },
    carouselItemInfo2: {
      fontFamily: 'Roboto',
      fontSize: 14,
      color: 'rgb(188, 188, 188)',
    },
    avatarWrap: {
      alignItems:'center',
      justifyContent:'flex-end',
      width:40,
      height:40,
      borderRadius:20,
    },
    avatar: {
      width: 40,
      height: 40,
      resizeMode: Image.resizeMode.stretchs,
      borderRadius:20,
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
    popupContainer: {
      // marginTop: -45,
      // marginLeft: -12,
      backgroundColor: 'transparent',
      justifyContent: 'flex-end',
      paddingBottom: 153,
    },
    popupStyle: {
      //position: 'absolute',
      //bottom: 160,
      backgroundColor: 'transparent',
    },

  });
}

export default Exchanges