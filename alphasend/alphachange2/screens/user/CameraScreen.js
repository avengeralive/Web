import React, {Component} from 'react';
import {StyleSheet, Text, TouchableOpacity, View} from 'react-native';
import {RNCamera} from 'react-native-camera';
import {withNavigation} from 'react-navigation';

export default class CameraScreen extends withNavigation(Component) {
  constructor(props) {
    super(props);
  }

  render() {
    return (
        <View style={styles.container}>
          <RNCamera
              ref={ref => {
                this.camera = ref;
              }}
              type={RNCamera.Constants.Type.front}
              style = {styles.preview}
              flashMode={RNCamera.Constants.FlashMode.off}
              ratio={'1:1'}
              permissionDialogTitle={'Permission to use camera'}
              permissionDialogMessage={'We need your permission to use your camera phone'}
          />
          <View style={{flex: 0, flexDirection: 'row', justifyContent: 'center',}}>
            <TouchableOpacity
                onPress={this.takePicture.bind(this)}
                style={styles.takeShotButton}
            >
              <Text style={styles.takeShotButtonText}> SNAP </Text>
            </TouchableOpacity>
          </View>
        </View>
    );
  }

  takePicture = async function() {
    if (this.camera) {
      const options = { quality: 0.5, base64: true };
      const data = await this.camera.takePictureAsync(options);
      const formData = new FormData();
      formData.append('user_id', this.props.user.id);
      formData.append('userAvatar', {
        uri: data.uri,
        type: 'image/jpeg',
        name: 'avatar.jpg',
      });
      return fetch('http://b.alphachange.ru/api/user/upload?token=' + this.props.user.accessToken, {
        method: 'post',
        body: formData
      })
      .then(() => {
        return fetch('http://b.alphachange.ru/api/user-settings/' + this.props.user.settings.id + '?expand=defaultLocation,defaultCurrency&token=' + this.props.user.accessToken)
            .then((response) => {
              return response.json()
            })
            .then((userSettings) => {
              const updatedUser = this.props.user;
              updatedUser.settings = userSettings;
              return this.props.setUser(updatedUser);
            })
            .catch((err) => alert(err));
      })
      .then(() => {
        this.props.navigation.navigate('Dashboard', {
          activeTab: 1,
        });
      })
      .catch((error) => {
        alert("Error saving settings!\n" + error);
      });
    }
  };
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    flexDirection: 'column',
    backgroundColor: 'black'
  },
  preview: {
    flex: 1,
    justifyContent: 'flex-end',
    alignItems: 'center'
  },
  capture: {
    flex: 0,
    backgroundColor: '#fff',
    borderRadius: 5,
    padding: 15,
    paddingHorizontal: 20,
    alignSelf: 'center',
    margin: 20
  },
  takeShotButtonText: {
    fontSize: 20,
    color: 'rgb(30, 81, 197)',
    fontFamily: 'Roboto-bold',
    fontWeight: 'bold',
  },
  takeShotButton: {
    borderRadius: 25,
    marginTop: 6,
    backgroundColor: 'transparent',
    borderWidth: 2,
    borderColor: 'rgb(30, 81, 197)',
    height: 50,
    justifyContent: 'center',           // Center vertically
    alignItems: 'center',               // Center horizontally
    paddingHorizontal: 32,
    marginHorizontal: 48,
  },
});

