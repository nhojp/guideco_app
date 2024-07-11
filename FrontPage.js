import React, { useState } from 'react';
import { View, Text, ImageBackground, StyleSheet, TouchableOpacity } from 'react-native';
import AppLoading from 'expo-app-loading';
import { useFonts, Montserrat_900Black } from '@expo-google-fonts/montserrat';
import config from './frontPageConfig.json';

export default function FrontPage({ navigation }) {
  const [fontsLoaded] = useFonts({
    Montserrat_900Black,
  });

  const [isLoading, setIsLoading] = useState(!fontsLoaded); // Set isLoading initially based on font loading

  const handleContinue = () => {
    navigation.navigate('Login');
  };

  if (!fontsLoaded) {
    return <AppLoading />;
  }

  return (
    <View style={styles.container}>
      <ImageBackground source={require('./school.jpg')} style={styles.backgroundImage}>
        <View style={styles.overlay}>
          <Text style={styles.title}>{config.frontPage.title.text}</Text>
          <Text style={styles.subtitle}>{config.frontPage.subtitle.text}</Text>
          <TouchableOpacity onPress={handleContinue}>
            <Text style={styles.linkText}>Continue to Login</Text>
          </TouchableOpacity>
        </View>
      </ImageBackground>
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  backgroundImage: {
    width: '100%',
    height: '100%',
    justifyContent: 'center',
    alignItems: 'center',
  },
  overlay: {
    flex: 1,
    backgroundColor: 'rgba(0, 102, 51, 0.7)',
    justifyContent: 'center',
    alignItems: 'center',
    width: '100%',
    padding: 20,
  },
  title: {
    fontFamily: 'Montserrat_900Black',
    fontSize: config.frontPage.title.fontSize,
    color: config.frontPage.title.color,
    textAlign: config.frontPage.title.textAlign,
  },
  subtitle: {
    fontFamily: 'Montserrat_900Black',
    fontSize: config.frontPage.subtitle.fontSize,
    color: config.frontPage.subtitle.color,
    textAlign: config.frontPage.subtitle.textAlign,
    marginTop: config.frontPage.subtitle.marginTop,
    marginHorizontal: config.frontPage.subtitle.marginHorizontal,
  },
  linkText: {
    fontFamily: 'Montserrat_900Black',
    fontSize: 12,
    color: '#FFFFFF',
    marginTop: 200,
    textDecorationLine: 'underline',
  },
});
