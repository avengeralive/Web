import React, {Component} from 'react';
import {withNavigation} from 'react-navigation';
import {Image, StyleSheet, Text, TouchableHighlight, View} from 'react-native';
import LinearGradient from 'react-native-linear-gradient';

class BottomNavbar extends Component {
  constructor(props) {
    super(props)
  }

  render() {
    return (
        <View style={this.styles.bar}>
          <TouchableHighlight
              style={(this.props.activeTab === 0) ? [
                this.styles.button,
                /*this.styles.buttonActive*/
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('Dashboard')}
          >
            <View style={this.styles.buttonView}>
              <Image
                  style={this.styles.buttonImage}
                  source={require('../../assets/images/icons/profile.png')}
              />
              <LinearGradient
                start={{x: 0.0, y: 0.5}} end={{x: 1.0, y: 0.5}}
                colors={['#00cdff', '#1163ff']}
                style={(this.props.activeTab === 0) ? [
                this.styles.gradActive
              ] : this.styles.grad}>
              </LinearGradient>
            </View>
          </TouchableHighlight>

          <TouchableHighlight
              style={(this.props.activeTab === 1) ? [
                this.styles.button,
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('Exchanges')}
          >
            <View style={this.styles.buttonView}>
              <Image
                  style={this.styles.buttonImage}
                  source={require('../../assets/images/icons/search.png')}
              />
              <LinearGradient
                  start={{x: 0.0, y: 0.5}} end={{x: 1.0, y: 0.5}}
                  colors={['#00cdff', '#1163ff']}
                  style={(this.props.activeTab === 1) ? [
                  this.styles.gradActive
                ] : this.styles.grad}>
                </LinearGradient>
              </View>
          </TouchableHighlight>

          <TouchableHighlight
              style={(this.props.activeTab === 2) ? [
                this.styles.button,
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('CreateExchanges')}
          >
            <View style={this.styles.buttonView}>
              <Image
                  style={this.styles.buttonImage}
                  source={require('../../assets/images/icons/plus.png')}
              />
              <LinearGradient
                  start={{x: 0.0, y: 0.5}} end={{x: 1.0, y: 0.5}}
                  colors={['#00cdff', '#1163ff']}
                  style={(this.props.activeTab === 2) ? [
                  this.styles.gradActive
                ] : this.styles.grad}>
                </LinearGradient>
              </View>
          </TouchableHighlight>

          <TouchableHighlight
              style={(this.props.activeTab === 3) ? [
                this.styles.button,
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('ChatsList')}
          >
            <View style={this.styles.buttonView}>
              <Image
                  style={this.styles.buttonImage}
                  source={require('../../assets/images/icons/comment.png')}
              />
              <LinearGradient
                  start={{x: 0.0, y: 0.5}} end={{x: 1.0, y: 0.5}}
                  colors={['#00cdff', '#1163ff']}
                  style={(this.props.activeTab === 3) ? [
                  this.styles.gradActive
                ] : this.styles.grad}>
                </LinearGradient>
              </View>
          </TouchableHighlight>
        </View>
    )
  }

  styles = StyleSheet.create({
    grad: {
      height: 0,
      width: '100%',
      bottom: 0,
    },
    gradActive: {
      height: 3,
      width: '100%',
      bottom: -11,
    },
    bar: {
      flex: 1,
      flexDirection: 'row',
      backgroundColor: '#ffffff',
      position: 'absolute',
      'bottom': 0,
      'left': 0,
      'width': '100%'
    },
    buttonView: {
      flex: 1,
      height: 56,
      width: '100%',
      alignItems: 'center',
      justifyContent: 'center',
    },
    button: {
      flex: 1,
      height: 56,
      alignItems: 'center',
      justifyContent: 'center',
    },
    buttonActive: {
      borderBottomColor: 'rgb(0, 197, 255)',       // Bottom border for active tabs
    },
    buttonImage: {
      width: 32,
      height: 32,
      resizeMode: Image.resizeMode.contain,
    },
  })
}
export default withNavigation(BottomNavbar)