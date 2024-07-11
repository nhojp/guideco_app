const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const cors = require('cors'); // Import CORS middleware

const app = express();
const port = 3000;

// Create connection pool
const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'guideco'
});

// Middleware
app.use(cors()); // Enable CORS for all routes
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

// Login endpoint
app.post('/login', (req, res) => {
  const { username, password } = req.body;

  pool.query(
    'SELECT id, username, password, email, first_name, middle_name, last_name, birthdate, sex, religion, grade, section, contact_number FROM users WHERE username = ? AND password = ?',
    [username, password],
    (err, results) => {
      if (err) {
        res.status(500).json({ error: 'Database error' });
      } else {
        if (results.length > 0) {
          const user = results[0];
          res.json(user);
        } else {
          res.status(401).json({ error: 'Invalid username or password' });
        }
      }
    }
  );
});

// Profile endpoint
app.get('/profile', (req, res) => {
  const userId = req.query.userId;

  pool.query(
    'SELECT id, username, email, first_name, middle_name, last_name, birthdate, sex, religion, grade, section, contact_number FROM users WHERE id = ?',
    [userId],
    (err, results) => {
      if (err) {
        res.status(500).json({ error: 'Database error' });
      } else {
        if (results.length > 0) {
          const userProfile = results[0];
          res.json(userProfile);
        } else {
          res.status(404).json({ error: 'User not found' });
        }
      }
    }
  );
});

// Start server
app.listen(port, () => {
  console.log(`Server is running on http://localhost:${port}`);
});
