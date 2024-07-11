import React, { useEffect, useState } from 'react';
import { View, Text, ActivityIndicator, StyleSheet } from 'react-native';

const Profile = ({ route }) => {
  const { userData } = route.params || {};
  const [profileData, setProfileData] = useState(null);

  useEffect(() => {
    if (userData) {
      fetchProfileData(userData.id);
    }
  }, [userData]); // Trigger fetchProfileData when userData changes

  const fetchProfileData = async (userId) => {
    try {
      const response = await fetch(`http://192.168.1.2:3000/profile?userId=${userId}`);

      if (!response.ok) {
        throw new Error('Failed to fetch profile data');
      }

      const profile = await response.json();
      setProfileData(profile);
    } catch (error) {
      console.error(error);
      // Handle error
    }
  };

  if (!profileData) {
    return (
      <View style={styles.loadingContainer}>
        <ActivityIndicator size="large" color="#0000ff" />
      </View>
    );
  }

  return (
    <View style={styles.container}>
      <Text>ID: {profileData.id}</Text>
      <Text>Username: {profileData.username}</Text>
      <Text>Email: {profileData.email}</Text>
      <Text>First Name: {profileData.first_name}</Text>
      <Text>Middle Name: {profileData.middle_name}</Text>
      <Text>Last Name: {profileData.last_name}</Text>
      <Text>Birthdate: {profileData.birthdate}</Text>
      <Text>Sex: {profileData.sex}</Text>
      <Text>Religion: {profileData.religion}</Text>
      <Text>Grade: {profileData.grade}</Text>
      <Text>Section: {profileData.section}</Text>
      <Text>Contact Number: {profileData.contact_number}</Text>
    </View>
  );
};

const styles = StyleSheet.create({
  container: {
    flex: 1,
    padding: 20,
    backgroundColor: '#fff',
  },
  loadingContainer: {
    flex: 1,
    alignItems: 'center',
    justifyContent: 'center',
  },
});

export default Profile;
