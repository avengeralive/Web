import React, {Component} from 'react';
import {withNavigation} from 'react-navigation';
import {Image, StyleSheet, TouchableHighlight, View} from 'react-native';

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
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('Dashboard')}
          >
            <Image
                style={this.styles.buttonImage}
                source={require('../../assets/images/icons/profile.png')}
            />
          </TouchableHighlight>

          <TouchableHighlight
              style={(this.props.activeTab === 1) ? [
                this.styles.button,
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('Exchanges')}
          >
            <Image
                style={this.styles.buttonImage}
                source={require('../../assets/images/icons/search.png')}
            />
          </TouchableHighlight>

          <TouchableHighlight
              style={(this.props.activeTab === 2) ? [
                this.styles.button,
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('CreateExchanges')}
          >
            <Image
                style={this.styles.buttonImage}
                source={require('../../assets/images/icons/plus.png')}
            />
          </TouchableHighlight>

          <TouchableHighlight
              style={(this.props.activeTab === 3) ? [
                this.styles.button,
                this.styles.buttonActive
              ] : this.styles.button}
              onPress={() => this.props.navigation.navigate('ChatsList')}
          >
            <Image
                style={this.styles.buttonImage}
                source={require('../../assets/images/icons/comment.png')}
            />
          </TouchableHighlight>
        </View>
    )
  }

  styles = StyleSheet.create({
    bar: {
      flex: 1,
      flexDirection: 'row',
      backgroundColor: '#ffffff',
      position: 'absolute',
      'bottom': 0,
      'left': 0,
      'width': '100%'
    },
    button: {
      flex: 1,
      height: 56,
      alignItems: 'center',
      justifyContent: 'center',
      borderBottomWidth: 3,               // Add thick border at the bottom
      borderBottomColor: 'transparent',
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