import React, {Component} from 'react';
import {GiftedChat} from "react-native-gifted-chat";
import firebase from "react-native-firebase";

export default class ChatScreen extends Component {
  constructor(props) {
    super(props);

    this._chatRef = null;
    this._ref = null;

    this.state = {
      messages: [],
    };
  }

  componentWillMount() {
    const chatsRef = firebase.database().ref('/chats');
    this._chatRef = chatsRef.child(this.props.chatId);
    this._ref = this._chatRef.child('messages');

    this._chatRef.on('value', (snapshot) => {
      // do smth with chat value: display title, etc
    });

    this._ref.on('value', (messages) => {
      if(messages.exists()) {
        const msgObj = messages.val();
        let messageList = [];
        const keyNames = Object.keys(msgObj);
        keyNames.map((id) => {
          messageList.push(msgObj[id])
        });

        this.setState({
          messages: messageList,
        });
      }
    });
  }

  onSend = (messages) => {
    messages.map((message) => {
      this._ref.push(message)
    })
  };

  render() {
    return (
        <GiftedChat
            messages={this.state.messages}
            onSend={messages => this.onSend(messages)}
            user={{
              _id: this.props.user.id,
              name: this.props.user.settings.name,
              avatar: 'http://b.alphachange.ru' + this.props.user.settings.avatar,
            }}
        />
    )
  }
};
