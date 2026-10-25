import React, {Component} from 'react';
import Exchanges from '../../components/exchanges/Exchanges.js'

export default class ExchangesScreen extends Component {
  constructor(props) {
    super(props)
  }

  render() {
    return <Exchanges {...this.props}/>
  }
};
