import React from 'react';
import { View, Text, StyleSheet } from 'react-native';

const Chatbot = () => {
  return (
    <View style={styles.container}>
      <Text style={styles.text}>Chatbot Screen</Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  text: {
    fontSize: 20,
  },
});

export default Chatbot;
