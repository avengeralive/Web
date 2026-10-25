
/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 * @flow
 */

import React, {Component} from 'react';
import Locations from '../../components/locations/Locations.js'

export default class LocationScreen extends Component {
  constructor(props) {
    super(props);
  }

  render() {
    return <Locations {...this.props}/>
  }
};
