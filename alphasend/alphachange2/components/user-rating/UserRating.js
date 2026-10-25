import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Image,
} from 'react-native';

STAR_FULL = require('./assets/images/star-full.png');
STAR_HALF = require('./assets/images/star-half.png');
STAR_EMPTY = require('./assets/images/star-empty.png');

class UserRating extends Component {
  stars = [];

  constructor(props) {
    super(props);

    const doubledRate = Math.round(props.rating * 2);
    for(let i=0; i<10; i++) {
      let dx = Math.floor(i / 2);
      if(i < doubledRate) {
        this.stars[dx] = STAR_FULL;
      }
      else if(i === doubledRate) {
        this.stars[dx] = STAR_HALF;
      }
      else {
        this.stars[dx] = STAR_EMPTY;
      }
    }
  }

  render() {
    return (
        <View style={this.styles.container}>
          {this.stars.map((value, index) => <Image
              key={'key'+index}
              style={this.styles.image}
              source={value}
          />)}
        </View>
    );
  }

  styles = StyleSheet.create({
    // Component container
    container: {
      flex: 1,
      flexDirection: 'row',
    },
    image: {
      width: 20,
      height: 20,
      marginRight: 3,
    },
  })
}

export default UserRating