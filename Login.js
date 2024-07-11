import React from 'react';
import { View, Text, TextInput, TouchableOpacity, StyleSheet } from 'react-native';
import { useFonts, Montserrat_400Regular } from '@expo-google-fonts/montserrat';
import AppLoading from 'expo-app-loading';
import config from './loginConfig.json';

export default function Login() {
  let [fontsLoaded] = useFonts({
    Montserrat_400Regular,
  });

  if (!fontsLoaded) {
    return <AppLoading />;
  }

  return (
    <View style={styles.container}>
      <Text style={styles.header}>{config.login.header}</Text>
      <View style={styles.inputContainer}>
        <TextInput style={styles.input} placeholder="Username" />
      </View>
      <View style={styles.inputContainer}>
        <TextInput style={styles.input} placeholder="Email" keyboardType="email-address" />
      </View>
      <View style={styles.inputContainer}>
        <TextInput style={styles.input} placeholder="Password" secureTextEntry={true} />
      </View>
      <View style={styles.inputContainer}>
        <TextInput style={styles.input} placeholder="Confirm Password" secureTextEntry={true} />
      </View>
      <TouchableOpacity style={styles.button}>
        <Text style={styles.buttonText}>Login</Text>
      </TouchableOpacity>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: '#FFFFFF',
  },
  header: {
    fontFamily: 'Montserrat_400Regular',
    fontSize: 30,
    color: '#000000',
    marginBottom: 20,
  },
  inputContainer: {
    width: '80%',
    marginVertical: 10,
  },
  input: {
    height: 50,
    borderWidth: 1,
    borderColor: '#DDDDDD',
    borderRadius: 5,
    paddingHorizontal: 10,
    fontFamily: 'Montserrat_400Regular',
  },
  button: {
    backgroundColor: '#006633',
    paddingVertical: 15,
    paddingHorizontal: 30,
    borderRadius: 5,
    marginTop: 20,
    width: '80%',
    justifyContent: 'center',
    alignItems: 'center',
    
  },
  buttonText: {
    color: '#FFFFFF',
    fontFamily: 'Montserrat_400Regular',
    fontSize: 16,
    
    
  },
});
