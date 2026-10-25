import React, {Component} from 'react';
import {
  StyleSheet,
  View,
  Text,
  TouchableOpacity,
} from 'react-native';

class Tabs extends Component {
  constructor(props) {
    super(props);

    this.state = {
      activeTab: props.activeTab,
    };
  }

  // Pull children out of props passed from App component
  render({ children } = this.props) {
    return (
        <View style={this.styles.container}>
          {/* Tabs row */}
          <View style={this.styles.tabsContainer}>
            {/* Pull props out of children, and pull title out of props */}
            {children.map(({ props: { title } }, index) =>
                <TouchableOpacity
                    style={[
                      // Default style for every tab
                      this.styles.tabContainer,
                      // Merge default style with styles.tabContainerActive for active tab
                      index === this.state.activeTab ? this.styles.tabContainerActive : []
                    ]}
                    // Change active tab
                    onPress={() => this.setState({ activeTab: index }) }
                    // Required key prop for components generated returned by map iterator
                    key={index}
                >
                  <Text style={[
                    this.styles.tabText,
                    index === this.state.activeTab ? this.styles.tabContainerActiveText : []
                  ]}>
                    {title}
                  </Text>
                </TouchableOpacity>
            )}
          </View>
          {/* Content */}
          <View style={this.styles.contentContainer}>
            {children[this.state.activeTab]}
          </View>
        </View>
    );
  }

  styles = StyleSheet.create({
    // Component container
    container: {
      flex: 1,
      backgroundColor: 'rgb(242, 242, 242)',
    },
    // Tabs row container
    tabsContainer: {
      flexDirection: 'row',               // Arrange tabs in a row
    },
    // Individual tab container
    tabContainer: {
      flex: 1,                            // Take up equal amount of space for each tab
      paddingVertical: 16,                // Vertical padding
      borderBottomWidth: 3,               // Add thick border at the bottom
      borderBottomColor: 'transparent',   // Transparent border for inactive tabs
    },
    // Active tab container
    tabContainerActive: {
      borderBottomColor: 'rgb(0, 197, 255)',       // Bottom border for active tabs
    },
    tabContainerActiveText: {
      color: 'rgb(74, 74, 74)',
    },
    // Tab text
    tabText: {
      color: 'rgb(178, 178, 178)',
      fontWeight: 'bold',
      textAlign: 'center',
      fontFamily: 'Roboto',
    },
    // Content container
    contentContainer: {
      flex: 1                             // Take up all available space
    }
  })
}

export default Tabs